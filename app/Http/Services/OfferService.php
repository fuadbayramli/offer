<?php

namespace App\Http\Services;

use App\Exceptions\AlreadyLikedException;
use App\Http\Repositories\Offer\OfferFileRepository;
use App\Http\Repositories\Offer\OfferVideoRepository;
use App\Http\Repositories\Offer\OfferLikeRepository;
use App\Http\Repositories\Offer\OfferRepository;
use App\Offer;
use App\OfferFile;
use App\OfferVideo;
use App\OfferLike;
use App\Category;
use App\District;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class OfferService
 *
 * @package App\Http\Services
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferService
{
    /**
     * @var string
     */
     protected $guard = 'site-user';

    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * @var OfferFileRepository
     */
    protected $offerFileRepository;

    /**
     * @var OfferVideoRepository
     */
    protected $offerVideoRepository;

    /**
     * @var OfferLikeRepository;
     */
    protected $offerLikeRepository;

    /**
     * OfferService constructor.
     *
     * @param OfferRepository $offerRepository
     * @param OfferFileRepository $offerFileRepository
     * @param OfferVideoRepository $offerVideoRepository
     * @param OfferLikeRepository $offerLikeRepository
     */
    public function __construct(
        OfferRepository $offerRepository,
        OfferFileRepository $offerFileRepository,
        OfferVideoRepository $offerVideoRepository,
        OfferLikeRepository $offerLikeRepository
    )
    {
        $this->offerRepository = $offerRepository;
        $this->offerFileRepository = $offerFileRepository;
        $this->offerVideoRepository = $offerVideoRepository;
        $this->offerLikeRepository = $offerLikeRepository;
    }

    /**
     * Create New Offer
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $offer = $this->offerRepository->create((new OfferDataFactory($data))->getData());

        $data['offer_id'] = $offer->id;
        if (isset($data['images']) && $data['images']) {
            $paths = $this->filePaths($data['images']);
            $this->offerFileRepository->insert((new OfferFileDataFactory($paths, ['offer_id' => $data['offer_id']]))->getData());
        }
        if (isset($data['videos']) && $data['videos']) {
            $paths = $this->videoUpload($data['videos']);
            $this->offerVideoRepository->insert((new OfferVideoDataFactory($paths, ['offer_id' => $data['offer_id']]))->getData());
        }
        return $offer;
    }

    public function update(int $id, array $data)
    {
        $offer = $this->offerRepository->update($id, [
            'title' => $data['title'],
            'area' => $data['area'],
            'category_id' => $data['category_id'] ?? 0,
            'district_id' => $data['district_id'] ?? 0,
            'description' => $data['description'],
            'anonymous' => $data['anonymous'] ?? 0
        ]);

        if (isset($data['images']) && $data['images']) {
            $paths = $this->filePaths($data['images']);
            $this->offerFileRepository->insert((new OfferFileDataFactory($paths, ['offer_id' => $id]))->getData());
        }
        if (isset($data['videos']) && $data['videos']) {
            $paths = $this->videoUpload($data['videos']);
            $this->offerVideoRepository->insert((new OfferVideoDataFactory($paths, ['offer_id' => $id]))->getData());
        }

        return $offer;
    }

    /**
     * Upload offer files
     *
     * @param array $files
     * @return array
     */
    protected function fileUpload(array $files): array
    {
        $paths = [];
        foreach($files as $file) {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $directory =  OfferFile::TYPE_IMAGE ;
            $fullPath = $directory . '/' . date('Y-m-d') . '/' . $filename;
            $paths[] = $fullPath;

            Storage::disk()->put($fullPath, file_get_contents($file));
        }

        return $paths;
    }

    protected function filePaths(array $files): array
    {
        $paths = [];

        foreach($files as $file) {
            $paths[] = $file;
        }

        return $paths;
    }

    /**
     * Upload offer videos
     *
     * @param array $files
     * @return array
     */
    protected function videoUpload(array $files): array
    {
        $paths = [];
        foreach($files as $file) {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $directory =  OfferVideo::TYPE_VIDEO;
            $fullPath = $directory . '/' . date('Y-m-d') . '/' . $filename;
            $paths[] = $fullPath;

            Storage::disk()->put($fullPath, file_get_contents($file));
        }

        return $paths;
    }

    public function like(array $data)
    {
       $offer = $this->offerRepository->show($data['id']);

       $this->checkLikeStatus($offer);

       $offerLike = $this->offerLikeRepository->create([
          'offer_id' => $offer['id'],
          'user_id' => Auth::guard($this->guard)->id()
       ]);

       return $offerLike;
    }

    /**
     * Client Like status
     *
     * @param array $data
     * @return bool
     * @throws AlreadyLikedException
     */
    public function checkLikeStatus(array $data): bool
    {
        $credentials = $this->getLikeData($data['id']);

        $like = OfferLike::where($credentials)->first();

        if ($like) {
            throw new AlreadyLikedException();
        }

        return true;
    }

    /**
     * Get like data
     *
     * @param int $offer_id
     * @return array
     */
    public function getLikeData(int $offer_id): array
    {
        return [
            'offer_id' => $offer_id,
            'user_id' => Auth::guard($this->guard)->id(),
        ];
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|mixed
     */
    public function findById(int $id)
    {
        $offer = $this->offerRepository->show($id);
        $credentials = $this->getLikeData($id);

        $liked = OfferLike::where($credentials)->first();

        if($liked) {
           $offer['liked'] = true;
        }else {
           $offer['liked'] = false;
        }

        return $offer;
    }

    /**
     * Search by category and district
     *
     * @return mixed|null
     */
    public function search()
    {
        $where = [];

        if (request()->category_id) {
            $where['category_id'] = request()->category_id;
        }
        if (request()->district_id) {
            $where['district_id'] = request()->district_id;
        }

        $offers = $this->offerRepository
            ->findByWhere($where);
        return $offers;
    }

}

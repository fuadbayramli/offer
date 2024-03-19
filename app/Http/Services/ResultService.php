<?php

namespace App\Http\Services;

use App\Exceptions\AlreadyLikedException;
use App\Http\Repositories\Result\ResultLikeRepository;
use App\Http\Repositories\Result\ResultRepository;
use App\ResultLike;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ResultService
 *
 * @package App\Http\Services
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultService
{
    /**
     * @var string
     */
     protected $guard = 'site-user';

    /**
     * @var ResultRepository
     */
    protected $resultRepository;

    /**
     * @var ResultLikeRepository;
     */
    protected $resultLikeRepository;

    /**
     * ResultService constructor.
     *
     * @param ResultRepository $resultRepository
     * @param ResultLikeRepository $resultLikeRepository
     */
    public function __construct(
        ResultRepository $resultRepository,
        ResultLikeRepository $resultLikeRepository
    )
    {
        $this->resultRepository = $resultRepository;
        $this->resultLikeRepository = $resultLikeRepository;
    }

    public function like(array $data)
    {
       $result = $this->resultRepository->show($data['id']);

       $this->checkLikeStatus($result);

       $resultLike = $this->resultLikeRepository->create([
          'result_id' => $result['id'],
          'user_id' => Auth::guard($this->guard)->id()
       ]);

       return $resultLike;
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

        $like = ResultLike::where($credentials)->first();

        if ($like) {
            throw new AlreadyLikedException();
        }

        return true;
    }

    /**
     * Get like data
     *
     * @param int $result_id
     * @return array
     */
    public function getLikeData(int $result_id): array
    {
        return [
            'result_id' => $result_id,
            'user_id' => Auth::guard($this->guard)->id(),
        ];
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|mixed
     */
    public function findById(int $id)
    {
        $result = $this->resultRepository->show($id);
        $credentials = $this->getLikeData($id);

        $liked = ResultLike::where($credentials)->first();

        if ($liked) {
           $result['liked'] = true;
        } else {
           $result['liked'] = false;
        }

        return $result;
    }

    /**
     * Search by category and district
     *
     * @return mixed|null
     */
    public function search()
    {
        $results = $this->resultRepository
            ->findByWhere([
                           'category_id' => request()->category_id,
                           'district_id' => request()->district_id
                          ]);
        return $results;
    }
}

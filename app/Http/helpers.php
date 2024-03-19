<?php

use App\OfferFile;
use App\OfferVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Upload offer files
 *
 * @param array $files
 * @return array
 */
function fileUpload(array $files): array
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

/**
 * Upload offer videos
 *
 * @param array $files
 * @return array
 */
function videoUpload(array $files): array
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

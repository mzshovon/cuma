<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

if (!function_exists('customPaginate')) {
    /**
     * @param mixed $items
     * @param int $perPage
     * @param null $page
     *
     * @return mixed
     */
    function customPaginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}

if (!function_exists('getUserInfo')) {
    /**
     * @return mixed
     */
    function getUserInfo()
    {
        return auth()->user();
    }
}

if (!function_exists('storeOrUpdateImage')) {
    /**
     * @return mixed
     */
    function storeOrUpdateImage($filePath, $file)
    {
        if(!File::exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
        $fileName = "profile_image.".$file->getClientOriginalExtension();
        $dirPath = $filePath . $fileName;
        if (File::exists($dirPath)) {
            File::deleteDirectory($dirPath);
        }
        file_put_contents($dirPath, file_get_contents($file));
        return $dirPath;
    }
}


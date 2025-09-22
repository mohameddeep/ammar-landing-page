<?php

namespace App\Http\Traits;

trait FileManager
{
    /**
     * Validates the file from the request & persists it into storage
     *
     * @param  string  $requestAttributeName  from request
     * @param  string  $folder
     * @param  string  $disk
     * @return string $path
     */
    public function upload($requestAttributeName = null, $folder = '', $disk = 'public')
    {
        $path = null;
        if (request()->hasFile($requestAttributeName) && request()->file($requestAttributeName)->isValid()) {

            $path = 'storage/'.request()->file($requestAttributeName)->store($folder, $disk);
        }

        return $path;
    }

    public function uploadFile($file, $folder = '', $disk = 'public')
    {
        return 'storage/'.$file->store($folder, $disk);
    }

    /**
     * Validates the file from the request & persists it into storage then unlink old one
     *
     * @param  string  $requestAttributeName  from request
     * @param  string  $folder
     * @param  string  $oldPath
     * @return string $path
     */
    public function updateFile($requestAttributeName, $folder, $oldPath)
    {
        $path = null;
        if (request()->hasFile($requestAttributeName) && request()->file($requestAttributeName)->isValid()) {
            $path = $this->upload($requestAttributeName, $folder);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        return $path;
    }

    /**
     * Delete the file from the path
     *
     * @param  string  $oldPath
     */
    public function deleteFile($oldPath)
    {
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
}

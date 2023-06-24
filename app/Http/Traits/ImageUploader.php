<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageUploader
{
    protected function UploadImage($file , $base_folder , $folder)
    {
        $year = Carbon::now()->year;
        $mouth = Carbon::now()->month;
        $day = Carbon::now()->day;

        $base_folder = str_contains($base_folder, '.') ? str_replace('.', '-', $base_folder) : $base_folder;
        $folder = str_contains($folder, '.') ? str_replace('.', '-', $folder) : $folder;

        $imagePath = "/uploads/{$base_folder}/{$year}-{$mouth}-{$day}/{$folder}/";
        $filename = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalName();

        $file = $file->move(public_path($imagePath) ,$filename);

        $sizes = ["300" ,"600" ,"900"];
        $url['images'] = $this->Resize($file->getRealPath() ,$sizes ,$imagePath ,$filename);
        $url['thumb'] = $url['images'][$sizes[0]];

        return $url;
    }

    protected static function UploadMultipleImages($file , $base_folder , $folder)
    {
        $images = [];

        $year = Carbon::now()->year;
        $mouth = Carbon::now()->month;
        $day = Carbon::now()->day;

        $base_folder = str_contains($base_folder, '.') ? str_replace('.', '-', $base_folder) : $base_folder;
        $folder = str_contains($folder, '.') ? str_replace('.', '-', $folder) : $folder;

        $imagePath = "/uploads/{$base_folder}/{$year}-{$mouth}-{$day}/{$folder}/";

        foreach ($file as $caption)
        {
            $filename = Str::random(20) . '-' . time() . '.' . $caption->getClientOriginalName();
            $caption->move(public_path($imagePath) ,$filename);

            array_push($images , $imagePath . $filename);
        }

        return $images;
    }

    private function Resize($path ,$sizes ,$imagePath ,$filename)
    {
        $images['original'] = $imagePath . $filename;
        foreach ($sizes as $size) {
            $images[$size] = $imagePath . "{$size}_" . $filename;

            Image::make($path)->resize($size ,null ,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($images[$size]));
        }

        return $images;
    }
}

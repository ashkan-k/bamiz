<?php

namespace App\Http\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait Uploader
{
    private function Upload($file , $base_folder , $folder)
    {
        $year = Carbon::now()->year;
        $mouth = Carbon::now()->month;
        $day = Carbon::now()->day;

        $base_folder = str_contains($base_folder, '.') ? str_replace('.', '-', $base_folder) : $base_folder;
        $folder = str_contains($folder, '.') ? str_replace('.', '-', $folder) : $folder;

        $imagePath = "/uploads/{$base_folder}/{$year}-{$mouth}-{$day}/{$folder}/";
        $filename = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalName();

        $file->move(public_path($imagePath) ,$filename);
        return $imagePath . $filename;
    }

    private function UploadRealTime($file , $base_folder , $folder)
    {
        $year = Carbon::now()->year;
        $mouth = Carbon::now()->month;
        $day = Carbon::now()->day;

        $base_folder = str_contains($base_folder, '.') ? str_replace('.', '-', $base_folder) : $base_folder;
        $folder = str_contains($folder, '.') ? str_replace('.', '-', $folder) : $folder;

        $imagePath = "/uploads/{$base_folder}/{$year}-{$mouth}-{$day}/{$folder}/";
        $filename = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalName();

        $file->storeAs($imagePath ,$filename, 'real_public');
        return $imagePath . $filename;
    }

    public function UploadFile($request, $name, $base_folder , $folder, $default=null)
    {
        $file = $request->hasFile($name) ? $this->Upload($request->file($name) , $base_folder, $folder) : $default;
        return $file;
    }
}

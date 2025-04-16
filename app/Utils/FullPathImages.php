<?php


namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class FullPathImages
{
  public static function getFullPathImages(array | null $images): array
  {
    if ($images === null) return [];

    if (is_array($images)) {
      return array_map(fn($image) => asset(Storage::url($image)), $images);
    }

    return [];
  }
}
<?php

namespace App\Services;

class FileService
{
    public static function generateFolderAndFile(string $folder, string $file): bool
    {
        $filePath = $folder.$file;

        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (! file_exists($filePath)) {
            touch($filePath);
        }

        return is_dir($folder) && file_exists($filePath);

    }
}

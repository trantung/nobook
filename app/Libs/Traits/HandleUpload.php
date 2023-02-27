<?php

namespace App\Libs\Traits;

trait HandleUpload
{
    /**
     * @param string $data
     * @param string $destinationPath
     * @param string $uniqueName
     * @return string
     */
    protected function uploadImageBase64(string $data, string $destinationPath, $uniqueName = 'nobook'): string
    {
        $this->ensureDestinationDirectoryExists($destinationPath);

        $base64Image = explode(";base64,", $data);
        $extension = explode("image/", $base64Image[0])[1];

        $fileName = uniqid($uniqueName) . '.' . $extension;
        file_put_contents($destinationPath.'/'.$fileName, base64_decode($base64Image[1]));

        return $fileName;
    }

    /**
     * @param $file
     * @param string $destinationPath
     * @param string $uniqueName
     * @return string
     */
    protected function uploadImage($file, string $destinationPath, $uniqueName = 'nobook'): string
    {
        $this->ensureDestinationDirectoryExists($destinationPath);

        if ($file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid($uniqueName) . '.' . $extension;
            $file->move($destinationPath, $fileName);

            return $fileName;
        }

        return false;
    }

    /**
     * @param string $filePath
     */
    protected function removeImage(string $filePath = '')
    {
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * @param string $destinationPath
     * @return bool
     */
    private function ensureDestinationDirectoryExists(string $destinationPath): bool
    {
        if (! is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
            $gitignore = '.gitignore';
            $text = "*\n!.gitignore\n";
            file_put_contents($destinationPath.'/'.$gitignore, $text);
        }

        return true;
    }
}

<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    /**
     * Upload an image file and update the specified model's column with the file path.
     *
     * @param string       $inputName   The name of the file input field.
     * @param string       $column      The column in the database where the file path will be stored.
     * @param string       $folder      The folder where the image will be stored.
     * @param Model        $entry       The model instance to be updated.
     * @return void
     */
    public function uploadImg(string $inputName, string $column, string $folder, Model $entry): void
    {
        if (request()->hasFile($inputName)) {
            $uploadedFile = request()->file($inputName);

            if ($uploadedFile instanceof UploadedFile) {
                $folderPath = 'uploads/' . $folder . '/' . uniqid('', true);
                $filePath = $uploadedFile->store($folderPath, 'public');

                // Delete the previous image if it exists
                $this->deletePreviousImage($entry->$column);

                // Update the model with the new file path
                $entry->update([$column => $filePath]);
            }
        }
    }

    /**
     * Delete the previous image from storage.
     *
     * @param string|null $filePath The path of the file to be deleted.
     * @return void
     */
    protected function deletePreviousImage(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}

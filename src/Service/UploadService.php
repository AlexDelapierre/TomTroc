<?php

namespace App\Service;

use Exception;

class UploadService
{
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Gère l'upload d'une image.
    public function uploadImage(array $file, string $destinationDir, string $prefix = '', ?string $oldFilename = null): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur lors de l'upload du fichier.");
        }

        $tmpPath = $file['tmp_name'];
        $filename = $file['name'];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $this->allowedExtensions)) {
            throw new Exception("Format d'image non supporté.");
        }

        $newFilename = uniqid($prefix) . '.' . $ext;
        $destination = rtrim($destinationDir, '/') . '/' . $newFilename;

        if (move_uploaded_file($tmpPath, $destination)) {
            // Suppression de l'ancien fichier si fourni
            if ($oldFilename && file_exists(rtrim($destinationDir, '/') . '/' . $oldFilename)) {
                unlink(rtrim($destinationDir, '/') . '/' . $oldFilename);
            }

            return $newFilename;
        }

        throw new Exception("Erreur lors de la sauvegarde de l'image.");
    }
}

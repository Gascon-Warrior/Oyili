<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder = '', ?int $width = 250, ?int $height = 250)
    {
        $originalName = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
        $sanitizedOriginalName = preg_replace('/[^a-zA-Z0-9_-]/', '-', $originalName);
        $fichier = $sanitizedOriginalName . '-' . md5(uniqid(rand(), true));

        // Récupération des infos de l'image
        $picture_infos = getimagesize($picture->getPathname());

        if ($picture_infos === false && $picture->getClientMimeType() !== 'image/svg+xml') {
            throw new Exception('Format d\'image incorrect');
        }

        $path = $this->params->get('images_directory') . $folder;
        // Traitement spécifique pour SVG
        if ($picture->getClientMimeType() === 'image/svg+xml') {
            $fichier .= '.svg';
            $path = $this->params->get('images_directory') . $folder; // Utiliser un dossier spécifique pour les SVG
        } else {
            if ($picture_infos === false) {
                throw new Exception('Format d\'image incorrect');
            }

            switch ($picture_infos['mime']) {
                case 'image/jpeg':
                    $image_resource = imagecreatefromjpeg($picture->getPathname());
                    break;
                case 'image/png':
                    $image_resource = imagecreatefrompng($picture->getPathname());
                    break;
                case 'image/gif':
                    $image_resource = imagecreatefromgif($picture->getPathname());
                    break;
                default:
                    throw new Exception('Format d\'image non supporté');
            }
            $fichier .= '.webp';
        }

        // Assurez-vous que le dossier existe
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $destinationPath = $path . '/' . $fichier;

        if ($picture->getClientMimeType() === 'image/svg+xml') {
            // Déplacez le fichier SVG sans conversion
            move_uploaded_file($picture->getPathname(), $destinationPath);
        } else {
            // Conversion en .webp pour les autres types d'image
            imagewebp($image_resource, $destinationPath, 80);
            imagedestroy($image_resource);
        }

        return $fichier;
    }


    public function delete(string $fichier, ?string $folder = '')
    {
        if ($fichier !== 'default.webp') {
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            // Chemin de l'image .webp
            $original = $path . '/' . $fichier;

            if (file_exists($original)) {
                unlink($original);
                $success = true;
            }

            return $success;
        }
        return false;
    }
}

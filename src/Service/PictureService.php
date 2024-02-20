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
        // Sanitisation du nom original du fichier, en excluant l'extension
        $originalName = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
        $sanitizedOriginalName = preg_replace('/[^a-zA-Z0-9_-]/', '-', $originalName); // Remplacement des caractères non désirés

        // Génération d'un nouveau nom de fichier avec le nom sanitisé, un identifiant unique et l'extension .webp
        $fichier = $sanitizedOriginalName . '-' . md5(uniqid(rand(), true)) . '.webp';

        // On récupère les infos de l'image
        $picture_infos = getimagesize($picture->getPathname());

        if ($picture_infos === false) {
            throw new Exception('Format d\'image incorrect');
        }

        // On vérifie le format de l'image et on la convertit en ressource GD si nécessaire
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

        // Conversion de l'image en .webp
        $path = $this->params->get('images_directory') . $folder;
        // Assurez-vous que le dossier existe
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $destinationPath = $path . '/' . $fichier;
        imagewebp($image_resource, $destinationPath, 80); // Convertit et sauvegarde l'image en .webp avec une qualité de 80
        imagedestroy($image_resource); // Libère la ressource image

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

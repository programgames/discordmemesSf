<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class UploadProcessor
{
    public function processMP3(?UploadedFile $mp3,?string $name,?string $url,string $mp3Folder): Response
    {
        if(!$name) {
            return new Response('Nom du meme incorrect');
        }
        $name = $this->clearName($name);

        if ($mp3) {
            if (!$mp3->getMimeType() === "audio/mp3") {
                return new Response('Fichier MP3 invalide', 400);
            }
        }

        if ($mp3) {
            try {
                $mp3->move($mp3Folder, $name . '.mp3' );
                return new Response('Fichier bien transmis : ' . $name . '.mp3',200);
            } catch (FileException $e) {
                return new Response('Erreur inconnu',400);
            }
        }
        elseif ($url) {
            $path = $mp3Folder .'/'. $name . '.mp3';
            file_put_contents($path, file_get_contents($url));
            return new Response('Fichier bien transmis : ' . $name . '.mp3',200);
        }
    }

    private function clearName(?string $name)
    {
        return preg_replace("/[^a-z0-9.]+/i", "", $name);
    }
}
<?php

namespace App\Controller;

use App\Form\UploadMusicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadMusicController extends AbstractController
{
    /**
     * @Route("/upload/music", name="upload_music")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(UploadMusicType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mp3 = $form->get('mp3file')->getData();
            $name = $form->get('filename')->getData();
            if ($mp3 && $name) {
                try {
                    $mp3->move($this->getParameter('mp3_directory'), $name . '.mp3' );
                } catch (FileException $e) {
                    //TODO something
                }
            }

        }

        return $this->render('upload_music/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

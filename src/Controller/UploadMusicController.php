<?php

namespace App\Controller;

use App\Form\UploadMusicType;
use App\Utils\UploadProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadMusicController extends AbstractController
{
    /**
     * @Route("/upload/music", name="upload_music")
     * @param Request $request
     * @param UploadProcessor $processor
     * @return Response
     */
    public function index(Request $request,UploadProcessor $processor)
    {
        $form = $this->createForm(UploadMusicType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mp3 = $form->get('mp3file')->getData();
            $name = $form->get('filename')->getData();
            $url = $form->get('mp3url')->getData();

            return $processor->processMP3($mp3,$name,$url,$this->getParameter('mp3_directory'));
        }

        return $this->render('upload_music/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

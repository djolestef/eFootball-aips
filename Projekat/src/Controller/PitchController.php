<?php

namespace App\Controller;

use App\Entity\Pitch;
use App\Service\PitchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PitchController extends AbstractController
{
    /**
     * @var PitchService $pitchService
     */
    protected $pitchService;

    public function __construct(PitchService $pitchService)
    {
        $this->pitchService = $pitchService;
    }

    /**
     * @Route("/pitch/{id}", name="pitch", methods="GET")
     */
    public function index(Request $request): Response
    {
        $id = $request->get('id');
        dd($id);

        /**
         * @var Pitch $pitch
         */
        $pitch = $this->pitchService->getPitchById($id);

        return $this->render('pitch/index.html.twig', [
            'controller_name' => 'PitchController',
        ]);
    }
}

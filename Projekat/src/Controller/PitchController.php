<?php

namespace App\Controller;

use App\Entity\Pitch;
use App\Form\PitchType;
use App\Service\PitchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pitch")
 */
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
     * @Route("/{id}", name="pitch", methods="GET", requirements={"id"="\d+"})
     */
    public function index(Request $request): Response
    {
        $id = $request->get('id');
        $pitch = $this->pitchService->getPitchById($id);

        return $this->render('pitch/index.html.twig', [
            'controller_name' => 'PitchController',
        ]);
    }

    /**
     * @Route ("/add", name="create_pitch", methods="POST|GET")
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function createPitch(Request $request)
    {
        $pitch = new Pitch();
        $form = $this->createForm(PitchType::class, $pitch);

        $data = $request->request->all();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $pitch->setCompany($this->getUser()->getId());
            $id = $this->pitchService->createNewPitch($pitch);
            return $this->redirectToRoute('pitch', [
                'id' => $id
            ]);
        }

        return $this->render('pitch/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

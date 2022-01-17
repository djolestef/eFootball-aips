<?php

namespace App\Controller;

use App\Form\RegistrationType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RegistrationController extends BaseController
{
    private $eventDispatcher;
    private $formFactory;
    private $userManager;
    private $tokenStorage;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        FactoryInterface $formFactory,
        UserManagerInterface $userManager,
        TokenStorageInterface $tokenStorage
    ) {
        parent::__construct($eventDispatcher, $formFactory, $userManager, $tokenStorage);

        $this->eventDispatcher = LegacyEventDispatcherProxy::decorate($eventDispatcher);
        $this->formFactory = $formFactory;
        $this->userManager = $userManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request): Response
    {
        $user = $this->userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_INITIALIZE); //FOSUserEvents::REGISTRATION_INITIALIZE

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();

        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);

                $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_SUCCESS); //FOSUserEvents::REGISTRATION_SUCCESS
                $this->userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $this->eventDispatcher->dispatch(new FilterUserResponseEvent($user, $request, $response), FOSUserEvents::REGISTRATION_COMPLETED); //FOSUserEvents::REGISTRATION_COMPLETED

                return $response;
            }

            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch($event, FOSUserEvents::REGISTRATION_FAILURE); //FOSUserEvents::REGISTRATION_FAILURE

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//    public function confirmedAction(Request $request)
//    {
//        $user = $this->getUser();
//        dd($user);
//        if (!is_object($user) || !$user instanceof UserInterface) {
//            throw new AccessDeniedException('This user does not have access to this section.');
//        }
//        dd('ddd');
//
//        return $this->render('@FOSUser/Registration/confirmed.html.twig', [
//            'user' => $user,
//            'targetUrl' => $this->getTargetUrlFromSession($request->getSession()),
//        ]);
//    }
}

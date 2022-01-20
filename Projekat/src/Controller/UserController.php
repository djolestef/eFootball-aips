<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Company;
use App\Entity\User;
use App\Form\QuestionnaireClientType;
use App\Form\QuestionnaireCompanyType;
use App\Service\ClientService;
use App\Service\CompanyService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $userService;
    private $clientService;
    private $companyService;

    public function __construct(
        UserService $userService,
        CompanyService $companyService,
        ClientService $clientService
    ){
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->clientService = $clientService;
    }
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @param Request $request
     * @Route("/questionnaire", name="questionnaire")
     */
    public function questionnaire(Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $isCompany = $user->hasRole(User::ROLE_COMPANY);

        if ($isCompany) {
            $company = new Company();
            $company->setId($user->getId());
            $form = $this->createForm(QuestionnaireCompanyType::class, $company);
            $view = 'company/questionnaire.html.twig';
        } else {
            $client = new Client();
            $client->setId($user->getId());
            $form = $this->createForm(QuestionnaireClientType::class, $client);
            $view = 'client/questionnaire.html.twig';
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $isCompany ?
                $this->companyService->submitQuestionnaire($company) :
                $this->clientService->submitQuestionnaire($client);

            $url = $this->generateUrl('questionnaire');
            return new RedirectResponse($url);
        }

        return $this->render($view, [
           'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\CompanyRepository;

class CompanyService
{
    /**
     * @var CompanyRepository $companyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function submitQuestionnaire(Company $company)
    {
        $this->companyRepository->save($company);
    }
}

<?php

namespace App\Entity;

use App\Repository\UserRepository;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const ROLE_DEFAULT = 'DEFAULT';
    const ROLE_COMPANY = 'ROLE_COMPANY';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Override
     *
     * @param $email
     * @return User
     */
    public function setEmail($email): self
    {
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}

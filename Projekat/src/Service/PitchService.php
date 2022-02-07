<?php

namespace App\Service;

use App\Entity\Pitch;
use App\Repository\PitchRepository;

class PitchService
{
    protected $pitchRepository;

    public function __construct(PitchRepository $pitchRepository)
    {
        $this->pitchRepository = $pitchRepository;
    }

    public function getPitchById(int $id) : Pitch
    {
        return $this->pitchRepository->find($id);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function createNewPitch(Pitch $pitch): ?int
    {
        return $this->pitchRepository->save($pitch);
    }

}

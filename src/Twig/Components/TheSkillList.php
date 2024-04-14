<?php

namespace App\Twig\Components;

use App\Repository\SkillRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class TheSkillList
{
    private SkillRepository $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function getSkills(): array
    {
        return $this->skillRepository->findAll();
    }
}
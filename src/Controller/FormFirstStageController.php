<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contracts\ControllerInterface;
use App\Repository\QuestionRepository;
use Psr\Container\ContainerInterface;

class FormFirstStageController implements ControllerInterface
{
    private QuestionRepository $questionRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->questionRepository = $container->get(QuestionRepository::class);
    }

    public function processesRequest(): void
    {
        $math = $this->questionRepository->mathFistDayWithAllQuestions();
        $physical = $this->questionRepository->physicalFistDayWithAllQuestions();
        $chemical = $this->questionRepository->chemicalFistDayWithAllQuestions();


        require_once __DIR__ . '/../../views/user/first-stage.php';
    }
}

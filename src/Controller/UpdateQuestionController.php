<?php

declare(strict_types=1);

namespace App\Controller;


use App\Contracts\ControllerInterface;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Psr\Container\ContainerInterface;

class UpdateQuestionController  implements ControllerInterface
{
    private QuestionRepository $questionRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->questionRepository = $container->get(QuestionRepository::class);
    }

    public function processaRequisicao(): void
    {

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $number = filter_input(INPUT_POST, 'number');

        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
            return;
        }


        $alternative = filter_input(INPUT_POST, 'alternative');
        if ($alternative == "") {
            $alternative = null;
        }

        $photo = filter_input(INPUT_POST, 'photo');

        if ($photo == "") {
            $_SESSION['error'] = "Não é permitido atualizar uma questão sem o campo FOTO";
            header('Location: /primeira-fase');
            return;
        }


        $is_publish = filter_input(INPUT_POST, 'is_publish');
        if ($is_publish == "on" && !is_null($alternative)) {
            $is_publish = true;
        } else {
            $is_publish = false;
        }

        $question = new Question($alternative, $number, $photo, $is_publish);
        $question->setId($id);

        $success = $this->questionRepository->update($question);

        if ($success === false) {
            $_SESSION['error'] = true;
            header('Location: /primeira-fase');
        } else {
            $_SESSION['success'] = true;
            header('Location: /primeira-fase');
        }
    }
}

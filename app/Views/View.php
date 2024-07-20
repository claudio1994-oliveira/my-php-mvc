<?php

namespace App\Views;

use Twig\Environment;

class View
{

    public function __construct(protected Environment $twig)
    {
    }

    public function render(string $view, array $data = [])
    {
        $view = $this->normalizerPath($view);

        return $this->twig->render($view . '.twig', $data);
    }

    protected function normalizerPath(string $view)
    {
        $paths = explode(".", $view);
        if (count($paths) < 2) {
            return $view;
        }
        $completePath = "";

        foreach ($paths as $key => $path) {
            if ($key + 1 >= count($paths)) {
                $completePath .= $path;
            } else {
                $completePath .= $path . DIRECTORY_SEPARATOR;
            }
        }
        return $completePath;
    }
}

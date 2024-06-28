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

        echo $this->twig->render($view . '.twig', $data);
    }

    protected function normalizerPath(string $view)
    {
        $paths = explode(".", $view);
        $completePath = "";

        if (count($paths) > 1) {
            foreach ($paths as $key => $path) {
                if ($key + 1 >= count($paths)) {
                    $completePath .= $path;
                } else {
                    $completePath .= $path . DIRECTORY_SEPARATOR;
                }
            }
        }

        return $completePath;
    }
}

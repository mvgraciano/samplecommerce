<?php

namespace Source\Core;

use League\Plates\Engine;

class View {

    private $engine;

    public function __construct(string $path)
    {
        $this->engine = new Engine($path, 'php');
    }

    public function path(string $name, string $path): View
    {
        $this->engine->addFolder($name, $path);
        return $this;
    }

    public function render(string $templateName, array $data): string
    {
        return $this->engine->render($templateName, $data);
    }
}
<?php

namespace Humble\View;

use Psr\Http\Message\ResponseInterface;

interface ViewInterface
{
    public function setTemplatePath(string $templatePath): ViewInterface;

    public function setLayout(string $layout): ViewInterface;

    public function registerExtension(string $name, callable $extension): ViewInterface;

    public function getExtension(string $name);

    public function callExtension(string $name, ...$arguments);

    public function render(ResponseInterface $response, array $sections = array(), array $data = array());

    public function layout(string $layout, array $sections = array(), array $data = array()): string;

    public function partial(string $template, array $arguments = array()): string;
}

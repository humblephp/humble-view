<?php

namespace Humble\View;

use Psr\Http\Message\ResponseInterface;

class View
{
    private $settings = [
        'templatePath' => '',
        'layout' => '',
    ];

    private $container = array();
    private $extensions = array();

    public function __construct(array $settings = array(), $container = null)
    {
        $this->settings = array_merge($this->settings, $settings);
        $this->container = $container;
    }

    public function setTemplatePath(string $templatePath): self
    {
        $settings['templatePath'] = $templatePath;

        return $this;
    }

    public function setLayout(string $layout): self
    {
        $settings['layout'] = $layout;

        return $this;
    }

    public function register(string $name, $extension): self
    {
        $this->extensions[$name] = $extension;

        return $this;
    }

    public function get(string $name)
    {
        return $this->extensions[$name] ?? null;
    }

    public function call(string $name, ...$arguments)
    {
        if (isset($this->extensions[$name]) && is_callable($this->extensions[$name])) {
            return $this->extensions[$name](...$arguments);
        }

        return null;
    }

    public function render(ResponseInterface $response, array $sections = array(), array $data = array())
    {
        $layout = $this->layout($this->settings['layout'], $sections, $data);
        $response->getBody()->write($layout);

        return $response;
    }

    public function layout(string $layout, array $sections = array(), array $data = array()): string
    {
        $arguments['c'] = $this->container;
        $arguments['view'] = (object) $data;

        foreach ($sections as $name => $section) {
            $sections[$name] = $this->partial($section, $arguments);
        }

        $arguments['section'] = (object) $sections;

        return $this->partial($layout, $arguments);
    }

    public function partial(string $template, array $arguments = array()): string
    {
        if (!is_file($this->settings['templatePath'] . $template)) {
            throw new \RuntimeException("The template `$template` could not be found.");
        }

        extract($arguments);

        ob_start();
        include $this->settings['templatePath'] . $template;
        return ob_get_clean();
    }
}

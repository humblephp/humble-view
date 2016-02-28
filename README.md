# humble-view

[![Latest Version](https://img.shields.io/github/release/humblephp/humble-view.svg)](https://github.com/humblephp/humble-view/releases)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/humblephp/humble-view.svg?branch=master)](https://travis-ci.org/humblephp/humble-view)

HUMBLE View

## Install

Via Composer

``` bash
$ composer require humble/view
```

## Usage

Get Php View.
```
$view = new \Humble\View\View;
```

Set template path.
```
$view->setTemplatePath('/absolute/path/to/templates/');
```

Set layout.
```
$view->setLayout('relative/path/to/layout.php');
```

Get Php View with predefined settings.
```
$view = new \Humble\View\View([
    'templatePath' => '/absolute/path/to/templates/',
    'layout' => 'relative/path/to/layout.php',
]);
```

Register extension.
```
$extension = new Extension
$view->register('extensionName', $extension);
```

Register callback.
```
$callback = function(string $string) { return strtoupper($string); };
$view->register('callableName', $callback);
```

Get registered extension.
```
$view->get('extensionName');
```

Get registered callable extension or callback.
```
$view->call('callableName', 'string');
```

Render PSR-7 response with layout section.
```
$view->render(new Response(), array('section' => 'relative/path/to/section.php'));
```

Render PSR-7 response with layout sections, and view data.
```
$view->render(new Response(), [
    'header' => 'relative/path/to/header.php',
    'content' => 'relative/path/to/content.php',
], [
    'data' => array(),
]);
```

Get layout output.
```
$view->layout('relative/path/to/layout/default.php', [
    'section' => 'relative/path/to/section.php',
], [
    'data' => array(),
]);
```

Get partial output.
```
$view->partial('relative/path/to/partial.php', [
    'data' => array(),
]);
```

Get absolute path to template.
```
$view->getTemplate('relative/path/to/template.php');
```

Use sections in layout.
```
<?= $section->header; ?>
<?= $section->content; ?>
```

Use view data in layout, or section.
```
<?= $view->data; ?>
```

Use extension in layout, section, or partial.
```
<?= $this->get('extensionName'); ?>
```

Use callable in layout, section, or partial.
```
<?= $this->call('callableName', 'string'); ?>
```

Include layout in other layout, section, or partial.
```
<?= $this->layout('relative/path/to/layout.php', [
    'section' => 'relative/path/to/section.php'
]); ?>
```

Include partial in layout, section, or other partial.
```
<?= $this->partial('relative/path/to/partial.php'); ?>
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

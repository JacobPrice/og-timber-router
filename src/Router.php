<?php

namespace Og\TimberHierarchy;

use Timber\Timber;

use Og\TimberHierarchy\ContextProvider;
use Og\TimberHierarchy\ContextProviderInterface;
use Og\TimberHierarchy\TemplateProviderInterface;

class Router
{
    public function __construct(private ?ContextProviderInterface $context_provider = null, private ?TemplateProviderInterface $template_provider = null)
    {
        $this->context_provider ??= new ContextProvider();
        $this->template_provider ??= new TemplateProvider();
    }
    public function get_context(): array
    {
        return $this->context_provider->get_context();
    }

    public function get_template(): array
    {
        return $this->template_provider->get_template();
    }

    public function render(): void
    {
        $context = $this->get_context();
        $template = $this->get_template();
        Timber::render($template, $context);
    }
}

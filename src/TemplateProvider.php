<?php

namespace Og\TemplateLoader;

use Og\TemplateLoader\Hierarchy;
use Og\TemplateLoader\TemplateProviderInterface;

class TemplateProvider implements TemplateProviderInterface {
    public function __construct(private array $config = []) {
    }

    public function get_template(): array {
        $hierarchy = Hierarchy::instance();
        $templates =  $hierarchy->templates() ?? [];
        $templates = array_map(function($template) {
            return $template . '.twig';
        }, $templates);

        if(!isset($this->config['template_dir'])) {
            return $templates;
        }
        $template_dir = $this->config['template_dir'];

        $templates = array_map(function($template) use ($template_dir) {
            return $template_dir . '/' . $template;
        }, $templates);

        return $templates;
    }
}
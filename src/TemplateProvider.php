<?php

namespace Og\TimberHierarchy;

use Brain\Hierarchy\Hierarchy;
use Og\TimberHierarchy\TemplateProviderInterface;

class TemplateProvider implements TemplateProviderInterface {
    public function __construct() {
    }

    public function get_template(): array {
        global $wp_query;
        $hierarchy = new Hierarchy();
        $templates =  $hierarchy->templates($wp_query) ?? [];
        return array_map(function($template) {
            return $template . '.twig';
        }, $templates);
    }
}
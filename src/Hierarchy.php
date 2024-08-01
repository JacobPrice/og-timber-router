<?php

namespace Og\TemplateLoader;

use Brain\Hierarchy\Hierarchy as WpHierarchy;

class Hierarchy
{
    private static $instance;
    public $query;
    private function __construct(){
        global $wp_query;
        $this->query = $wp_query;
    }

    public static function instance(): Hierarchy
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function templates(): array
    {
        $hierarchy = new WpHierarchy();
        return $hierarchy->templates($this->query) ?? [];

    }
}

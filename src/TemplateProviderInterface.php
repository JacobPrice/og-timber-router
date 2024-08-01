<?php

namespace Og\TemplateLoader;

interface TemplateProviderInterface {
    public function get_template(): array;
}
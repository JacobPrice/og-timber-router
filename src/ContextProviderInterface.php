<?php

namespace Og\TemplateLoader;

interface ContextProviderInterface {
    public function get_context(): array;
}
<?php

namespace Og\TimberHierarchy;

use Og\TimberHierarchy\ContextProviderInterface;

class ContextProvider implements ContextProviderInterface {

    public function get_context(): array {
        return [];
    }
}
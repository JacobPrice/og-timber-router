<?php

namespace Og\TimberHierarchy;

interface ContextProviderInterface {
    public function get_context(): array;
}
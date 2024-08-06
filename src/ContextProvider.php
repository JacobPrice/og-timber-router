<?php

namespace Og\TemplateLoader;

use Timber\Timber;
use Og\TemplateLoader\ContextProviderInterface;

class ContextProvider implements ContextProviderInterface
{
    public function __construct(private array $config = [])
    {
    }


    public function get_context(): array
    {
        $global_context = Timber::context();
        if (!isset($this->config['context_dir'])) {
            return Timber::context();
        }

        $context_dir = $this->config['context_dir'];

        $context_files = new \FilesystemIterator($context_dir);
        $templates = (Hierarchy::instance())->templates() ?? [];

        $templates = apply_filters('og/templateloader/contextmap', $templates);

        $mapped_context = [];

        foreach ($context_files as $file) {
            $file_name = $file->getBasename('.php');
            if ($file_name === 'global') {
                $context = include $file->getPathname();
                if (is_array($context)) {
                    array_merge($global_context, $context);
                }
                continue;
            }
            $mapped_context[$file_name] = $file->getPathname();
        }

        foreach ($templates as $template) {
            if (array_key_exists($template, $mapped_context)) {
                $context = include $mapped_context[$template];
                if (!is_array($context)) {
                    continue;
                }
                return array_merge(Timber::context(), $context);
            }
        }

        return Timber::context();
    }
}
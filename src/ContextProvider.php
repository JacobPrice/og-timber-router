<?php

namespace Og\TemplateLoader;

use Timber\Timber;
use Og\TemplateLoader\ContextProviderInterface;

class ContextProvider implements ContextProviderInterface {
    public function __construct(private array $config = []) {}


    public function get_context(): array {
        $context = Timber::context();
        if(!isset($this->config['context_dir'])) {
            return $context;
        }
        $context_dir = $this->config['context_dir'];

        $context_files = new \FilesystemIterator($context_dir);
        $global_context = Timber::context();
        foreach ($context_files as $file) {
            $context = include $file->getPathname();
            if(!is_array($context)) {
                continue;
            }
            $global_context = array_merge($global_context, $context);
        }
        return $global_context;
    }


    /**
	 * format_for_class_name
	 *
	 * Converts a template name to a class name
	 * example: page-home -> PageHome
     * example: archive-tribe_events -> ArchiveTribeEvents
	 *
	 * @param  string $template
	 * @return string
	 */
	public function format_for_class_name($template)
	{
        $template = str_replace('_', '-', $template);
		$parts = explode('-', $template);
		$parts = array_map('ucfirst', $parts);
		return implode('', $parts);
	}

}
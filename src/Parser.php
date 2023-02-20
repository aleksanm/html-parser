<?php

namespace Alex\HtmlParser;

use DOMXPath;
use DOMDocument;

class Parser
{
    protected string $file;

    public static function load(string $path): self
    {
        $instance = new static();

        $instance->file = file_get_contents($path);

        return $instance;
    }
    public function loadHTML(string $html): self
    {
        $this->file = $html;

        return $this;
    }

    public function toDom(): DOMDocument
    {
        $dom = new DOMDocument();
        $dom->loadHTML($this->file);

        return $dom;
    }

    public function toDomXP(): DOMXPath
    {
        return new DOMXPath($this->toDom());
    }

    public function value(string $name): string
    {
        $xpath = $this->toDomXP();

        $nodes = $xpath->query("//input[@name='$name']");

        if (count($nodes) === 0) {
            $name = strtolower($name);
            $nodes = $xpath->query("//input[@name='$name']");
        }
        if (count($nodes) === 0) {
            return '';
        }
        $node = $nodes[0];

        return trim($node->getAttribute('value'));
    }
    public function __toString(): string
    {
        return $this->file;
    }
}

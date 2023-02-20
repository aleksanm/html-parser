<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Alex\HtmlParser\Parser;

class ParserTest extends TestCase
{
    /** @test */
    public function it_loads_html_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/test.html';

        $this->assertStringEqualsFile(
            $file,
            Parser::load($file)
        );
    }

    /** @test */
    public function playground()
    {
        libxml_use_internal_errors(true) && libxml_clear_errors();

        $file = __DIR__ . '/stubs/test.html';

        $parser = Parser::load($file);

        $kods = $parser->value('kods');

        $this->assertEquals('12345', $kods);
    }
}

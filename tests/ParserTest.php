<?php

namespace Tests;

use AdamCornforth\PhpNameParser\Parser;

class ParserTest extends \PHPUnit\Framework\TestCase
{
    public function nameProvider()
    {
        return [
            [
                "Mr John Smith",
                [
                    'title' => 'Mr',
                    'first_name' => 'John',
                    'initial' => null,
                    'last_name' => 'Smith'
                ]
            ],
            [
                "Mr Smith",
                [
                    'title' => 'Mr',
                    'first_name' => null,
                    'initial' => null,
                    'last_name' => 'Smith',
                ],
            ],
            [
                "Mrs Smith",
                [
                    'title' => 'Mrs',
                    'first_name' => null,
                    'initial' => null,
                    'last_name' => 'Smith',
                ],
            ],
            [
                "Mr J. Smith",
                [
                    'title' => 'Mr',
                    'first_name' => null,
                    'initial' => "J",
                    'last_name' => 'Smith'
                ]
            ]
        ];
    }

    public function homeownerProvider()
    {
        return [
            [
                "Mr and Mrs Smith",
                [
                    "Mr Smith",
                    "Mrs Smith"
                ]
            ],
            [
                "Mr Tom Staff and Mr John Doe",
                [
                    "Mr Tom Staff",
                    "Mr John Doe"
                ]
            ],
            [
                "Dr & Mrs Joe Bloggs",
                [
                    "Dr Joe Bloggs",
                    "Mrs Joe Bloggs"
                ]
            ]
        ];
    }

    /**
     * @dataProvider nameProvider
     */
    public function testParseName($input, $expected)
    {
        $parser = new Parser();
        $name = $parser->parseName($input);
        $this->assertEquals($expected, $name->toArray());
    }

    public function testParseNameThrowsExceptionIfTitleMissing()
    {
        $parser = new Parser();
        $this->expectException(\RuntimeException::class);
        $parser->parseName("John");
    }

    public function testParseNameThrowsExceptionIfLastNameMissing()
    {
        $parser = new Parser();
        $this->expectException(\RuntimeException::class);
        $parser->parseName("Dr");
    }

    /**
     * @dataProvider homeownerProvider
     */
    public function testParseHomeowner($input, $expected)
    {
        $parser = new Parser();
        $homeowner = $parser->parseHomeowner($input);
        $this->assertEquals($expected, $homeowner);
    }

    public function testParseHomeownerThrowsExceptionIfTooManyNames()
    {
        $parser = new Parser();
        $this->expectException(\RuntimeException::class);
        $homeowner = $parser->parseHomeowner("Mr & Dr & Miss John Doe");
    }
}

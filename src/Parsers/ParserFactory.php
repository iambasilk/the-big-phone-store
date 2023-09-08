<?php

namespace src\Parsers;

use \src\Parsers\Parser;
use \src\Parsers\CSVParser;
use \src\Parsers\TSVParser;

class ParserFactory
{
    public static function createParser(string $format): Parser
    {
        switch ($format) {
            case 'csv':
                return new CSVParser();
            case 'tsv':
                return new TSVParser();

            default:
                throw new \Exception("Unsupported file format: $format");
        }
    }
}

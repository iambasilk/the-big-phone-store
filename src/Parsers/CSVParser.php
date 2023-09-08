<?php

namespace src\Parsers;

use \src\Models\Product;
use Generator;


class CSVParser implements Parser
{
    public function parseFile($filename): Generator
    {
        if (!file_exists($filename)) {
            throw new \Exception("File not found: $filename");
        }

        $file = fopen($filename, 'r');
        if (!$file) {
            throw new \Exception("Failed to open file: $filename");
        }


        // Skip header row
        fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            yield new Product($data);
        }

        fclose($file);
    }
}

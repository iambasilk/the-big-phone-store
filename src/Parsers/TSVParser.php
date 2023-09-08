<?php

namespace src\Parsers;

use Generator;
use src\Models\Product;

class TSVParser implements Parser
{
    public function parseFile($filename): Generator
    {
        if (!file_exists($filename)) {
            throw new \Exception("File not found: $filename");
        }

        $handle = fopen($filename, 'r');

        if (!$handle) {
            throw new \Exception("Unable to open file: $filename");
        }

        $skipHeader = true;
        while (($line = fgets($handle)) !== false) {
            if ($skipHeader) {
                $skipHeader = false;
                continue;
            }

            $fields = str_getcsv($line, "\t", '"'); // Parse CSV with tab delimiter

            $data = str_replace('"', '', $fields);

            yield new Product($data);
        }
    }
}

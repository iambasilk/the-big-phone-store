<?php

namespace src\Parsers;

class CommandLineParser
{
    public static function parse($argv): array
    {
        $args = [];

        if (count($argv) !== 4) {
            echo "Please check command usage: php parser.php --file <input_file.csv> --unique-combinations=<output_file.csv>\n";
            exit(1);
        }

        array_shift($argv);

        $currentArg = null;
        foreach ($argv as $arg) {
            if ($arg === '--file' || preg_match('/^--([a-z-]+)=(.*)$/i', $arg, $matches)) {
                if ($arg === '--file') {
                    $currentArg = 'file';
                } elseif ($matches) {
                    $argName = $matches[1];
                    $argValue = $matches[2];
                    $args[$argName] = $argValue;
                }
            } elseif ($currentArg !== null) {
                $args[$currentArg] = $arg;
                $currentArg = null;
            }
        }

        if (!isset($args['file']) || !isset($args['unique-combinations'])) {
            echo "Please check command usage: php parser.php --file <input_file.csv> --unique-combinations=<output_file.csv>\n";
            exit(1);
        }

        $inputFile = $args['file'];
        if (!file_exists($inputFile)) {
            echo "Input file not found: $inputFile\n";
            exit(1);
        }

        return $args;
    }
}

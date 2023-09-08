<?php
require_once __DIR__ . '/vendor/autoload.php';

use config\Constants;
use src\Loggers\FileLogger;
use src\Parsers\ParserFactory;
use src\Parsers\CommandLineParser;
use src\UniqueCombinationsGenerator;

$startTime = microtime(true);

$args = CommandLineParser::parse($argv);
$fileName = $args['file'];

$fileInfo = pathinfo($fileName);
$fileFormat = strtolower($fileInfo['extension']);

$parser = ParserFactory::createParser($fileFormat);
$productsGenerator = $parser->parseFile($fileName);

$uniqueCombinationsGenerator = UniqueCombinationsGenerator::generateAndDisplay($productsGenerator);

$uniqueCombinationsFilePath = Constants::OUTPUT_FILE_PATH . $args['unique-combinations'];
if (file_exists($uniqueCombinationsFilePath)) {
    unlink($uniqueCombinationsFilePath);
}

$fileHandle = fopen($uniqueCombinationsFilePath, 'a');

foreach ($uniqueCombinationsGenerator as $combinationLine) {
    fwrite($fileHandle, $combinationLine);
}

fclose($fileHandle);

echo 'Parsed Successfully !';

$endTime = microtime(true);
$timeTaken = $endTime - $startTime;

$fileLogger = new FileLogger('logs\memory_usage_log.txt');
$logMessage = "Time taken: " . round($timeTaken, 2) . " seconds";
$fileLogger->log($logMessage);

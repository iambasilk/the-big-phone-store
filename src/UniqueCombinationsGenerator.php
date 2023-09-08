<?php

namespace src;

use Generator;
use config\Constants;
use src\Helpers\MemoryHelper;
use src\Loggers\FileLogger;
use src\Models\Product;
use src\Models\UniqueCombination;

class UniqueCombinationsGenerator
{
    public static function generateAndDisplay(Generator $productsGenerator): Generator
    {
        $batch = [];
        foreach ($productsGenerator as $product) {
            $batch[] = $product;
            if (count($batch) >= Constants::BATCH_SIZE) {
                yield from self::processBatch($batch);
                $batch = [];
            }
        }

        yield from self::processBatch($batch);
    }

    private static function processBatch(array $batch): Generator
    {
        $uniqueCombinations = [];
        $fileLogger = new FileLogger(Constants::LOG_FILE_PATH . 'memory_usage_log.txt');

        foreach ($batch as $product) {
            $combinationKey = self::generateCombinationKey($product);

            MemoryHelper::logMemoryUsage($fileLogger);

            if (!isset($uniqueCombinations[$combinationKey])) {
                $uniqueCombinations[$combinationKey] = new UniqueCombination($product);
            }

            $uniqueCombinations[$combinationKey]->count += $product->count;
        }

        // Yield the processed unique combinations
        foreach ($uniqueCombinations as $product) {
            yield Product::display($product);
            yield "{$product->make},{$product->model},{$product->colour},{$product->capacity},{$product->network},{$product->grade},{$product->condition},{$product->count}\n";
        }
    }

    private static function generateCombinationKey(Product $product): string
    {
        return "{$product->make}_{$product->model}_{$product->colour}_{$product->capacity}_{$product->network}_{$product->grade}_{$product->condition}";
    }
}

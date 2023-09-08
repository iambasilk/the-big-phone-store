<?php

namespace src\Helpers;

use src\Loggers\FileLogger;

class MemoryHelper
{
    public static function logMemoryUsage(FileLogger $logger): void
    {
        $memoryUsage = memory_get_usage(true);
        $peakMemoryUsage = memory_get_peak_usage(true);

        $formattedMemoryUsage = self::formatBytes($memoryUsage);
        $formattedPeakMemoryUsage = self::formatBytes($peakMemoryUsage);

        $logger->log("Memory usage: $formattedMemoryUsage | Peak memory usage: $formattedPeakMemoryUsage");
    }

    public static function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $unitIndex = 0;

        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return round($bytes, 2) . ' ' . $units[$unitIndex];
    }
}

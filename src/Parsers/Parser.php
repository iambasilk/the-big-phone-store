<?php

namespace src\Parsers;

use Generator;

interface Parser
{
    public function parseFile(string $filename): Generator;
}

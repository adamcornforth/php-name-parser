<?php

namespace AdamCornforth\PhpNameParser;

require "vendor/autoload.php";

$parser = new Parser();

$csvFile = file('examples.csv');
$parsed = [];
foreach ($csvFile as $lineNumber => $line) {
    if ($lineNumber == 0) {
        // We don't want to parse the header row
        continue;
    }
    $homeowner = str_getcsv($line);

    // Extract multiple names from one row, if needed.
    $names = $parser->parseHomeowner($homeowner[0]);
    foreach ($names as $name) {
        // Parse the extracted names into their name parts
        $parsed[] = $parser->parseName($name)->toArray();
    }
}

// Output the parsed data to the console
print_r($parsed);

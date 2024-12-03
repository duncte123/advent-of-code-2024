<?php

declare(strict_types = 1);

$contents = trim(file_get_contents(__DIR__.'/../data/day3.txt'));
//$contents = trim(file_get_contents(__DIR__.'/../data/day3test.txt'));

$regex = '/mul\(([0-9]{1,3}),([0-9]{1,3})\)/';

preg_match_all($regex, $contents, $matches);

// php moment
[$full, $leftNums, $rightNums] = $matches;
$matchCount = count($full);
$result1 = 0;

for ($i = 0; $i < $matchCount; $i++) {
    $left = intval($leftNums[$i]);
    $right = intval($rightNums[$i]);

    $result1 += $left * $right;
}

echo "Part 1: $result1\n";

$regex = '/mul\(([0-9]{1,3}),([0-9]{1,3})\)|do\(\)|don\'t\(\)/';

preg_match_all($regex, $contents, $matches);

[$full, $leftNums, $rightNums] = $matches;
$matchCount = count($full);
$enabled = true;
$result2 = 0;

for ($i = 0; $i < $matchCount; $i++) {
    $item = $full[$i];

    if ($item == 'do()') {
        $enabled = true;
        continue;
    }

    if ($item == 'don\'t()') {
        $enabled = false;
        continue;
    }

    if ($enabled) {
        $left = intval($leftNums[$i]);
        $right = intval($rightNums[$i]);

        $result2 += $left * $right;
    }
}

// too high: 123321612, 121743828
echo "Part 2: $result2\n";

<?php

declare(strict_types = 1);

function getDistance(int $one, int $two): int {
    if ($one > $two) {
        return $one - $two;
    }

    return $two - $one;
}

$contents = trim(file_get_contents(__DIR__.'/../data/day1.txt'));
//$contents = trim(file_get_contents(__DIR__.'/../data/day1test.txt'));

/** @var int[] $left */
$left = [];
/** @var int[] $right */
$right = [];

$lines = explode("\n", $contents);

array_map(static function(string $line) use (&$left, &$right) {
    [$firstStr, $secondStr] = explode('   ', $line);

    $left[] = (int) $firstStr;
    $right[] = (int) $secondStr;
}, $lines);

sort($left);
sort($right);

$totalLines = count($left);
$result = 0;

for ($i = 0; $i < $totalLines; $i++) {
    $result += getDistance($left[$i], $right[$i]);
}

echo "Part 1: $result\n";

$part2Res = 0;

for ($i = 0; $i < $totalLines; $i++) {
    $num = $left[$i];
    $countInList = count(array_filter($right, fn (int $val) => $val === $num));

    $part2Res += ($num * $countInList);
}

echo "Part 2: $part2Res\n";

<?php

declare(strict_types = 1);

$contents = trim(file_get_contents(__DIR__.'/../data/day4.txt'));
//$contents = trim(file_get_contents(__DIR__.'/../data/day4test.txt'));

$lines = explode("\n", $contents);

/** @var string[][] $charArray */
$charArray = array_map(fn(string $line) => mb_str_split($line), $lines);
/** @var int[][] $coords */
$coords = [];

foreach ($charArray as $index => $chars) {
    foreach ($chars as $charIndex => $char) {
        if ($char === 'X') {
            $coords[] = [$index, $charIndex];
        }
    }
}

$result1 = 0;
$ca = $charArray;

// What does the @ symbol mean in this context?
// It suppresses out of bounds errors/warnings and just returns NULL
// WHo needs bounds checks? Just yolo it
foreach ($coords as $cord) {
    $c0 = $cord[0];
    $c1 = $cord[1];

    // Horizontal first

    // left to right
    $ca0 = $charArray[$c0];
    if (
        implode('', [ @$ca0[$c1 - 3], @$ca0[$c1 - 2], @$ca0[$c1 - 1], @$ca0[$c1] ]) === 'SAMX'
    ) {
        $result1++;
    }

    // right to left
    if (
        implode('', [ @$ca0[$c1], @$ca0[$c1 + 1], @$ca0[$c1 + 2], @$ca0[$c1 + 3] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // Vertical second

    // top to bottom
    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 - 1][$c1], @$ca[$c0 - 2][$c1], @$ca[$c0 - 3][$c1] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // bottom to top
    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 + 1][$c1], @$ca[$c0 + 2][$c1], @$ca[$c0 + 3][$c1] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // Diagonal third

    // down left

    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 - 1][$c1 - 1], @$ca[$c0 - 2][$c1 - 2], @$ca[$c0 - 3][$c1 - 3] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // down-right
    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 - 1][$c1 + 1], @$ca[$c0 - 2][$c1 + 2], @$ca[$c0 - 3][$c1 + 3] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // up-left
    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 + 1][$c1 - 1], @$ca[$c0 + 2][$c1 - 2], @$ca[$c0 + 3][$c1 - 3] ]) === 'XMAS'
    ) {
        $result1++;
    }

    // down-right
    if (
        implode('', [ @$ca[$c0][$c1], @$ca[$c0 + 1][$c1 + 1], @$ca[$c0 + 2][$c1 + 2], @$ca[$c0 + 3][$c1 + 3] ]) === 'XMAS'
    ) {
        $result1++;
    }

}

echo "Part 1: $result1\n";

$result2 = 0;
$coords = [];

foreach ($charArray as $index => $chars) {
    foreach ($chars as $charIndex => $char) {
        if ($char === 'A') {
            $coords[] = [$index, $charIndex];
        }
    }
}

foreach ($coords as $cord) {
    $c0 = $cord[0];
    $c1 = $cord[1];

    if (
        implode('', [
            @$ca[$c0 - 1][$c1 - 1],
            @$ca[$c0 + 1][$c1 + 1],
            @$ca[$c0 + 1][$c1 - 1],
            @$ca[$c0 - 1][$c1 + 1],
        ]) === 'MSMS'
    ) {
        $result2++;
    }

    if (
        implode('', [
            @$ca[$c0 - 1][$c1 - 1],
            @$ca[$c0 + 1][$c1 + 1],
            @$ca[$c0 + 1][$c1 - 1],
            @$ca[$c0 - 1][$c1 + 1],
        ]) === 'SMMS'
    ) {
        $result2++;
    }

    if (
        implode('', [
            @$ca[$c0 - 1][$c1 - 1],
            @$ca[$c0 + 1][$c1 + 1],
            @$ca[$c0 + 1][$c1 - 1],
            @$ca[$c0 - 1][$c1 + 1],
        ]) === 'SMSM'
    ) {
        $result2++;
    }

    if (
        implode('', [
            @$ca[$c0 - 1][$c1 - 1],
            @$ca[$c0 + 1][$c1 + 1],
            @$ca[$c0 + 1][$c1 - 1],
            @$ca[$c0 - 1][$c1 + 1],
        ]) === 'MSSM'
    ) {
        $result2++;
    }
}

echo "Part 2: $result2\n";

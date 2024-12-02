<?php

declare(strict_types = 1);

$contents = trim(file_get_contents(__DIR__.'/../data/day2.txt'));
//$contents = trim(file_get_contents(__DIR__.'/../data/day2test.txt'));

$reports = explode("\n", $contents);

/**
 * @param string $report
 *
 * @return int[]
 */
function parseReport(string $report): array {
    $strLevels = explode(' ', $report);

    return array_map('intval', $strLevels);
}

$safeCount = 0;

foreach ($reports as $report) {
    $levels = parseReport($report);
    $isSafe = checkReport($levels);

    if ($isSafe) {
        $safeCount++;
    }
}

echo "Part 1: $safeCount\n";

$safeCount2 = 0;

// had a bit of help from the internet with this one.
// I tried to be clever, and that bit me in the bum.
// I need to remember to write more shit code for AOC and not fuck around with enums
function checkReport(array $levels): bool {
    $safe = true;
    $direction = 'unknown';
    $prev = $levels[0];
    $lvlCount = count($levels);

    for ($i = 1; $i < $lvlCount && $safe; $i++) {
        $cur = $levels[$i];

        if ($direction === 'unknown') {
            $direction = $cur > $prev ? 'increasing' : 'decreasing';
        }

        if ($direction !== 'increasing' && $cur > $prev) {
            $safe = false;
        } else if ($direction !== 'decreasing' && $prev > $cur) {
            $safe = false;
        }

        $diff = abs($cur - $prev);

        if ($diff < 1 || $diff > 3) {
            $safe = false;
        }

        $prev = $cur;
    }

    return $safe;
}

function sliceArray($arr, int $start, int $deleteCount): array {
    return array_merge(
        array_slice($arr, 0, $start),
        array_slice($arr, $start + $deleteCount)
    );
}

foreach ($reports as $report) {
//    echo $report. "\n";
    $levels = parseReport($report);
    $isSafe = checkReport($levels);
    $lvlCount = count($levels);

//    echo "Safe: ". ($isSafe? 'Yes' : 'No'). "\n";

    if ($isSafe) {
        $safeCount2++;
    } else {
        $isSafe = false;

        for ($i = 0; $i < $lvlCount && !$isSafe; $i++) {
            $isSafe = checkReport(sliceArray($levels, $i, 1));
        }

        if ($isSafe) {
            $safeCount2++;
        }
    }
}

echo "Part 2: $safeCount2\n";


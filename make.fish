#!/bin/fish

set day $argv[1]

echo "Making template files for day $day"

echo '' > "./data/day$day.txt"
echo '' > "./data/day$(echo $day)test.txt"

echo "<?php

declare(strict_types = 1);

//\$contents = trim(file_get_contents(__DIR__.'/../data/day$day.txt'));
\$contents = trim(file_get_contents(__DIR__.'/../data/day$(echo $day)test.txt'));
" > "./src/day$day.php"
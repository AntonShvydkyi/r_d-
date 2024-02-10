<?php

$unsorted = [39, 32, 56, 2, 76, 5, 89, 49, 21, 44];

function showArray($array)
{
    $arrayInString = '[' . implode(', ', $array) . ']';
    echo $arrayInString . PHP_EOL;
}

function sortUsingQuick(array $array): array
{
    if (count($array) <= 1) {
        return $array;
    }

    $pivot = $array[0];
    $left = $right = [];

    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] < $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }

    return array_merge(sortUsingQuick($left), [$pivot], sortUsingQuick($right));
}
function findMinValue($array)
{
    $minValue = $array[0];
    foreach ($array as $value) {
        if ($value < $minValue) {
            $minValue = $value;
        }
    }
    return $minValue;
}
echo "Unsorted array: ";
showArray($unsorted);

$sorted = sortUsingQuick($unsorted);

echo "Sorted array: ";
showArray($sorted);

$minValue = findMinValue($unsorted);
echo "Minimum value in the array: $minValue";

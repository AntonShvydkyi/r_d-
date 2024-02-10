
<?php

$unsorted = [39, 32, 56, 2, 76, 5, 89, 49, 21, 44];

function showArray($array)
{
    $arrayInString = '[' . implode(', ', $array) . ']';

    echo $arrayInString . PHP_EOL;
}

function sortUsingBubble(array $array): array
{
    for($i = count($array) - 1; $i > 0; $i--){
        $isSwapped = false;
        for($j = 0; $j < $i; $j++) {

            $currentElement = $array[$j];
            $nextElement    = $array[$j + 1];

            if ($currentElement > $nextElement) {
                $temp = $currentElement;

                $array[$j]     = $nextElement;
                $array[$j + 1] = $temp;

                $isSwapped = true;
            }



            showArray($array);
        }
        if (!$isSwapped) {
            break;
        }
    }
    return $array;
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

showArray($unsorted);

$sorted = sortUsingBubble($unsorted);

showArray($sorted);

$minValue = findMinValue($unsorted);
echo "Minimum value in the array: $minValue" . PHP_EOL;

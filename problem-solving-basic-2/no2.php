<?php
function test($arr) {
    $positiveNumber = 0;
    $negativeNumber = 0;
    $zero = 0;

    foreach ($arr as $number) {
        if ($number == 0) {
            $zero++;
        } elseif ($number < 0) {
            $negativeNumber++;
        } else {
            $positiveNumber++;
        }
    }

    $formatter = function($number) {
        return number_format($number, 6, '.', '');
    };

    echo $formatter($positiveNumber / count($arr)) . "\n";
    echo $formatter($negativeNumber / count($arr)) . "\n";
    echo $formatter($zero / count($arr)) . "\n";
}

test([-4, 3, -9, 0, 4, 1]);
?>
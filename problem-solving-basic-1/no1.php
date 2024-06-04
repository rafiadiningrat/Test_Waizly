<?php
function test($arr) {
    sort($arr);
    
    $sum = array_sum($arr);
    $min = $sum - $arr[count($arr) - 1];
    $max = $sum - $arr[0];
    
    return [$min, $max];
}

$arr = [1, 2, 3, 4, 5];
$ans = test($arr);
echo $ans[0] . " " . $ans[1];
?>

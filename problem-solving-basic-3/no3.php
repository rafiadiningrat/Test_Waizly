<?php
function test($time) {
    $timeArr = explode(":", $time);
    $formattedTime = "";
    $hour = "";
    $minutes = "";
    $seconds = "";

    if (strpos($timeArr[count($timeArr) - 1], "PM") !== false) {
        $checkHour = (intval($timeArr[0]) + 12) == 24 ? 0 : intval($timeArr[0]) + 12;
        $hour = str_pad($checkHour, 2, "0", STR_PAD_LEFT);
    } else {
        $hour = str_pad(intval($timeArr[0]), 2, "0", STR_PAD_LEFT);
    }

    $minutes = str_pad(intval($timeArr[1]), 2, "0", STR_PAD_LEFT);
    $seconds = str_pad(intval(substr($timeArr[2], 0, 2)), 2, "0", STR_PAD_LEFT);

    $formattedTime = $hour . ":" . $minutes . ":" . $seconds;
    echo $formattedTime . "\n";
}

test("07:05:45PM");
?>

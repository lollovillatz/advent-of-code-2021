<?php
// Day-2: https://adventofcode.com/2021/day/2
$input = file_get_contents("input.txt");
$handle = fopen("input.txt", "r");
if ($handle) {
  $answer = 0;
  $horizontal_position = 0;
  $depth_position = 0;
  while (($depth = fgets($handle)) !== false) {
    $depthArray = explode(" ", $depth);
    $step = $depthArray[0];
    $value = (int) $depthArray[1];
    if ($step == 'forward') {
      $horizontal_position += $value;
    }
    if ($step == 'down') {
      $depth_position += $value;
    }
    if ($step == 'up') {
      $depth_position -= $value;
    }
  }
  $answer = $horizontal_position * $depth_position;
  fclose($handle);
  echo "\nAnswer: " . $answer;
}

<?php
// Day-1: https://adventofcode.com/2021/day/1
$input = file_get_contents("input.txt");
$handle = fopen("input.txt", "r");

if ($handle) {
  $answer = 0;
  $prev = 0;
  $current = 0;
  $inputArray = [];

  while (($depth = fgets($handle)) !== false) {
    $depth = (int) $depth;
    $inputArray[] = $depth;
  }

  for ($i = 0; $i < count($inputArray) - 3; $i++) {
    $prev = $inputArray[$i] + $inputArray[$i + 1] + $inputArray[$i + 2];
    $current = $inputArray[$i + 1] + $inputArray[$i + 2] + $inputArray[$i + 3];

    if ($current > $prev) {
      $answer++;
    }
  }


  echo "\nAnswer: " . $answer;
}

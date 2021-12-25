<?php
// Day-1: https://adventofcode.com/2021/day/1
$input = file_get_contents("input.txt");
$handle = fopen("input.txt", "r");
if ($handle) {
  $answer = 0;
  $prevDepth = 0;
  while (($depth = fgets($handle)) !== false) {
    $depth = (int) $depth;
    if ($depth > $prevDepth && $prevDepth > 0) {
      $answer++;
    }
    $prevDepth = $depth;
  }
  fclose($handle);
  echo "Answer: " . $answer;
}

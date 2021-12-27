<?php
// Day-4: https://adventofcode.com/2021/day/4
$input = file_get_contents("input.txt");
$handle = fopen("input.txt", "r");

if ($handle) {
  $data_array = array();
  $boards_array = array();
  $boards_marks = array();
  $index = 0;

  $index_boards = 1;
  while (($data = fgets($handle)) !== false) {
    $data = preg_replace("/\r|\n/", "", $data);
    $data_array[] = $data;
    if ($index > 1) {
      if (!empty($data)) {
        $data = trim(str_replace("  ", " ", $data), " ");
        $board_array[] = array_map('intval', explode(" ", $data));

        if ($index_boards % 5 == 0) {
          $boards_array[] = $board_array;
          $board_array = [];
        }
        $index_boards++;
      }
    }
    $index++;
  }

  $draw_numbers = explode(",", $data_array[0]);

  foreach ($boards_array as $index => $board) {
    for ($i = 0; $i < 5; $i++) {
      for ($j = 0; $j < 5; $j++) {
        $boards_marks[$index][$i][$j] = 'N';
      }
    }
  }


  $winning_board = 0;
  $won_number = 0;

  for ($k = 0; $k < count($draw_numbers); $k++) {
    foreach ($boards_array as $index => $board) {
      for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 5; $j++) {
          if ($draw_numbers[$k] == $board[$i][$j] && empty($winning_board)) {
            $boards_marks[$index][$i][$j] = 'Y';

            if (checkRowMarked($boards_marks[$index])) {
              $winning_board = $index;
              $won_number = $boards_array[$index][$i][$j];
              break;
            }
          }
        }
      }
    }
  }

  echo "\nWinning Board: $winning_board";

  $score = $won_number * getScore($winning_board, $boards_marks, $boards_array);

  echo "\nScore: $score";

  fclose($handle);
}


function checkRowMarked($marked_board)
{
  for ($i = 0; $i < 5; $i++) {
    if ($marked_board[$i][0] == 'Y' && $marked_board[$i][1] == 'Y' && $marked_board[$i][2] == 'Y' && $marked_board[$i][3] == 'Y' && $marked_board[$i][4] == 'Y') {
      return true;
    } else
    if ($marked_board[0][$i] == 'Y' && $marked_board[1][$i] == 'Y' && $marked_board[2][$i] == 'Y' && $marked_board[3][$i] == 'Y' && $marked_board[4][$i] == 'Y') {
      return true;
    }
  }
  return false;
}


function getScore($index, $boards_marks, $boards_array)
{
  $sum = 0;
  for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
      if ($boards_marks[$index][$i][$j] == 'N') {
        $sum += $boards_array[$index][$i][$j];
      }
    }
  }

  return $sum;
}

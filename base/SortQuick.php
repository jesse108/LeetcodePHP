<?php

$list = [5,6,545,15,54,6,34,6,6,653234,2,3];
quickSort($list);
var_dump($list);


/**
 * 经典快速排序
 */
function quickSort(array &$list,$start = 0,$end = null){
   if($end === null){
       $end = count($list) - 1;
   }
   if($start >= $end){
       return;
   }
   if($start == $end - 1){ //只有两个元素
       if($list[$start] > $list[$end]) swap($list, $start, $end);
       return ;
   }
   
   
   
   $mid = intval(($start + $end) / 2);
   swap($list, $start, $mid);
   
   $i = $start;
   $j = $end;
   
   while($i < $j){
       if($list[$i + 1] <= $list[$i]){
           swap($list, $i, $i + 1);
           $i++;
       } else {
           swap($list, $i + 1, $j);
           $j--;
       }
   }
   
   quickSort($list,$start,$i - 1);
   quickSort($list,$i+1,$end);
}

function swap(&$list,$i,$j){
    $tmp = $list[$i];
    $list[$i] = $list[$j];
    $list[$j] = $tmp;
}
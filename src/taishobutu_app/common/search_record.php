<?php

if(isset($_POST['search_appendix'])){
  $search_appendix = (int)$_POST['search_appendix'];
}
if(isset($_POST['search_taishobutu_name'])){
  $search_taishobutu_name = $_POST['search_taishobutu_name'];
}
if(isset($_POST['search_taishobutu_address'])){
  $search_taishobutu_address = $_POST['search_taishobutu_address'];
}
if(isset($_POST['search_total_area'])){
  $search_total_area = $_POST['search_total_area'];
}
// 「用途区分」だけ入力されている場合
if(isset($search_appendix) && empty($search_taishobutu_name)&& 
empty($search_taishobutu_address) && empty($search_total_area)){
  $search_taishobutu_name = '' ;
  $search_taishobutu_address = '';
  $search_total_area = '';
}
//「対象物名」だけ入力されている場合
if(empty($search_appendix) && isset($search_taishobutu_name) &&
    empty($search_taishobutu_address) && empty($search_total_area)){
      $search_appendix = '';
      $search_taishobutu_address = '';
      $search_total_area = '';
    }
//「対象物所在地」だけ入力されている場合
if(empty($search_appendix) && empty($search_taishobutu_name) &&
  isset($search_taishobutu_address) && empty($search_total_area)){
    $search_appendix = '';
    $search_taishobutu_name = '';
    $search_total_area = '';
}
//「延べ面積」だけ入力されている場合
if(empty($search_appendix) && empty($search_taishobutu_name) &&
  empty($search_taishobutu_address) && isset($search_total_area)){
    $search_appendix = '';
    $search_taishobutu_name = '';
    $search_taishobutu_address = '';
}
//「用途区分」と「対象物名」が入力されている場合 
if(isset($search_appendix) && isset($search_taishobutu_name) && 
    empty($search_taishobutu_address) && empty($search_total_area)){
      $search_taishobutu_address = '';
      $search_total_area = '';
}
//「用途区分」と「対象物所在地」が入力されている場合 
if(isset($search_appendix) && empty($search_taishobutu_name) && 
    isset($search_taishobutu_address) && empty($search_total_area)){
      $search_taishobutu_name = '';
      $search_total_area = '';
}
//「用途区分」と「延べ面積」が入力されている場合 
if(isset($search_appendix) && empty($search_taishobutu_name) && 
    empty($search_taishobutu_address) && isset($search_total_area)){
      $search_taishobutu_name = '';
      $search_taishobutu_address = '';
}

//「対象物名」と「対象物所在地」が入力されている場合 
if(empty($search_appendix) && isset($search_taishobutu_name) && 
    isset($search_taishobutu_address) && empty($search_total_area)){
      $search_appendix = '';
      $search_total_area = '';
}
//「対象物名」と「延べ面積」が入力されている場合 
if(empty($search_appendix) && isset($search_taishobutu_name) && 
    empty($search_taishobutu_address) && isset($search_total_area)){
      $search_appendix = '';
      $search_total_area = '';
}
//「対象物所在地」と「延べ面積」が入力されている場合 
if(empty($search_appendix) && empty($search_taishobutu_name) && 
    isset($search_taishobutu_address) && isset($search_total_area)){
      $search_appendix = '';
      $search_taishobutu_name = '';
}
//「用途区分」と「対象物名」と「対象物所在地」が入力されている場合 
if(isset($search_appendix) && isset($search_taishobutu_name) && 
    isset($search_taishobutu_address) && empty($search_total_area)){
      $search_total_area = '';
}
//「用途区分」と「対象物名」と「延べ面積」が入力されている場合 
if(isset($search_appendix) && isset($search_taishobutu_name) && 
    empty($search_taishobutu_address) && isset($search_total_area)){
      $search_taishobutu_address = '';
}
//「用途区分」と「対象物所在地」と「延べ面積」が入力されている場合 
if(isset($search_appendix) && empty($search_taishobutu_name) && 
    isset($search_taishobutu_address) && isset($search_total_area)){
      $search_taishobutu_name = '';
}
//「対象物名」と「対象物所在地」と「延べ面積」が入力されている場合 
if(empty($search_appendix) && isset($search_taishobutu_name) && 
    isset($search_taishobutu_address) && isset($search_total_area)){
      $search_appendix = '';
}

?>
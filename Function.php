<?php

$conn = mysqli_connect("localhost","root","","kb_social_media") or die("Connection Faild". mysqli_connect_error());


function dbSelectTableData($tblName,$columnNames,$whereCondition){
  global $conn;
  $qry = "SELECT {$columnNames} FROM {$tblName}";
  if(!empty($whereCondition) && isset($whereCondition) && $whereCondition != NULL){
    $qry .= " WHERE {$whereCondition}";
  }
  $result = mysqli_query($conn,$qry);
  return $result;
}

function dbInsertTableData($tblName,$values = array()){
  global $conn;

  $columns = "";
  $colValues = "";
  foreach($values as $key => $val){
    $columns .= "{$key},";
    $colValues .= "'{$val}',";
  }

  $columns = trim($columns, ",");
  $colValues = trim($colValues, ",");

  $qry2 = "INSERT INTO {$tblName}";
  $qry2 .= " ({$columns}) VALUES ({$colValues})";

  $result2 = mysqli_query($conn,$qry2);
  return $result2;
}

function dbUpdateTableData($tblName,$values = array(),$whereCondition){
  global $conn;

  $colVal = "";
  foreach($values as $key => $val){
    $colVal .= "{$key} = '{$val}',";
  }

  $colVal = trim($colVal, ",");

  $qry2 = "UPDATE {$tblName}";
  $qry2 .= " SET {$colVal} WHERE {$whereCondition}";
  // if(!empty($whereCondition) && isset($whereCondition) && $whereCondition != NULL){
  //   $qry2 .= " WHERE {$whereCondition}";
  // }
  $result2 = mysqli_query($conn,$qry2);
  return $result2;
}





?>

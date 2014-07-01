<?php
  include "settings/general.php";
  $con=connect(false);

  // Create database
  $sql="CREATE DATABASE flowchart_data";
  if (mysqli_query($con,$sql)) {
    echo "Database flowchart_data created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($con);
  }
  
  // Create table
  $sql="CREATE TABLE Events(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Name CHAR(30), Universe CHAR(10), Level SMALLINT, Date CHAR(15), Location CHAR(15))";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "Table Events created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($con);
  }
    
  // Create table
  $sql="CREATE TABLE Effects(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Universe CHAR(10), From CHAR(30), To CHAR(30), Type CHAR(15))";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "Table Effects created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($con);
  }
?>

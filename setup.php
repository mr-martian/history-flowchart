<?php
  include "globals.php";
  $create=connect(false);

  // Create database
  $sql="CREATE DATABASE flowchart_data";
  if (mysqli_query($create,$sql)) {
    echo "Database flowchart_data created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($con);
  }
  
  $con=connect();
  
  // Create table
  $sql="CREATE TABLE Events(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Name CHAR(30), Universe CHAR(10), Date CHAR(15), Location CHAR(15));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Events created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
    
  // Create table
  $sql="CREATE TABLE Vessays(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Title CHAR(50), About INT(10));"; //add author, etc.?

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Vessays created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  
  // Create table
  $sql="CREATE TABLE Effects(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Cause INT(10), Effect INT(10), Type CHAR(15), Universe CHAR(10));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Effects created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  
  // Create table
  $sql="CREATE TABLE Fessays(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Title CHAR(50), About INT(10));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Fessays created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
?>

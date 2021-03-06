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
  $sql="CREATE TABLE Events(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Name CHAR(30), Date CHAR(15), Location CHAR(15));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Events created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
    
  // Create table
  $sql="CREATE TABLE Vessays(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Title CHAR(50), About INT(10), Name CHAR(30));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Vessays created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  
  // Create table
  $sql="CREATE TABLE Effects(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Cause INT(10), Effect INT(10));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Effects created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  
  // Create table
  $sql="CREATE TABLE Fessays(PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), Title CHAR(50), About INT(10), Name CHAR(30));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Fessays created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  echo "\n";
  
  // Create table
  $sql="CREATE TABLE Tags(Category INT(1), PID INT, Tag CHAR(20));";

  // Execute query
  if (mysqli_query($con,$sql)) {
    echo "\nTable Tags created successfully";
  } else {
    echo "\nError creating table: " . mysqli_error($con);
  }
  echo "\n";
?>

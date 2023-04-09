<?php
$link = mysqli_connect("localhost", "root", "abc456");
mysqli_query($link, "CREATE DATABASE IF NOT EXISTS pmj");
	
mysqli_select_db($link, "pmj");
	
$sql = "CREATE TABLE IF NOT EXISTS autocomplete(
			product_name VARCHAR(50) UNIQUE)";
				
mysqli_query($link, $sql);
	
$sql = "REPLACE INTO autocomplete VALUES
			('Acer') , ('Asus'), ('AMD'), ('Apple'), ('ATI'),
			('BenQ'), ('Brother'), 
			('Compaq'), ('Cannon'), ('Casio'), ('Cisco')";
	
mysqli_query($link, $sql);
mysqli_close($link);
?>
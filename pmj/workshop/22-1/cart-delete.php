<?php
session_start();

$id = $_POST['id'];
$a = $_SESSION['cart'];
unset($a[$id]);
$_SESSION['cart'] = $a;
sleep(1);
?>
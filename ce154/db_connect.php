<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'ce154_bu18777';

$link = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if (!$link)
{
	die("Error: " . mysqli_error($link));
}

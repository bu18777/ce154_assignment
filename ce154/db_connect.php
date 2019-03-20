<?php
$DB_HOST = 'cseemyweb.essex.ac.uk';
$DB_USER = 'bu18777';
$DB_PASS = '';
$DB_NAME = 'ce154_bu18777';

$link = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if (!$link) {
	die("Error Occured" . mysqli_error($link));
}

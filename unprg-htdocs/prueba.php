<?php
	error_reporting(E_ERROR);

	$mysqli = new mysqli('192.168.0.10', 'root', 'root', 'unprg-web', '3306');

    echo "<br>errno: ".$mysqli->errno;
    echo "<br>error: ".$mysqli->error;
    echo "<br>connect_errno: ".$mysqli->connect_errno;
    echo "<br>connect_errno: ".$mysqli->connect_error;

?>
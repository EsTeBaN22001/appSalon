<?php

// $db = mysqli_connect('sql113.infinityfree.com', 'if0_38568589', 'BTvnKSw1Zq', 'if0_38568589_appsalon');
$db = mysqli_connect('localhost', 'root', 'root', 'appsalon');
mysqli_set_charset($db, 'utf8');

if (!$db) {
	echo "Error: No se pudo conectar a MySQL.";
	echo "errno de depuración: " . mysqli_connect_errno();
	exit;
}
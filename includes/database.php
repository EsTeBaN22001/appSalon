<?php

$db = mysqli_connect('sql300.infinityfree.com', 'if0_35519129', 'I9ETe02UTsFaO', 'if0_35519129_appsalon');
mysqli_set_charset($db, 'utf8');

if (!$db) {
	echo "Error: No se pudo conectar a MySQL.";
	echo "errno de depuración: " . mysqli_connect_errno();
	exit;
}
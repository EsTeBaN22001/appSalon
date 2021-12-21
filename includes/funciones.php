<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Retorna un bool verificando si es el último id
function isLatest(string $current, string $next): bool{

    if($current !== $next){
        return true;
    }

    return false;

}

// Verificar si el usuario es un administrador
function isAdmin() : void{
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}
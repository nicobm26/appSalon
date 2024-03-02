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

function esUltimo(string $actual, string $proximo): bool{
    if($actual !== $proximo){
        return true;
    }
    return false;
}

function isAuth(): void{
    if(!isset($_SESSION['login'])){
        header('Locaction: /');
    }
}

function isAdmin(): void{
    isAuth();
    // debuguear($_SESSION); // vacioo
    if(!isset($_SESSION['admin']) || empty($_SESSION)){
        header('Locaction: /');
    }
}
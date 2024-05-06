<?php
namespace colors;

// Fonction pour afficher du texte en rouge
function red($text) {
    return "\033[0;31m$text\033[0m";
}

// Fonction pour afficher du texte en vert
function green($text) {
    return "\033[0;32m$text\033[0m";
}

function yellow($text) {
    return "\033[0;33m$text\033[0m";
}

?>

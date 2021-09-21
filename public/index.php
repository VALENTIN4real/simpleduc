<?php
/* initialisation des fichiers TWIG */
    require_once '../lib/vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
    $twig = $twig = new \Twig\Environment($loader, []);
    echo 'SIMPLEDUC';
?>
<?php namespace Config;

    define("ROOT", dirname(__DIR__) . "/");
    //Path to your project's root folder
    define("FRONT_ROOT", "/PetHero/"); // cambiar
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
    define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "img/");
    // Constantes para la base de datos
    define("DB_HOST", "localhost");
    define("DB_NAME", "PetHero");   // Nombre de la base de datos
    define("DB_USER", "root");
    define("DB_PASS", "");

?>



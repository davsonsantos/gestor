<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();
    $minCSS->add(__DIR__ . "/../../../shared/common/css/variables.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/load.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/alert.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/paginator.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/style.css");


     //Minify CSS
     $minCSS->minify(__DIR__."/../../../views/_assets/css/style.min.css");

    /**
     * JS
      */
    $minJS = new MatthiasMullie\Minify\JS();
    $minJS->add(__DIR__ . "/../../../shared/common/js/jquery.mask.js");
    $minJS->add(__DIR__ . "/../../../shared/common/js/components.js");



    //Minify JS
    $minJS->minify(__DIR__ . "/../../../views/_assets/js/scripts.min.js");
}
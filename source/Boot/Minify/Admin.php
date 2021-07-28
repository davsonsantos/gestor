<?php
if (strpos(url(), "localhost")) {
    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();
    $minCSS->add(__DIR__ . "/../../../shared/common/css/variables.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/load.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/alert.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/paginator.css");
    $minCSS->add(__DIR__ . "/../../../shared/common/css/style.css");
    // $minCSS->add(__DIR__ . "/../../../shared/common/css/datatable.css");
    $minCSS->add(__DIR__ . "/../../../shared/admin/css/style.css");
 
 
     //Minify CSS
     $minCSS->minify(__DIR__."/../../../views/_assets/admin/css/style.min.css");

    /**
     * JS
      */
    $minJS = new MatthiasMullie\Minify\JS();
    $minJS->add(__DIR__ . "/../../../shared/admin/js/off-canvas.js");  
    $minJS->add(__DIR__ . "/../../../shared/admin/js/template.js");  
    $minJS->add(__DIR__ . "/../../../shared/common/js/componets.js");  
    


    // //Minify JS
    $minJS->minify(__DIR__ . "/../../../views/_assets/admin/js/scripts.min.js");
}
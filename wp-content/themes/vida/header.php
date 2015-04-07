<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Equitel al Dia - Home</title>
        <meta name="Keywords" content="equitel, equitel al dia , cummins , c3" />
        <meta name="Description" content="mostramos todos los articulos de equitel" />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url')?>">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/css/circular_content_carousel.css">
        <link rel="icon" href="<?php bloginfo('template_url')?>/images/favicon.ico" sizes="64x64">
        
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/jquery-ui.min.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/bootstrap.min.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/jquery.slides.min.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/jquery.mousewheel.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/jquery.easing.1.3.js"></script>
        <script src="<?php bloginfo('template_url')?>/js/jquery.contentcarousel.js"></script>
        <script>
            $(function(){
                if($("#slideshow")){
                    $("#slideshow").slidesjs({
                      height: 351,
                      navigation: false,
                      play: {
                          active: false,
                          effect: "fade",
                          interval: 3000,
                          auto: true,
                          swap: true,
                          pauseOnHover: false,
                          restartDelay: 2500
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
        <div id="content">
            <nav id="menu" role="navigation">
                <form action="busqueda.php" method="get">
                <a href="<?php bloginfo('url')?>"><img src="<?php bloginfo('template_url')?>/images/logo.png" id="logo" alt="Vida" /></a>
                </form>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php 
                        wp_nav_menu(
                                array(
                                    'container' => false,
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'theme_location' => 'top-menu'
                                )
                            );
                    ?>
                </div>
            </nav>
    <?php
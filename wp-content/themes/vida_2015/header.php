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
                      height: 460,
                      navigation: false,
                      play: {
                          active: false,
                          effect: "fade",
                          interval: 68000,
                          auto: true,
                          swap: true,
                          pauseOnHover: false,
                          restartDelay: 8000
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
        <a href="<?php bloginfo('url')?>"><img src="<?php bloginfo('template_url')?>/images/logo.png" id="logo" alt="Vida" /></a>
        <div id="whiteBar">
            <div id="menu" role="navigation">
                <div id="search">
                <?php echo $search = str_replace('id="s"','id="s" placeholder = "Búsqueda"',get_search_form(false)); ?>
                </div>
                <div id="login">
                <?php 
                $url = wp_login_url($redirect);
                if ( is_user_logged_in() ): 
                    $url = get_admin_url();?>
                <a class="ingresarPortal" href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">Salir</a>
                <?php else:?>
                <a class="ingresarPortal" href="<?php echo $url; ?>">Ingresar</a>
                <?php endif;?>
            </div>
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
            </div>
        </div>
        
        <div id="content">
            
            <section id="main">
            <div id="bannerPrincipal">
                <div id="slider">
                    <?php include TEMPLATEPATH .'/slideshow.php';?>
                </div>           
            </div>
            <div id="botones">
                <a href="http://www.equitel.com.co" target="_blank" class="equitel"></a>
                <a href="http://www.enconexion.com.co" target="_blank" class="enconexion"></a>
                <a href="https://www.facebook.com/equitel" target="_blank" class="facebook"></a>
                <a href="https://www.youtube.com/user/EquitelTV" class="youtube" target="_blank"></a>
            </div>
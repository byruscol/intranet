<?php get_header();?>
        <section id="main">
            <div id="bannerPrincipal">
                <div id="slider">
                    <?php include TEMPLATEPATH .'/slideshow.php';?>
                </div>
                
                <div id="fotoSemana">
                    <?php include TEMPLATEPATH .'/fotoActitud.php';?>
                    <?php 
                    $category_id = get_cat_ID( 'Foto actitud' );
                    $category_link = get_category_link( $category_id );
                    ?>
                    <a href="<?php echo $category_link; ?>" class="leerMas">Foto con actitud <span>+</span></a>
                </div>            
            </div>
            <div id="cuerpo">
                <div id="contenidoCuerpo">
                    
                    <h1 class="titleArticulos">Últimos artículos</h1>
                    <?php query_posts("paged=$paged");?>
                    <?php if(have_posts()): while (have_posts()): the_post();?>
                        <div class="bloqueArticulo">
                            <div class="imgListArticles">
                            <a href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()){the_post_thumbnail('slider_small_thumbs');}?></a>
                            </div>
                            <h3><?php echo $t= str_replace("Private:","",  the_title("", "", false)); ?></h3>
                            <div class="excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="leerMasArticleList">Leer mas <span>></span></a>
                        </div>
                    <?php endwhile;
                    else:?>
                        No se encontraron artículos
                    <?php endif;?>
                                        
                                        <div id="bannerArticulos">
                        <div id="videoArticulo">
                            <h3 class="tituloBanner">Video con actitud <span>+</span></h3>
                            <a href="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/galarticulo/video/a87d36_zeus3_01.jpg" style="display:block;width:444px;height:251px; margin-top: 5px;" id="playerInterna"></a>
                            <script type="text/javascript">
                                flowplayer("playerInterna", "jquery/flowplayer-3.2.5.swf",{
                                clip: {

                                    // these two configuration variables does the trick
                                    autoPlay: false,
                                    autoBuffering: true // <- do not place a comma here
                                }
                                });
                            </script>
                        </div>
                        <div id="portalesAmigos">
                            <h3 class="tituloBanner">Portales amigos<span>+</span></h3>
                                                        <a target="_blank" href="http://www.enconexion.com.co"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/5b5076_enconexion-26.png" alt="enConnexion" title="enConnexion" border="0" /></a>
                                                        <a target="_blank" href="http://www.culturavida.com"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/e01dba_VIDA-27.png" alt="Cultura VIDA" title="Cultura VIDA" border="0" /></a>
                                                    </div>
                    </div>
                </div>
                <div id="menuPagina">
                                                    <div id="login">
                                                <a href="http://www.culturavida.com/index.php"><img src="images/banner_vida.png" alt="Cultura Vida" title="Cultura Vida" border="0" /></a>
                                            </div>
                    <div id="publicidad">
                                                    <a href="murovida.php?username=&idUsuario=&nombre=" ><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/91f5a6_buzon copy.jpg" alt="Muro de VIDA" title="Muro de VIDA" border="0" /></a>
                                                                            <a target="_blank" href="http://www.equitel.com.co/html/contacto.html"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/9ccc27_Contacto.jpg" alt="Contacto Equitel" title="Contacto Equitel" border="0" /></a>
                                                                        <a target="_blank" href="http://www.facebook.com/pages/Organización-Equitel/36254260198"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/4b4723_Face.png" alt="Siguenos en Facebook" title="Siguenos en Facebook" border="0" /></a>
                                            </div>                </div>
            </div>
        </section>
        <div style="clear: both"></div>
        <div id="pie">
            <a href="http://www.c3comunicaciones.com" title="Pulse para consultar el sitio c3comunicaciones, abre en nueva ventana" target="blank"><img src="images/barra_inferior.png" border="0" /></a>        </div>
    </body>
</html>
<?php /*get_header();?>
        <section id="main">
            <div id="no-slide">
                <?php include TEMPLATEPATH .'/slideshow.php';?>
            </div>
            <section id="columna1">
                
                <?php if(have_posts()): while(have_posts()) : the_post();?>
                    <?php if (in_category('Home') ) : ?>
                        <div class="home_txt">
                            <h2><a href="<?php the_permalink();?>"><b><?php the_title();?></b></a></h2>
                            <p><?php the_excerpt();?></p>
                        </div>
                    <?php endif;?>
                <?php endwhile; else:?>
                <div class="home_txt">
                    <h2>No hay artículos</h2>
                    <p>No hay artículos</p>
                </div>
                <?php endif;?>
		
                <div id="fb_box">
			<div id="titulo_fb">
                            <h3>Haga parte de nuestra comunidad</h3>
			</div>
                    <div class="fb-like-box" data-href="https://www.facebook.com/comunidadlaflota" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
		</div>
            </section>
            <?php get_sidebar();?>           
        </section>
<?php get_footer();*/?>    


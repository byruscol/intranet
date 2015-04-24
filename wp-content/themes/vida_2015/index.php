<?php get_header();?>
            <div id="cuerpo">
                <h1 class="titleArticulos">Últimos artículos</h1>
                <div id="contenidoCuerpo">
                    <?php 
                    $args = array(
                        'numberposts' => 4,
                        'offset' => 0,
                        'category' => 0,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                        'post_status' => 'publish, private',
                        'suppress_filters' => true 
                    );

                    $recent_posts = wp_get_recent_posts( $args );
                    if(count($recent_posts) > 0):
                    foreach( $recent_posts as $recent ): $permalink = get_permalink($recent["ID"]); $thumbnail =  get_the_post_thumbnail( $recent["ID"], 'slider_small_thumbs' );?>
                    <div class="bloqueArticulo">
                        <div class="imgListArticles">
                        <a href="<?php echo $permalink; ?>"><?php echo $thumbnail;?></a>
                        </div>
                        <h3><span><?php echo $recent["post_title"]; ?></span></h3>
                        <div class="excerpt"><?php echo $recent["post_excerpt"]; ?></div>
                        <a href="<?php echo $permalink; ?>" class="leerMasArticleList">Leer más</a>
                    </div>
                    <?php endforeach;
                    else:?>
                        No se encontraron artículos
                    <?php endif;?>
<?php get_footer();?> 
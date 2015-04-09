<section id="slideshow">
    <?php 
    $args = array(
        'numberposts' => 5,
        'offset' => 0,
        'category_name' => 'slideshow',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish, private',
        'suppress_filters' => true 
    );

    $recent_posts = wp_get_recent_posts( $args );
    if(count($recent_posts) > 0):
    foreach( $recent_posts as $recent ): $permalink = get_permalink($recent["ID"]); $thumbnail =  get_the_post_thumbnail( $recent["ID"], 'slider_thumbs' );?>
    <div class="slide">
        <a class="slideThumbnail" href="<?php echo $permalink; ?>"><?php echo $thumbnail;?></a>
        <article class="bannerText">
            <hgroup>
                <h2 class="titleBanner"><a href="<?php echo $permalink; ?>"><?php echo $t= str_replace("Private:","",  $recent["post_title"]); ?></a></h2>
            </hgroup>
            <p>
                <?php echo $recent["post_excerpt"]; ?>
            </p>
            <p>
                <a class="leerMas" href="<?php echo $permalink; ?>">Leer mas <span>></span></a>
            </p>
        </article>
    </div>        
    <?php endforeach; else: ?>
    <div class="home_txt">
        <h2>No hay imagenes</h2>
    </div>
    <?php endif; ?>
</section>
<section id="slideshow">
    <?php $query = new WP_Query( 'category_name=SlideShow' );
    if($query->have_posts()):while($query->have_posts()): $query->the_post();?>
        <div class="slide">
            <a class="slideThumbnail" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()){the_post_thumbnail('slider_thumbs');}?></a>
            <article class="bannerText">
                <hgroup>
                    <h2 class="titleBanner"><a href="<?php the_permalink(); ?>"><?php echo $t= str_replace("Private:","",  the_title("", "", false)); ?></a></h2>
                </hgroup>
                <p>
                    <?php the_excerpt(); ?>
                </p>
                <p>
                    <a class="leerMas" href="<?php the_permalink(); ?>">Leer mas <span>></span></a>
                </p>
            </article>
        </div>
    <?php endwhile; else:?>
    <div class="home_txt">
        <h2>No hay imagenes</h2>
    </div>
    <?php endif;?>
</section>
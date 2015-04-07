<?php $query = new WP_Query( 'category_name=foto-actitud' );
if($query->have_posts()):while($query->have_posts()): $query->the_post();?>
    <a class="slideThumbnail" href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()){the_post_thumbnail('slider_small_thumbs');}?></a>

<?php endwhile; else:?>
    <h2>No hay imagenes</h2>
<?php endif;?>
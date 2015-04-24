<?php 
$args = array(
    'numberposts' => 1,
    'offset' => 0,
    'category_name' => 'foto-actitud',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish, private',
    'suppress_filters' => true 
);

$recent_posts = wp_get_recent_posts( $args );

foreach( $recent_posts as $recent ): $thumbnail =  get_the_post_thumbnail( $recent["ID"], 'foto_actitud_thumbs' );?>
    <?php echo $thumbnail;?>
<?php endforeach; ?>

<?php 
$args = array(
    'numberposts' => 1,
    'offset' => 0,
    'category_name' => 'video-actitud',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish, private',
    'suppress_filters' => true 
);

$recent_posts = wp_get_recent_posts( $args );
foreach( $recent_posts as $recent ): $thumbnail =  get_the_post_thumbnail( $recent["ID"], 'slider_small_thumbs' );?>
<?php 
        $content = str_replace(array("[embed]","[/embed]"),"",$recent["post_content"]);
        $matches = array();
        preg_match('|https://www.youtube.com/watch\?v=([a-zA-Z0-9_]+)|', $content, $matches);
        if (!empty($matches[1])) : ?>
        <iframe width="440" height="230" src="https://www.youtube.com/embed/<?php echo $matches[1] ?>" frameborder="0" allowfullscreen></iframe>
        <br>
        <a class="leerMas leerMasBlack" href="<?php echo get_permalink($recent["ID"]); ?>">Ver más <span>></span></a>
<?php endif; endforeach; ?>

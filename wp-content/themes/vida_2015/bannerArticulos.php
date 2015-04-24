<div id="bannerArticulos">
    <div id="videoArticulo">
        <div class="videActitud">
        <?php include TEMPLATEPATH .'/videoActitud.php';
        $category_id = get_cat_ID( 'Video actitud' );
        $category_link = get_category_link( $category_id );
        ?>
        </div>
        <h3 class="tituloBanner">Video con actitud
        <a class="masFoto" href="<?php echo $category_link; ?>">Ver más</a></h3>
    </div>
    <div id="fotoSemana">
        <div class="fotoActitud">
        <?php include TEMPLATEPATH .'/fotoActitud.php';
        $category_id = get_cat_ID( 'Foto actitud' );
        $category_link = get_category_link( $category_id );
        ?>
        </div>
        <h3 class="tituloBanner">Foto con actitud
        <a class="masFoto" href="<?php echo $category_link; ?>">Ver más</a>
        </h3>
    </div>
    
</div>
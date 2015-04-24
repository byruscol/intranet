<div id="login">
    <?php 
    $url = wp_login_url($redirect);
    if ( is_user_logged_in() ): $url = get_admin_url();?>
    <a class="ingresarPortal" href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">Cerrar sesión</a>
    <?php endif;?>
    <a class="ingresarPortal" href="<?php echo $url; ?>">Ingresar al portal Vida</a>
</div>
<div id="publicidad">
    <a target="_blank" href="http://www.equitel.com.co/html/contacto.html"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/9ccc27_Contacto.jpg" alt="Contacto Equitel" title="Contacto Equitel" border="0" /></a>
    <a target="_blank" href="http://www.facebook.com/pages/Organización-Equitel/36254260198"><img src="http://www.culturavida.com/equitelaldia/../../../equitelaldia/images/banners/4b4723_Face.png" alt="Siguenos en Facebook" title="Siguenos en Facebook" border="0" /></a>
</div>
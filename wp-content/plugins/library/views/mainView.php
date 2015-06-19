<?php
require_once $pluginPath . "/helpers/resources.php";

if(empty($_GET["page"])){
    $viewDir = "basic";
    $viewName = "basic";
}else{
    $viewDir = $_GET["page"]."View";
    switch ($_GET["task"]){
        case "Details": $viewName = $_GET["page"]."DetailsView";break;
        default: $viewName = $_GET["page"]."View";break;
    }  
}

$viewFile = $pluginPath . "/views/" . $viewDir . "/" . $viewName . ".php";
$resource = new resources();

if(!file_exists($viewFile)){
	$viewFile = $pluginPath. "/views/basicView/basicView.php";
}

function clientes() {
    global $pluginPath;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}

function vehiculos() {
    global $pluginPath;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}

function extensiones() {
    global $pluginPath;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}

function muestras() {
    global $pluginPath;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}
    
class WPcustomized {
        static $add_script;

        static function init() {
                add_filter( 'login_redirect', create_function( '$url,$query,$user', 'return admin_url();' ), 10, 3 );
                add_action('admin_menu',array(__CLASS__, 'wp_hide_update'));
                add_action('wp_dashboard_setup', array(__CLASS__, 'remove_dashboard_widgets') );
                add_action('wp_dashboard_setup', array(__CLASS__, 'custom_dashboard_widgets'));
                
                add_action('admin_head', array(__CLASS__, 'custom_logo'));

                add_action('admin_head', array(__CLASS__, 'register_script'));
        }
       
        static function custom_logo() {
           echo '<style type="text/css">
                        #wp-admin-bar-wp-logo{display:none;}
                        #header-logo { background-image: url('.get_bloginfo('template_directory').'/images/logo-c-small.png) !important; }'
                   . '</style>';
        }
        static function wp_hide_update(){
            global $current_user;
            get_currentuserinfo();

            if ($current_user->data->ID != 1) { // solo el admin lo ve, cambia el ID de usuario si no es el 1 o añade todso los IDs de admin
                remove_action( 'admin_notices', 'update_nag', 3 );
            }
        }
        
        static function customerFiles_dashboard_widget_function() {
            $template =  file_get_contents(__DIR__."/dashBoardView/clientesFilesView.php");
                
            echo $template;
        }

        static function vehiculos_dashboard_widget_function() {
            $template =  file_get_contents(__DIR__."/dashBoardView/vehiculosView.php");
                
            echo $template;
        }
        
         static function hojaVida_dashboard_widget_function() {
             $template =  file_get_contents(__DIR__."/dashBoardView/hojaVidaView.php");
            $template .=  file_get_contents(__DIR__."/dashBoardView/vehiclesFilesView.php");
                
            echo $template;
        }
        
        static function params_dashboard_widget_function(){
            $template =  file_get_contents(__DIR__."/dashBoardView/params.php");
           
            echo $template;
        }
        
        static function laflota_dashboard_widget_function(){
            $template =  file_get_contents(__DIR__."/myFleetView/myFleetView.php");
           
            echo $template;
        }

        static function custom_dashboard_widgets(){
            global $wp_meta_boxes;
            
            if(current_user_can( "publish_posts" )){
                add_meta_box( 'params_dashboard_widget', 'Seleccione cliente', array(__CLASS__, 'params_dashboard_widget_function'), 'dashboard', 'normal', 'high' );
            }
            
            add_meta_box( 'vehiculos_dashboard_widget', 'Mi flota de vehículos', array(__CLASS__, 'vehiculos_dashboard_widget_function'), 'dashboard', 'normal', 'high' );
            add_meta_box( 'customerFiles_dashboard_widget', 'Archivos de interés', array(__CLASS__, 'customerFiles_dashboard_widget_function'), 'dashboard', 'normal', 'high' );
            add_meta_box( 'hojaVida_dashboard_widget', 'Hoja de vida', array(__CLASS__, 'hojaVida_dashboard_widget_function'), 'dashboard', 'side', 'high' );
            add_meta_box( 'laflota_dashboard_widget', 'La Flota', array(__CLASS__, 'laflota_dashboard_widget_function'), 'dashboard', 'side', 'high' );
        }
        
        static function remove_dashboard_widgets(){
            global $wp_meta_boxes;
            global $wp_filter;
            
            unset ($wp_filter['welcome_panel']);
            remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
            
        }
        
        static function handle_shortcode($atts) {
                
                global $resource;
                self::$add_script = true;
                if ( !is_user_logged_in() )
                    return $resource->getWord("necesitaAutenticarse");
                
                $template =  file_get_contents(__DIR__."/miFlotaUserView/miFlotaUserView.php");
                $template = str_replace("{placa}", $resource->getWord("placa"), $template);
                $template = str_replace("{buscarPlaca}", $resource->getWord("buscarPlaca"), $template);
                $template = str_replace("{placasCriticas}", $resource->getWord("placasCriticas"), $template);
                $template = str_replace("{placasExtendidas}", $resource->getWord("placasExtendidas"), $template);
                
                return $template;
        }

        static function register_script() {

                if ( is_user_logged_in() ){
                    wp_register_script('clienteFiles', plugins_url('../views/dashBoardView/JSScripts/filesGrid.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('clienteFiles');
                    
                    wp_register_script('vehiculos', plugins_url('../views/dashBoardView/JSScripts/vehiculos.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('vehiculos');
                    
                    wp_register_script('vehiclesFiles', plugins_url('../views/dashBoardView/JSScripts/vehiclesFilesGrid.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('vehiclesFiles');
                    
                    wp_register_script('hojaVida', plugins_url('../views/dashBoardView/JSScripts/hojaVida.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('hojaVida');
                    
                    wp_register_script('myFleet', plugins_url('../views/myFleetView/JSScripts/myFleet.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('myFleet');
                    
                    if(current_user_can( "publish_posts" )){
                        wp_register_script('params', plugins_url('../views/dashBoardView/JSScripts/params.php', __FILE__), array('jquery'), '1.0', true);
                        wp_enqueue_script('params');
                    }
                    
                    
                    /*wp_register_style( 'bootstrapThemeCss', plugins_url('../css/bootstrap-theme.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapThemeCss' );*/
                    
                    /*wp_register_style( 'bootstrapResponsiveCss', plugins_url('../css/bootstrap-responsive.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapResponsiveCss' );
                    wp_register_style( 'bootstrapThemeCss', plugins_url('../css/bootstrap-theme.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapThemeCss' );
                    
                    wp_register_style( 'flexslider', plugins_url('../css/flexslider.css', __FILE__));
                    wp_enqueue_style( 'flexslider' );
                    
                    wp_register_style( 'uiCss', plugins_url('../css/jqGrid/themes/ui-lightness/jquery-ui.min.css', __FILE__));
                    wp_enqueue_style( 'uiCss' );

                    wp_register_style( 'gridCss', plugins_url('../css/jqGrid/ui.jqgrid.css', __FILE__));
                    wp_enqueue_style( 'gridCss' );

                    wp_register_style( 'pluginCss', plugins_url('../css/plugincss.css', __FILE__) );
                    wp_enqueue_style( 'pluginCss' );


                    wp_register_script('jqGridLocale_es', plugins_url('../js/jqGrid/grid.locale-es.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jqGridLocale_es');
                
                    wp_register_script('jqGrid', plugins_url('../js/jqGrid/jquery.jqGrid.src.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jqGrid');

                    wp_register_script('flexslider', plugins_url('../js/jquery.flexslider-min.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script( 'flexslider' );
        
                    wp_register_script('pluginjs', plugins_url('../js/pluginjs.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('pluginjs');

                    wp_register_script('myFleet', plugins_url('miFlotaUserView/JSScripts/myFleet.php', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('myFleet');
                    */
                }

        }

        static function print_script() {
                if ( ! self::$add_script )
                        return;
                if ( is_user_logged_in() ){
                    wp_print_scripts('clienteFiles');
                }
        }
}

if(substr_count($_SERVER["PHP_SELF"],"index.php") > 0)
    WPcustomized::init();

?>

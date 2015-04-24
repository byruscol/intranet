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

function integrantes() {
    global $pluginPath;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}

function familiares() {
    global $pluginPath;
    global $pluginURL;
    global $viewFile;
    global $resource;
    require_once($viewFile);
}

add_filter('login_redirect', 'my_login_redirect',100,3);
function my_login_redirect($redirect_to, $request){
      
    return admin_url( 'admin.php?page=integrantes' );
    
}

 class library_Shortcodes {
        static $add_script;
        static $p;
        static function init() {

            add_shortcode('library_Shortcode', array(__CLASS__, 'library_handle_shortcode'));
            
            //if(!is_admin()){

                add_action('init', array(__CLASS__, 'register_script'));
                add_action('wp_footer', array(__CLASS__, 'print_script'));
            //}
        }
        
	static function addStyle(){
		echo '<style>aside{
				    width: 0px !important;
				}

				.entry-content-wrapper li {
				    margin-left: 1px !important;
				}

				#top #main .container{
					width: 987px;
				}

				.container .nine.units {
				    width: 100% !important;
				}</style>';
	}

        static function library_handle_shortcode($atts) {
            
            ?>
                <canvas id="the-canvas" style="border:1px solid black;"/>
            <?php
            /*<iframe src="http://docs.google.com/gview?url=http://infolab.stanford.edu/pub/papers/google.pdf&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>
             * <iframe src="http://localhost/apps/wp-content/plugins/EqApp_RH/viewFile.php" style="width:600px; height:500px;" frameborder="0"></iframe>
             * global $resource;
		
            self::$add_script = true;
            if ( !is_user_logged_in() )
                return $resource->getWord("necesitaAutenticarse");
            else
                include (__DIR__."/PQRCustomerServiceView/PQRCustomerServiceView.php");
	     
            self::addStyle();*/
        }
        
	
        static function viewJSScripts() {
            /*global $pluginURL;
            global $pluginPath;

	    if(strpos($_SERVER["REDIRECT_URL"],"sgc-2"))
                $folder = "PQRCustomerService";
            elseif(strpos($_SERVER["REDIRECT_URL"],"quejas-y-reclamos")) 
		$folder = "nonConformity";
            elseif(strpos($_SERVER["REDIRECT_URL"],"peticiones"))
                $folder = "request";
            elseif(strpos($_SERVER["REDIRECT_URL"],"tareas-pqr"))
                $folder = "tasks";
            elseif(strpos($_SERVER["REDIRECT_URL"],"solicitudes-de-accion"))
                $folder = "request";
            elseif(strpos($_SERVER["REDIRECT_URL"],"documentos"))
                $folder = "documents";
            
            
            $JSPath = $pluginPath."/views/" . $folder . "View/JSScripts/";
            $JSURL = $pluginURL."views/" . $folder . "View/JSScripts/";
            
            if(is_dir($JSPath))
            {
                $dir = opendir($JSPath);
                while ($file = readdir($dir)){
                    if( $file != "." && $file != ".."){
                        if(is_file($JSPath.$file)){
                            $js =  $JSURL . $file ."?view=" . $folder;
                            if(array_key_exists('rowid', $_GET))
                                $js .= "&rowid=" . $_GET["rowid"];
                            $registerName = str_replace(".","",$file)."_" . $folder;
                            wp_register_script($registerName, $js, array('jquery'), '1.0', true);
                            wp_enqueue_script($registerName);
                        }
                    }
                }
            }*/
        }
        
        static function register_script() {
          
                if ( is_user_logged_in() ){
                    wp_register_script('pdf', plugins_url('../js/pdfjs/pdf.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('pdf');
                    /*wp_register_script('worker_loader', plugins_url('../js/pdfjs/worker_loader.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('worker_loader');*/
                    /*wp_register_script('hello', plugins_url('../js/hello.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('hello');*/
                     /*wp_register_style( 'bootstrapCss', plugins_url('../css/bootstrap.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapCss' );
                    
                    wp_register_style( 'bootstrapResponsiveCss', plugins_url('../css/bootstrap-responsive.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapResponsiveCss' );
                    
                    wp_register_style( 'bootstrapThemeCss', plugins_url('../css/bootstrap-theme.min.css', __FILE__));
                    wp_enqueue_style( 'bootstrapThemeCss' );
                   
                    wp_register_style( 'uiCss', plugins_url('../css/jqGrid/themes/ui-lightness/jquery-ui.min.css', __FILE__));
                    wp_enqueue_style( 'uiCss' );

                    wp_register_style( 'gridCss', plugins_url('../css/jqGrid/ui.jqgrid.css', __FILE__));
                    wp_enqueue_style( 'gridCss' );

                    wp_register_style( 'pluginCss', plugins_url('../css/plugincss.css', __FILE__) );
                    wp_enqueue_style( 'pluginCss' );

                    wp_register_style( 'front-end', plugins_url('../css/front-end.css', __FILE__) );
                    wp_enqueue_style( 'front-end' );

                    wp_register_script('jqGridLocale_es', plugins_url('../js/jqGrid/grid.locale-es.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jqGridLocale_es');
                
                    wp_register_script('jqGrid', plugins_url('../js/jqGrid/jquery.jqGrid.src.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jqGrid');
        
                    wp_register_script('ajaxfileupload', plugins_url('../js/ajaxfileupload.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('ajaxfileupload');
        
                    wp_register_script('tinymce', plugins_url('../js/tinymce/tinymce.min.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('tinymce');
                    
                    wp_register_script('tinymceJQuery', plugins_url('../js/tinymce/jquery.tinymce.min.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('tinymceJQuery');
                                       
                    wp_register_script('googlechart', 'https://www.google.com/jsapi', array('jquery'), '1.0', true);
                    wp_enqueue_script('googlechart');
                    
                    wp_register_script('pluginjs', plugins_url('../js/pluginjs.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('pluginjs');
                                        
                    wp_register_script('jquery-u', plugins_url('../js/jquery-ui-1.10.4.custom.min.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jquery-u');
                    
                    wp_register_script('jCombo', plugins_url('../js/jquery.jCombo.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('jCombo');
                    
                    wp_register_script('bootstrap', plugins_url('../js/bootstrap.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('bootstrap');
                    
                    wp_register_script('ExportExcel', plugins_url('../js/jqgridExcelExportClientSide.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('ExportExcel');
                    
                    wp_register_script('ExportExcelclient', plugins_url('../js/jqgridExcelExportClientSide-libs.js', __FILE__), array('jquery'), '1.0', true);
                    wp_enqueue_script('ExportExcelclient');
                    
                    self::viewJSScripts();*/
                    
                }

        }

        static function print_script() {
           
                if ( ! self::$add_script )
                        return;
                if ( is_user_logged_in() ){
                    wp_print_scripts('pdf'); 
                    wp_print_scripts('worker_loader');
                    wp_print_scripts('hello');
                    //wp_print_scripts('jquery-u');*/
                }
        }
}
if(!is_admin())
    library_Shortcodes::init();
?>

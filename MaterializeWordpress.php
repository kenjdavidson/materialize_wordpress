<?php

/**
 * Initialize the MaterializePlugin within the Wordpress environment.  The
 * plugin class provides static activate and deactivate functions, as well as 
 * initialization functions used to setup short codes.
 *
 * @author kendavidson
 * @link http://www.kenjdavidson.com/web/materialize-wordpress
 * @since 1.0.0
 * 
 * @package MaterializeWordpress
 */
class MaterializeWordpress {

    /**
     * Static function activate is called to install/activate the plugin.  Currently
     * it does not perform any specific functionality.
     * 
     * @since 1.0.0
     */
    static function activate() {
        
    }
    
    /**
     * Static function deactivate is called to un-install/deactivate the plugin.
     * Currently it does not perform any specific functionality.
     */
    static function deactivate() {
        
    }
    
    protected $pluginName;
    protected $version;
    
    
    /**
     * Constructor method.  
     */
    public function __construct() {
        $this->pluginName = 'MaterializeWordpress';
        $this->version = '1.0.0'; 
        
        // Turn this off for now, eventually add a flag in Admin to set whether
        // materialize libraries are already loaded
        //add_action('wp_enqueue_scripts', array(&$this, 'enqueueMaterialize'));       
        
        $this->loadShortcodes();
        
        if (is_admin()) {
            
        }
    }
    
    /**
     * Loads all the installed shortcodes at the __DIR__ . /shortcodes folder and includes
     * and implements all the shortcodes available.  This requires that all
     * shortcode/class.php is named correctly.
     */
    public function loadShortcodes() {
        $dir = __DIR__ . '/shortcodes/';
        $files = scandir( $dir );
        if ($files) {
            foreach($files as $file) {
                if (is_file($dir . $file)) {
                    require( $dir . $file );

                    $clazz = substr($file, 0, strlen($file) - 4);                    
                    $r = new ReflectionClass($clazz);
                    $shortcode = $r->newInstanceArgs(array($this->version));
                }
            }
        }
    }
   
    /**
     * Enqueue the scripts required.
     */
    public function enqueueScripts() {
        wp_enqueue_style('materialize',
                'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css',
                array(),
                '0.100.2');
                
        wp_enqueue_script('materialize', 
                'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js', 
                array('jquery'), 
                '0.100.2');
    }    
    
    /**
     * Gets the pluginName
     * @return String
     */
    public function getPluginName() {
        return $this->pluginName;
    }
    
    /**
     * Gets the version
     * @return String
     */
    public function getVersion() {
        return $this->version;
    }
}

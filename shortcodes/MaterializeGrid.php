<?php

/**
 * MaterializeGrid provides Wordpress functionality of the Grid
 * framework.  The MaterialGrid contains two shortcodes that are 
 * used to create the Materialize CSS elements:
 * 
 * To implement a row:
 * [mdw-row
 *      container="[true | false]"        // Add 'container' to the row
 *      classes="special row"   // Add other classes to the row
 * ]
 * 
 * to implement the subsequent columns:
 * 
 * [mdw-col
 *      sizes="s12 m12 l6"      // Appropriate sizes
 *      classes="push-l6"       // Added classes
 * ][/mdw-col]
 * [mdw-col
 *      sizes="s12 m12 l6"      // Appropriate sizes
 * ][/mdw-col]
 * 
 * The previous shortcodes will result in:
 * 
 * <div class="row container">
 *      <div class="col s12 m12 l6 push-l6"></div>
 *      <div class="col s12 m12 l6"></div>
 * </div>
 *
 * @link http://www.kenjdavidson.com/web/materialize-wordpress
 * @since 1.0.0
 * 
 * @author kendavidson
 * 
 * @package MaterializeWordpress
 * @subpackage MaterializeWordpress/shortcodes
 * 
 * @link http://materializecss.com/grid.html
 */
class MaterializeGrid {

    private $version;
    
    /**
     * Initialize the MaterializeGrid shortcode
     * @param String $version
     */
    public function __construct($version) {
        $this->version = $version;
        
        add_shortcode('mdw-row', array(&$this, 'handleRow'));
        add_shortcode('mdw-col', array(&$this, 'handleCol'));
    }
    
    /**
     * Handle the [mdw-row] short code.  Short code can contain attributes:
     * - container = [true]
     * - classes ="extra-classes"
     * 
     * which will be merged into the classes field.
     * @param Array $atts
     * @param String $content
     * @param String $tag
     * @return String
     */
    public function handleRow($atts = [], $content = null, $tag = '') {
        $lAtts = array_change_key_case((array)$atts, CASE_LOWER);
        $options = shortcode_atts([
            'container'     => false,
            'classes'       => ''
        ], $lAtts);
        
        $isContainer = $options['container'] ? 'container' : '';
        $result = "<div class=\"mdw row {$isContainer} {$options['classes']}\">";
        $result .= do_shortcode($content);
        $result .= "</div>";
        
        return $result;
    }
    
    /**
     * Handle the [mdw-col] short code.  [mdw-col] should be wrapped within
     * an [mdw-row] short code for best functionality.  The attributes should
     * contain:
     * - sizes = "sX mY lZ"
     * - classes = "extra-classes"
     * which will be merged into the classes field.
     * 
     * @param Array $atts
     * @param String $content
     * @param String $tag
     * @return String
     */
    public function handleCol($atts = [], $content = null, $tag = '') {
        $lAtts = array_change_key_case((array)$atts, CASE_LOWER);
        $options = shortcode_atts([
            'sizes'         => 's12',
            'classes'       => ''
        ], $lAtts);
        
        $result = "<div class=\"mdw col {$options['sizes']} {$options['classes']}\">";
        $result .= do_shortcode($content);
        $result .= "</div>";
        
        return $result;        
    }
}

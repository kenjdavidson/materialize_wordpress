<?php

/**
 * MaterializeCarousel provides a number of available Materialize JavaScript
 * carousel features within Wordpress.  There is one shortcode for the
 * MaterializeCarousel:
 * 
 * [mdw-carousel
 *      id="mycarousel"
 *      slider="[true | false]
 *      classes="list of classes"
 *      [gallery sizes="[thumbnail|full" ids="..."]
 * ]
 *      [Wordpress Gallery]
 * [/mdw-carousel]
 * 
 * or
 * 
 * [mdw-carousel
 *      id="mycarousel"
 *      slider="[true | false]
 *      indicators="[true | false]"
 * ]
 *      [mdw-carousel-item]....[/mdw-carousel-item]
 *      [mdw-carousel-item]....[/mdw-carousel-item]
 * [/mdw-carousel]
 * 
 * <div id="mycarousel" class="carousel">
 *      ...
 * </div>
 *
 * @author kendavidson
 * 
 * @package MaterializeWordpress
 * @subpackage MaterializeWordpress/shortcodes
 * 
 * @link http://materializecss.com/carousel.html
 */
class MaterializeCarousel {
    
    private $version;
    
    /**
     * Initialize the MaterialCarousel shortcode
     * @param String $version
     */
    public function __construct($version) {
        $this->version = $version;       
        
        add_action('wp_enqueue_scripts', array(&$this,'enqueueScript'));
        
        add_shortcode('mdw-carousel', array(&$this, 'handleCarousel'));
        add_shortcode('mdw-carousel-item', array(&$this, 'handleItem'));        
    }
    
    /**
     * Enqueue the mdw-carousel Script
     */
    public function enqueueScript() {
        wp_enqueue_style('mdw-carousel', 
                plugin_dir_url(__FILE__) . 'css/mdw-carousel.css', 
                array(), 
                $this->version);              
    }
    
    /**
     * Handle the [mdw-carousel] short code.  Short code can contain the 
     * attributes:
     * - slider = [true|false]
     * - indicators = [true|false]
     * 
     * @param type $atts
     * @param type $content
     * @param type $tag
     */
    public function handleCarousel($atts = [], $content = null, $tag = '') {
        $options = shortcode_atts([
            'id'            => 'carousel',
            'timer'         => 3000,
            'classes'       => '',
            'duration'      => 200,
            'dist'          => -100,
            'shift'         => 100,
            'padding'       => 20,
            'fullwidth'     => 'false',
            'indicators'    => 'false',
            'nowrap'        => 'false'
        ], $atts);       
                       
        $variableId = 'mdw_carousel_' . $options['id'];        
        $sliderCss = $options['fullwidth'] ? 'carousel-slider' : 'no-slider';
        
        wp_enqueue_script('mdw-carousel', 
                plugin_dir_url(__FILE__) . 'js/mdw-carousel.js', 
                array('jquery','materialize'), 
                $this->version);                
        
        $result = "<p><div id=\"{$options['id']}\" class=\"mdw carousel {$sliderCss} {$options['classes']}\" data-variables=\"{$variableId}\">";               
        
        $isGallery = '/\[gallery.+]/';        
        preg_match($isGallery, $content, $matches);              
        if (count($matches) > 0) {
            $result .= $this->handleGalleryItems($matches);
        } else {
            $result .= do_shortcode($content);            
        }
        
        $result .= "</div></p>";
        
        $jsOptions = array(
            'id'        => $options['id'],
            'config'    => array(
                'timer'         => $options['timer'],
                'duration'      => $options['duration'],
                'dist'          => $options['dist'],
                'shift'         => $options['shift'],
                'padding'       => $options['padding'],
                'fullWidth'     => $options['fullwidth'],
                'indicators'    => $options['indicators'],
                'noWrap'        => $options['nowrap']               
            )
        );
        wp_localize_script('mdw-carousel', $variableId, $jsOptions);  
        
        return $result;
    }
    
    /**
     * Handles output specific carousel items.
     * 
     * @param type $atts
     * @param type $content
     * @param type $tag
     */
    public function handleItem($atts = [], $content = null, $tag = '') {
        $result = "<div class=\"mdw carousel-item\">";
        $result .= do_shortcode($content);
        $result .= "</div>";
        
        return $result;        
    }
    
    /**
     * Handles converting media Ids to carousel-item elements.  The
     * $matches array contains:
     * 
     * 0 => the full match
     * 1 => size
     * 2 => link
     * 3 => media ids 
     * 
     * @param Array $idString comma separated string of media Ids
     */
    private function handleGalleryItems($matches) {
        preg_match('/size="(\w+)"/', $matches[0], $sizes);
        preg_match('/link="(\w+)"/', $matches[0], $links);
        preg_match('/ids="([\d,]+)"/', $matches[0], $ids); 
        
        $size = count($sizes) == 2 ? $sizes[1] : null;
        $link = count($links) == 2 ? $links[1] : null;
        $mediaIds = count($ids) == 2 ? explode(",", $ids[1]) : null;       
        
        $result = '';
        
        foreach($mediaIds as $media) {
            $result .= "<div class=\"mdw carousel-item\">";
            $result .= wp_get_attachment_image($media, $size, false);
            $result .= "</div>";
        }
        
        return $result;        
    }
}

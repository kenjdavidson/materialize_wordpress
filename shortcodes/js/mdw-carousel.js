(function($){
    $(document).ready(function(){
        $('.carousel').each(function(index){
            var $carousel = $(this);
            var varName = $carousel.data('variables');
            var options = window[varName];            
            
            var images = $('img', $carousel);
            if (images.length > 0) {
                $(images[0]).ready(function(){resize($carousel, $(images[0]));});                 
                $(window).resize(function(){resize($carousel, $(images[0]));});
            }
            
            $carousel.carousel(options.config);
            if (options.config.timer !== undefined && options.config.timer > 0) {
                var $items = $('.carousel-item', $carousel);
                var count = $items.length;
                var current = 1;
                setInterval(function(){ 
                    if (current == count) {
                        $carousel.carousel('prev', count-1);
                        current = 1;
                    } else {
                        $carousel.carousel('next');    
                        current++;
                    }                     
                }, options.config.timer);
            }
        });
    });
    
    function resize($carousel, $element) {
        $carousel.height($element.height() + 1);
    }
})(jQuery);

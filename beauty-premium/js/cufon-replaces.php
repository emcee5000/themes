<?php require(dirname(__FILE__).'/../../../../wp-load.php'); ?>
<?php header('Content-type: text/javascript'); ?>

function cufon_replace() {                                              
    <?php if( function_exists( 'get_option_fontsize' ) ) : ?>
    Cufon.replace('h1:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h1' ), 'px\'' ) ?>});
    Cufon.replace('h2:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h2' ), 'px\'' ) ?>});
    Cufon.replace('h3:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h3' ), 'px\'' ) ?>});
    Cufon.replace('h4:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h4' ), 'px\'' ) ?>});
    Cufon.replace('h5:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h5' ), 'px\'' ) ?>});
    Cufon.replace('h6:not(.no-cufon)', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'h6' ), 'px\'' ) ?>});
    Cufon.replace('div#slogan h1, h1#slogan, #slogan strong', {fontFamily: '<?php echo $actual_font ?>', hover:true<?php string_( ', fontSize: \'', get_option_fontsize( 'slogan' ), 'px\'' ) ?>});
    <?php else : ?>
    Cufon.replace('h1:not(.no-cufon), h2:not(.no-cufon), h3:not(.no-cufon), h4:not(.no-cufon), h5:not(.no-cufon), h6:not(.no-cufon), div#slogan h1, h1#slogan, #slogan strong', {fontFamily: '<?php echo $actual_font ?>', hover:true} );
    <?php endif; ?>
    
    Cufon.replace('#logo a span.name', {fontFamily: 'halo'});
    Cufon.replace('#logo a span.description', {fontFamily: '<?php echo $actual_font ?>'});
    Cufon.replace('#logo strong, #logo p, .sidebar-nav li, .p404 h1, .p404 h2, .p404 strong', {fontFamily: '<?php echo $actual_font ?>', hover: true});
    Cufon.replace('#sidebar .menu a, h3.title-blog a', {fontFamily: '<?php echo $actual_font ?>', hover: true});
}
cufon_replace();
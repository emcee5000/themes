		<?php if( !is_404() || !is_search() ) : ?>	
		
		    <div class="line clear"></div>
            
            <?php $slogan = get_post_meta( get_the_ID(), '_slogan_page', true ) ?>
                    
            <?php string_( '<h1 id="slogan">', get_convertTags( $slogan ), '</h1><div class="line"></div>' ) ?> 
            
            <div class="space"></div>
            
        <?php endif ?>                        
            
            <div class="clear"></div>
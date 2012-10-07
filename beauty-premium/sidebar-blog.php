            <?php wp_reset_query() ?>                  
			
            <?php if( get_layout_page() != 'sidebar-no' ) : ?>   
		
				<?php do_action( 'yiw_before_sidebar' ) ?> 
				<?php do_action( 'yiw_before_sidebar_' . get_current_pagename() ) ?> 
				
                <?php 
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Blog Sidebar' ) )
                        get_sidebar( 'default' ) 
                ?>
		
				<?php do_action( 'yiw_after_sidebar' ) ?>       
				<?php do_action( 'yiw_after_sidebar_' . get_current_pagename() ) ?> 
				   
            <?php endif ?>
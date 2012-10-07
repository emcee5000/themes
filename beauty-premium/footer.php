	        <?php 
	            global $shortname; 
            	$type = get_option( $shortname . '_footer_type', 'normal' ); 
	        ?>
	        
	        <!-- START FOOTER -->
	        <div id="footer">
	        
	        <?php if( $type == 'normal' ) : ?>
	        
	            <p class="left">
	                <?php convertTags( do_shortcode( stripslashes( get_option( $shortname . '_copyright_text_left', 'Copyright <a href="%site_url%"><strong>%name_site%</strong></a> 2010' ) ) ) ) ?>
	            </p>
	            
	            <p class="right">
	                <?php convertTags( do_shortcode( stripslashes( get_option( $shortname . '_copyright_text_right', 'Powered by <a href="http://www.yourinspirationweb.com/en"><strong>Your Inspiration Web</strong></a>' ) ) ) ) ?>  
	            </p>
	            
	        <?php elseif( $type == 'centered' ) : ?> 
	            
	            <p class="center">
                	<?php convertTags( do_shortcode( stripslashes( get_option( $shortname . '_footer_text_centered' ) ) ) ) ?>  
	            </p>
	            
	        <?php endif ?>
	        
	        </div>
	        <!-- END FOOTER -->     
	    
	        <div class="clear"></div> 
	    
		</div>     
	    <!-- END WRAPPER --> 
	    
	</div>	<!-- END WRAPSHADOW -->           
    
	<?php wp_footer() ?>   
	
	<?php echo stripslashes( get_option( $shortname . '_ga_code' ) ) ?>     
    
    <script type="text/javascript">
        //<![CDATA[
        Cufon.now();  //]]>
    </script>  
	
	</body>

</html>
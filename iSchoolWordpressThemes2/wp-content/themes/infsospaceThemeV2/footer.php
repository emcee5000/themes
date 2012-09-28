 </div><!– #main –>
 
 <div id="footer">

 
   <div id="aboutContainer">
								<span class="aboutTitle">About the Blog</span>
  	
    <p>Information Space is where the people of the Syracuse iSchool community share their stories, ideas and thoughts about the information field. Our bloggers are students, alumni, faculty and staff. We invite you to join the conversation by commenting on the stories that interest you, and we will do our best to respond to all inquiries.</p>
                        </div>     
                        <div id="newsletterContainer">
                       <!-- 
                        
                        
                        	<p>Fill out the form below to sign up for the <a href="http://ischool.syr.edu/newsroom/Newsletter.aspx" target="_blank">iSchool Insider</a></p>
                             <?php echo do_shortcode( '[contact-form 1 "Contact form 1"]' ); ?>                     
                            
                            <?php /*?>
                            <span class="formFieldTitle">Name:</span>
                            <input name="test" type="text" value="test" />
                            <span class="formFieldTitle">Email:</span>
                            <input name="test" type="text" value="test" /><br />
                            <div style="padding-top:8px;"><img src="wp-content/themes/InformationSpaceTheme/images/buttonSignUp.gif" alt="sign-up" /></div><?php */?>
                            -->
                            
                                                 
                        </div>
                        <div style="clear:both">
 	<div id="access">
       <div class="skip-link">
       		<a href="#content" title="<?php _e( 'Skip to content', 'your-theme' ) ?>"><?php _e( 'Skip to content', 'your-theme' ) ?></a>
        </div>
        <div class="pageMenu">
        	<ul>
  				<li class="home<?php if(is_front_page) echo ' current';?>"><a href="#">Home</a></li>
            	  <?php wp_list_pages('title_li=&depth=1'); ?>
                  
			</ul>
        
           <?php /*?>	<?php wp_page_menu( 'sort_column=menu_order' ); ?> <?php */?>                     
        </div>
     </div><!-- #access -->
  <div id="colophon">
 
   <div id="site-info">
   </div><!– #site-info –>
   
  </div><!– #colophon –>
  

 </div><!– #footer –>
</div><!– #wrapper –>
<?php wp_footer(); ?>

</body>
</html>
 <div id="footer">
   <div id="aboutContainer"></div>
   <h3>About the Blog</h3>
      <p>Information Space is where the people of the Syracuse iSchool community share their stories, ideas and thoughts about the information field. Our bloggers are students, alumni, faculty and staff. We invite you to join the conversation by commenting on the stories that interest you, and we will do our best to respond to all inquiries.</p>
    </div>     
    <div id="access">
      <div class="skip-link">
       	<a href="#content" title="<?php _e( 'Skip to content', 'your-theme' ) ?>"><?php _e( 'Skip to content', 'your-theme' ) ?></a>
      </div>
      <div class="pageMenu">
       	<ul>
	  <li class="home<?php if(is_front_page) echo ' current';?>"><a href="#">Home</a></li>
	    <?php wp_list_pages('title_li=&depth=1'); ?>
        </ul>
        <?php /*?><?php wp_page_menu( 'sort_column=menu_order' ); ?> <?php */?>                     
        </div>
     </div><!-- #access -->
  <div id="colophon">
   <div id="site-info">
   </div><!–- #site-info -–>
  </div><!–- #colophon -–>
 </div><!-- #footer -->
 </div><!-- #wrapper -->
  <?php wp_footer(); ?> 
</body>
</html>
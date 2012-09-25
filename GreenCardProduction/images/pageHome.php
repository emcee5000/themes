<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

<div id="header">
  <div id="masthead">
    <div id="branding">
      <div id="homeBanner"> <a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/headerHomeImage.jpg" alt="Central New York Green Card" /></a> </div>
      <div class="homeTitle">
        <a href="membership-options-page/"><span class="homeTitleText">Get the Card</span></a>
      </div>
      <div class="homeContainer">
      	<div id="homeDescription">
                		
      		<br /> 
      		
      		The PGA of Central New York Section presentts the “Green Card” the all-in-one
golf discount card giving members access to all the best golf deals, discounts and
tournaments Central New York has to offer.  Sign-up and start saving Today!
      	</div>
      	<div id="homeSignButton">
      		<a href="/membership-options-page/"><img src="<?php bloginfo('template_directory'); ?>/images/buttonSign.png" alt="Sign Up" /></a><br />
          

      	</div>
      	<div class="clearFloat"></div>
      </div>
      <div class="homeTitle">
      	<a href="deals-2"><span class="homeTitleText">Featured Deals</span></a>
      </div>
      <div class="homeContainer">
	
	
          <?php if (function_exists('fpg_show')) {
            $args = array(
                'post_type'     => 'kpsgcdeal',/* comma separated list of category ids to include (put '-' in front of ids to exclude) */
                'tag'     => '' /* comma separated list tag slugs to include */);
            echo fpg_show($args);
        }?>
      </div>

      
    </div>
    <!-- #branding --> 
  </div>
  <!-- #masthead --> 
</div>
<!-- #header -->

<div id="main">


<?php get_sidebar(); ?>
<?php get_footer(); ?>

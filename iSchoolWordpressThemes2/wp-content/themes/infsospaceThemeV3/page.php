<?php get_header(); ?>
<div id="mainWrapper">
	    <div id="sidebar" class="clearfix"><?php dynamic_sidebar('SidebarInside'); ?></div>
<div id="mainContainer">
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
 <div id="content">
 <h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
 <div class="entrytext">
  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
  <div class="CommentStuff">	
	<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>	
  </div>
 </div>
 </div>
</div>

</div>
<?php get_footer(); ?>







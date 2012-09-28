<?php
/*
Template Name: Single Post
*/
?>
<?php get_header(); ?>

<div id="content" class="content-singular content-single">
	<div class="pad">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php while (have_posts()) : ?>
	<?php the_post(); ?>

<h1><?php the_title(); ?></h1>	
<div class="meta">
	<p>
		<span class="date"><?php the_time('d F Y') ?></span> 
		&bull; 
		<span class="comments"><?php comments_number('no comments', '1 comment', '% comments'); ?> </span> 
		&bull; 
		<span class="categories"><?php the_category(', '); ?></span>
	</p>
</div>

<div class="content">
	<?php the_content(); ?>
	<?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<?php
	$desc = get_the_author_meta('description');
	if (!empty($desc)) {
?>
<div class="post-box post-box-about-author">
	<div class="title">
		<h2>About the Author</h2>
	</div>
	<div class="interior">
		<?php echo get_avatar(get_the_author_meta('email'),53) ?>
		<p><?php echo $desc; ?></p>
		<div class="clear"></div>
	</div>
</div>
<?php 
	}
?>

<?php 
	$enabled = get_option(PADD_NAME_SPACE . '_rp_enable');
	if ($enabled) { 
?>

<?php } ?>
<?php comments_template('',true); ?>
<div class="post-box post-box-related">
	<div class="title">
		<h2>Related Posts</h2>
	</div>
	<div class="interior">
		<?php
			padd_theme_single_related_posts(get_the_ID());
		?>
	</div>
</div>
<?php endwhile; ?>

		</div>
	</div>
</div>

<?php get_sidebar(); ?>

<div class="clear"></div>

<?php get_footer(); ?>
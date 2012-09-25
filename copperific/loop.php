


<?php if (!have_posts()) : ?>

<div id="post-0" class="post error404 not-found">
	<div class="title">
		<h2>Not Found</h2>
	</div>
	<div class="content">
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
	</div>
</div>

<?php else : ?>

	<?php add_filter('excerpt_length', 'padd_theme_hook_excerpt_index_length'); ?>
	<?php while (have_posts()) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('append-clear'); ?>>
			<div class="title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="meta">
				<p>
					<span class="author">
						<span class="no-display">By: </span>
						<?php echo get_avatar( get_the_author_email(),'40'); ?> 
						<span class="no-display"><?php the_author(); ?></span>
					</span>
				</p>
			</div>
			<div class="thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php
						$padd_image_def = get_template_directory_uri() . '/images/thumbnail.jpg';
						if (has_post_thumbnail()) {
							the_post_thumbnail(PADD_THEME_SLUG . '-thumbnail');
						} else {
							echo '<img class="image-thumbnail" alt="Default thumbnail." src="' . $padd_image_def . '" />';
						}
					?>
				</a>
			</div>
			<div class="excerpt">
				<?php padd_theme_share_button(); ?>
				<?php the_excerpt();?>
				<p class="links">
					<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>">Read More &raquo;</a> |
					<a href="<?php comments_link(); ?>"><?php comments_number('No comments', '1 comment', '% comments'); ?> &raquo;</a>
				</p>
			</div>
			
		</div>
	<?php endwhile; ?>
	<?php remove_filter('excerpt_length', 'padd_theme_hook_excerpt_index_length'); ?>

	<?php Padd_PageNavigation::render(); ?>

<?php endif; ?>









	
	

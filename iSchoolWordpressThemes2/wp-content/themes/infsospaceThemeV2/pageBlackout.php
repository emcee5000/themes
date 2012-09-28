<?php
/*
Template Name: Blackout
*/
?>

<?php include (TEMPLATEPATH . '/headerBlackout.php'); ?>        
<style>
							body
							{
							margin:0;
							padding:0;
							background-color:#ccc;
							}

							#blackoutContainer
							{
							text-align:center;
							}
							
							#blackoutMainBody
							{
							width:700px;
							margin:0 auto;
							font-family:Arial, Helvetica, sans-serif;
							text-align:left;
							color:#333;
							font-size:16px;
							font-weight:bold;
							padding-top:10px;
							}

							#blackoutMainBody a
							{
							color:#fff;
							text-decoration:underline;
							}
							.button
							{
							background-color:#333;
							padding:10px;
							}
							#blackoutMainBody p
							{
							line-height:20px;
							}
						</style>
                   
                       
					
					
										
							

							<div id="blackoutContainer">

								<div id="blackoutMainBody">
									<?php the_post(); ?>
									<div id="postDetials">
										<img src="http://ischool.syr.edu/temp/sopa/postDetails.png" />
									</div>

										<div class="featuredImage">
											<?php the_post_thumbnail(); ?>
										</div>

										<div class="entry-content">
											<?php the_content(); ?>
											<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>

										</div>
										<!-- .entry-content -->
										<?php comments_template('', true); ?>

									</div>
									<!-- #post-<?php the_ID(); ?> -->
									<?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?>
									<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>

								</div>
								<!-- #content -->
							
							



								</div>
							</div>
                          
				
<?php

add_action( 'admin_bar_menu', 'change_edit_link', 999 );

function change_edit_link( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'edit' );
	$args = array(
		'id'    => 'edit',
		'title' => 'Edit Home Page',
		'href'  => '/wp-admin/admin.php?page=smm-home'
	);
	$wp_admin_bar->add_node( $args );
}

get_header(); ?>

			<div id="front-page-header">
				<div class="hero">
					<div class="container">
						<h1 class="tag"><?php the_field('hero_title', 'option'); ?></h1>
						<h2 class="subtag"><?php the_field('hero_subtitle', 'option'); ?></h2>
					</div>
					<div class="container more-arrow">
						<a href="#content"><i class="fa fa-chevron-down"></i></a>
					</div>
				</div>
			</div>
			<main id="content">
				<section class="offwhite">
					<div class="container narrow">
						<p class="text-center"><?php the_field('about', 'option'); ?></p>
					</div>
				</section>
				<section id="works">
					<div class="container">
						<h2>Client Works</h2>
					</div>
					<div class="container projects">
						<div class="row">
							<?php
							// check if the repeater field has rows of data
							if( have_rows('client_works','option') ):
							 	// loop through the rows of data
							    while ( have_rows('client_works','option') ) : the_row();
							        // display a sub field value
							        $workspostid = get_sub_field('post_id');
											?>
												<div class="col-sm-6">
													<div class="project">
														<?php if( !get_field('video_oembed', $workspostid ) ): ?>
															<div class="thumbnail_cover">
																<?php echo get_the_post_thumbnail($workspostid, array(360,250)); ?>
																<div class="thumbnail_links">
																	<div class="audio_links">
																		<?php if( get_field('soundcloud_link', $workspostid) ): ?>
																			<a class="soundcloud" href="<?php the_field('soundcloud_link', $workspostid); ?>"><i class="fa fa-fw fa-soundcloud"></i></a>
																		<?php endif; ?>
																		<?php if( get_field('spotify_link', $workspostid) ): ?>
																			<a class="spotify" href="<?php the_field('spotify_link', $workspostid); ?>"><i class="fa fa-fw fa-spotify"></i></a>
																		<?php endif; ?>
																		<?php if( get_field('apple_music_link', $workspostid) ): ?>
																			<a class="apple" href="<?php the_field('apple_music_link', $workspostid); ?>"><i class="fa fa-fw fa-apple"></i></a>
																		<?php endif; ?>
																	</div>
																	<!--<a class="readmore" href="<?php the_permalink($workspostid); ?>">Read More</a>-->
																</div>
															</div>
														<?php elseif ( get_field('video_oembed', $workspostid ) ): ?>
															<div class="max-embed-width">
																<div class="embed-container">
																	<?php the_field('video_oembed', $workspostid); ?>
																	<!--<a class="readmore" href="<?php the_permalink($workspostid); ?>">Read More</a>-->
																</div>
															</div>
														<?php endif; ?>
														<div class="caption">
															<p><strong>Client:</strong> <?php the_field('project_client', $workspostid); ?></p>
															<p><strong>Role:</strong> <?php the_field('project_role', $workspostid); ?></p>
														</div>
													</div>
												</div>
											<?php
							    endwhile;

							else :
							    // no rows found
							endif;
							?>
						</div>
					</div>
				</section>
				<section id="listen" class="offwhite">
					<div class="container">
						<h2>Listen</h2>
					</div>
					<div class="container">
						<?php
						// check if the repeater field has rows of data
						if( have_rows('listen','option') ):
							// loop through the rows of data
								while ( have_rows('listen','option') ) : the_row();

										// display the sub field value
										$listenpostid = get_sub_field('post_id');

										// get value from post id
										$url = get_field('soundcloud_link', $listenpostid);

										// set height of oembed
										$args = array( 'height'=>'166' );

										// get oembed iframe
										$iframe = wp_oembed_get( $url, $args );

										// remove visual setting in soundcloud oembed
										$iframe = str_replace( 'visual=true', 'color=00aabb', $iframe );

										// remove width attribute
										$iframe = str_replace( 'width=""', '', $iframe );

										// add extra attributes to iframe html
										$attributes = 'style="width:100%"';
										$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

										echo $iframe;
										?>

										<?php
								endwhile;

						else :
								// no rows found
						endif;
						?>
					</div>
				</section>
				<section id="quote" class="graydarker">
					<div class="container">
						<?php
						// check if the repeater field has rows of data
						if( have_rows('quote','option') ):
							// loop through the rows of data
								while ( have_rows('quote','option') ) : the_row();

								// get values from quote section of home options
								$quote = get_sub_field('the_quote');
								$name = get_sub_field('the_name');
								$cred = get_sub_field('credibility');

								?>
								<div class="quote">
									<p class="the_quote"><i class="fa fa-quote-left"></i> <?php echo $quote ?> <i class="fa fa-quote-right"></i></p>
									<p class="the_name"><?php echo $name ?></p>
									<p class="the_cred"><?php echo $cred ?></p>
								</div>

										<?php
								endwhile;

						else :
								// no rows found
						endif;
						?>
					</div>
				</section>
				<section id="contact">
					<div class="container">
						<div class="col-xs-8 pull-right">
							<h2>Contact</h2>
							<a href="mailto:stuartmccloudmusic@gmail.com" class="btn glass-button">Email</a>
						</div>
					</div>
				</section>
				<section id="backtotop">
					<a href="#front-page-header">Back to Top</a>
				</section>
			</main>

<?php get_footer(); ?>

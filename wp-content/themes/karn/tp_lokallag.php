<?php /* Template Name: Spesifikt lokallag */ ?>

<?php get_header(); ?>

<main class="Main row">
	
	<?php include('template-parts/header.php'); ?>
	
	<div class="Content col-md-12">
		<div class="Content-squad">
			<h1 class="Content-title"><?php echo get_the_title(); ?></h1>
			<section class="FbFeedLokallag col-md-6 no-padding-sides padding-right-lg">
				<div class="FbFeedLokallag-feedWrap">
					<div class="FbFeedLokallag-feedWrap-titleWrap">
						<h2 class="FbFeedLokallag-feedWrap-titleWrap-title">Innlegg fra Facebookgruppen</h2>
						<!--<a class="FbFeedLokallag-feedWrap-titleWrap-toGroup" href="#">
							<span class="icon icon-external-link-square"></span>
						</a>-->
					</div>
					<div class="FbFeedLokallag-feedWrap-feed">
						<?php 
							echo do_shortcode("[custom-facebook-feed id=" . get_field('ID') . " num=3]");
						?>
					</div>
				</div>
			</section>
			<section class="ContactPersons col-md-6 no-padding-sides padding-left-lg">
				<div class="ContactPersons-list">
					<h2 class="ContactPersons-list-title">Kontaktpersoner</h2>
					<div class="ContactPersons-list-content">
						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>
					</div>
				</div>
			</section>
		</div>
	</div><!-- .Content end -->

</main><!-- .Main -->

<?php get_footer();

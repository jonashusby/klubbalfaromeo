	
<?php /* Template Name: Alle lokallag */ ?>

<?php get_header(); ?>

<main class="Main row">
	
	<?php include('template-parts/header.php'); ?>
	
	<div class="Content col-md-12">
		<section class="SquadWrap col-md-6 no-padding-sides">
			<div class="SquadWrap-title">
				Finn ditt lokallag
			</div>		
			<?php list_lokallag(); ?>
		</section>
	</div><!-- .Content end -->

</main><!-- .Main -->

<?php get_footer();

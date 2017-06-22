<?php /* Template Name: Dashboard */ ?>

<?php get_header(); ?>

<div class="AdminWrapper row">
	
	<?php include('template-parts/admin-sidebar.php'); ?>

	<main class="AdminWrapper-content col-md-9 no-padding-sides">
		<div class="AdminWrapper-content-msgList col-md-6 no-padding-sides admin-border-right">
			<div class="AdminWrapper-content-msgList-child">
				<h2 class="AdminWrapper-content-msgList-child-title">Meldinger - privat</h2>
				<p class="AdminWrapper-content-msgList-child-msg important">Du har ikke betalt kontingenten for i år. Klikk på meldingen for å betale.<p>
			</div>
		</div>
		<div class="AdminWrapper-content-msgList col-md-6 no-padding-sides">
			<div class="AdminWrapper-content-msgList-child">
				<h2 class="AdminWrapper-content-msgList-child-title">Arrangementer - lokallag</h2>
				<p class="AdminWrapper-content-msgList-child-msg inactive">Ingen arrangementer foreløpig<p>
			</div>
		</div>
		<div class="AdminWrapper-content-msgList col-md-6 no-padding-sides admin-border-right">
			<div class="AdminWrapper-content-msgList-child">
				<h2 class="AdminWrapper-content-msgList-child-title">Meldinger - alle medlemmer</h2>
				<p class="AdminWrapper-content-msgList-child-msg">Systemet fungerer som normalt<p>
			</div>
		</div>
		<div class="AdminWrapper-content-msgList col-md-6 no-padding-sides admin-border-right">
			<div class="AdminWrapper-content-msgList-child">
				<h2 class="AdminWrapper-content-msgList-child-title">Arrangementer - landsdekkende</h2>
				<p class="AdminWrapper-content-msgList-child-msg inactive">Ingen arrangementer foreløpig<p>
			</div>
		</div>
	</main>

</div><!-- .Wrapper -->

<?php get_footer();

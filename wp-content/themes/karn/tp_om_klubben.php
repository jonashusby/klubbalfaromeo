	
<?php /* Template Name: Om klubben */ ?>

<?php get_header(); ?>

<main class="Main row">
	
	<?php include('template-parts/header.php'); ?>

	<div class="Content">
		<section class="About">
			<div class="About-child">
				<h1 class="About-child-title">
					<?php the_title(); ?>
				</h1>
				<p class="About-child-text">
					<?php the_field('about'); ?>
					<br />
					<br />
					<a class="About-child-text-linkToBecomeMember" href="https://klubbalfaromeonorge.appspot.com/selfservice/signup" target="_blank">Se fordelene av å være medlem her</a>
				</p>
			</div>
		</section>
		<section class="People">
			<div class="People-child col-md-11">
				<div class="People-child-generalMail">
					<div class="People-child-generalMail-title">
						For generelle spørsmål, send epost til:
					</div>
					<div class="People-child-generalMail-mail">
						<a href="mailto:<?php the_field('generell_epost'); ?>">
							<?php the_field('generell_epost'); ?>
						</a>
					</div>
				</div><!-- end general mail -->
				<div class="People-child-contacts">
					<div class="People-child-contacts-row">
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('formann_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('formann_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('formann_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-mobile">
									<?php the_field('formann_mobil'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('formann_epost'); ?>">
										<?php the_field('formann_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('kasserer_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('kasserer_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('kasserer_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('kasserer_epost'); ?>">
										<?php the_field('kasserer_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
					</div><!-- end first row -->

					<div class="People-child-contacts-row">
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('medlemskontakt_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('medlemskontakt_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('medlemskontakt_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('medlemskontakt_epost'); ?>">
										<?php the_field('medlemskontakt_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('webmaster_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('webmaster_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('webmaster_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('webmaster_epost'); ?>">
										<?php the_field('webmaster_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('redaktor_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('redaktor_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('redaktor_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('redaktor_epost'); ?>">
										<?php the_field('redaktor_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('lmk_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('lmk_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('lmk_stilling'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-mobile">
									<?php the_field('lmk_mobil'); ?>
								</div>
								<div class="People-child-contacts-row-person-details-email">
									<a href="mailto:<?php the_field('lmk_epost'); ?>">
										<?php the_field('lmk_epost'); ?>
									</a>
								</div>
							</div>
						</div><!-- end person -->
					</div><!-- end second row -->

					<div class="People-child-contacts-row">
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem1_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem1_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem1_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem2_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem2_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem2_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem3_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem3_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem3_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem4_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem4_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem4_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem5_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem5_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem5_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
						<div class="People-child-contacts-row-person">
							<div class="People-child-contacts-row-person-imgWrap">
								<?php 
									$image = get_field('styremedlem6_bilde');
									if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="People-child-contacts-row-person-details">
								<h3 class="People-child-contacts-row-person-details-name">
									<?php the_field('styremedlem6_navn'); ?>
								</h3>
								<div class="People-child-contacts-row-person-details-occupation">
									<?php the_field('styremedlem6_stilling'); ?>
								</div>
							</div>
						</div><!-- end person -->
					</div><!-- end third row -->

				</div><!-- end contacts -->

				<div class="People-child-generalMail">
					<div class="People-child-generalMail-title">
						Vår postadresse:
					</div>
					<div class="People-child-generalMail-mail">
						<?php the_field('postadresse'); ?>
					</div>
				</div><!-- end general mail -->

			</div><!-- end child -->
		</section><!-- end people -->
	</div>

</div>

<?php get_footer();

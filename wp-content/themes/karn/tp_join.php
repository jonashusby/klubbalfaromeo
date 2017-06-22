<?php /* Template Name: Bli medlem */ ?>

<?php get_header(); ?>

<!-- 

	Huskeliste:
	- Gjør alt oppdaterbart i forskjellige seksjoner
	- Legg inn ikoner
	- Funksjon for å åpne siste versjon av Alfanytt
	- Gjøre tekst (eller lignende) klikkbart på mobil for å åpne siste verson av Alfanytt

-->

<main class="Main row">
	
	<?php include('template-parts/header.php'); ?>
	
	<div class="Content col-md-12 no-padding-sides">

		<div class="Benefits">
			<section class="Benefits-benefit Benefits-alfanytt">
				<div class="Benefits-benefit-child col-md-12">
					<div class="Benefits-benefit-child-textPart col-md-9 col-sm-8">
						<h1 class="Benefits-benefit-child-textPart-title">
							Alfanytt
						</h1>
						<p class="Benefits-benefit-child-textPart-text">
							Alfanytt er klubbens eget medlemsblad. Det sendes ut 4 ganger i året. 
							<br />
							Her finner du variert stoff, laget av og for medlemmer.
							<br />
							Klikk på bladet for å få en sniktitt av siste utgave.
						</p>
					</div>
					<div class="Benefits-benefit-child-imgPart col-md-3 col-sm-4">
						<img class="Benefits-benefit-child-imgPart-img" src="<?php bloginfo('template_url'); ?>/img/alfanytt.jpg" />
					</div>
				</div>
			</section>
			<section class="Benefits-benefit Benefits-meet">
				<div class="Benefits-benefit-child col-md-12">
					<div class="Benefits-benefit-child-imgPart col-md-4">
						<img class="Benefits-benefit-child-imgPart-img meetup1" src="<?php bloginfo('template_url'); ?>/img/meetups/column.jpg" />
						<img class="Benefits-benefit-child-imgPart-img meetup2" src="<?php bloginfo('template_url'); ?>/img/meetups/italian_day_track.jpg" />
						<img class="Benefits-benefit-child-imgPart-img meetup3" src="<?php bloginfo('template_url'); ?>/img/meetups/italian_day.jpg" />
					</div>
					<div class="Benefits-benefit-child-textPart lg-double-left-padding col-md-8">
						<h1 class="Benefits-benefit-child-textPart-title">
							Treff
						</h1>
						<p class="Benefits-benefit-child-textPart-text">
							Vår største begivenhet er landstreffet. Treffet varer i 3 dager, hvor vi arrangerer turkjøring, banekjøring, Concorzo d'Eleganza og fest om kvelden. 
							<br />
							Utover dette arrangerer vi en rekke aktiviteter ellers, slik som rene sosiale møter, banekjøring, iskjøring, verkstedsbesøk og ikke minst <a href="http://www.corsaitaliana.no/" target="_blank">Corsa Italiana</a>.
							<br />
							Lokallagene for landsdelene byr på egne treff. <a href="lokallag/" target="_blank">Finn ditt lokallag her</a>.
					</div>
				</div>
			</section>
			<section class="Benefits-benefit Benefits-discounts">
				<div class="Benefits-benefit-child col-md-12">
					<div class="Benefits-benefit-child-textPart col-md-8">
						<h1 class="Benefits-benefit-child-textPart-title">
							Rabatter
						</h1>
						<p class="Benefits-benefit-child-textPart-text">
							Å være medlem i Klubb Alfa Romeo Norge har sine fordeler.
							<br />
							Medlemskapet gir deg rabatt på diverse verksteder, restauranter og butikker over hele landet.
							<br />
							Komplett oversikt vises i hver utgave av Alfanytt.
					</div>
					<div class="Benefits-benefit-child-imgPart col-md-4">
						
					</div>
				</div>
			</section>
			<section class="Benefits-benefit Benefits-assistance">
				<div class="Benefits-benefit-child col-md-12">
					<div class="Benefits-benefit-child-imgPart col-md-4">
						
					</div>
					<div class="Benefits-benefit-child-textPart lg-double-left-padding col-md-8">
						<h1 class="Benefits-benefit-child-textPart-title">
							Hjelp og rådgivning
						</h1>
						<p class="Benefits-benefit-child-textPart-text">
							Vi hjelper våre medlemmer!
							<br />
							Trenger du råd angående kjøp og salg av Alfa Romeo, 
							<br />
							eller reparasjon og trimming, så er vi der for deg.
					</div>
				</div>
			</section>
			<section class="Benefits-benefit Benefits-insurance">
				<div class="Benefits-benefit-child col-md-12">
					<div class="Benefits-benefit-child-textPart col-md-8">
						<h1 class="Benefits-benefit-child-textPart-title">
							Gunstig veteranbilforsikring
						</h1>
						<p class="Benefits-benefit-child-textPart-text">
							For biler over 30 år kan vi formidle en gunstig veteranbilfosikring.
							<br />
							Klubben er tilknyttet <a href="http://www.lmk.no/" target="_blank">LMK</a>.
					</div>
					<div class="Benefits-benefit-child-imgPart col-md-4">
						
					</div>
				</div>
			</section>
		</div>

		<section class="Main-rest-becomeMember">
			<div class="Main-rest-becomeMember-child col-md-6">
				<h1 class="Main-rest-becomeMember-child-title">
					Alt dette for kun <span class="red">475,-</span> per år
				</h1>
				<p class="Main-rest-becomeMember-child-info">
					Etter registrering mottar du i tillegg en velkomstpakke i posten. 
					<br />
					Denne inneholder Alfanytt, klistremerker og et gyldig medlemskort.
				</p>
				<input type="text" placeholder="Navn" class="col-md-12" />
				<input type="text" placeholder="Adresse" class="col-md-12"  />
				<div class="row">
					<div class="col-xs-3 no-padding-left no-padding-right">
						<input type="text" placeholder="Postnummer" />
					</div>
					<div class="col-xs-9 no-padding-right">
						<input type="text" placeholder="Poststed" />
					</div>
				</div>
				<input type="text" placeholder="Land" class="col-md-12" />
				<input type="email" placeholder="Epost" class="col-md-12" />
				<input type="text" placeholder="Telefonnummer" class="col-md-12" />
				<button type="submit" class="Main-rest-becomeMember-child-submit" class="col-md-12">
					<span class="icon icon-torsos-all"></span>
					Bli medlem
				</button>
			</div>
		</section>

	</div><!-- .Content end -->

</main><!-- .Main -->

<?php get_footer();

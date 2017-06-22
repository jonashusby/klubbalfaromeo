	
<?php /* Template Name: Forside */ ?>

<?php get_header(); ?>

<script>
	var token = "EAACjnZAwACnoBAM14SRg1XrJSBl9gvZCtIMHgdbzg09y7FGiJOVLrfGtSpndiHw4Vl4buM2pSgnlp3tFazbKq9tHDIWN8Kc2HyAlpyZBtzmpIS5ZBhyBragyDzMZC3KtpY5rZCDoiEAHhEoRGbmscK44g0dpctpmMZD";
	/* "access_token" : "179897322441338|xpYUImgLB4nGWPZY9Gor8kfFF24", */
	window.fbAsyncInit = function() {
	FB.init({
	  appId      : '179897322441338',
	  xfbml      : true,
	  version    : 'v2.8'
	});
	FB.AppEvents.logPageView();

		FB.api(
		    "/117410641614655/events",
		    function (response) {
		    	var eventList = response.data;
		    	sortEvents(eventList);
		    }, { access_token: token }
		);
	};

	(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	function sortEvents(eventList) {
		var arr = [];

		// convert JSON object to JS array
      	var i;
      	for ( i = 0; i < eventList.length; i++ ) {
      		arr.push(eventList[i]);
      	}

      	// sort oldest to newest
      	arr.sort(function(a,b){ return a.start_time > b.start_time ? 1:-1 });

      	// remove previous events
      	var currentDate = moment();

    	for (var l = arr.length - 1; l >= 0; l--) {
    		var date = arr[l].start_time;
		    
		    date = moment(date);

		    var futureEvent = currentDate.diff(date);
		   
		    if ( futureEvent > 0 ) {
		    	arr.splice(l, 1);
		    }
		}
		
		moment.locale("nb");

		// put first event in event box
			// title
			$('.Intro-bottom-child-eventWrap-event-title').html(
														"<a target='_blank' href='https://www.facebook.com/events/" 
														+ arr[0].id 
														+ "'>" 
														+ arr[0].name 
														+ "</a>");
			// date
			$('.Intro-bottom-child-eventWrap-event-date').html(moment(arr[0].start_time).format("LL"));      	
    }

</script>

<div class="Main row FrontPage">

	<div class="output">
		
	</div>

	<section class="Intro">
		<div class="Intro-slideshow">
			<div class="Intro-slideshow-slide slide1"><span>4C Coupé og Spider</span></div>
			<div class="Intro-slideshow-slide slide2"><span>8C 2300 Le Mans 1931</span></div>
			<div class="Intro-slideshow-slide slide3"><span>Giulia</span></div>
			<div class="Intro-slideshow-slide slide4"><span>1900 Sport Spider 1954</span></div>
			<div class="Intro-slideshow-slide slide5"><span>750 Competizione 1955</span></div>
		</div>
		<div class="Overlay"></div>
		<div class="Intro-slideshowControls">
			<div class="Intro-slideshowControls-prev"><</div>
			<div class="Intro-slideshowControls-label">4C Coupé og Spider</div>
			<div class="Intro-slideshowControls-next">></div>
		</div>

		<?php include('template-parts/header.php'); ?>

		<div class="Intro-bottom">
			<div class="Intro-bottom-child">
				<div class="Intro-bottom-child-slideshowNav col-md-1">
					<div class="Intro-bottom-child-slideshowNav-child">
						<div class="Intro-bottom-child-slideshowNav-child-left">
							<span class="arrow icon-angle-left"></span>
						</div>
						<div class="Intro-bottom-child-slideshowNav-child-right">
							<span class="arrow icon-angle-right"></span>
						</div>
					</div>
				</div>
				<div class="Intro-bottom-child-eventWrap col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<div class="Intro-bottom-child-eventWrap-event">
						<span class="Intro-bottom-child-eventWrap-event-title"></span>
						<span class="Intro-bottom-child-eventWrap-event-location"></span>
						<h2 class="Intro-bottom-child-eventWrap-event-date"></h2>
						<a class="Intro-bottom-child-eventWrap-event-seeSeveral" href="arrangementer/">Se flere</a>
					</div>
				</div>
				<div class="Intro-bottom-child-forums col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<a class="Intro-bottom-child-forums-becomeMember" href="https://klubbalfaromeonorge.appspot.com/selfservice/signup" target="_blank">
						<div class="Intro-bottom-child-forums-becomeMember-child">
							<h2 class="Intro-bottom-child-forums-becomeMember-child-title">Bli medlem</h2>
							<span class="Intro-bottom-child-forums-becomeMember-child-plus">+</span>
							<div class="line"></div>
						</div>
					</a>
					<a class="Intro-bottom-child-forums-facebook" href="https://www.facebook.com/groups/www.klubbalfaromeo.no/" target="_blank">
						<div class="Intro-bottom-child-forums-facebook-child">
							<h2 class="Intro-bottom-child-forums-facebook-child-title">Facebook<h2>
							<div class="line"></div>
						</div>
					</a>
					<a class="Intro-bottom-child-forums-cuoresportivo" href="https://cuoresportivo.no/" target="_blank">
						<div class="Intro-bottom-child-forums-cuoresportivo-child">
							<h2 class="Intro-bottom-forums-child-cuoresportivo-child-title">Cuoresportivo.no</h2>
							<div class="line"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!--<div class="Main-rest">
		<section class="Main-rest-becomeMember" id="memberForm">
			<div class="Main-rest-becomeMember-child col-md-6 col-sm-8">
				<h1 class="Main-rest-becomeMember-child-title">Bli medlem</h1>
				<p class="Main-rest-becomeMember-child-info">
					Prisen for et medlemsskap er 475 kroner per år. 
					Dette inkluderer fire nummer av Alfanytt.
				
					Som KARN-medlem kan du få en rekke rabatter på forskjellige butikker rundt i landet. Du kan se medlemsfordelene på følgende side:
					<br />
					<a href="bli-medlem/">Les mer om medlemsfordelene</a>
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
					<div class="Main-rest-becomeMember-child-submit-child">
						<span class="Main-rest-becomeMember-child-submit-child-title">Bli medlem</span>
						<div class="bottomline"></div>
					</div>
				</button>
			</div>
			<div class="Main-rest-becomeMember-imgWrap col-md-6 col-sm-4">
				<div class="Main-rest-becomeMember-imgWrap-img col-md-6"></div>
			</div>
		</section>
	</div>--><!-- .Main-rest end -->

</div><!-- .Main -->

<?php get_footer();

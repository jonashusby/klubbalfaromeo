	
<?php /* Template Name: Arrangementer */ ?>

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

		var eventList = "";

		for ( var e = 0; e < arr.length; e++ ) {

			// check if place is specified
			var tempLocation = "";
			if ( typeof arr[e].place === 'undefined' ) {
	    		tempLocation = "Ukjent sted";
			}
			else {
			    tempLocation = "<a target='_blank' href='http://maps.google.com/?q=" + arr[e].place.name + "'>" + arr[e].place.name + "</a>";
			}

			// chop down length of event text string - if over 300
			var tempDescription = "";
			tempDescription = arr[e].description;
			
			if ( tempDescription.length > 300 ) {
				tempDescription = tempDescription.substring(0, 300);
				tempDescription += " [...]";
			}

			var tempArrElement = "<div class='Events-list-item'>" +
									"<h2 class='Events-list-item-title'>" + 
										arr[e].name + 
									"</h2>" + 
									"<span class='Events-list-item-date'>" + 
										moment(arr[e].start_time).format("LLLL") + 
									"</span>" + 
									"<p class='Events-list-item-text'>" + 
										tempDescription + 
									"</p>" + 
									"<span class='Events-list-item-location'>" + 
										tempLocation +
									"</span>" +
									"<a class='Events-list-item-seeOnFacebook' target='_blank' href='https://www.facebook.com/events/" + arr[e].id + "'>" + "Se på Facebook</a>" +
								"</div>";

			eventList += tempArrElement;

		}

		$('.Events-list').html(eventList);
		/*
		$('.Events-list').html(
							"<a target='_blank' href='https://www.facebook.com/events/" 
							+ arr[0].id 
							+ "'>" 
							+ arr[0].name 
							+ "</a>");
		
		$('.Events-list').html(moment(arr[0].start_time).format("LL"));
		*/
		
      	
    }

</script>

<main class="Main row">

	<!--<div class='Events-list-item'>
		<h2 class='Events-list-item-title'>arr[e].name</h2>
		<span class='Events-list-item-date'>moment(arr[e].start_time).format("LLLL")</span>
		<p class='Events-list-item-text'>
			arr[e].description
		</p>
		<span class="Events-list-item-location">arr[e].place.name, arr[e].place.location.city</span>
		<a class="Events-list-item-seeOnFacebook" href="https://www.facebook.com/events/arr[e].id"></a>
	</div>-->
	
	<?php include('template-parts/header.php'); ?>

	<div class="Content">
		<section class="Events">
			<h1 class="Events-title"><?php echo get_the_title(); ?></h1>
			<div class="Events-list col-md-8">
				
			</div>
		</section>	
	</div>

</div>

<?php get_footer();

$(function(){

	// HTML objects

	var $contactPersons;
	var $contactPerson;
	var $contactPersonImg;

	var $mobileNavBtn;
	var $mobileNavBtnTop;
	var $mobileNavBtnMiddle;
	var $mobileNavBtnBottom;
	var $navigation;

	// slideshow
	var $slideshow;
	var $slide;
	var $slide1;
	var $prevSlide;
	var $nextSlide;

	var $slideshowLabel;
	var $prevSlideBtn;
	var $nextSlideBtn;

	// intro bottom boxes
	var $becomeMember;

	// Facebook errror message
	var $fbErrorMsg;


	var init = function(){

		var setHTMLObjects = function(){

			$contactPersons = $('.ContactPersons');
			$contactPerson = $contactPersons.find('h3');
			$contactPersonImg = $contactPersons.find('img');

			$mobileNavBtn = $('.Header-main-mobileNavBtn');
			$mobileNavBtnTop = $('.Header-main-mobileNavBtn-top');
			$mobileNavBtnMiddle = $('.Header-main-mobileNavBtn-middle');
			$mobileNavBtnBottom = $('.Header-main-mobileNavBtn-bottom');
			$navigation = $('.Header-main-nav');

			// slideshow
			$slideshow = $('.Intro-slideshow');
			$slide = $('.Intro-slideshow-slide');
			$slide1 = $('.slide1');
			$prevSlide = $('.Intro-bottom-child-slideshowNav-child-left');
			$nextSlide = $('.Intro-bottom-child-slideshowNav-child-right');

			// slideshow - controls
			$slideshowLabel = $('.Intro-slideshowControls-label');
			$prevSlideBtn = $('.Intro-slideshowControls-prev');
			$nextSlideBtn = $('.Intro-slideshowControls-next');

			// intro bottom boxes
			$becomeMember = $('.Intro-bottom-child-becomeMember');

			// Facebook errror message
			$fbErrorMsg = $('.cff-error-msg');

		}();

		var setEvents = function(){
			wrapContactInfo();
			designProfileImgs();
			wrapContactInfoAndProfileImg();

			$mobileNavBtn.click(function(){ mobileNavBtnClick(); });

			// run slideshow
			runSlideshow();

			// next slide btn event
			$prevSlideBtn.click(function(){ prevSlide(); });
			$nextSlideBtn.click(function(){ nextSlide(); });

			// intro bottom boxes
			/* $becomeMember.click(function(){ toMemberForm(); }); */
		}();

	}();


	function wrapContactInfo() {
		if ( $contactPersons.length > 0 ) {
			$contactPerson.each(function(){
				$this = $(this);
				$this.next().addBack().wrapAll('<div class="contactPersonInfo"></div>');
			});
		}
	}
	function designProfileImgs() {
		if ( $contactPersons.length > 0 ) {
			$contactPersonImg.each(function(){
				$this = $(this);

				// find heigth & width of img
				thisHeight = $this.height();
				thisWidth = $this.width();

				// position profile img correctly
				if ( thisHeight >= thisWidth ) {
					// if height is greater or equal to width
					$this.css({ 'width':'100px', 'height':'auto' });

					// get new height based on width change (since img keeps aspect ratio - height changes according to width)
					thisNewHeight = $(this).height();
					$this.css({ 'position':'absolute', 'top':'50%', 'margin-top':-thisNewHeight / 2 });
				} else {
					// if width is greater than height
					$this.css({ 'height':'100px', 'width':'auto' });

					// get new width
					thisNewWidth = $(this).width();
					$this.css({ 'position':'absolute', 'left':'50%', 'margin-left':-thisNewWidth / 2 });
				}

				// wrap into new class
				$this.unwrap();
				$this.wrap('<div class="profileImgWrap"></div>');
			});
		}
	}
	function wrapContactInfoAndProfileImg() {
		$profileImgWrap = $('.profileImgWrap');
		$contactPersonInfo = $('.contactPersonInfo');

		$profileImgWrap.each(function(){
			$(this).next($contactPersonInfo).addBack().wrapAll('<div class="contactPerson"></div>');
		});
	}

	function mobileNavBtnClick() {
		if ( !$mobileNavBtn.hasClass('active') ) {
			// show navigation
			$navigation
				.css({ 'display':'block', 'top':'-100%' })
				.animate({ 'top':'0px' }, 300);
			$mobileNavBtn.addClass('active');

			// transform button to close
			$mobileNavBtnMiddle.fadeOut(300);
			$('.openMenu').removeClass('openMenu');
			$mobileNavBtnTop.animate({ 'top':'13px' }, 300, function(){
				$(this).addClass('closeMenu');
			});
			$mobileNavBtnBottom.animate({ 'top':'13px' }, 300, function(){
				$(this).addClass('closeMenu');
			});
		} else {
			// hide navigation
			$navigation
				.animate({ 'top':'-100%' }, 300, function(){
					$(this).css({ 'display':'none' });
				});
			$mobileNavBtn.removeClass('active');

			// transform button to close
			$('.closeMenu').removeClass('closeMenu');
			$mobileNavBtnTop.animate({ 'top':'5px' }, 300, function(){
				$(this).addClass('openMenu');
			});
			$mobileNavBtnBottom.animate({ 'top':'21px' }, 300, function(){
				$(this).addClass('openMenu');
			});
			setTimeout(function(){
				$mobileNavBtnMiddle.fadeIn(300);
			}, 600);
		}
	}

	// slideshow - sequence
	$active = $slide1;

	function runSlideshow() {
		setInterval(function(){
			$nextSlideBtn.trigger('click');
		}, 7500);
	}

	// prev slide
	function prevSlide() {
		// unbind click to prevent clogging animations
		$prevSlideBtn.unbind('click');
		$nextSlideBtn.unbind('click');

		$prev = $active.prev();
		if ( !$prev.is(':animated') ) {
			if ( $prev.length > 0 ) {
				$slideshowLabel.html($prev.children('span').html());
				$prev.css({ 'left':'-100%' });
				$active.animate({ 'left':'100%' }, 700);
				$prev.animate({ 'left':'0%' }, 700, function(){
					// bind click again
					$prevSlideBtn.click(function(){ prevSlide(); });
					$nextSlideBtn.click(function(){ nextSlide(); });
				});
				$active = $prev;
			} else {
				$prev = $('.Intro-slideshow-slide:last-child');
				$slideshowLabel.html($prev.children('span').html());
				$prev.css({ 'left':'-100%' });
				$active.animate({ 'left':'100%' }, 700);
				$prev.animate({ 'left':'0%' }, 700, function(){
					// bind click again
					$prevSlideBtn.click(function(){ prevSlide(); });
					$nextSlideBtn.click(function(){ nextSlide(); });
				});
				$active = $prev;
			}
		}
	}

	// next slide
	function nextSlide() {
		// unbind click to prevent clogging animations
		$prevSlideBtn.unbind('click');
		$nextSlideBtn.unbind('click');

		$next = $active.next();
		if ( $next.length > 0 ) {
			$slideshowLabel.html($next.children('span').html());
			$next.css({ 'left':'100%' });
			$active.animate({ 'left':'-100%' }, 700);
			$next.animate({ 'left':'0%' }, 700, function(){
				// bind click again
				$prevSlideBtn.click(function(){ prevSlide(); });
				$nextSlideBtn.click(function(){ nextSlide(); });
			});
			$active = $next;
		} else {
			$next = $slide1;
			$slideshowLabel.html($next.children('span').html());
			$next.css({ 'left':'100%' });
			$active.animate({ 'left':'-100%' }, 700);
			$next.animate({ 'left':'0%' }, 700, function(){
				// bind click again
				$prevSlideBtn.click(function(){ prevSlide(); });
				$nextSlideBtn.click(function(){ nextSlide(); });
			});
			$active = $next;
		}
	}

	// intro bottom boxed
	function toMemberForm() {
		$('html, body').animate({
        	scrollTop: $("#memberForm").offset().top
    	}, 500);
	}

	// if Facebook feed is locked or doesn't exist
	(function(){
		if ( $fbErrorMsg.css('display') == 'block' ) {
			$fbErrorMsg.html("Facebook-gruppen er låst eller ikke-eksisterende");
		}
	})();


});
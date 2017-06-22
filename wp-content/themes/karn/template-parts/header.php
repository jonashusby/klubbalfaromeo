	<header class="Header">
		<div class="Header-main">
			<div>
				<a href="<?php echo home_url(); ?>">
					<img src="<?php bloginfo('template_url'); ?>/img/logo_white.png" class="Header-main-logo" />
				</a>
				<div class="Header-main-mobileNavBtn">
					<div class="Header-main-mobileNavBtn-top"></div>
					<div class="Header-main-mobileNavBtn-middle"></div>
					<div class="Header-main-mobileNavBtn-bottom"></div>
				</div>
				<nav class="Header-main-nav">
					<?php 
						wp_nav_menu( array('menu' => 'Meny') );
					?>
				</nav>
			</div>
		</div><!-- .Header-main -->
	</header><!-- .Header -->
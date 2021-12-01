<?php
?>

<?php if(home_url($_SERVER['REQUEST_URI']) !== get_site_url().'/kontakt/'){  ?>
<div  class="hero2 <?= (get_the_title() == 'Wohnungen') ? "":"mt-5" ?>" id="wincasa-alarm" style="background-image:url(<?= get_field('wincasa_background','options')?>)" name="wincasa-alarm">
    <!--<div class="hero-overlay"></div>  -->
    <div class="container ">
        <div class=" d-flex  align-items-center h-100 justify-content-center">
            <div class="text-center row">

				<div class="col-12"><img class="wincasa-alarm-logo" src="<?= get_field('wincasa_alarm_icon', 'options') ?>"></div>
					<h2 class="col-lg-10 offset-lg-1 p-3">Wincasa Alarm</h2>
					<div class="col-12 col-lg-7 wincasa-text">
						Abonnieren Sie den Wincasa Alarm und verpassen Sie keine freiwerdenden Objekte mehr!Ich möchte darüber benachrichtigt werden, wenn eines der untenstehenden Objekte verfügbar wird:	
					</div>
                <?php $form = '[ultimatemember form_id="29"]'; ?>
                <div class="subscribe-form col-12 col-lg-6  offset-lg-3" >
                <?php
                if ( !is_user_logged_in() ) {
                    echo do_shortcode($form);
                } 
                ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php }?>
 <?php if ( UM()->form()->count_errors() > 0 ) : ?>
	<script>
	  document.getElementById("wincasa-alarm").scrollIntoView();
	</script>	
<?php endif ; ?>   



<!-- MAP -->
<div class="map-block clearfix">
       <iframe  class="float-left iframe-map" src="<?php echo get_field('map_link','option'); ?>" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<!-- end  MAP -->


<!-- start FOOTER-->
<div class="footer text-center text-lg-left">
    <div class="container">
        <div class="row justify-content-lg-between">
            <div class="col-lg-7 col-xl-8 col-12 mb-4 about">
                <img class="footer-logo" src="<?php echo get_field('site_footer_logo','options');  ?>" >
            </div>
            <div class="col-lg-2 col-12">
				 <h3 class="py-3 pb-4">Links</h3>
				<?php 
                    wp_nav_menu( array(
                        'theme_location'       => 'primary',
                        'menu'       => 'primary',
                        'depth'      => 1,
                        'container'  => 'ul',
                        'menu_class' => 'px-0 text-center text-lg-left',
						'walker'=> new wp_bootstrap_navwalker()
                        )
                    ); 
                ?> 
            </div>
            <div class="col-lg-3 col-xl-2 col-12 contact-us">
				<div>
					<h3 class="py-3 pb-4">Kontaktieren Sie uns</h3>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <img src="<?php bloginfo('template_directory'); ?>/images/telephone.svg">
                    <p><a href="tel:0584557777">058 455 77 77</a></p>
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <img src="<?php bloginfo('template_directory'); ?>/images/mail.svg">
                    <p><a href="mailto:info@wincasa.ch">info@wincasa.ch</a></p>
                </div>
				<div class="d-flex justify-content-center justify-content-lg-start">
					 <img class="footer-map-image" src="<?php bloginfo('template_directory'); ?>/images/ic-map.svg">
                    <?= get_field('footer-location','options') ?>
				</div>
				</div>
                
            </div>
        </div>

    </div>
</div>


<div class="copyright">
	<div class="container">
        <div class="row">
			
<!--             <div class="col-lg-2">
				<div class="copy-logo mb-3 mb-lg-0 text-center text-lg-left">
					<img src="<?php //bloginfo('template_directory'); ?>/images/WincasaLogo.png">
				</div>                
            </div>
			 -->
            <div class="col-12">
                <div class="copy-text text-center">
					<span>©</span> 2021 <?php echo get_field('site_link','options');?>  Alle Rechte vorbehalten.  
					<div class="footer-links ml-1">
				       <a href="<?php echo get_home_url(); ?>/rechtliche-informationen/">Rechtliche Informationen</a> | <a href="<?php echo get_home_url(); ?>/datenschutzerklaerung">Datenschutz</a> 
					</div>
				</div>
            </div>
            
        </div>
	</div>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->


<?php wp_footer();?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js" defer></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.bundle.min.js" defer></script>

<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/magnific-popup.css">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.magnific-popup.js" defer></script>


<!-- Slider -->

<?php if(home_url($_SERVER['REQUEST_URI']) == get_site_url().'/wohnungen/' || home_url($_SERVER['REQUEST_URI']) == get_site_url().'/gewerbe/' || home_url($_SERVER['REQUEST_URI']) == get_site_url().'/parkplaetze/'):  ?>

 <script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js" defer></script>
 <script src="<?php bloginfo('template_directory'); ?>/js/plugin_wincasaobjektliste.js" defer></script>
<?php endif; ?>
<?php if(home_url($_SERVER['REQUEST_URI']) == get_site_url().'/'):  ?>
<script src="<?php bloginfo('template_directory'); ?>/js/swiper.js" defer></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<?php endif; ?>
<script src="<?php bloginfo('template_directory'); ?>/js/script.js?v=1" defer></script>


</body>

</html>
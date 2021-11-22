<?php
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
    <title>
        <?php 
            if(is_front_page()) { 
                bloginfo('name');  
            } else {
                wp_title('');
            }        
        ?>
    </title>
	
    <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	<?php  if(is_front_page()) : ?>
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<?php endif; ?>
<?php if(home_url($_SERVER['REQUEST_URI']) == get_site_url().'/wohnungen/' || home_url($_SERVER['REQUEST_URI']) == get_site_url().'/gewerbe/' || home_url($_SERVER['REQUEST_URI']) == get_site_url().'/parkplaetze/'):  ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper.min.css">
	<?php endif; ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?v=9">
    
   
    
    <link rel="icon" href="<?php echo get_field('site_favicon','options');  ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_field('site_favicon','options');  ?>" type="image/x-icon" />
</head>

    
<body <?php body_class(); ?>>

<!-- start NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container ml-0">
        <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
            <img src="<?php echo get_field('site_logo','options');  ?>" alt="">
        </a>

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span> </span>
                    <span> </span>
                    <span> </span>
                </button>

        <div class="collapse navbar-collapse" id="navbarMain">
			  <nav class="mainnav navbar-nav ml-auto">
                <?php 
                    wp_nav_menu( array(
                        'theme_location'       => 'primary',
                        'menu'       => 'primary',
                        'depth'      => 1,
                        'container'  => 'ul',
                        'menu_class' => 'navbar-nav text-center',
						'walker'=> new wp_bootstrap_navwalker()
                        )
                    ); 
                ?> 
            </nav>
            <div class="contact text-center">
                <a href="<?= site_url();?>/kontakt">Kontakt</a>
            </div>
        </div>
    </div>
</nav>
<!-- end NAVBAR -->
  <!-- start SLIDER -->
     <?php  if(is_front_page()) : ?>
	<div class="position-relative homepage-header">
		 <div id="carouselExampleIndicators" class=" mb-5 carousel slide" data-ride="carousel">
			<div class="position-absolute indicators-wrapper">
				<div class="indicators-holder">
					<span class="current-slide">01</span>
					<ol class="carousel-indicators d-flex align-items-center">

						<?php if( have_rows('slider', 'option') ):
						  $i=0
						?>

						<?php while( have_rows('slider', 'option') ): the_row(); ?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?php if($i==0){echo "active";} ?>"></li>
						<?php $i+=1 ?>
						<?php endwhile; ?>

						<?php endif; ?>

					</ol>
					<span>0<?= count(get_field('slider','option')) ?></span>	
				</div>
				
				
				
				 <?php if(count(get_field('slider', 'option')) > 1 ): ?>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>

					
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
					
					<?php endif; ?>
			</div>
				
			<div class="carousel-inner">
				<?php 
					$active=1; 
					if( have_rows('slider', 'option') ): 
				?>

					<?php while( have_rows('slider', 'option') ): the_row(); 
						$image = get_sub_field('slide');
						$size = 'cover';
						$size_mob = 'cover-mob';
						$thumb = $image['sizes'][ $size ];
						$thumb_mob = $image['sizes'][ $size_mob ];

					   if (wp_is_mobile()) {
							$cover_image = $thumb_mob;
						} else {
							$cover_image = $thumb;
						}
					?>
						<div class="carousel-item <?php if($active){echo "active"; $active=0;}?>">
							<img class="d-block w-100 carousel-image" 
								 src="<?= $cover_image ?>" 
								 alt="">
						</div>

					<?php endwhile; ?>
				<?php endif; ?>
			</div>


		</div>
		
		<div class="head-info">
			<div>
				<div class="site-slogan">
					<h1>Wohnen <span class="text-nowrap">In der Würe</span> Bronschhofen</h1>
				</div>
				<a href="/#wincasa-alarm" class="to-gallery-button d-block">
					<div class=" d-flex h-100">
						<div class="white-part">
							Abonnieren Sie den Wincasa Alarm und verpassen Sie keine freiwerdenden Objekte mehr!
						</div>
						<div class="yellow-part">
							<img src="<?php bloginfo('template_directory'); ?>/images/Arrow.svg">
						</div>
					</div>
				</a>
			</div>
			
		</div>
	</div>
   
    <?php endif; ?>  
    <!-- end SLIDER -->
    
    
     <?php  if(!is_front_page()&& get_the_title() !== '404 Fehler') : ?>  
	<?php 
	$image =  get_field('image_background');
					$size = 'banner';
					$size_mob = 'banner-mob';
					$thumb = $image['sizes'][ $size ];
					$thumb_mob = $image['sizes'][ $size_mob ];
			
			       if (wp_is_mobile()) {
						$cover_image = $thumb_mob;
					} else {
						$cover_image = $thumb;
					}
	
	?>
		<div class="container-fluid  main-title-block" style="background-image: url(<?= $cover_image ?>) ;">	
		<!--	<div class="color-overlay"></div> -->
			<div class="header-title">
				<h1>
					<?= get_the_title() ?>
				</h1>
			</div>
		</div>       
    <?php endif; ?>  
	<?php 

<?php /* Template Name: Startseite */ ?>

<?php get_header() ?>

    <!-- start INFO  -->
    <div class="pt-lg-5 pt-0 startsite-wrapper mt-lg-5 mt-0">
        <div class="container px-0 pb-5">
            
			
			<div class="contact-section">
				<img class="contact-image" src="<?= get_field('contact_image') ?>">
				
			</div>
			<div class="contact-cards-wrapper d-flex justify-content-center position-relative">
				<div class="contact-cards d-flex flex-wrap">
					<div class="contact-card mb-3 mr-3 mr-0 pt-lg-5 p-4">
                        <div class=" m-auto text-center">
                            <img src="<?= get_field("image_location") ?>">
                        </div>
                        <div class="mt-lg-4 mt-3 ">
                            <?= get_field("location") ?>
                        </div>
                    </div>
                    <div class="contact-card mb-3  mr-3 mr-0 pt-lg-5 p-4">
                        <div class=" m-auto text-center">
                            <img src="<?= get_field("image_phone") ?>">
                        </div>
                        <div class="mt-lg-4 mt-3">
                            <?= get_field("phone") ?>
                        </div>
                    </div>
                    <div class="contact-card pt-lg-5  mr-3 mr-0 p-4">
                        <div class=" m-auto text-center">
                            <img src="<?= get_field("image_mail") ?>">
                        </div>
                        <div class="mt-lg-4 mt-3 ">
                            <?= get_field("mail") ?>
                        </div>
                    </div>
				</div>
			</div>
			<div class="gallery-section">
				<h2>Entdecken Sie unsere Galerie</h2>
				<div class="my-swiper-wrapper position-relative">
					
					<div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-pointer-events py-3">
						<div class="swiper-wrapper" id="swiper-wrapper-62c9102c378c52feb" aria-live="polite">
							<?php $images = get_field('galerie'); ?>
							<?php foreach ($images as $i=>$image):
								$size = 'swiper';
								$size_mob = 'swiper-mob';
								$thumb = $image['sizes'][$size];
								$thumb_mob = $image['sizes'][$size_mob];
								if (wp_is_mobile()) {
									$cover_image = $thumb_mob;
								}
								else {
									$cover_image = $thumb;
								}
							?>

							<div class="swiper-slide <?php if($i==0){ echo "swiper-slide-active";} ?>" role="group" aria-label="1 / 9" style="width: 620px; margin-right: 30px;">
								<img src="<?= $cover_image; ?>">
							</div>
							<?php endforeach; ?>
						</div>

						<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					
				</div>
				<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
					<?php foreach ($images as $i=>$image):?>
						<span class="swiper-pagination-bullet <?php if($i==0){ echo "swiper-pagination-bullet-active";} ?>" tabindex="0" role="button" aria-label="Go to slide 1"></span>
					<?php endforeach; ?>
				</div>
				<a href="/galerie" class="to-gallery-button d-block">
					<div class=" d-flex h-100">
						<div class="white-part">
							Alle Bilder anzeigen
						</div>
						<div class="yellow-part">
							<img src="<?php bloginfo('template_directory'); ?>/images/Arrow.svg">
						</div>
					</div>
				</a>
			</div>
        </div>
    </div>
<?php 
get_footer() ?>

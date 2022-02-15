<?php /* Template Name: Kontakt*/ ?>
<?php get_header();?>

    <!-- content -->
    <main class="contact-page">
		<div class="width_basic mx-auto">
            <div class="row">
                <div class="col-12 p-0 mb-5 pr-lg-5 mb-lg-0">
                    
					<?php //echo do_shortcode('[contact-form-7 id="46" title="Contact form DE"]'); ?>	
                    <?php the_field('contact_form'); ?>
                    <?php the_field('text_main'); ?>
                </div>
            </div>
        </div>
		

				<img class="contact-cards-image w-100" src="<?= get_field('kontakt_image') ?>">
		
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
                    <div class="vertiacal-line"></div>
                    <div class="contact-card mb-3  mr-3 mr-0 pt-lg-5 p-4">
                        <div class=" m-auto text-center">
                            <img src="<?= get_field("image_phone") ?>">
                        </div>
                        <div class="mt-lg-4 mt-3">
                            <?= get_field("phone") ?>
                        </div>
                    </div>
                    <div class="vertiacal-line"></div>
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
    </main>

<?php  get_footer() ?>

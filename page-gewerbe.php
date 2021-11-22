<?php /* Template Name: Gewerbe*/ ?>
<?php get_header(); ?>
<main>
<!-- free FLATS -->
<div class="free-flats white-block standard-block">
    <div class="container">
        <?php echo get_field('page_text') ?>
      <?php // echo do_shortcode("[get_wohnungen_free_table]"); ?>
<div class="spinner   d-flex flex-column justify-content-center align-items-center w-100">
				<div class="d-none  spinner-border text-secondary " role="status">
  <span class="sr-only">Loading...</span>
</div>
			</div>
    </div>
</div>

<!-- all FLATS -->
<div class="all-flats gray-block">

    <div class="container">
        <div class="standard-block ">
            <h2 class=" red-text text-center mb-5">Alle Gewerbeflächen</h2>
			<div class="spinner   d-flex flex-column justify-content-center align-items-center w-100">
				<div class="d-none  spinner-border text-secondary " role="status">
  <span class="sr-only">Loading...</span>
</div>
			</div>
			        <div class="modal fade" id="modal-" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog  modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                           </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
			<div class="spinner   d-flex flex-column justify-content-center align-items-center w-100">
				<div class="d-none  spinner-border text-secondary " role="status">
  <span class="sr-only">Loading...</span>
</div>
			</div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
	</main>
<!-- start FOOTER -->
<?php get_footer(); ?>
<!-- end FOOTER -->

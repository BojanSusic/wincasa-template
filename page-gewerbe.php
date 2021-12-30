<?php /* Template Name: Gewerbe */ ?>
<?php get_header(); ?>
<main>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $break = Explode('/', $url);
    $file = $break[count($break) - 2];
    $cachefile = 'cached-'.$file.'.html';

    // Serve from the cache if it is younger than $cachetime
    if (file_exists($cachefile)) {
        echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
        readfile($cachefile);
    }else{
        ob_start();

// // Start the output buffer
        ?>
        <!-- free FLATS -->
        <div class="free-flats white-block standard-block">
            <div class="text-before-table-wrapper d-flex justify-content-center">
                <div class="text-before-table">
                    <?php echo get_field('page_text') ?>
                </div>
            </div>

            <div class="gray-background">
                <div class="container">
                    <h2 class=" red-text text-center wohnungen-heading mb-5">Freie Gewerbeflächen im Überblick</h2>
                    <?php echo do_shortcode("[get_gewerbe_free_table]"); ?>
                    <div class="swiper-container  cards swiper-container-initialized swiper-container-horizontal"
                         id="freieWohnungenSwiper">
                        <div class="swiper-wrapper">
                            <?php echo do_shortcode("[get_mobile_cards_gewerbe]"); ?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>

                    </div>

                </div>
            </div>
        </div>
        <!-- all FLATS -->
        <div class="all-flats gray-background gray-block">

            <div class="container">
                <div class="standard-block ">
                    <h2 class=" red-text text-center mb-5 wohnungen-heading ">Alle Gewerbeflächen</h2>
                    <?php echo do_shortcode("[get_gewerbe_all_table]") ?>

                </div>
            </div>
        </div>
        <?php
// Cache the contents to a cache file
        $cached = fopen($cachefile, 'w');

        fwrite($cached, ob_get_contents());
        fclose($cached);
        ob_end_flush(); // Send the output to the browser
    }
    ?>
</main>
<!-- start FOOTER -->
<?php
get_footer(); ?>
<!-- end FOOTER -->
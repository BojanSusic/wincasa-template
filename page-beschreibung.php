<?php /* Template Name: Beschreibung*/ ?>
<?php get_header(); ?>


    <div class="cards">
        <div class="container">

            <?php $beshcreibungCards = get_field('beschreibung')?>
            <?php foreach($beshcreibungCards as $i=>$beshcreibungCard): ?>
                <?php if($i%2==0): ?>
                    <div class="row beschreibung-card flex-lg-row flex-column-reverse">
                        <div class="col-12 col-lg-6 pr-lg-4">
                            <img class="left-border w-100" src="<?= $beshcreibungCard['picture'];?>">
                        </div>
                        <div class="col-12 col-lg-6 d-flex align-items-center mt-5 mt-lg-0">
                            <div>
                                <div class="col-lg-2 m-auto">
                                    <div class="image-wrapper">
                                        <img src="<?= $beshcreibungCard['image'];?>">
                                    </div>
                                </div>
                                <div class="col pt-1 text-center">
                                    <h2 class="red-text"><?= $beshcreibungCard['title'];?></h2>
                                    <p><?= $beshcreibungCard['text']?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="row beschreibung-card">
                        <div class="col-12 col-lg-6 d-flex align-items-center mt-5 mt-lg-0">
                            <div>
                                <div class="col-lg-2 m-auto">
                                    <div class="image-wrapper">
                                        <img src="<?= $beshcreibungCard['image'];?>">
                                    </div>
                                </div>
                                <div class="col pt-1 text-center">
                                    <h2 class="red-text"><?= $beshcreibungCard['title'];?></h2>
                                    <p><?= $beshcreibungCard['text']?></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 pl-lg-4">
                            <img class="right-border w-100" src="<?= $beshcreibungCard['picture'];?>">
                        </div>

                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

<?php
get_footer();
?>
<?php  /*Template Name: loeschen*/ ?>
<?php get_header();?>
    <script>
        if (confirm('Möchten Sie Ihr Konto wirklich löschen?')) {
        } else {
            window.close();
        }
    </script>
<?php

$email=get_userdata($_GET['user_id'])->user_email;
if(get_hash_code($email,$_GET['user_id'])==$_GET['hash'])
{
    delete_user_account($_GET['user_id']);
}
?>
    <div class="py-5">
        <div class="container ">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
            <?php //galerie
            $images = get_field('galerie');
            if( $images ): ?>
                <div class="gallery gallery-block clearfix">
                    <?php foreach( $images as $image ): ?>

                        <a href="<?= $image['sizes']['gallery']; ?>" title="">
                            <img src="<?= $image['sizes']['gallery-thumb']; ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php  get_footer() ?>
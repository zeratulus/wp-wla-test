<?php get_header(); ?>

    <div class="d-flex flex-center">
        <div class="container" id="content">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_title( '<h1 class="text-center">', '</h1>' ); ?>

                <div class="content">
					<?php the_content(); ?>
                </div>

            </article>

        </div>
    </div>

<?php get_footer(); ?>
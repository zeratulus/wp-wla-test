<?php get_header(); ?>
<div class="d-flex flex-center">
	<div class="container" id="content">
		<?php while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content-page' );
		endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>

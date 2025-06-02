<?php
get_header();
?>

<main id="primary" class="site-main post-single">

	<div class="container">
		<?php
		while (have_posts()):
			the_post();

			get_template_part('template-parts/content', get_post_type());

			if (comments_open() || get_comments_number()):
				comments_template();
			endif;

		endwhile;
		?>
	</div>

</main>

<?php
get_footer();

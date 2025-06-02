<?php
add_action('wp_ajax_get_filtered_movies', 'get_filtered_movies');
add_action('wp_ajax_nopriv_get_filtered_movies', 'get_filtered_movies');

function get_filtered_movies(): void
{
	header('Content-Type: application/json');
	$genre = sanitize_text_field($_GET['genre'] ?? '');
	$date_from = sanitize_text_field($_GET['date_from'] ?? '');
	$date_to = sanitize_text_field($_GET['date_to'] ?? '');
	$sort = sanitize_text_field($_GET['sort'] ?? '');
	$paged = max(1, (int) ($_GET['page'] ?? 1));
	$posts_per_page = 2;
	$meta_query = [];

	if ($date_from || $date_to) {
		$meta_query[] = [
			'key' => 'movies-data_vyhoda',
			'value' => [
				$date_from ? $date_from . '-01-01' : '1900-01-01',
				$date_to ? $date_to . '-12-31' : date('Y-m-d')
			],
			'compare' => 'BETWEEN',
			'type' => 'DATE',
		];
	}

	$args = [
		'post_type' => 'movies',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'meta_query' => $meta_query,
	];

	if ($genre) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'movies-category',
				'field' => 'slug',
				'terms' => $genre,
			]
		];
	}

	$args += match ($sort) {
		'rating_desc' => [
			'meta_key' => 'movies-rejting',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
		],
		'rating_asc' => [
			'meta_key' => 'movies-rejting',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
		],
		'date_desc' => [
			'meta_key' => 'movies-data_vyhoda',
			'orderby' => 'meta_value',
			'order' => 'DESC',
		],
		'date_asc' => [
			'meta_key' => 'movies-data_vyhoda',
			'orderby' => 'meta_value',
			'order' => 'ASC',
		],
		default => [],
	};

	$query = new WP_Query($args);

	ob_start();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			get_template_part('template-parts/components/movie-card');
		}
	} else {
		echo '<p>No movies found</p>';
	}

	$html = ob_get_clean();
	wp_reset_postdata();

	wp_send_json([
		'html' => $html,
		'has_more' => $paged < $query->max_num_pages,
	]);
}
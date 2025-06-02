<?php
function moviehub_scripts() {
    wp_enqueue_style('vendor', get_template_directory_uri() . '/app/css/vendor.css', [], _S_VERSION);
    wp_enqueue_style('main', get_template_directory_uri() . '/app/css/main.css', [], _S_VERSION);

    wp_enqueue_script('main', get_template_directory_uri() . '/app/js/main.js', [], _S_VERSION, true);
    wp_enqueue_script('afisha-filter', get_template_directory_uri() . '/ajax/js/afisha-filter.js', [], null, true);
	wp_localize_script('afisha-filter', 'afisha_ajax', [
		'url' => admin_url('admin-ajax.php')
	]);
}
add_action( 'wp_enqueue_scripts', 'moviehub_scripts' );
<?php
if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

require get_template_directory() . '/include/scripts.php';

require get_template_directory() . '/include/custom-post-types.php';

require get_template_directory() . '/include/ajax-filter.php';

require get_template_directory() . '/include/acf-json.php';

add_theme_support('post-thumbnails');

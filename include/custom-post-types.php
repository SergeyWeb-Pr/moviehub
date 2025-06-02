<?php
add_action('init', 'register_movies_post_types');
function register_movies_post_types()
{

  register_post_type('movies', [
    'label' => null,
    'labels' => [
      'name' => 'Фильмы',
      'singular_name' => 'Фильмы',
      'add_new' => 'Добавить',
      'add_new_item' => 'Добавление',
      'edit_item' => 'Редактирование',
      'new_item' => 'Новое ____',
      'view_item' => 'Смотреть',
      'search_items' => 'Искать',
      'not_found' => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon' => '',
      'menu_name' => 'Фильмы',
    ],
    'description' => '',
    'public' => true,
    'publicly_queryable' => true,
    'show_in_nav_menus' => true,
    'show_in_menu' => true,
    'show_in_rest' => null,
    'rest_base' => null,
    'menu_position' => 4,
    'menu_icon' => null,
    'hierarchical' => true,
    'supports' => ['title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats'],
    'taxonomies' => ['movies-category'],
    'has_archive' => false,
    'rewrite' => ['slug' => 'movies'],
    'query_var' => true,
  ]);
}

add_action('init', 'create_movies_taxonomy');
function create_movies_taxonomy()
{
  register_taxonomy('movies-category', ['movies'], [
    'label' => '',
    'labels' => [
      'name' => 'Жанры',
      'singular_name' => 'Жан',
      'search_items' => 'Поиск',
      'all_items' => 'Все',
      'view_item' => 'Посмотреть',
      'parent_item' => 'Родительская',
      'parent_item_colon' => 'Parent Genre:',
      'edit_item' => 'Редактировать',
      'update_item' => 'Обновить',
      'add_new_item' => 'Добавить',
      'new_item_name' => 'New Genre Name',
      'menu_name' => 'Жанры',
      'back_to_items' => '← Вернуться',
    ],
    'description' => '',
    'public' => true,
    'hierarchical' => true,

    'rewrite' => false,
    'capabilities' => array(),
    'meta_box_cb' => null,
    'show_admin_column' => false,
    'show_in_rest' => null,
    'rest_base' => null,
    'publicly_queryable' => false,
    'query_var' => true,
  ]);
}
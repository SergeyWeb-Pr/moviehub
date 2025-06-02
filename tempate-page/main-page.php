<?php
/*
Template Name: Главная страница
*/
get_header(); ?>

<main class="main">
  <section class="hero">
    <div class="container">
      <div class="hero__inner">
        <div class="hero__content">
          <h1 class="hero__title">Explore a <span>World</span> of Cinematic Wonders </h1>
          <div class="hero__text">
            <p>Our database not only includes blockbusters but also independent films, documentary features, and
              works
              from talented directors worldwide. </p>
          </div>
          <div class="hero__buttons">
            <a href="" class="hero__button-register btn1">REGISTER NOW</a>
            <a href="" class="hero__button-about btn2">About us</a>
          </div>
        </div>
        <div class="hero__image">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/app/img/images/hero.png" alt="" width="416"
            height="416">
          <div class="hero__image-label label-name">
            <div class="hero__image-label-inner">MovieHub</div>
          </div>
          <div class="hero__image-label label-rating">
            <div class="hero__image-label-inner">
              <span>4.8</span>
              <span>⭐</span>
            </div>
          </div>
          <div class="hero__image-label label-count">
            <div class="hero__image-label-inner">18K</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="afisha">
    <div class="container">
      <h2 class="afisha__title">Discover a <span>Universe</span> of Cinematic Marvels</h2>
      <div class="afisha__inner">
        <div class="afisha__sidebar">
          <div class="afisha__sidebar-search">
            <form class="afisha-search js-search-form" role="search" method="get" id="searchform" action="">
              <input class="afisha-search__input input-reset" type="text" autocomplete="off" value="" name="s" id="s"
                placeholder="Search by name">
              <button class="afisha-search__submit btn-reset" type="submit" id="searchsubmit">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/app/img/icons/akar-icons_search.png" alt=""
                  width="24" height="24">
              </button>
            </form>
          </div>
          <div class="afisha-filter">
            <div class="afisha-filter__name">FILTER:</div>
            <div class="afisha-filter__options">
              <?php
              $terms = get_terms([
                'taxonomy' => 'movies-category',
                'hide_empty' => false,
              ]);
              ?>
              <div class="afisha-filter__option">
                <label for="genre">Genre:</label>
                <select id="genre" name="genre">
                  <option value="all-genres">All genres</option>
                  <?php foreach ($terms as $term): ?>
                    <?php if ($term->slug !== 'all-genres'): ?>
                      <option value="<?= esc_attr($term->slug) ?>">
                        <?= esc_html($term->name) ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php
              $years = [];
              $args = [
                'post_type' => 'movies',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'meta_key' => 'movies-data_vyhoda',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'fields' => 'ids',
              ];
              $query = new WP_Query($args);
              if ($query->have_posts()) {
                foreach ($query->posts as $post_id) {
                  $date = get_field('movies-data_vyhoda', $post_id);
                  if ($date) {
                    $timestamp = strtotime(str_replace('/', '-', $date));
                    $year = date('Y', $timestamp);
                    if (!in_array($year, $years)) {
                      $years[] = $year;
                    }
                  }
                }
              }
              wp_reset_postdata();
              rsort($years);
              ?>
              <div class="afisha-filter__option">
                <label>Date from:</label>
                <select name="date-from">
                  <?php foreach ($years as $year): ?>
                    <option value="<?= esc_attr($year); ?>" <?= $year == min($years) ? 'selected' : '' ?>>
                      <?= esc_html($year); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span>to</span>
                <select name="date-to">
                  <?php foreach ($years as $year): ?>
                    <option value="<?= esc_attr($year); ?>" <?= $year == max($years) ? 'selected' : '' ?>>
                      <?= esc_html($year); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>
            <div class="afisha-filter__apply">
              <button class="btn1" type="submit">APPLY</button>
            </div>
          </div>
        </div>
        <div class="afisha__content">
          <div class="afisha__option">
            <label for="sort">Sort by:</label>
            <select id="sort" name="sort">
              <option value="rating_desc">Rating (high to low)</option>
              <option value="rating_asc">Rating (low to high)</option>
              <option value="date_desc">Date (new to old)</option>
              <option value="date_asc">Date (old to new)</option>
            </select>
          </div>
          <div class="afisha__items" id="movie-list">
            <?php $args = array(
              'post_type' => 'movies',
              'posts_per_page' => 2,
              'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
              while ($query->have_posts()) {
                $query->the_post(); ?>
                <?php
                echo get_template_part('template-parts/components/movie-card');
                ?>
                <?php
              }
            }
            wp_reset_postdata();
            $total_pages = $query->max_num_pages;
            ?>
          </div>
          <?php if ($total_pages > 1): ?>
            <button class="afisha__load-more btn1" data-page="1">Load more</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer() ?>
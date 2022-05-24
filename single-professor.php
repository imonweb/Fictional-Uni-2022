<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();
    ?>
     

    <div class="container container--narrow page-section">
         
      <div class="generic-content">
         <div class="row group">

          <div class="one-third">
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>

          <div class="two-thirds">
            <?php

              $likeCount = new WP_Query(array(
                'post_type' => 'like',
                'meta_query' => array(
                  array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => get_the_ID()
                  )
                )
              ));

              $existStatus = 'no';

              if (is_user_logged_in()) {
                $existQuery = new WP_Query(array(
                  'author' => get_current_user_id(),
                  'post_type' => 'like',
                  'meta_query' => array(
                    array(
                      'key' => 'liked_professor_id',
                      'compare' => '=',
                      'value' => get_the_ID()
                    )
                  )
                ));

                if ($existQuery->found_posts) {
                  $existStatus = 'yes';
                }
              }

              

            ?>

            <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
              <i class="fa fa-heart-o" aria-hidden="true"></i>
              <i class="fa fa-heart" aria-hidden="true"></i>
              <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
            </span>
            <?php the_content(); ?>
          </div>

        </div>
      </div>

       <?php

          $relatedProfessors = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'professor',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if ($relatedProfessors->have_posts()) {
          echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';

        echo '<ul class="professor-cards">';
        while($relatedProfessors->have_posts()) {
          $relatedProfessors->the_post(); ?>
          <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink(); ?>">
              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
              <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
          </li>
        <?php }
        echo '</ul>';
        }

        wp_reset_postdata();

          if($relatedProfessors->have_posts()){
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

          while($relatedProfessors->have_posts()) {
            $relatedProfessors->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php }
          }

        $relatedPrograms = get_field('related_programs');

        if ($relatedPrograms) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
          echo '<ul class="link-list min-list">';
          foreach($relatedPrograms as $program) { ?>
            <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
          <?php }
          echo '</ul>';
          
        }

      ?>


    </div>
    

    
  <?php }

  get_footer();

?>
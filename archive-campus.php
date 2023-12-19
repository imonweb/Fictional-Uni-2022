<?php

get_header(); 
pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have several conveniently located campuses.'
));
?>

<div class="container container--narrow page-section">

<!-- <ul class="link-list min-list"> -->
  <div class="acf-map">

    
    <?php
  while(have_posts()) {
    the_post(); 
    $mapLocation = get_field('map');
    ?>
    <!-- <li><a href="<?php // the_permalink(); ?>"><?php // the_title(); 
    // $mapLocation = get_field('map'); 
    // print_r($mapLocation);
    // echo $mapLocation['lng']?>  
    </a></li> -->
    <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
      <h3><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php echo $mapLocation['address']; ?>
    </div>
    <?php } ?>
<!-- </ul> -->
</div>
 
 
</div>

<?php get_footer();

?>


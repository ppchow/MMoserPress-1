<?php 
/**
* Template Name: Service
*/
//echo "services template"; exit;
get_header(); 
?>
		<div class="row">
            <div class="large-12 columns">
                <ul class="tabs-mm">
                  <li><a class="active"><?php echo the_title(); ?></a></li>
                  <li></li>
                  
                </ul>
                <?php
                $type = 'services';
                $args=array(
                  'post_type' => $type,
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  //'order' => 'ASC',
                  //'orderby' => 'meta_value',
                );

                $my_query = null;
                $my_query = new WP_Query($args);
                //echo "<pre>",print_r($args);
                if( $my_query->have_posts() ) : ?>
                  <div class="isotopeSizer">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>
                  <?php
                  while ($my_query->have_posts()) : $my_query->the_post();
                    ?>
                    <div class="item w2 h3">
                      <a href="<?php echo get_permalink() ?>" class="whole-div">
                        <div class="blurb transparent">
                          <h4><?php echo the_title(); ?></h4>
                        </div>
                        <?php echo get_the_post_thumbnail($my_query->ID ) ?>
                      </a>
                    </div>
                    <?php
                  endwhile;
                  ?>
                  </div>
                  <?php
                endif;
                ?>
            </div>
    </div>
<?php get_footer(); ?>
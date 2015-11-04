<?php 
/**
* Template Name: Project
*/
get_header(); 
if(pll_current_language()=="en"){
  $filter_text = "Filter by location";
  $close_text = "Close";
  $all_text = "All";
  $location_text = "Locations";
}else{
  $filter_text = "按地区查看";
  $close_text = "关闭";
  $all_text = "全部 ";
  $location_text = "地点";
}
?>
		<div class="row">
            <div class="large-12 columns">
                <ul class="tabs-mm">
                    <li><a class="active"><?php the_title(); ?></a></li>
                </ul>
                <!-- <div id="readmore" class="filterproject">
                    <div class="row" id="filters">
                      <div class="large-3 columns">
                        <?php
                              $argscategory=array(
                                                'orderby' => 'name',
                                                'order' => 'ASC',
                                                'taxonomy'=> 'project_location',
                                                'parent' =>0
                                                );
                              global $wp_query;
                              $categories=get_categories($argscategory);
                              if(count($categories)>0){
                                ?>
                                <h4><?php echo $location_text ?></h4>
                                <ul class="filter button-group large-block-grid-2" data-filter-group="loc">
                                  <li><a class="btn is-checked" data-filter=""><?php echo $all_text ?></a></li>
                                <?php
                                $i = 1;
                                foreach($categories as $key=>$val)
                                {
                                  ?>
                                  <li><a data-filter="<?php echo '.'.$val->slug ?>" class="btn"><?php echo $val->name; ?> </a></li>
                                  <?php
                                }
                                ?>
                                </ul>
                                <?php
                              }
                              ?>
                      </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="large-12 columns">
                        <?php 

                                $taxonomy='project_location';
                                $type = 'project';
                                $args=array(
                                  'post_type' => $type,
                                  'post_status' => 'publish',
                                  'posts_per_page' => -1,
                                  //'order' => 'ASC',
                                  //'orderby' => 'meta_value',
                                );

                                $my_query = null;
                                $my_query = new WP_Query($args);
                                if( $my_query->have_posts() ) {
                                  ?>
                                  <div class="isotope" style="position: relative;">
                                  <?php
                                  $i=1;
                                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                    <?php
                                    $custom = get_post_custom($my_query->ID);
                                    $terms = get_the_terms($post->ID,'project_location');
                                    // echo $terms{0}->slug;
                                    ?>
                                    <div class="item g1 <?php  echo $terms{0}->slug  ?>">
                                      <a href="<?php echo get_permalink() ?>" class="whole-div">
                                          <div class="blurb gradient">
                                            <h6><?php echo $custom["sq_ft"][0]; echo (pll_current_language()=="en")?' sq-ft':''; ?></h6>
                                            <h4><?php echo $custom["subtitle"][0] ?></h4>
                                            <!--<h6><?php //echo $custom["sq_ft"][0] . ' sq-ft'; ?></h6>-->
                                            <h5><?php echo the_title();?></h5>
                                             
                                          </div>
                                          <?php //echo get_the_post_thumbnail($my_query->ID);
                                            $image_url = wp_get_attachment_url( get_post_thumbnail_id($my_query->ID));
                                          ?>
                                          <img alt="<?php the_title() ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/img-loader.gif" data-original="<?php echo $image_url ?>" class="lazy"> 
                                      		<!-- <img alt="<?php the_title() ?>" src="<?php echo $image_url ?>" > -->
                                      
                                      </a>
                                    </div>
                                    <?php
                                    $i++;
                                  endwhile;
                                  ?>
                                  </div>
                                  <?php
                                }
                                wp_reset_query();  // Restore global post data stomped by the_post().
                                ?>
                    </div>
                </div>
            </div>
        </div>

<?php get_footer(); ?>

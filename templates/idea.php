<?php 
/**
* Template Name: Idea
*/
get_header(); 
?>
<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active"><?php echo the_title() ?></a></li>
        </ul>
          <?php

          $type = 'idea';
          $args=array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            //'order' => "asc"
          );

          $my_query = null;
          //echo "<pre>",print_r($args);
          $my_query = new WP_Query($args);
          if( $my_query->have_posts() ) {
            ?>
            <div class="isotopeIdea">
              <div class="grid-sizer"></div>
              <div class="gutter-sizer"></div>
              <?php
              while ($my_query->have_posts()) : $my_query->the_post();
                $custom = get_post_custom($my_query->ID);
                $classnm= ($custom["disp_type"][0]=="vertical")? "h2" : "w2" ;
                $link = $custom["link"][0];
                if($link!=""){
                  $generated_url=$link;
                  $target= "target='_blank'";
                }else{
                  $generated_url=get_permalink();
                  $target="";
                }
                ?>
                <div class="i-dea m-<?php echo $classnm ?>" style="">
                  <a href="<?php echo $generated_url ;?>" <?php echo $target ?> class="whole-div">
                    <?php echo the_post_thumbnail() ?>
                  </a>
                </div>
                <?php
              endwhile;
              ?>
            </div>
            <?php
          }
          ?>
    </div>
</div>
<?php get_footer(); ?>
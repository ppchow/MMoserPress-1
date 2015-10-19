<?php 
/**
* Template Name: Media
*/
get_header(); 
?>
<div class="row">
    <div class="large-12 columns">
      <?php
     // $selected_media = "2015";
      if(pll_current_language()=="en"){
          $in_media = "In the Media";
          $media_link = "/in-the-media/";
          $readmore_text = "Read More";
		  $publish_label = "Published in";
      }else{
          $in_media = "媒体报道";
          $media_link = "/cn/in-the-media/";
          $readmore_text = "阅读全文";
		  $publish_label = "刊登于";
      }
      $argscategory=array(
                        //'orderby' => 'name',
                        //'order' => 'ASC',
                        'taxonomy'=> 'news_category',
                        'parent' =>0
                        );
      global $wp_query;
      $categories=get_categories($argscategory);
      if(count($categories)>0){
        ?>
        <ul class="tabs-mm">
        <?php
          foreach ($categories as $key => $value) {
            ?>
            <li><a href="<?php echo get_term_link($value->slug, 'news_category');?>" class="">
              <?php echo $value->name; ?></a>
            </li>
            <?php
          }
          ?>
          <li><a href="<?php echo get_site_url().$media_link; ?>" class="active"><?php echo $in_media?></a></li>
          <li></li>
        </ul>
        <?php
      }

        $argscategory=array(
                        //'orderby' => 'meta_value',
                        //'order' => 'DESC',
                        'taxonomy'=> 'media_year',
                        'parent' =>0
                        );
        global $wp_query;
        $categories=get_categories($argscategory);
        if(count($categories)>0){
          $k=1;
        ?>
          <div class="row">
            <div class="large-12 columns">
              <div class="label">
                <ul>
                <?php
                  foreach ($categories as $key => $value1) {
                    if($k==1){
                      $classes=" active ";
                      $selected_media = $value1->slug;
                    }else{
                      $classes="";
                    }
                    ?>
                    <li><a href="<?php echo get_term_link($value1->slug, 'media_year'); ?>" class="<?php echo $classes ?>"><?php echo $value1->name; ?></a></li>
                    <?php
                    $k++;
                  }
                ?>
                </ul>
              </div>
            </div>
          </div>
          <?php
          $type = 'media';
          $taxonomy = "media_year";
          $arg=array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            $taxonomy => $selected_media,
           // 'order' => 'media_date',
           // 'orderby' => 'desc',
          );
          $mquery = null;
          $mquery = new WP_Query($arg);

          if($mquery->have_posts() ) {
              ?>
              <div class="row">
                <div class="large-12 columns">
                  <div class="isotopeSizer">
                      <div class="grid-sizer"></div>
                      <div class="gutter-sizer"></div>
                      <?php
                      while ($mquery->have_posts()) : $mquery->the_post();
                        $custom=get_post_custom($mquery->ID);
                        ?>
                          <article class="item w2 h3" style="">
                            <div class="panel">
                              <a class="whole-div" href="<?php echo get_permalink(); ?>">
                                <h4><?php the_title(); ?></h4>

                                <?php echo get_the_post_thumbnail($mquery->ID) ?>

                                <!--<span class="label">Published in <b><i><?php echo $custom['publish'][0] ?></i></b><?php echo " | ".get_the_date("F Y") ;?></span>-->
                                <span class="label"><? echo $publish_label ?><b><i><?php echo $custom['publish'][0] ?></i></b><?php echo " | ".date ("F Y",strtotime($custom['media_date'][0])) ;?></span>
                                <?php  echo ($custom["shortdescription"][0]!="")? "<p>".$custom["shortdescription"][0]."</p>":"" ;?>
                              </a>
                              <a href="<?php echo get_permalink();?>" class="button"><?php echo $readmore_text ?></a>
                            </div>
                          </article>
                        <?php
                      endwhile;
                      ?>
                  </div> <!-- container -->
                </div> 
              </div>
            <?php
          }
        }
      ?>
    </div>
</div>
<?php get_footer(); ?>
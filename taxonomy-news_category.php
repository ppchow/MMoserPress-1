<?php 
get_header(); 
$catname=single_cat_title('', false );
$term = get_term_by('name', $catname, 'news_category');
$catid= $term->term_id;

?>
<div class="row">
    <div class="large-12 columns">
      <?php      
      if(pll_current_language()=="en"){
          $in_media = "In the Media";
          $in_media_link = "in-the-media/";
          $news_text = "news/";
          $readmore_text = "Read More";
      }else{
          $in_media = "媒体报道";
          $in_media_link = "cn/in-the-media/";
          $news_text = "cn/news/";
          $readmore_text = "阅读全文";
      }
      $argscategory=array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'taxonomy'=> 'news_category',
                        'parent' =>0
                        );
      global $wp_query;
      $categories=get_categories($argscategory);
      if(count($categories)>0){
        ?>
        <ul class="tabs-mm">
        <?php
        $k=1;
        foreach ($categories as $key => $value) {
		      if($term->slug==$value->slug){
            $classes=" active ";
            $selected_news = $value->slug;
          }else{
            $classes="";
          }
          ?>
              <li><a href="<?php echo get_term_link($value->slug, 'news_category'); ?>"  class="<?php echo $classes ?>">
                <?php echo $value->name; ?></a>
              </li>
          <?php
          $k++;
        }
        ?>
          <li><a href="<?php echo get_site_url().'/'.$in_media_link; ?>"><?php echo $in_media ?></a></li>
          <li></li>
        </ul>
        <?php
      }
        $type = 'news';
        $arg=array(
          'post_type' => $type,
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'news_category'=> $selected_news,
          //'order' => 'news_date',
          //'orderby' => 'asc',
          );
        $mquery = null;
        $mquery = new WP_Query($arg);
        
        if($mquery->have_posts() ) {
          $i=1;
          while ($mquery->have_posts()) : $mquery->the_post();
            $custom=get_post_custom($mquery->ID);
            //echo "<pre>",print_r($custom);
            if($i==1){
              $i++;
              ?>
              <div class="row">
                <div class="large-6 columns">
                  <a href="<?php echo get_permalink() ?>">
                    <?php echo get_the_post_thumbnail($mquery->ID) ?></a>
                </div>
                <div class="large-6 columns">
                    <h3 class="m-top"><?php the_title(); ?></h3>
                    <?php if($custom["news_type"][0]==""){
                          $pipe_sign=" ";
                     }else{
                          $pipe_sign=" | ";
                     } ?>
                    <p class="label heading"><?php echo $custom[news_type][0].$pipe_sign.$custom["news_date"][0]?></p> 
                    <?php  echo ($custom["shortdescription"][0]!="")? "<p>".$custom["shortdescription"][0]."</p>":"" ;?>
                    <a href="<?php echo get_permalink() ?>" class="button m-bottom"><?php echo $readmore_text ?></a>
                </div>  
              </div>

    </div>
</div>
              <div class="row">
                <div class="large-12 columns">
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <div class="isotopeSizer">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>
              <?php
            }else{
                      $i++;
                      ?>
                      <article class="item w2 h3">
                        <a class="whole-div" href="<?php echo get_permalink() ?>">
                          <div class="panel">
                            <h4><?php the_title(); ?></h4>
                             <?php echo get_the_post_thumbnail($mquery->ID) ?>
                             <?php if($custom["news_type"][0]==""){
                                  $pipe_sign=" ";
                             }else{
                                  $pipe_sign=" | ";
                             } ?>
                            <span class="label"><?php echo $custom["news_type"][0].$pipe_sign ; echo $custom["news_date"][0] ?></span>
                            <?php  echo ($custom["shortdescription"][0]!="")? "<p>".$custom["shortdescription"][0]."</p>":"" ;?>
                            <a href="<?php echo get_permalink() ?>" class="button"><?php echo $readmore_text ?></a>
                          </div>
                        </a>
                      </article>
                      <?php
            }
        endwhile;
        ?>
                    </div>
                </div>
              </div>
        <?php
        }
      ?>

<?php get_footer(); ?>
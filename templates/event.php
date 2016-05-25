<?php 
/**
* Template Name: Event
*/
get_header(); 
if(pll_current_language()=="en"){
	 $in_media = "In the Media";
      $in_media_link = "in-the-media/";
      $news_text = "news/";
    $visitgallery_text = "Visit Album";
    
}else{
		$in_media = "媒体报道";
		$in_media_link = "cn/in-the-media/";
     	 $news_text = "cn/news/";
    $visitgallery_text = "浏览图片";
    
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
<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
        	<?php
        $k=1;
        foreach ($categories as $key => $value) {
		  if($k==1){
            $classes=" active ";
            $selected_news = $value->slug;
          }else{
            $classes="";
          }
          ?>
              <li><a href="<?php echo get_term_link($value->slug, 'news_category'); ?>"  class="">
                <?php echo $value->name; ?></a>
              </li>
          <?php
          $k++;
        }
        ?>
          <li><a href="<?php echo get_site_url().'/'.$in_media_link; ?>"><?php echo $in_media ?></a></li>
          <li><a href="<?php echo get_bloginfo('url').'/album/' ?>" class="active"><?php the_title(); ?></a></li>
          <li class="right"></li>
        </ul>
        <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3 galleries" style="">
          <?php
	  }
          $type = 'event';
          $args=array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key'    => 'hide_from_menus',
            'meta_value'  => 'no'
            //'order' => 'ASC',
            //'orderby' => 'meta_value',
          );
			
          $my_query = null;
          //echo "<pre>",print_r($args);
          $my_query = new WP_Query($args);
          if( $my_query->have_posts() ) {

              while ($my_query->have_posts()) : $my_query->the_post();
               $imagedataarr= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),array(390,407)); 
				?>
                <li>
                  <a href="<?php echo get_permalink()?>" class="whole-div">
                    <img alt="<?php the_title() ?>" src="<?php echo $imagedataarr[0];?>">
                    <div class="intro-cap gal">
                      <h2><?php the_title() ?></h2>
                      <p href="<?php echo get_permalink()?>" class="button"><?php echo $visitgallery_text ; ?></p>
                    </div>
                  </a>
                </li>
                <?php
              endwhile;
          }
          ?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
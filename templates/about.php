<?php 
/**
* Template Name: About
*/
get_header(); 
if(pll_current_language()=="en"){
  $awards = "Awards";
  $awards_link = "awards/";
}else{
  $awards = "所获奖项";
  $awards_link = "cn/awards/";
}
?>
		<div class="row">
            <div class="large-12 columns">
                <ul class="tabs-mm">
                  <li><a href="<?php echo get_permalink(); ?>" class="active"><?php the_title(); ?></a></li>
                  <li><a href="<?php echo get_site_url().'/'.$awards_link; ?>"><?php echo $awards ?></a></li>
                </ul>

                <!--<p class="readmore-js-toggle"><a class="button">Filter by location<i class="icon-arrow-down"></i></a></p>-->
                
                	<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						the_content();
						//get_template_part( 'content', get_post_format() );

					// End the loop.
					endwhile;
					?>
                
            </div>
        </div>
<?php get_footer(); ?>
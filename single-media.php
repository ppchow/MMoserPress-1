<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage mmoser
 * @since mmoser
 */

get_header(); ?>
			<div class="row">
              <div class="large-12 columns">
              	<?php 
              	if(pll_current_language()=="en"){
				  $in_media = "In the Media";
				}else{
				  $in_media = "媒体报道";
				}
              	$custom = get_post_custom();
	        	
              	$media_terms = get_the_terms($post->ID,'media_year');
				$media_cat = $media_terms{0}->slug;


				$terms = get_the_terms($post->ID,'news_category');
				$news_cat = $terms{0}->slug;

			      $argscategory=array(
			                        'orderby' => 'name',
			                        'order' => 'ASC',
			                        'taxonomy'=> 'news_category',
			                        'parent' => 0
			                    );
			      global $wp_query;
			      $categories=get_categories($argscategory);
			      if(count($categories)>0){
			        ?>
			        <ul class="tabs-mm">
			        <?php

			        foreach ($categories as $key => $value) {
					?>
			          <li><a href="<?php echo get_term_link($value->slug, 'news_category'); ?>" class="<?php echo ($value->slug==$news_cat)? 'active':'' ?>">
			            <?php echo $value->name; ?></a>
			          </li>
			          <?php
			          $k++;
			        }
			        ?>
			          <li><a href="<?php echo get_bloginfo('url').'/in-the-media/' ?>" class="active"><?php echo $in_media; ?></a></li>
			         <!-- <li class="right"> <a href="<?php echo get_site_url().'/in-the-media/'.$media_cat; ?>">← back </a></li> -->
			        </ul>
			        <?php
			      }
			      ?>
                <div class="row">
                	<div class="large-7 columns">
	                	<?php
	                	if(has_post_thumbnail())
	                	{
	                		$imgarrr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),array(696,346));
	                		?>
								<img class="th" alt="<?php the_title() ?>" src="<?php echo $imgarrr[0] ;?>">
	                		<?php
	                	}
                	?>
                  	</div>
                  <div class="large-5 columns">
                    <h2><?php echo the_title() ?></h2>
                    <h3></h3>
                    <p><?php //echo $custom[shortdescription][0] ?></p>
                    <?php 
                    while ( have_posts() ) : the_post();
                    	the_content();
                    endwhile;
                    ?>
                  </div>
                </div>
                <hr>
              </div> <!-- main col -->
            </div> <!-- main row -->

<?php get_footer(); ?>
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
				  $in_media_link = "in-the-media/";
				}else{
				  $in_media = "媒体报道";
				  $in_media_link = "cn/in-the-media/";
				}
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
			            <?php echo $value->name; ?></a></li>
			          <?php
			          $k++;
			        }
			        ?>
			          <li><a href="<?php echo get_site_url().'/'.$in_media_link; ?>"><?php echo $in_media ?></a></li>
                     <!-- <li class="right"> <a href="<?php echo get_term_link($news_cat, 'news_category'); ?>">&larr; back</a></li> -->
			        
			        </ul>
		        <?php
			      }
			      ?>
                <div class="row">
                	<div class="large-8 medium-9 columns">
                		<article class="content-post">

                			<div class="featured-image">
                				                			<?php $custom1 = get_post_custom($post->ID);
                				                			 	$image = get_field('news_image');

                				                			 	$size = 'large';
                				                			 	$full = $image['sizes'][ $size ];
                				                			 	$width = $image['sizes'][ $size . '-width' ];
                				                			 	$height = $image['sizes'][ $size . '-height' ];

                				                			 	$image_caption = get_field('news_image_caption');

                												if( !empty($image) ){ ?>
                													<div class="featured-image"> 
                														<img src="<?php echo $full; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                													 	 <?php if ( $image_caption ) : ?>
                													 	 <p><?php echo $image_caption; ?></p>
                													 	<?php endif; ?>
                													</div>
                												<?php } ?>
                			</div>

	                		<h3><?php the_title(); ?></h3>
	                		<?php if($custom1["news_place"][0]!="")
	                			$news_place=', '.$custom1["news_place"][0];
	                		?>
	                		<h6><?php echo  $custom1["news_date"][0].$news_place; ?></h6>
		                  	<?php
							while ( have_posts() ) : the_post();
								the_content();
							endwhile;
							?>
						</article>
						<?php dynamic_sidebar("footer-sidebar-3"); ?>
					</div>
					<div class="large-4 medium-3 columns">
						<?php
						$type = 'news';
						$arg=array(
						  'post_type' => $type,
						  'post_status' => 'publish',
						  'posts_per_page' => 4,
						  'news_category'=> $news_cat,
						  'post__not_in' => array($post->ID),
						  //'order' => 'news_date',
						  //'orderby' => 'asc',
						);
						$mquery = null;
						$mquery = new WP_Query($arg);

						if($mquery->have_posts() ) {
							?>
							<h4>Other <?php echo $terms{0}->name; ?></h4>
							<?php
						  while ($mquery->have_posts()) : $mquery->the_post();
						    //$custom=get_post_custom($mquery->ID);
							$imagedataarr= wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail')
						    ?>
						    <div class="row">
						      <div class="large-4 columns">
						        <a href="<?php echo get_permalink(); ?>"><img class="th" src="<?php echo $imagedataarr[0] ;?>" width="<?php echo $imagedataarr[1]; ?>" height="<?php echo $imagedataarr[2]; ?>"></a>
						      </div>
						      <div class="large-8 columns">
						        <h5><?php echo the_title();?></h5>
						        <a href="<?php echo get_permalink(); ?>">Read article</a>
						      </div>
						    </div>
						    <hr>
						    <?php
						  endwhile;
						}

						$taxonomy = 'news_category';
						$argscategory=array(
						    //'orderby' => 'title',
						    //'order' => 'ASC',
						    'taxonomy'=> $taxonomy,
						    'taxonomy__not_in' => array($news_cat),
						    'parent' =>0
						    );
							global $wp_query;
							//echo "<pre>",print_r($argscategory);
							$categories=get_categories($argscategory);
							if(count($categories)>0){
							foreach($categories as $key=>$val){
						  	?>
						      	<?php
						      	$args=array(
						        	'post_type' => $type,
						        	//'orderby' => 'title',
						        	//'order' => 'asc',
						        	'posts_per_page' => 4,
						        	$taxonomy => $val->slug,
						        	'post_status' => 'publish',
						        	'tax_query' => array(
								        array(
								            'taxonomy' => $taxonomy,
								            'field' => 'slug',
								            'terms' => $news_cat,
								            'operator' => 'NOT IN',
								        ),
								    ),
						        );
						      	$my_query = null;
						      	$my_query = new WP_Query($args);
						      	//echo "<pre>",print_r($args);
						      	if( $my_query->have_posts() ) {
						        	?>
						        	<h4><?php echo $val->name; ?></h4>
						              <?php
										while ($my_query->have_posts()) : $my_query->the_post();
						                	$custom = get_post_custom($my_query->ID);
						              	?>
										<div class="row">
						                  <div class="large-4 columns">
						                    <!--<a href="<?php //echo get_permalink(); ?>"><img class="th" src="<?php //echo wp_get_attachment_image_src(get_post_thumbnail_id($my_query->ID))[0] ;?>"></a>-->
						                    <?php $imagedataarr1 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); ?>
						                    <a href="<?php echo get_permalink(); ?>"><img class="th" src="<?php echo $imagedataarr1[0] ;?>" width="<?php echo $imagedataarr1[1]; ?>" height="<?php echo $imagedataarr1[2]; ?>"></a>
						                  </div>
						                  <div class="large-8 columns">
						                    <h5><?php echo the_title();?></h5>
						                    <a href="<?php echo get_permalink(); ?>">Read article</a>
						                  </div>
						                </div>
						                <hr>
						              <?php
						              endwhile;
						              ?>
						          <?php
						      	}
							}
							}
					?>
					</div>
                </div> <!-- END ROW -->
              </div> <!-- main col -->
            </div> <!-- main row -->

<?php get_footer(); ?>
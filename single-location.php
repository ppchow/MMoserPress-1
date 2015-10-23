<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage mmoser
 * @since mmoser
 */

get_header();


if(pll_current_language()=="en"){
          $global_location_text = "Global Locations";
          $go_backlink = "/global-locations/" ;
      }else{
          $global_location_text = "全球分布";  
          $go_backlink = "/cn/global-locations/" ;        
      }
?>

	<div class="row">
		<div class="large-12 columns">
			<ul class="tabs-mm">

	        	<li><a href="<?php echo get_permalink() ?>" class="active"><?php echo $global_location_text; ?></a></li>
	        	<!-- <li class="right"> <a href="<?php echo get_site_url().$go_backlink; ?>">&larr; back</a></li> -->
	        </ul>
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
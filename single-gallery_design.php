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
	$goback_link = get_site_url()."/design-galleries";
	$view_more_gallery = "View more galleries of designs by M Moser:";
	$go_to_top = "Go to top";
}else{
	$goback_link = get_site_url()."/cn/design-galleries/";
	$view_more_gallery = "欣赏更多穆氏设计";
	$go_to_top = "返回頁首";
}
?>
<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active"><?php the_title();?></a></li>
          <li class="right"> <a href="<?php echo $goback_link?>">&larr; back </a></li>
        </ul>
        <div class="row">
		
           <div class="large-12 columns">
	           <?php
	            while ( have_posts() ) : the_post();
	           		the_content();
				endwhile;     
			   ?>
            </div>
      	</div> <!-- row -->
      	<?php
		$arg=array(
		  'post_type' => 'gallery_design',
		  'post_status' => 'publish',
		  'posts_per_page' => -1,
		  'news_category'=> $news_cat,
		  'post__not_in' => array($post->ID),
		  'meta_key'    => 'hide_from_menus',
		  'meta_value'  => 'no'
		  //'order' => 'news_date',
		  //'orderby' => 'asc',
		);
		$mquery = null;
		$mquery = new WP_Query($arg);
		//echo "<pre>",print_r($arg);
		if($mquery->have_posts() ) {
			?>
			<div class="row">
				<div class="large-12 columns">
					<h3><?php echo $view_more_gallery; ?></h3>
					<hr>
					<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
						<?php
						while ($mquery->have_posts()) : $mquery->the_post();
							$imagedataarr= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),array(289,302));
						?>
							<li><h4><?php echo the_title(); ?></h4><a class="" href="<?php echo get_permalink(); ?>">
								<img src="<?php echo $imagedataarr[0];?>"></a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
			</div>
			<?php
		}
		?>
    </div>
</div>
<?php get_footer(); ?>


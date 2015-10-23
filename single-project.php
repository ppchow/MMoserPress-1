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
		$sel_project_text = "Selected Projects";
		$go_backlink = "/selected-projects/" ;
	}else{
		$sel_project_text = "项目案例";
		$go_backlink = "/cn/selected-projects/" ;
	}
?>
      
	<div class="row">
		<div class="large-12 columns projectpin">
			<ul class="tabs-mm">
	          <li><a href="<?php echo get_permalink() ?>" class="active"><?php echo $sel_project_text; ?></a></li>
	          <!-- <li class="right"> <a href= "<?php echo get_site_url().$go_backlink; ?>">&larr; back</a></li> -->
	          
	        </ul>
	        <?php $custom = get_post_custom(); //echo "<pre>",print_r(get_images_src('custom-full',true,$custom[thumbnail_id]));
	        //echo "Post :".get_post_meta(get_the_ID(), 'miu_images', true);
	        $galimgarr=miu_get_images(get_the_ID());

	        if(count($galimgarr)>0){
	        ?>
		        <div class="contentmax content-slick ">
		        	<div class="row">
		        		<div class="large-7 columns column-slick">
		        			<div class="slider multiple-items">
		        				  <?php
								  	foreach($galimgarr as $keyimg=>$valimg)
									{?>
										<div><img src="<?php echo $valimg?>" class="pinthis" /></div>
							  <?php }
								  ?>
	                        </div>
	                       
		        		</div>
		        		<div class="large-5 columns">
	                    	<h2><?php echo the_title() ;?></h2>
	                    	<h3><?php echo $custom["subtitle"][0]; ?></h3>
	                    	<?php echo $custom["shortdescription"][0]; ?>
	                  	</div>
		        	</div>
		        </div>
		        <hr />
	        <?php } ?>
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
			<hr />
		</div>
	</div>

<?php get_footer(); ?>
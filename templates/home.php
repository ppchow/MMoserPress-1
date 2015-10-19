<?php 
/**
* Template Name: Home
*/

get_header();
?>


<div class="row">
	<div class="large-12 columns">
		<ul class="tabs-mm not home hide-for-small">
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
        </ul>

		<div id="container">
			<div class="home-grid-sizer"></div>
			<div class="home-gutter-sizer"></div>

			<?php 
			 
			//Define your custom post type name in the arguments
			$args = array(
				'post_type' => 'home-block',
				'posts_per_page' => -1,
				'post_status' => null
				);

			 
			//Define the loop based on arguments
			$loop = new WP_Query( $args );
			 
			//Display the contents
			while ( $loop->have_posts() ) : $loop->the_post();
			?>

			<?php if ( get_field('hb_class') == 'plain' ) : ?>

				<div class="home-block <?php the_field('hb_class'); ?>">
					<h2><?php the_field('hb_icon'); ?> <?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>


			<?php elseif ( get_field('hb_class') == 'w6' ) : ?>

				<div class="home-block <?php the_field('hb_class'); ?>">
					<a class="whole-div" href="<?php the_field('hb_link'); ?>">

						<div class="trans">
						  <div class="slider multiple-items slick-plain">

						  	<div><img src="<?php the_field('gallery_item_1'); ?>" width="1040" height="376" alt="M Moser Gallery"></div>
						  	<div><img src="<?php the_field('gallery_item_2'); ?>" width="1040" height="376" alt="M Moser Gallery"></div>
						  	<div><img src="<?php the_field('gallery_item_3'); ?>" width="1040" height="376" alt="M Moser Gallery"></div>
						  	<div><img src="<?php the_field('gallery_item_4'); ?>" width="1040" height="376" alt="M Moser Gallery"></div>

						  </div>
						</div>

						<span><?php the_post_thumbnail(); ?></span>
					</a>
					<div class="intro-cap">
						<h2><?php the_field('hb_icon'); ?> <?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
				</div>

			<?php else : ?>

				<div class="home-block <?php the_field('hb_class'); ?>">
					<a class="whole-div" href="<?php the_field('hb_link'); ?>">
						<?php the_post_thumbnail(); ?>
					
						<div class="intro-cap">
							<h2><?php the_field('hb_icon'); ?> <?php the_title(); ?></h2>
							<?php the_content(); ?>
						</div>
					</a>
				</div>

			<?php endif; ?>

			<?php endwhile;?>

		</div> <!-- container -->
	</div> <!-- large-12 columns -->
</div> <!-- row -->

<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active">Search</a></li>
          <li class="right"> <a href="<?php echo get_site_url(); ?>">&larr; back home </a></li>
        </ul>

        <div class="contentgal">

        		<?php do_action( 'foundationpress_before_content' ); ?>

        		<h3><?php _e( 'Search Results for', 'foundationpress' ); ?> "<?php echo get_search_query(); ?>"</h3>
                <hr>
        	<?php if ( have_posts() ) : ?>

        		<?php while ( have_posts() ) : the_post(); ?>
        			<?php get_template_part( 'content-archive', get_post_format() ); ?>
        		<?php endwhile; ?>

        		<?php else : ?>
        			<?php get_template_part( 'content', 'none' ); ?>

        	<?php endif;?>
        </div>

    </div>
</div>

<?php get_footer(); ?>

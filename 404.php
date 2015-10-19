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
          <li><a href="<?php echo get_permalink(); ?>" class="active">404</a></li>
          <li class="right"> <a href="<?php echo get_site_url(); ?>">&larr; back home </a></li>
        </ul>

        <div class="contentgal">

        	<h3>Sorry, we can’t find the page you’re looking for.</h3>

        	<p>The file may have been moved or deleted. <br> <a title="M Moser Associates" href="<?php echo get_site_url(); ?>"><strong>Click here</strong></a> to head back to our homepage.</p>

        </div>

    </div>
</div>

<?php get_footer(); ?>

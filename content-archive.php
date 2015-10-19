<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php if ( get_the_post_thumbnail() ) : ?>

			<div class="row">
				<div class="large-6 columns">

					<?php the_post_thumbnail(); ?>

				</div>
				<div class="large-6 columns">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php the_excerpt( __( 'Continue reading...', 'foundationpress' ) ); ?>
				</div>
			</div>

		<?php else : ?>

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php the_excerpt( __( 'Continue reading...', 'foundationpress' ) ); ?>

		<?php endif; ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
	<hr />
</article>
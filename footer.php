<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<footer id="footer">
	<div class="row">
		<div class="large-6 columns">
			<hr class="show-for-medium-down">
			<ul class="followlink">
				<li class="socialink">
					<?php dynamic_sidebar("header-sidebar-2"); ?>
				</li>

				<li class="sharelink">
		          		<?php	
		           		//$post_type = get_post_type(get_the_ID());
		           		if(is_single()==false && $post_type=="news"){
		           			//echo "is single : ".is_single() .' post : '.$post_type;
		           			$catname=single_cat_title('', false );
							$term = get_term_by('name', $catname, 'news_category');
							$title = $term->name;
							$post_link = get_term_link($term->slug, 'news_category');
		           		}
		           		else{
		           			$title = get_the_title();
		           			$post_link = get_permalink();
		           		}
		           		if($post_type=="project" || $pageid=='111' || $pageid=='865' || $pageid=='117' || $pageid=='834' ) {
		           		?>
			          		<a href="#" data-dropdown="drop1">Share <i class="icon-paperplane"></i></a>
						    <ul id="drop1" class="f-dropdown" data-dropdown-content>
						      <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_link; ?>" target="_blank"><i class="icon-linkedin"></i> LinkedIn </a></li>
						      <li><a href="http://twitter.com/?status=<?php echo $title ?> - <?php echo $post_link; ?>" target="_blank"><i class="icon-twitter"></i> Twitter </a></li>
						      <li><a href="http://www.facebook.com/share.php?u=<?php echo $post_link; ?>" target="_blank"><i class="icon-facebook"></i> Facebook</a></li>
						      <li><a href="mailto:?subject=<?php echo $title ?> &amp;body=Hello, %0D%0A%0D%0AI thought this article would be of interest to you: %0D%0A%0D%0A<?php echo $title ?> %0D%0A%0D%0AClick here to learn more: <?php echo $post_link; ?>"><i class="icon-mail"></i> Mail</a>
						      </li>
						    </ul>
						<?php }?>
						</li>
			</ul>
			
			<!--<p class="copy">&copy; 1981-2015 M Moser Associates.  All rights reserved.</p>-->
			<?php dynamic_sidebar("footer-sidebar-1"); ?>
			
		</div>
		<div class="large-6 columns">
			
			
			<?php
			global $wp;
			$current_url = home_url(add_query_arg(array(), $wp -> request));
			?>

			<a href="#0" class="cd-top" title="Back to top"><i class="icon-arrow-up2"></i> </a>

			<!-- <p class="copy"><span class="right"><a href="<?php echo $current_url ?>/#top"><i class="icon-arrow-up"></i> <?php echo $go_to_top;?></a></span></p> -->

		</div>
	</div>
</footer>
</div> <!-- pull-me -->
</div> <!-- right pane -->
</div> <!-- main-pane -->
</section>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) :
?>

<a class="exit-off-canvas"></a>
<?php endif; ?>

<?php do_action('foundationpress_layout_end'); ?>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) :
?>
</div> <!-- off-canvas-wrap -->
</div> <!-- inner-wrap -->
<?php endif; ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<?php wp_footer(); ?>
<?php do_action('foundationpress_before_closing_body'); ?>
	<!-- Google Analytics Tracking code --> 

    <script type="text/javascript">  (function() {
    var ga = document.createElement('script');     ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:'   == document.location.protocol ? 'https://ssl'   : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[2]; s.parentNode.insertBefore(ga, s);
    })();
   </script>
   
   <!-- End of Google Analytics Tracking code -->
</body>
</html>

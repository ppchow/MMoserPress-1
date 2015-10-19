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
	              <!--<p class="copy">&copy; 1981-2015 M Moser Associates.  All rights reserved.</p>-->
	              <?php dynamic_sidebar("footer-sidebar-1"); ?>
	            </div>
	            <div class="large-6 columns">
	              <?php
	              global $wp;
	              $current_url = home_url(add_query_arg(array(),$wp->request)); ?>

	               <a href="#0" class="cd-top" title="Back to top"><i class="icon-arrow-up2"></i> </a>

	              <!-- <p class="copy"><span class="right"><a href="<?php echo $current_url ?>/#top"><i class="icon-arrow-up"></i> <?php echo $go_to_top;?></a></span></p> -->
	            
	            </div>
	          </div>
	        </footer>
	      </div> <!-- pull-me -->
	  </div> <!-- right pane -->
	</div> <!-- main-pane -->
</section>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>

<a class="exit-off-canvas"></a>
<?php endif; ?>

	<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
	</div> <!-- off-canvas-wrap -->
</div> <!-- inner-wrap -->
<?php endif; ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>

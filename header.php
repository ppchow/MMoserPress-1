<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-precomposed.png">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>

	<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<?php

		if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) :
		get_template_part( 'parts/off-canvas-menu' );
		endif;
	?>

	

	<section class="container" role="document">
		<?php do_action( 'foundationpress_after_header' ); ?>
	<div class="main-pane <?php echo '<!-- ' . basename( get_page_template() ) . ' -->'; ?> <?php echo get_the_ID(); ?> " id="top">

		<!-- Header Include-->
		<div class="left-pane">
		    <nav class="top-bar" data-topbar="">
		      <ul class="title-area">
		        <li class="name"> 
		          <!-- <h1><a href="#">My Site</a></h1>  --> 
		        </li>
		        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		        <li class="toggle-topbar menu-icon"><a href="<?php echo get_bloginfo('url'); ?>/#"><span>Menu</span></a></li>
		      </ul>
		      <section class="top-bar-section"> <!-- Right Nav Section -->
		        
		        
		        	<?php //echo custome_menu(); 
		        	 	$walker = new Menu_With_Description;
		        	 	if(pll_current_language()=="en"){
		        	 		$followUs_text = "Follow us: ";
		        	 		$nav_menu = wp_nav_menu(array('theme_location'=>'main', 'menu'=>'main_menu', 'menu_class' => 'right', 'walker' => $walker ,'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',)); 
	                    	echo $nav_menu;
		        	 	}else{
		        	 		$followUs_text = "关注我们";
		        	 		$nav_menu = wp_nav_menu(array('theme_location'=>'main', 'menu'=>'main_menu_chines', 'menu_class' => 'right', 'walker' => $walker ,'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',)); 
	                    	echo $nav_menu;
		        	 	}
	                    
	                ?>
		      </section>
		    </nav>
  		</div>
  		<div class="right-pane">
		    <div id="header" class="hide-for-small">
		      <div class="row">
		        <div class="medium-6 medium-push-6 columns">
		          <div class="logo"><a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/mmoser-logo.png" alt="M Moser Associates" width="340" height="51"></a></div>
		        </div>
		        <div class="medium-6 medium-pull-6 columns">
		        	<ul class="followlink">
		        		<li class="socialink">	
		          			<?php dynamic_sidebar("header-sidebar-2");?> 
		          		</li>
		          		<li class="languagelink">
		          			<?php
		          				dynamic_sidebar("header-sidebar-1");
							 ?>
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
		           		if($post_type=="project" || $post_type=="news" || $pageid=='111' || $pageid=='865' || $pageid=='117' || $pageid=='834' ) {
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
		        </div>
		      </div>
		    </div>
		<!-- Header Include END -->
		<div class="pull-me">
<?php

// Ken's Team's Custom Functions

add_image_size( 'custom-small', 160, 90, true );
add_image_size( 'custom-medium', 600, 450, true );		// Service Grid view
add_image_size( 'custom-large', 502, 525, true );		// Gallery Grid view
add_image_size( 'custom-full', 785, 440, true );		// Project Grid view

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary' => __( 'Primary Menu',      'twentyfifteen' ),
	// 'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
) );

//************************************************************************************ADDED BY RK


//==============================================================================================================================================================================
//==============================================================Custom Code Start For Services ============================================================================
//==============================================================================================================================================================================

add_action('admin_menu', 'services_menu');
function services_menu() {
	add_submenu_page('edit.php', 'services', 'services', 'manage_options', 'edit.php?category_name=services' ); 
}

add_action( 'init', 'create_post_services' );
function create_post_services(){
	register_post_type('services',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'services' ),
				'add_new' => 'Add services',
				'edit_item' => 'Edit services',
				'new_item' => 'New services',
				'add_new_item' => __('New services','your_text_domain'),
				'view_item' => 'View services',
				'search_items' => 'Search services',
				'capability_type' => 'services',
				'not_found' => 'No services found',
				'not_found_in_trash' => 'No services found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export' => true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
			'rewrite' => array(
				'slug' => 'services', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"
				'has_archive'=>false
			),
	));
}
//------------- .html extension service single-----------------------
/*
add_action( 'rewrite_rules_array', 'rewrite_rules' );
function rewrite_rules( $rules ) {
    $new_rules = array();
    foreach ( get_post_types() as $t )
        $new_rules[ $t . '/([^/]+)\.html$' ] = 'index.php?post_type=' . $t . '&name=$matches[1]';
    return $new_rules + $rules;
}

add_filter( 'post_type_link', 'custom_post_permalink' );
function custom_post_permalink ( $post_link ) {
    global $post;
    $type = get_post_type( $post->ID );
    return home_url( $type . '/' . $post->post_name . '.html' );
}
add_filter( 'redirect_canonical', '__return_false' );
*/
// ***********************short code for services************************
if (!function_exists('service_grid_shortcode')) {

		function service_grid_shortcode($atts, $content = null) {
			extract(shortcode_atts(array(
				'type'            => 'post',
				'limit'            => '10',
				//'order_by'        => 'date',
				//'order'           => 'DESC',
				'thumb_width'     => '94',
				'thumb_height'    => '71',
				'link'            => 'yes',
				'link_text'       => __('Read more', CHERRY_PLUGIN_DOMAIN),
				'custom_class'	  => '',
			), $atts));

			//echo "<pre>",print_r($atts);
			$rand  = rand();

			// check what order by method user selected
			switch ($order_by) {
				case 'date':
					$order_by = 'post_date';
					break;
				case 'title':
					$order_by = 'title';
					break;
				case 'popular':
					$order_by = 'comment_count';
					break;
				case 'random':
					$order_by = 'rand';
					break;
			}

			// check what order method user selected (DESC or ASC)
			switch ($order) {
				case 'DESC':
					$order = 'DESC';
					break;
				case 'ASC':
					$order = 'ASC';
					break;
			}

			// show link after posts?
			switch ($link) {
				case 'yes':
					$link = true;
					break;
				case 'no':
					$link = false;
					break;
			}

				global $post;
				global $my_string_limit_words;

				//$numb = $columns * $rows;

				// WPML filter
				$suppress_filters = get_option('suppress_filters');

				//START GET POST...............................

				$type = 'services';
                                $args=array(
                                  'post_type' => $atts[type],
                                  'post_status' => 'publish',
                                  'order_by' => $atts[order_by],
                                  'order' => $atts[order],
                                  'posts_per_page' => $atts[limit],
                                  );
	                $my_query = null;
	                $my_query = new WP_Query($args);
					//echo "<pre>";print_r($categories);exit;
					if( $my_query->have_posts() ) {
						$output = '<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">';
						while ($my_query->have_posts()) : $my_query->the_post(); 
							$custom = get_post_custom($my_query->ID);
							
						$output .= '<li>
					                    <a href="'.get_permalink().'">
					                    	'.get_the_post_thumbnail($my_query->ID).'</a><p>'.get_the_title().'</p>
					                </li>';

						endwhile;
						$output .= '</ul>';
					}
					?>
					<?php
				//END GET CATEGORY................................
			wp_reset_postdata(); // restore the global $post variable

			return $output;
		}
		add_shortcode('service_grid', 'service_grid_shortcode');
}
// ***********************short code for services end********************


// ***********************meta data for services************************

/*add_action("admin_init", "admin_init_services");

function admin_init_services(){ 
	add_meta_box("credits_meta", "Services Meta", "credits_meta_services", "services", "normal", "low"); 
}

function credits_meta_services(){
	global $post; 
	$custom = get_post_custom($post->ID);
	//echo "<pre>";
	//print_r($custom);exit;
	$descriptoin = $custom["descriptoin"][0];
	?>
	<h3 class="hndle"><span>Description :</span></h3>
    <?php wp_editor( $descriptoin, "descriptoin", $settings = array() );
}


global $post;

$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details_services');

function save_details_services(){
	global $post;
	update_post_meta($post->ID, "descriptoin", $_POST["descriptoin"]);
}
*/
//==============================================================================================================================================================================
//==============================================================Custom Code Start For location ============================================================================
//==============================================================================================================================================================================

add_action('admin_menu', 'location_menu');
function location_menu() {
	add_submenu_page('edit.php', 'location', 'location', 'manage_options', 'edit.php?category_name=location' ); 
}

add_action( 'init', 'create_post_location' );
function create_post_location(){
	register_post_type('location',
		array(
			'labels' => array(
				'name' => __( 'Locations' ),
				'singular_name' => __( 'Locations' ),
				'add_new' => 'Add Locations',
				'edit_item' => 'Edit Locations',
				'new_item' => 'New Locations',
				'add_new_item' => __('New Locations','your_text_domain'),
				'view_item' => 'View Locations',
				'search_items' => 'Search Locations',
				'capability_type' => 'locations',
				'not_found' => 'No Locations found',
				'not_found_in_trash' => 'No Locations found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export' => true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
			'rewrite' => array(
				'slug' => 'global-locations',
				'with_front' => false,
				'hierarchical' => true,
				'has_archive'=>true
			),
	));
}
add_action( 'init', 'add_custom_taxonomies_location', 0 );
function add_custom_taxonomies_location() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('continents', 'location', array(

		'labels' => array(
			'name' => _x( 'Continents', 'taxonomy general name' ),
			'singular_name' => _x( 'Continents', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Continents' ),
			'all_items' => __( 'All Continents' ),
			'parent_item' => __( 'Parent Continents' ),
			'parent_item_colon' => __( 'Parent Continents' ),
			'edit_item' => __( 'Edit Continents' ),
			'update_item' => __( 'Update Continents' ),
			'add_new_item' => __( 'Add New Continents' ),
			'new_item_name' => __( 'New Continents Name' ),
			'menu_name' => __( 'Continents'),
		),
		'hierarchical' => true,
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'continents', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"
			'has_archive'=>true
			
		),
	));
}
add_action('init', 'continents_links_add_default_boxes');
function continents_links_add_default_boxes() {
    register_taxonomy_for_object_type('continents', 'continents');
    //register_taxonomy_for_object_type('post_tag', 'courses Links Tag');
}

// *********************** META DATA FOR LOCATION ************************
add_action("admin_init", "admin_init_location");

function admin_init_location(){ 
	add_meta_box("credits_meta", "Location Meta", "credits_meta_location", "location", "normal", "low"); 
}

function credits_meta_location(){
	global $post; 
	$custom = get_post_custom($post->ID);
	//echo "<pre>";
	//print_r($custom);exit;
	$address = $custom["address"][0];
	$tel = $custom["tel"][0];
	$fax = $custom["fax"][0];
	$email = $custom["email"][0];

	?>
	<h3 class="hndle"><span>Address : </span></h3>
	<?php wp_editor( $address, "address", $settings = array() );?>
<!--<textarea rows="4" cols="50" name="address" size="100%" tabindex="1" id="address" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;"><?php echo $address;?></textarea>-->
	
	<h3 class="hndle"><span>Telephone : </span></h3>
    <input type="text" name="tel" size="100%" tabindex="2" id="tel" autocomplete="on" value="<?php echo $tel?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">
	
	<h3 class="hndle"><span>Fax : </span></h3>
    <input type="text" name="fax" size="100%" tabindex="3" id="fax" autocomplete="on" value="<?php echo $fax?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">

	<h3 class="hndle"><span> Email : </span></h3>
    <input type="text" name="email" size="100%" tabindex="4" id="email" autocomplete="on" value="<?php echo $email?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">
<?php
}

global $post;

$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details_location');

function save_details_location(){
	global $post;
	update_post_meta($post->ID, "address", $_POST["address"]);
	update_post_meta($post->ID, "tel", $_POST["tel"]);
	update_post_meta($post->ID, "fax", $_POST["fax"]);
	update_post_meta($post->ID, "email", $_POST["email"]);
}

// *********************** META DATA FOR LOCATION END ********************
// *********************** FLITER FOR LOCATION ***************************

add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters_global_location' );
function pippin_add_taxonomy_filters_global_location() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('continents');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'location' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}

// *********************** FLITER FOR LOCATION END ***********************

//==============================================================================================================================================================================
//==============================================================Custom Code Start For Project ============================================================================
//==============================================================================================================================================================================

add_action('admin_menu', 'project_menu');
function project_menu() {
	add_submenu_page('edit.php', 'project', 'project', 'manage_options', 'edit.php?category_name=project' ); 
}
add_action( 'init', 'create_post_project' );
function create_post_project(){
	register_post_type('project',
		array(
			'labels' => array(
				'name' => __( 'Project' ),
				'singular_name' => __( 'Project' ),
				'add_new' => 'Add Project',
				'edit_item' => 'Edit Project',
				'new_item' => 'New Project',
				'add_new_item' => __('New Project','your_text_domain'),
				'view_item' => 'View Project',
				'search_items' => 'Search Project',
				'capability_type' => 'project',
				'not_found' => 'No Project found',
				'not_found_in_trash' => 'No Project found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export' => true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
        	'rewrite' => array('slug' => 'selected-projects/%project_location%','with_front' => false),
			/*'rewrite' => array(
				'slug' => 'selected-projects',
				'with_front' => false,
				'hierarchical' => true,
				'has_archive'=>true
			),*/
	));

	/*Filtro per modificare il permalink*/
	add_filter('post_link', 'project_permalink', 1, 3);
	add_filter('post_type_link', 'project_permalink', 1, 3);

	function project_permalink($permalink, $post_id, $leavename) {
		//con %brand% catturo il rewrite del Custom Post Type
	    if (strpos($permalink, '%project_location%') === FALSE) return $permalink;
	        // Get post
			$post = get_post($post_id);
	        if (!$post) return $permalink;
				
	        // Get taxonomy terms
	        $terms = wp_get_object_terms($post->ID, 'project_location');
			
	        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
	        	$taxonomy_slug = $terms[0]->slug;
	        else $taxonomy_slug = 'no-project';

	    return str_replace('%project_location%', $taxonomy_slug, $permalink);
	}
}
add_action( 'init', 'add_custom_taxonomies_project', 0 );
function add_custom_taxonomies_project() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('project_location', 'project', array(

		'labels' => array(
			'name' => _x( 'Project Location', 'taxonomy general name' ),
			'singular_name' => _x( 'Project Location', 'taxonomy singular name' ),
			'search_items' =>  __( 'Project Location' ),
			'all_items' => __( 'All Project Location' ),
			'parent_item' => __( 'Parent Project Location' ),
			'parent_item_colon' => __( 'Parent Project Location' ),
			'edit_item' => __( 'Edit Project Location' ),
			'update_item' => __( 'Update Project Location' ),
			'add_new_item' => __( 'Add New Project Location' ),
			'new_item_name' => __( 'New Project Location' ),
			'menu_name' => __( 'Project Location'),
		),
		'hierarchical' => true,
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'project_location',
			'with_front' => false,
			'hierarchical' => true,
			'has_archive'=>true
		),
	));
}
add_action('init', 'project_location_links_add_default_boxes');
function project_location_links_add_default_boxes() {
    register_taxonomy_for_object_type('project_location', 'project_location');
    //register_taxonomy_for_object_type('post_tag', 'courses Links Tag');
}

// *********************** META DATA FOR PROJECT ************************

add_action("admin_init", "admin_init_project");

function admin_init_project(){ 
	add_meta_box("credits_meta", "Project Meta", "credits_meta_project", "project", "normal", "low"); 
}

function credits_meta_project(){
	global $post; 
	$custom = get_post_custom($post->ID);
	
	$sq_ft = $custom["sq_ft"][0];
	$subtitle = $custom["subtitle"][0];
	$shortdescription = $custom["shortdescription"][0];
	?>
	<h3 class="hndle"><span>Square Feet : </span></h3>
    <input type="text" name="sq_ft" size="100%" tabindex="1" id="sq_ft" autocomplete="on" value="<?php echo $sq_ft?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">
	
	<h3 class="hndle"><span>Sub Title : </span></h3>
    <input type="text" name="subtitle" size="100%" tabindex="2" id="subtitle" autocomplete="on" value="<?php echo $subtitle?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">

	<h3 class="hndle"><span>Short Description :</span></h3>
    <?php wp_editor( $shortdescription, "shortdescription", $settings = array() );
}

global $post;

$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details_project');

function save_details_project(){
	global $post;
	update_post_meta($post->ID, "sq_ft", $_POST["sq_ft"]);
	update_post_meta($post->ID, "subtitle", $_POST["subtitle"]);
	update_post_meta($post->ID, "shortdescription", $_POST["shortdescription"]);
}

// *********************** FLITER FOR PROJECT ************************

add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters_product_location' );
function pippin_add_taxonomy_filters_product_location() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('project_location');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'project' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}


//==============================================================================================================================================================================
//==============================================================Custom Code Start For Gallery ============================================================================
//==============================================================================================================================================================================

add_action('admin_menu', 'gallery_menu');
function gallery_menu() {
	add_submenu_page('edit.php', 'gallery_design', 'gallery_design', 'manage_options', 'edit.php?category_name=gallery_design' );
}

add_action( 'init', 'create_post_gallery' );
function create_post_gallery(){
	register_post_type('gallery_design',
		array(
			'labels' => array(
				'name' => __( 'Gallery' ),
				'singular_name' => __( 'Gallery' ),
				'add_new' => 'Add Gallery',
				'edit_item' => 'Edit Gallery',
				'new_item' => 'New Gallery',
				'add_new_item' => __('New Gallery','your_text_domain'),
				'view_item' => 'View Gallery',
				'search_items' => 'Search Gallery',
				'capability_type' => 'gallery',
				'not_found' => 'No Gallery found',
				'not_found_in_trash' => 'No Gallery found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export' => true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
			'rewrite' => array(
				'slug' => 'design-galleries',
				'with_front' => false,
				'hierarchical' => true,
				'has_archive'=>true
			),
	));
}

//==============================================================================================================================================================================
//==============================================================Custom Code Start For News ============================================================================
//==============================================================================================================================================================================


add_action('admin_menu', 'news_menu');
function news_menu() {
	add_submenu_page('edit.php', 'news', 'news', 'manage_options', 'edit.php?category_name=news' ); 
}

add_action( 'init', 'create_post_news' );
function create_post_news(){
	add_rewrite_tag('%news_year%','(\d+)');
	register_post_type('news',
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __( 'News' ),
				'add_new' => 'Add news',
				'edit_item' => 'Edit news',
				'new_item' => 'New news',
				'add_new_item' => __('New news','your_text_domain'),
				'view_item' => 'View news',
				'search_items' => 'Search news',
				'capability_type' => 'news',
				'not_found' => 'No news found',
				'not_found_in_trash' => 'No news found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var'  => true,
			'can_export' => true,
			'public'   => true,
        	'supports' => array('title','editor','thumbnail'),
			'rewrite'  => array('slug' => 'news/%news_category%/%news_year%','with_front' => false),
			'has_archive'   => true,
			
	));
}

/*Filtro per modificare il permalink*/
add_filter('post_link', 'brand_permalink', 1, 3);
add_filter('post_type_link', 'brand_permalink', 1, 3);

function brand_permalink($permalink, $post_id, $leavename) {
	//con %brand% catturo il rewrite del Custom Post Type
    
    if (strpos($permalink, '%news_category%') === FALSE) return $permalink;

        // Get post
		$post = get_post($post_id);
        if (!$post) return $permalink;
			
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'news_category');
		
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        	$taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-news';

		$custom = get_post_custom($post->ID);
		if($custom["news_date"][0]=="" )
			$news_date = get_the_date('Y', $post_id );
		else
			$news_date = date('Y',strtotime($custom["news_date"][0]));

		
	//echo $custom["news_date"][0]."<br>".get_the_date('Y-d-m h:s a', $post_id ); exit();	
		$year_link = str_replace('%news_year%', $news_date, $permalink);
		
	    return str_replace('%news_category%', $taxonomy_slug,$year_link);
}
//=======================End News Custome Post===========================================

//=======================Start News Meta Data============================================

add_action("admin_init", "admin_init_news");

function admin_init_news(){ 
	add_meta_box("credits_meta", "News Meta", "credits_meta_news", "news", "normal", "low"); 
}

function credits_meta_news(){
	global $post; 
	$custom = get_post_custom($post->ID);
	//echo $post->ID."<pre>",
	//print_r($custom);exit;
	$news_type = $custom["news_type"][0];
	$news_place = $custom["news_place"][0];
	//$place = $custom["place"][0];
	$shortdescription = $custom["shortdescription"][0];
	?>
	<h3 class="hndle"><span>News Type : </span></h3>
    <input type="text" name="news_type" size="100%" tabindex="1" id="news_type" autocomplete="on" value="<?php echo $news_type?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">

	<h3 class="hndle"><span>Place: </span></h3>
    <input type="text" name="news_place" size="100%" tabindex="2" id="news_place" autocomplete="on" value="<?php echo $news_place?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">

	<h3 class="hndle"><span>Shortdescription:</span></h3>
    <?php wp_editor( $shortdescription, "shortdescription", $settings = array() );
}

global $post;

$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details_news');

function save_details_news(){
	global $post;
	update_post_meta($post->ID, "news_type", $_POST["news_type"]);
	update_post_meta($post->ID, "news_place", $_POST["news_place"]);
	update_post_meta($post->ID, "shortdescription", $_POST["shortdescription"]);
}


//=====================End News Meta Data================================================ 

add_action( 'init', 'add_custom_taxonomies_news', 0 );
function add_custom_taxonomies_news() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('news_category', 'news', array(

		'labels' => array(
			'name' => _x( 'News Category', 'taxonomy general name' ),
			'singular_name' => _x( 'News Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search News' ),
			'all_items' => __( 'All News' ),
			'parent_item' => __( 'Parent News' ),
			'parent_item_colon' => __( 'Parent News' ),
			'edit_item' => __( 'Edit News' ),
			'update_item' => __( 'Update News' ),
			'add_new_item' => __( 'Add New News' ),
			'new_item_name' => __( 'New News Name' ),
			'menu_name' => __( 'News Category'),
		),
		'hierarchical'  => true,
		'public'		=> true,
		'query_var'		=> 'news_category',
		'rewrite'  => array(
			'slug' => 'news',
			'has_archive'=>true,
		),
		'_builtin'		=> false,
	));
}



add_action('init', 'news_links_add_default_boxes');
function news_links_add_default_boxes() {
    register_taxonomy_for_object_type('news_category', 'news_category');
    //register_taxonomy_for_object_type('post_tag', 'courses Links Tag');
}

//======================End News Textonomy===============

// *********************** FLITER FOR NEWS ************************

add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters_news_category' );
function pippin_add_taxonomy_filters_news_category() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('news_category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'news' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}






//======================Start Media Custom Post====================

add_action('admin_menu', 'media_menu');
function media_menu() {
	add_submenu_page('edit.php', 'media', 'media', 'manage_options', 'edit.php?category_name=media' ); 
}

add_action( 'init', 'create_post_media' );
function create_post_media(){
	register_post_type('media',
		array(
			'labels' => array(
				'name' => __( 'Media'),
				'singular_name' => __( 'Media' ),
				'add_new' => 'Add media',
				'edit_item' => 'Edit media',
				'new_item' => 'New media',
				'add_new_item' => __('New media','your_text_domain'),
				'view_item' => 'View media',
				'search_items' => 'Search media',
				'capability_type' => 'media',
				'not_found' => 'No media found',
				'not_found_in_trash' => 'No media found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export'=> true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
        	'rewrite'  => array('slug' => 'in-the-media/%media_year%','with_front' => false),
			'has_archive'   => true,
			/*'rewrite' => array(
				'slug' => 'in-the-media', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"
				'has_archive'=>true
			),*/
	));
}

/*Filtro per modificare il permalink*/
add_filter('post_link', 'media_permalink', 1, 3);
add_filter('post_type_link', 'media_permalink', 1, 3);

function media_permalink($permalink, $post_id, $leavename) {
	//con %brand% catturo il rewrite del Custom Post Type
    if (strpos($permalink, '%media_year%') === FALSE) return $permalink;
        // Get post
		$post = get_post($post_id);
        if (!$post) return $permalink;
			
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'media_year');
		
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        	$taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-media';

    return str_replace('%media_year%', $taxonomy_slug, $permalink);
}

//======================End Media Custom Post======================

//======================Start Media Meta Data======================

add_action("admin_init", "admin_init_media");

function admin_init_media(){ 
	add_meta_box("credits_meta", "Media Meta", "credits_meta_media", "media", "normal", "low"); 
}

function credits_meta_media(){
	global $post; 
	$custom = get_post_custom($post->ID);
	//echo $post->ID."<pre>",
	//print_r($custom);exit;
	$publish = $custom["publish"][0];

	
	$shortdescription = $custom["shortdescription"][0];
	?>
	<h3 class="hndle"><span>Publish : </span></h3>
    <input type="text" name="publish" size="100%" tabindex="1" id="publish" autocomplete="on" value="<?php echo $publish ?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">


	<h3 class="hndle"><span>Shortdescription:</span></h3>
    <?php wp_editor( $shortdescription, "shortdescription", $settings = array() );
}

global $post;

$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details_media');

function save_details_media(){
	global $post;
	update_post_meta($post->ID, "publish", $_POST["publish"]);
	//update_post_meta($post->ID, "news_date", $_POST["news_date"]);
	update_post_meta($post->ID, "shortdescription", $_POST["shortdescription"]);
}


//======================End Media Meta Data========================

//======================Start Media Textonomy======================

add_action( 'init', 'add_custom_taxonomies_media', 0 );
function add_custom_taxonomies_media() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('media_year', 'media', array(

		'labels' => array(
			'name' => _x( 'Media Year', 'taxonomy general name' ),
			'singular_name' => _x( 'Media Year', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Media' ),
			'all_items' => __( 'All Media' ),
			'parent_item' => __( 'Parent Media' ),
			'parent_item_colon' => __( 'Parent Media' ),
			'edit_item' => __( 'Edit Media' ),
			'update_item' => __( 'Update Media' ),
			'add_new_item' => __( 'Add New Media' ),
			'new_item_name' => __( 'New Media Name' ),
			'menu_name' => __( 'Media Year'),
		),
		'hierarchical' => true,
		'_builtin'	   => false,
		'rewrite'  => array(
			'slug' => 'in-the-media', 	// This controls the base slug that will display before each term
			'has_archive'=>true,
		),
		
	));
}
add_action('init', 'media_links_add_default_boxes');
function media_links_add_default_boxes() {
    register_taxonomy_for_object_type('media_year', 'media_year');
    //register_taxonomy_for_object_type('post_tag', 'courses Links Tag');
}

//======================End Media Textonomy======================== 

// *********************** FLITER FOR NEWS ************************

add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters_media_year' );
function pippin_add_taxonomy_filters_media_year() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('media_year');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'media' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}



//======================Start idea Custom Post====================

add_action('admin_menu', 'idea_menu');
function idea_menu() {
	add_submenu_page('edit.php', 'idea', 'idea', 'manage_options', 'edit.php?category_name=idea');
}

add_action( 'init', 'create_post_idea' );
function create_post_idea(){
	register_post_type('idea',
		array(
			'labels' => array(
				'name' => __( 'Idea'),
				'singular_name' => __( 'Idea' ),
				'add_new' => 'Add idea',
				'edit_item' => 'Edit idea',
				'new_item' => 'New idea',
				'add_new_item' => __('New idea','your_text_domain'),
				'view_item' => 'View idea',
				'search_items' => 'Search idea',
				'capability_type' => 'idea',
				'not_found' => 'No idea found',
				'not_found_in_trash' => 'No idea found in Trash'
			),
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'query_var' => true,
			'can_export' => true,
			'public' => true,
        	'supports' => array('title','editor','thumbnail'),
			'rewrite' => array(
				'slug' => 'ideas-library', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"
				'has_archive'=>true
			),
	));
}
//======================End idea Custom Post======================

//======================Start Idea Meta Data======================

add_action("admin_init", "admin_init_idea");

function admin_init_idea(){ 
	add_meta_box("credits_meta", "Idea Meta", "credits_meta_idea", "idea", "normal", "low"); 
}

function credits_meta_idea(){
	global $post; 
	$custam = get_post_custom($post->ID);
	$link = $custam["link"][0];
	$disp_type = $custam["disp_type"][0];
	//echo "<pre>",print_r($custam);
	?>
	<h3 class="hndle"><span>Link : </span></h3>
    <input type="text" name="link" size="100%" tabindex="1" id="link" autocomplete="on" value="<?php echo $link ?>" style="padding: 3px 8px;
font-size: 1.7em;line-height: 100%;width: 100%;outline: 0;">
	<h3 class="hndle"><span>Display Type : </span></h3>
	<select name="disp_type" id="disp_type" tabindex="2" style="padding : 0px 8px;
font-size: 1.4em;line-height: 100%;width: 100%;outline: 0;">
		<option value="" <?php echo  ($disp_type=="")? "selected" :"" ?> >Select Display Type</option>
		<option value="horizontal" <?php echo ($disp_type=="horizontal")? "selected" :"" ?>>Horizontal</option>
		<option value="vertical" <?php echo ($disp_type=="vertical")? "selected" :"" ?>>Vertical</option>
	</select>
<?php
}

global $post;

$custam = get_post_custom($post->ID);

add_action('save_post', 'save_details_idea');

function save_details_idea(){
	global $post;
	update_post_meta($post->ID, "link", $_POST["link"]);
	update_post_meta($post->ID, "disp_type", $_POST["disp_type"]);
}
//======================End Media Meta Data========================

//================================================================================================================================================================================
//==============================================================Custom Code End For Admin Partners  ============================================================================
//================================================================================================================================================================================


// Footer Widget Area 1
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'          => 'Footer 1',
		'id'            => 'footer-sidebar-1',
		'description'   => 'Common footer',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));
	// Footer Widget Area 2
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'          => 'Footer 2',
		'id'            => 'footer-sidebar-2',
		'description'   => 'Global Location Footer',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));
	// Footer Widget Area 3
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'          => 'Footer 3',
		'id'            => 'footer-sidebar-3',
		'description'   => 'News Detail footer',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));
	// Footer Widget Area 4
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'          => 'Footer 4',
		'id'            => 'footer-sidebar-4',
		'description'   => 'footer_desc',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));

	

	// Header Widget Area 4
	// Location: at the top of the Header
	register_sidebar(array(
		'name'          => 'Copyright Area',
		'id'            => 'copyright',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="copy-right widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));

	// Header Widget Area 4
	// Location: at the top of the Header
	register_sidebar(array(
		'name'          => 'Header',
		'id'            => 'header-sidebar-1',
		'description'   => 'header_desc',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="header-title">',
		'after_title'   => '</div>',
	));
	// Header bar
	// Location: at the top of the Header
	register_sidebar(array(
		'name'          => 'Social Medias',
		'id'            => 'header-sidebar-2',
		'description'   => 'Social Links',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="box-title">',
		'after_title'   => '</div>',
	));

//================================== FOR MENU DESCRIPTION WALKER CLASS CODE ================
class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= '<i class='.$item->description.'></i>';
		$item_output .= '<span>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.'</span>';

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


//=================================== REMOVE EXTRA CONTENT =================================

//remove_filter ('the_content',  'wpautop');
//=================================== REMOVE EXTRA CONTENT END =================================
 
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {

	if(get_the_ID()=="121" || get_the_ID()=="829"){
		$content_class = "contentmax";
	}else{
		$content_class = "contentgal";
	}
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
	
    $output = "<div class=\"$content_class\">\n";
    $output .= "<div class=\"slider multiple-items\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
		// $img = wp_get_attachment_image_src($id, 'medium');
		// $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'full');

        $output .= "<div>\n";
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
        $output .= "</div>\n";
    }

    $output .= "</div>\n";
    $output .= "</div>\n";

    return $output;
}

//================================ SOCIAL MEDIA =============================

//================================ SOCIAL MEDIA END==========================



//================================ MENU SELECT FOR SINGLE PAGE ===========================
add_action('wp_head', 'custom_menu_selected');
function custom_menu_selected(){
	$post_type = get_post_type(get_the_ID());
	$issingle = is_single();
	if(pll_current_language()=="en"){$cur_lang = "en";}else {$cur_lang="cn";}
	
	if ($post_type=="services" || ($issingle=='' && $post_type=="services"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-148 a':' .menu-main_menu_chines-container .right li#menu-item-939 a';
	}
	elseif ($post_type=="location" || ($issingle=='' && $post_type=="location"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-147 a':' .menu-main_menu_chines-container .right li#menu-item-940 a';
	}
	elseif ($post_type=="project" || ($issingle=='' && $post_type=="project"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-146 a':' .menu-main_menu_chines-container .right li#menu-item-941 a';
	}
	elseif ($post_type=="gallery_design" || ($issingle=='' && $post_type=="gallery_design"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-145 a':' .menu-main_menu_chines-container .right li#menu-item-942 a';
	}
	elseif ($post_type=="idea" || ($issingle=='' && $post_type=="idea"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-144 a':' .menu-main_menu_chines-container .right li#menu-item-943 a';
	}
	elseif ($post_type=="news" || ($issingle=='' && $post_type=="news"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-143 a':' .menu-main_menu_chines-container .right li#menu-item-944 a';
	}
	elseif ($post_type=="media" || ($issingle=='' && $post_type=="media"))
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-142 a':' .menu-main_menu_chines-container .right li#menu-item-945 a';
	}
	elseif (get_the_ID()=="254" || get_the_ID()=="825" )
	{
		$current = ($cur_lang=="en")?'.menu-main_menu-container .right li#menu-item-139 a':' .menu-main_menu_chines-container .right li#menu-item-2513 a';	//935 before 30 sep 2015
	}
	?>

	<style type="text/css">
	<?php echo $current; ?>{
		background:#ff7211 !important;
	  	color: #fff !important;
	}
	</style>
	<?php
}

?>

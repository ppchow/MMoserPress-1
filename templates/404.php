<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); 
if(pll_current_language()=="en"){
	$line1   = "Sorry, we can’t find the page you’re looking for";
	$line2   = "The file may have been moved or deleted.";
	$line3   = "Click here";
	$line4   = "to head back to our homepage.";
	$site_url = get_site_url();
	//$redirect_url = get_site_url().'/news/the-convivial-future-m-mosers-steve-gale-envisions-your-next-office-at-2020-workplace-network/';
}else{
	$line1   = "很抱歉，我们不能找到你要找的页面";
	$line2   = "该文件可能已被移动或删除。";
	$line3   = "点击这里";
	$line4   = "头回我们的主页。";
	$site_url = get_site_url()."/cn/index/";
	//$redirect_url = get_site_url().'/cn/news/the-convivial-future-m-mosers-steve-gale-envisions-your-next-office-at-2020-workplace-network/';
}
?>

<div class="row">
    <div class="large-12 columns nopin">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active">404</a></li>
        </ul>
        <div class="contentmax">
            <section class="row">
            	<div class="large-12 columns">
                	<h3><?php echo $line1; ?></h3>
					<h4><?php echo $line2; ?><br>
						<a title="" href="<?php echo $site_url; ?>"><?php echo $line3; ?></a> <?php echo $line4; ?>
					</h4>
                </div>
  			</section>
  		</div>
  		<hr>
    </div>
</div>
<?php get_footer(); ?>

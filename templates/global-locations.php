<?php 
/**
* Template Name: Global Locations
*/
get_header(); 
//echo get_site_url()."/cn/location/%E4%B8%89%E8%97%A9%E5%B8%82/";
if(pll_current_language()=="en"){
  $heading_text1 = "Over 750 multidisciplined professionals in 15 locations collaborate <span class='rwd-line'>to support our clients’ projects around the globe</span>";
  $heading_text2 = "Click on a location to learn more, ";
  $heading_text3 = "or scroll down";
  
  $general_info_text0 = "General Information";
  $general_info_text1_label = "General Enquiries";
  $general_info_text1 = "Pease email us at <a href='mailto:global-enquiry@mmoser.com'>global-enquiry@mmoser.com</a>";
  $general_info_text2_label = "Business Enquiries";
  $general_info_text2 = "Please refer to the appropriate office location page for direct contact details";
  $general_info_text3_label = "Job enquiries";
  $general_info_text3 = "Please go to the <a href='careers'><strong>Careers page</strong></a> or email us at <a href='mailto:careers@mmoser.com'>careers@mmoser.com</a>";
  $general_info_text4_label = "Media Enquiries";
  $general_info_text4 = "please email us at <a href='mailto:pr@mmoser.com'>pr@mmoser.com</a>";



  $sanfrancisco_title = "San Francisco" ;
  $newyork_title  =  "New York" ;
  $london_title =  "London" ;
  $delhi_title =  "Delhi" ;
  $mumbai_title =  "Mumbai" ;
  $bangalore_title =  "Bangalore" ;
  $chengdu_title =  "Chengdu" ;
  $beijing_title =  "Beijing" ;
  $shanghai_title =  "Shanghai" ;
  $guangzhou_title =  "Guangzhou" ;
  $taipei_title =  "Taipei" ;
  $shenzhen_title =  "Shenzhen" ;
  $hongkong_title =  "Hong Kong" ;
  $kualalumpur_title =  "Kuala Lumpur" ;
  $singapore_title = "Singapore";

  $sanfrancisco = get_site_url()."/global-locations/san-francisco/";
  $newyork = get_site_url()."/global-locations/new-york/";
  $london = get_site_url()."/global-locations/london/";
  $delhi = get_site_url()."/global-locations/delhi/";
  $mumbai = get_site_url()."/global-locations/mumbai/";
  $bangalore = get_site_url()."/global-locations/bangalore/";
  $chengdu = get_site_url()."/global-locations/chengdu";
  $beijing = get_site_url()."/global-locations/beijing/" ; 
  $shanghai = get_site_url()."/global-locations/shanghai/";
  $guangzhou = get_site_url()."/global-locations/guangzhou/";
  $taipei = get_site_url()."/global-locations/taipei/";
  $shenzhen = get_site_url()."/global-locations/shenzhen/";
  $hongkong = get_site_url()."/global-locations/hong-kong/";
  $kualalumpur = get_site_url()."/global-locations/kuala-lumpur/";
  $singapore = get_site_url()."/global-locations/singapore/";

}else{
  $heading_text1 = "超过750位专业人士，遍布全球15个分支机构，通力合作，成就客户所需所想。";
  $heading_text2 = "点击地区分布或向下滚屏";
  $heading_text3 = "以了解更多";
  
  
  $general_info_text0 = "一般咨询";
 $general_info_text1_label = "一般咨询";
  $general_info_text1 = "请电邮至 <a href='mailto:global-enquiry@mmoser.com'>global-enquiry@mmoser.com</a>";
  $general_info_text2_label = "业务咨询";
  $general_info_text2 = "业务咨询, 请访问我们的 全球分布页面，了解具体信息。";
  $general_info_text3_label = "就业机会";
  $general_info_text3 = "请前往  <a href='careers'><strong>招贤纳才</strong></a> or email us at <a href='mailto:careers@mmoser.com'>careers@mmoser.com</a>";
  $general_info_text4_label = "媒体合作";
  $general_info_text4 = "请电邮至 <a href='mailto:pr@mmoser.com'>pr@mmoser.com</a>";

  $sanfrancisco_title = "三藩市";
  $newyork_title  =  "纽约" ;
  $london_title =  "伦敦" ;
  $delhi_title  =  "德里" ;
  $mumbai_title =  "孟买" ;
  $bangalore_title =  "班加罗尔" ;
  $chengdu_title =  "成都" ;
  $beijing_title =  "北京" ;
  $shanghai_title=  "上海" ;
  $guangzhou_title =  "广州" ;
  $taipei_title =  "台北" ;
  $shenzhen_title =  "深圳" ;
  $hongkong_title =  "香港" ;
  $kualalumpur_title =  "吉隆坡" ;
  $singapore_title = "新加坡";

  $sanfrancisco = get_site_url()."/cn/global-locations/san-francisco/";
  $newyork = get_site_url()."/cn/global-locations/new-york/";
  $london = get_site_url()."/cn/global-locations/london/";
  $delhi = get_site_url()."/cn/global-locations/delhi/";
  $mumbai = get_site_url()."/cn/global-locations/mumbai/";
  $bangalore = get_site_url()."/cn/global-locations/bangalore/";
  $chengdu = get_site_url()."/cn/global-locations/chengdu/";
  $beijing = get_site_url()."/cn/global-locations/beijing/" ; 
  $shanghai = get_site_url()."/cn/global-locations/shanghai/";
  $guangzhou = get_site_url()."/cn/global-locations/guangzhou/";
  $taipei = get_site_url()."/cn/global-locations/taipei/";
  $shenzhen = get_site_url()."/cn/global-locations/shenzhen/";
  $hongkong = get_site_url()."/cn/global-locations/hong-kong/";
  $kualalumpur = get_site_url()."/cn/global-locations/kuala-lumpur/";
  $singapore = get_site_url()."/cn/global-locations/singapore/";
}
?>
    <div class="row">
        <div class="large-12 columns">
            <ul class="tabs-mm">
              <li><a href="<?php echo get_permalink(); ?>" class="active"><?php echo the_title(); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="contentmap">
      <div class="row">
        <div class="large-12 columns">
            <h3 class="text-center black"> <?php echo $heading_text1; ?></h3>
            <h4  class="text-center"><?php echo $heading_text2; ?><a href=" <?php echo the_permalink().'#lists' ?>"><?php echo $heading_text3 ?></a></h4>
            <div id="themap-2">
                <img width="1565" height="800" alt="" usemap="#mmoser-global-map"  src="<?php echo get_template_directory_uri(); ?>/assets/images/global-map-v2.jpg">
                  <map name="mmoser-global-map">
                    <area class="tooltip"  alt="San Francisco" title="<?php echo $sanfrancisco_title ?>" href="<?php echo  $sanfrancisco ?>" shape="rect" coords="183,280,223,317" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="New York" title="<?php echo $newyork_title ?>" href="<?php echo  $newyork ?>" shape="rect" coords="397,274,439,320" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="London" title="<?php echo $london_title ?>" href="<?php echo  $london ?>" shape="rect" coords="717,214,759,259" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Delhi" title="<?php echo $delhi_title ?>" href="<?php echo  $delhi ?>" shape="rect" coords="1048,335,1089,376" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Mumbai" title="<?php echo $mumbai_title ?>" href="<?php echo  $mumbai ?>" shape="rect" coords="1020,371,1061,412" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Bangalore" title="<?php echo $bangalore_title ?>" href="<?php echo  $bangalore ?>" shape="rect" coords="1047,407,1091,451" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Chengdu" title="<?php echo $chengdu_title ?>" href="<?php echo  $chengdu ?>" shape="rect" coords="1150,327,1195,364" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Beijing" title="<?php echo $beijing_title ?>" href="<?php echo  $beijing ?>" shape="rect" coords="1212,282,1252,323" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Shanghai" title="<?php echo $shanghai_title  ?>" href="<?php echo  $shanghai ?>" shape="rect" coords="1233,319,1273,356" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Guangzhou" title="<?php echo $guangzhou_title ?>" href="<?php echo  $guangzhou ?>" shape="rect" coords="1188,338,1217,370" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Taipei" title="<?php echo $taipei_title ?>" href="<?php echo  $taipei ?>" shape="rect" coords="1236,353,1276,390" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Shenzhen" title="<?php echo $shenzhen_title ?>" href="<?php echo  $shenzhen?>" shape="rect" coords="1208,346,1235,376" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Hong Kong" title="<?php echo $hongkong_title  ?>" href="<?php echo  $hongkong ?>" shape="rect" coords="1204,366,1237,405" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Kuala Lumpur" title="<?php echo $kualalumpur_title ?>" href="<?php echo  $kualalumpur ?>" shape="rect" coords="1150,429,1188,470" style="outline:none;" target="_self"     />
                    <area class="tooltip"  alt="Singapore" title="<?php echo $singapore_title ?>" href="<?php echo  $singapore ?>" shape="rect" coords="1158,456,1200,502" style="outline:none;" target="_self"     />
                  </map>
            </div> <!-- !themap -->
            <a name="lists">&nbsp;</a>

             <?php
                      $taxonomy = 'continents';
                      $argscategory=array(
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                        'taxonomy'=> $taxonomy,
                                        'parent' =>0
                                        );
                      global $wp_query;
                      $categories=get_categories($argscategory);
                      if(count($categories)>0){
                        $i = 1;
                        ?>
                        <a name="lists">&nbsp;</a>
                        <?php
                        foreach($categories as $key=>$val)
                        {
                          ?>
                          <h3><?php echo $val->name; ?></h3>
                           <?php if ($val->name =="Asia 亚洲" || $val->name =="Asia") {?>
                           	
                	<li class="single-languagelink ">
					<?php dynamic_sidebar("header-sidebar-1"); ?>
					</li>
					
                		<?php } ?>
                          <?php
                          $type = 'location';
                          $args=array(
                            'post_type' => $type,
                            'orderby' => 'title',
                            'order' => 'asc',
                            $taxonomy => $val->slug,
                            'post_status' => 'publish',
                            'posts_per_page' => -1
                            );
                          $my_query = null;
                          $my_query = new WP_Query($args);

                          if( $my_query->have_posts() ) {
                            ?>
                            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
                              
                                  <?php
                                  while ($my_query->have_posts()) : $my_query->the_post();
                                    $custom = get_post_custom($my_query->ID);
                                  ?>
                                  <li>
                                    <ul class="vcard">
                                      <li class="fn"><a href="<?php echo get_permalink() ?>"><?php echo the_title();?></a></li> 
                                      <li><?php echo $custom['address'][0];?></li> 
                                      <li class="fone"><?php echo ($custom['tel'][0]!="")? 'T: '.$custom['tel'][0] : '' ;?></li>
                                      <li><?php echo ($custom['fax'][0]!="")? 'F: '.$custom['fax'][0] : '' ;?></li>
                                      <li><?php  echo "<a href='mailto:".$custom['email'][0]."'>".$custom['email'][0]."</a>" ?></li>
                                    </ul>
                                  </li>
                                  <?php
                                  endwhile;
                                  ?>
                            </ul>
                              <?php
                          }
                        }
                      }
                    ?>
            <div class="row general-info">
              <div class="large-12 columns">
                <?php //dynamic_sidebar("footer-sidebar-2"); ?>
                
                <h3><?php echo $general_info_text0 ?></h3>
               
                        <div class="row">
                          <div class="large-4 columns">
                            <ul class="vcard"> 
                              <li class="fn"><?php echo $general_info_text1_label?></li> 
                              <li><?php echo $general_info_text1?></li> 
                            </ul>
                            <br><br>
                            <ul class="vcard"> 
                              <li class="fn"><?php echo $general_info_text2_label?></li> 
                              <li><?php echo $general_info_text2?></li>
                            </ul>
                          </div>
                          <div class="large-4 columns">
                            <ul class="vcard"> 
                              <li class="fn"><?php echo $general_info_text3_label?></li> 
                              <li><?php echo $general_info_text3?></li>
                            </ul>
                          </div>
                          <div class="large-4 columns">
                            <ul class="vcard"> 
                              <li class="fn"><?php echo $general_info_text4_label?></li> 
                              <li><?php echo $general_info_text4 ?></li> 
                            </ul>
                          </div>
                        </div>
                
                
              </div>
            </div>
        </div> <!-- column -->
      </div> <!-- row -->
    </div> <!-- !contentmap -->

<?php get_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/combined.js"></script>

<script>
    $(document).ready(function(e) {
      $('img[usemap]').rwdImageMaps();
    });
    </script>

    <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster({
                theme: 'tooltipster-light'
            });
        });
    </script>

    <script>
      $('#readmore').readmore({
        moreLink: '<p class="text-center"><a href="#" class="button map">or see list of all locations <i class="icon-arrow-down"></i></a></p>',
        lessLink: '<p class="text-center"><a href="#" class="button alert map">Close <i class="icon-arrow-up"></i></a></p>',
        maxHeight: 0
      });
    </script>
<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
  $content = "";
  
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent mlmenu vertical blindv blackwhite arrow delay inaccesible"><ul>' ;
   $ul_close='YES';//YES NO
	
  for ($i=0;$i<sizeof($box_categories_array);$i++) {
     
    switch(true) {
// to make a specific category stand out define a new class in the stylesheet example: A.category-holiday
// uncomment the select below and set the cPath=3 to the cPath= your_categories_id
// many variations of this can be done
//      case ($box_categories_array[$i]['path'] == 'cPath=3'):
//        $new_style = 'category-holiday';
//        break;
      case ($box_categories_array[$i]['top'] == 'true'):
        $new_style = 'category-top';
        break;
      case ($box_categories_array[$i]['has_sub_cat']):
        $new_style = 'category-subs';
        break;
      default:
        $new_style = 'category-products';
      }
     if (zen_get_product_types_to_category($box_categories_array[$i]['path']) == 3 or ($box_categories_array[$i]['top'] != 'true' and SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS != 1)) {
        // skip if this is for the document box (==3)
      } else {
	  /////////////////////////////1.1/////////////////////////
	  	if($box_categories_array[$i]['has_sub_cat'] &&  $new_style == 'category-top' ){
		
		  if($ul_close=='NO'){
		 
		    $content =$content.'</ul></li>';
		  
		  
			$ul_close='YES';
		  }
		  else{
		 
		  $ul_close='NO';
		
		  $content .= '<li><a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';
	      
           $content .= $box_categories_array[$i]['name'];

	
		  if ($box_categories_array[$i]['has_sub_cat']) {
			$content .= '=>';
		  }
		  
		  $content =$content.'</a><ul>';
		  
   		
	    }
	  }//new addon for <li>
	  elseif($box_categories_array[$i]['has_sub_cat']!=1&&$new_style == 'category-products'){// for child
	     
		  $content .= '<li><a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';
	     
           $content .= $box_categories_array[$i]['name'];

	
		 
		  $content =$content.'</a></li>';
		
	  if($i==(sizeof($box_categories_array)-1)){
		 
		
		  $content =$content.'</ul></li>';
		 
	  }
	  
	  }elseif($box_categories_array[$i]['has_sub_cat']!=1&&$new_style == 'category-top'){
	     if($ul_close=='NO'){
		
		       $content =$content.'</ul></li>';
			$ul_close='YES';
		  }
		
		  $content .= '<li><a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';
	       
           $content .= $box_categories_array[$i]['name'];
		  if ($box_categories_array[$i]['has_sub_cat']) {
			$content .= '=>';
		  }
		  $content =$content.'</a></li>';
		  
      ////////////////////////////
      if (SHOW_COUNTS == 'false') {//display counts
        if ((CATEGORIES_COUNT_ZERO == '1' and $box_categories_array[$i]['count'] == 0) or $box_categories_array[$i]['count'] >= 1) 		{
          $content .= CATEGORIES_COUNT_PREFIX . $box_categories_array[$i]['count'] . CATEGORIES_COUNT_SUFFIX;
        
      }
   
	   }
	  }
	  //eof new adds on
    }//end of else
  }//eof for loop
///////////////////////////////////////////////////////////////////////////////////////////
  if (SHOW_CATEGORIES_BOX_SPECIALS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true' or SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
// display a separator between categories and links
   
    if (SHOW_CATEGORIES_BOX_SPECIALS == 'true') {//display specials
      $show_this = $db->Execute("select s.products_id from " . TABLE_SPECIALS . " s where s.status= 1 limit 1");
      if ($show_this->RecordCount() > 0) {
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a></li>';
      }
    }
    if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {//displal new products
      // display limits
//      $display_limit = zen_get_products_new_timelimit();
      $display_limit = zen_get_new_date_range();

      $show_this = $db->Execute("select p.products_id
                                 from " . TABLE_PRODUCTS . " p
                                 where p.products_status = 1 " . $display_limit . " limit 1");
      if ($show_this->RecordCount() > 0) {
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a></li>' ;
      }
    }
    if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {//display featured products
      $show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
      if ($show_this->RecordCount() > 0) {
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a></li>';
      }
    }
    if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
      $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a></li>';
    }
  }
  $content .= '</ul></div>';
?>
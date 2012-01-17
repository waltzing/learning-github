<?php
/**
 * Side Box Template
 *
* @package templateSystem
 * @copyright Copyright 2010-2011 BlingTheme 
 * @copyright BlingThemes Reserved
 * @license http://BlingThemes.com
 * @version v1.0
 */
  $content = "";
  $featured_box_counter = 0;
  while (!$random_featured_product->EOF) {
    $featured_box_counter++;
    $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);
    $content .= '<div class="sideBoxContent centeredContent">';
    $content .=  '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], $random_featured_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); 
    $content .= '<br />' . $random_featured_product->fields['products_name'] . '</a>';
    $content .= '<div>' . $featured_box_price . '</div>';
    $content .= '</div>';
    $random_featured_product->MoveNextRandom();
  }
?>

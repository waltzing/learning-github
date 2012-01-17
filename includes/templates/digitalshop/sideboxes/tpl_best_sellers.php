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
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent ">' . "\n";
  $content .= '<div class="wrapper">' . "\n" . '<ol>' . "\n";
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
    $content .= '<li><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' . zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a></li>' . "\n";
  }
  $content .= '</ol>' . "\n";
  $content .= '</div>' . "\n";
  $content .= '</div>';
?>
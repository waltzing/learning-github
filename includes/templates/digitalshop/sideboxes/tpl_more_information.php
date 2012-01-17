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
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent hmenu">'  ;
  $content .=  "\n" . '<ul style="margin: 0; padding: 0; list-style-type: none;">'  ;
  for ($i=0; $i<sizeof($more_information); $i++) {
    $content .= '<li>' . $more_information[$i] . '</li>'  ;
  }

  $content .= '</ul>'  ;
  $content .= '</div>';
?>
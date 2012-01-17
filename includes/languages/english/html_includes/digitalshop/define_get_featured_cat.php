 <?php 
	 
  global $db;
$sql = "SELECT a.products_id as pro_id, a.products_image as image, a.products_price as price ,n.products_name as name ,n.products_description as description, n.products_url as url FROM ".TABLE_PRODUCTS." a inner join ". TABLE_PRODUCTS_DESCRIPTION." n on a.products_id = n.products_id  where a.master_categories_id='".FEATURED_CAT."'";
$result = $db->Execute($sql);
$path = HTTP_SERVER.DIR_WS_CATALOG.DIR_WS_IMAGES;
if ($result->RecordCount() > 0) {
  while (!$result->EOF) {
  
     echo '<li class="slider1Image"><a href="'.HTTP_SERVER.DIR_WS_CATALOG.'index.php?main_page=product_info&products_id='.($result->fields['pro_id']).'"> <img src="'.$path.($result->fields['image']).'" class="clip" alt="" />';
   
     echo '<span class="bottom"><strong>'.cut_str($result->fields['description'], 100, 0, '').'</strong></span></a></li>';
   
   // echo '<img src="'.$path.($result->fields['image']).'" />';
  // echo '"'.$path.'timthumb.php?src='.$path.($result->fields['image']).'&amp;h=275&amp;w=590&amp;zc=1" alt="" />';
    $result->MoveNext();
  }
} else {
  echo '<p>Sorry, no currencies found.</p>';
}
  
   
	                 
     function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
 
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
 
        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}
 


      
        
  
?>
  
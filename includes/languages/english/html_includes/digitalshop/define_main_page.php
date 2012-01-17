	<script type="text/javascript">
    $(document).ready(function() {
        $('#slider1').s3Slider({
            timeOut: 4000 
        });
    });
</script>
<div id="slider1">
<ul id="slider1Content">
<?php
//featured category ,define your parameters here
define('FEATURED_CAT','5');

?>
<?php require('define_get_featured_cat.php'); ?>
<div class="clear slider1Image"></div>
</ul>
</div>

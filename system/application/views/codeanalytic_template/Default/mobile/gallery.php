<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<link href="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>mobile/gallery/photoswipe.css" type="text/css" rel="stylesheet" /> 
<script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>mobile/gallery/klass.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>mobile/gallery/code_photoswipe.js"></script>

<script type="text/javascript">
    (function(window, $, PhotoSwipe){			
        $(document).ready(function(){				
            var options = {};
            $("#Gallery a").photoSwipe(options);
        });
    }(window, window.jQuery, window.Code.PhotoSwipe));
		
</script> 
<ul id="Gallery" class="gallery clearfix"> 
    <?php
    foreach ($query->result() as $r) {
        ?>
        <li>
            <a href="<?php echo base_url() ?>assets/media/upload/image/<?php echo str_replace('small', 'big', "$r->img") ?>"  rel="external">
                <img  alt="<?php echo $r->title ?>" src="<?php echo base_url() ?>assets/media/upload/image/<?php echo $r->img; ?>" /> 
            </a>
        </li>
        <?php
    }
    ?>
</ul> 
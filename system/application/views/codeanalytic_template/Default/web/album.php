<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php
if (is_ipad_user_agent()) {
    ?> 
    <link href="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/mobile/gallery/photoswipe.css" type="text/css" rel="stylesheet" /> 
    <script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/mobile/gallery/klass.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/mobile/gallery/code_photoswipe.js"></script>


    <script type="text/javascript">
        (function(window, $, PhotoSwipe){			
            $(document).ready(function(){				
                var options = {};
                $("#Gallery a").photoSwipe(options);
            });
        }(window, window.jQuery, window.Code.PhotoSwipe));
                		
    </script> 
    <div class="post_gallery">  
        <div class="post_title">
            <a href="<?php echo site_url('gallery/') ?>"><?php echo $title ?></a>
        </div> 
        <div class="gal_set">
            <a class="cat_gal" href="javascript:void(0)" onclick="$('div.cat_gal_box').slideToggle('slow')">album &Hacek;</a>

        </div>
        <div class="gallery_box">
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
        </div>
    </div>
    <?php
} else if ($this->agent->is_browser()) {
    ?>
    <div class="post_gallery">  
        <div class="post_title">
            <a href="<?php echo site_url('gallery/') ?>"><?php echo $title ?></a>
        </div> 

        <div class="gallery_box">
            <ul class="gallery clearfix"> 
                <?php
                foreach ($query->result() as $r) {
                    ?>
                    <li>
                        <a href="<?php echo base_url() ?>assets/media/upload/image/<?php echo str_replace('small', 'big', "$r->img") ?>" rel="prettyPhoto[gallery2]" title="<?php echo $r->description ?>">
                            <img  alt="<?php echo $r->title ?>" src="<?php echo base_url() ?>assets/media/upload/image/<?php echo $r->img; ?>" /> 
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $("area[rel^='prettyPhoto']").prettyPhoto();				
                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
                $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
                    	 
            });
        </script> 
    </div>
    <?php
}
?>
    
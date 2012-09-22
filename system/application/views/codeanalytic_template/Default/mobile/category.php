<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php 
$no = 1;
$uri_segment = 4;
$offset = $this->uri->segment($uri_segment);
$config['base_url'] = site_url("posts/kanal_/$id/");
$config['total_rows'] = $rows;
$config['per_page'] = $limit; 
$config['div'] = 'div#wrap_center';
$config['uri_segment'] = $uri_segment;
$this->pagination->initialize($config);
echo "<ul data-role=\"listview\" data-inset=\"true\" data-theme=" . ca_setting('mobile_theme') . ">
        <li data-role=\"list-divider\" data-theme=" . ca_setting('mobile_theme') . ">
            <a data-ajax='false' data-theme=" . ca_setting('mobile_theme') . " href='" . base_url() . "posts/kanal/$id' style='font-size:16px; text-transform:capitalize'>$title</a>  
        </li>";
$no = 1;
foreach ($query->result() as $r) {
    $id = $r->id;
    $d = explode(" ", $r->date);
    $d1 = explode("-", $d['0']);
    $d2 = explode(":", $d['1']);

    $datecreate = date_create("$d1[0]-$d1[1]-$d1[2]");
    $timecreate = date_create("$d2[0]:$d2[1]:$d2[2]");
    $format_date = date_format($datecreate, "d F Y");
    $format_time = date_format($timecreate, "h:i:s"); 
    $link = "posts/detail/$id/$d1[0]/$d1[1]/$d1[2]/$d2[0]/$d2[1]/$d2[2]/";
    if ($no == 1) {
        ?>
        <li class="l_<?php echo $no ?>">  
            <h3 class="post_title">
                <a data-ajax='false' href="<?php echo site_url($link) ?>">
                    <?php
                    echo str_replace("-", " ", $r->title);
                    ?>
                </a>
            </h3>
            <p class="post_info">
                <span id="date"><?php echo $format_date ?></span>
                <span id="time"><?php echo $format_time ?> WIB</span>
            </p>
            <?php
             if ($r->is_show_thumb) {
                    ?>
                    <p class="post_content">
                        <img class="mobile-image image" src="<?php echo base_url() . "assets/media/upload/image/" . $r->img; ?>" style="float: left"/>
                    </p>
                    <?php
                }
             ?>
             <p class="post_content">
             <?php
                if (ca_template_setting("is_parse_smiley") == "TRUE") {
                     $content = parse_smileys($r->content, base_url() . "assets/images/smileys/");
                 } else {
                     $content = $r->content;
                 }
                 echo character_limiter($content, ca_mobile_setting('limit_caracter'));
             ?>
             </p>
        </li> 
        <?php
    } else {
        ?>
        <li>
            <a data-ajax='false' href="<?php echo base_url() . "$link" ?>" ><?php echo $r->title ?></a>
        </li>
        <?php
    }
    $no++;
}
echo "</ul>";
?>
<p>
    <span id="pagination">
        <?php 
            echo $this->pagination->create_mobile_links(); 
        ?>
    </span>
</p> 
<div class="result_search" onclick="$(this).remove()">
      SEARCH BY "<?php echo $s_content ?>"
</div>
<?php
$no = 1;
$uri_segment = 4;
$offset = $this->uri->segment($uri_segment);
$config['base_url'] = site_url("posts/search_/$s_content/");
$config['total_rows'] = $rows;
$config['per_page'] = $limit;
$config['div'] = 'div#wrap_center';
$config['uri_segment'] = $uri_segment;
$this->pagination->initialize($config);
if ($query->num_rows() > 0) {
    echo "<ul style='list-style:none'>";
    foreach ($query->result() as $r) {
        if ($no == 1) {
            $id = $r->id;
            $num_com = $this->mposts->get_num_comments($r->id);
            $link = $r->permalink;
            $d = explode(" ", $r->date);
            $d1 = explode("-", $d['0']);
            $d2 = explode(":", $d['1']);
            $datecreate = date_create("$d1[0]-$d1[1]-$d1[2]");
            $timecreate = date_create("$d2[0]:$d2[1]:$d2[2]");
            $format_date = date_format($datecreate, ca_template_setting('date_format'));
            $month = date_format($datecreate, "M");
            $format_time = date_format($timecreate, "h:i:s");
            ?>
            <li>
                <div class="post">
                    <div class="post_title">
                        <a href="<?php echo site_url($link) ?>">
                            <?php
                            echo $r->title;
                            ?>
                        </a>
                    </div>
                    <div class="post_info">
                        <span id="date"> Posted on <?php echo $format_date ?></span>
                        <?php if (ca_template_setting('is_show_post_user')) { ?>
                            <span id="admin">Posted By : <?php echo $r->username ?></span>
                            <?php
                        }
                        if (ca_template_setting('is_comment') == '1') {
                            if (ca_template_setting('comment_via') == 'default') {
                                ?>
                                <span class="comments"><a href="#"><?php echo $num_com ?>Comments</a></span>
                                <?php
                            } else if (ca_template_setting('comment_via') == 'fb') {
                                ?>
                                <span class="comments"><a href="#"><?php echo ca_count_comment_via_fb($this_link) ?></a></span>
                                <?php
                            }
                        }
                        ?>
                        | <span class="views"><a href="#"><?php echo $r->view ?> Times Viewed</a></span>
                        <?php ?>
                    </div> 
                    <div class="content">
                        <?php
                        $real_image = str_replace('small', 'big', $r->img);
                        if ($r->is_show_thumb) {
                            ?>
                            <img class="image" src="<?php echo base_url() . "assets/media/upload/image/" . $real_image; ?>" alt="" align="left" />

                            <?php
                        }
                        if (ca_template_setting("is_parse_smiley") == "TRUE") {
                            $content = parse_smileys($r->content, base_url() . "assets/images/smileys/");
                        } else {
                            $content = $r->content;
                        }
                        echo character_limiter($content, ca_template_setting('limit_caracter'));
                        ?>
                        <a class="readmore" href="<?php echo base_url() . "$link" ?>" >Continue Reading → </a>
                    </div> 
                </div>
            </li>
            <?php
        }
    }
    echo "</ul>";
    ?>
    <p>
        <span id="pagination">
            <?php
            echo $this->pagination->create_links()
            ?>
        </span>
    </p>
    <?php
} else {
    echo "<div class='post'>
        <div class='post_title'>Not found post in entry keyword </div>
        </div>";
}
?>

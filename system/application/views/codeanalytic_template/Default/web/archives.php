<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php
if ($rows > 0) {
    $no = 1;
    $uri_segment = 5;
    $offset = $this->uri->segment($uri_segment);
    $config['base_url'] = site_url("archives/index_/$year/$month");
    $config['total_rows'] = $rows;
    $config['per_page'] = $limit;
    $config['div'] = 'div#wrap_center';
    $config['uri_segment'] = $uri_segment;
    $this->pagination->initialize($config);
      foreach ($query->result() as $r) {
             $d = explode(" ", $r->date);
                $d1 = explode("-", $d['0']);
                $d2 = explode(":", $d['1']);
                $datecreate = date_create("$d1[0]-$d1[1]-$d1[2]");
                $archive = date_format($datecreate, "F");
      }
    echo "<h2 class='archive_title'>Archive $archive</h2>
        <ul class='list_berita' style='list-style:none'>";
    if ($rows > 0) {
        $no = 1;
        foreach ($query->result() as $r) {
            if ($no == 1) {
                $id = $r->id;
                $num_com = $this->db->query("SELECT count(id) as count FROM ca_comments WHERE id_posts='$id' and publish='1'")->row()->count;
                $link = $r->permalink;
                $d = explode(" ", $r->date);
                $d1 = explode("-", $d['0']);
                $d2 = explode(":", $d['1']);
                $datecreate = date_create("$d1[0]-$d1[1]-$d1[2]");
                $timecreate = date_create("$d2[0]:$d2[1]:$d2[2]");
                $date = date_format($datecreate, "d M F");
                $format_time = date_format($timecreate, ca_template_setting('timee_format'));
                $format_date = date_format($timecreate, ca_template_setting('date_format'));
                ?>
                <li>
                    <div class="post">
                        <h2 class="post_title">
                            <a href="<?php echo site_url($link) ?>">
                                <?php echo $r->title; ?>
                            </a>
                        </h2>
                        <div class="post_info">
                            <?php if (ca_template_setting("is_show_post_date") == "TRUE") { ?>
                                <span id="date"><?php echo $format_date ?></span>
                            <?php } if (ca_template_setting("is_show_post_time") == "TRUE") { ?>
                                <span id="time"><?php echo $format_time ?></span>
                            <?php } if (ca_template_setting("is_show_post_user") == "TRUE") { ?>
                                <span id="admin">posted by <?php echo $r->username ?></span>
                                <?php
                            }

                            if (!$this->agent->is_mobile()) {
                                if (ca_template_setting('is_comment') == 'TRUE') {
                                    if (ca_template_setting('comment_via') == 'default') {
                                        ?>
                                        <span class="comments"><a href="#"><?php echo $num_com ?> comments</a></span>
                                        <?php
                                    } else if (ca_template_setting('comment_via') == 'fb') {
                                        ?>
                                        <span class="comments"><a href="#"><?php echo ca_count_comment_via_fb($link) ?> comments</a></span>
                                        <?php
                                    }
                                }
                                ?>
                                | <span class="views"><a href="#"><?php echo $r->view ?> Times Viewed</a></span>
                                <?php
                            }
                            ?>
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
                            <a class="readmore" href="<?php echo base_url() . "$link" ?>" >Continue Reading &rightarrow; </a>
                        </div> 
                    </div>
                </li>
                <?php
            }
        }
    }
    echo "</ul>";
    ?>
    <p>
        <span id="pagination">
            <?php
            echo $this->pagination->create_links();
            ?>
        </span>
    </p>
    <?php
}
else
    echo "<div class='post'>
        <div class='post_title'>Not found post in Archive selected </div>
        </div>";
?>
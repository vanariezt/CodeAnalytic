 <div class="relate comment_box" id="com_">
            <?php
            if ($this->session->userdata("member_id") <> '') {
                $id_ = $this->session->userdata('member_id');
                $q = $this->db->query("SELECT * FROM ca_members WHERE id='$id_'")->row();
                ?>
                <form class="comment" action="<?php echo base_url() ?>comments/insert" method="post">
                    <input type="hidden" name="id_posts" value="<?php echo $id ?>">
                    <input type="hidden" name="url_back" value="<?php echo $this_link ?>">
                    <p class="fill_com_img">
                        <img src="<?php echo base_url() . "assets/images/member/" . str_replace('middle', 'small', $q->photo) ?>" align="left"/> 
                    </p>
                    <div class="encode">
                        <a href="javascript:void(0)" class="opt_key code" onclick="insertAtCaret('smiley','<pre>\n&nbsp;your code\n</pre>');com_help('code')">insert code</a>
                        <a href="javascript:void(0)" class="opt_key smiley" onclick="$('#fill_cont_smilley').slideToggle('slow');com_help('smiley')">smiley</a>
                    </div>
                    <p class="fill_com_content">
                        <textarea name="content" id="smiley" class="comment_default keyboardInput"></textarea>
                    </p>
                    <div class="fill_smiley"> 
                        <div id="fill_cont_smilley" style="display: none">
                            <?php ca_get_smiley('smiley'); ?>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            var txt = $('.comment_default'),
                            hiddenDiv = $(document.createElement('div')),
                            content = null;
                            txt.addClass('txtstuff');
                            hiddenDiv.addClass('hiddendiv common');
                            $('body').append(hiddenDiv);
                            txt.keypress(function () { 
                                content = $(this).val(); 
                                content = content.replace(/\n/g, '<br>');
                                hiddenDiv.html(content + '<br class="lbr">');

                                $(this).css('height', hiddenDiv.height());

                            });
                        });
                    </script>

                    <?php echo form_error('content', '<p class="filed_error" style="color:red">', '</p>') ?>
                    <div class="fill_smiley">
                        <input type="submit" class="button-red submit submit-comment" value="send">  
                    </div> 
                </form>
            <?php } else {
                ?>
                <div class="login_desc">
                    <?php
                    if ($this->agent->is_mobile()) {
                        ?>
                        <a href="<?php echo base_url() ?>member/mobile_login" data-transition="slidedown" data-rel="dialog"  data-theme="<?php echo ca_template_setting('mobile_theme'); ?>" class="ui-btn-right">Login</a>
                        <?php
                        echo "Before give your comment";
                    } else if ($this->agent->is_browser()) {
                        echo "Please";
                        ?> <a href="javascript:void(0)" class="button-red rounded" onclick="lightbox('member/login')">Login</a> , <?php
                echo "Before give your comment";
            }
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <div class="relate">
            <h2>Comments Entry (<?php echo $num_com ?>)</h2>
            <div class="default_comment">
                <ul class="com_list">
                    <?php
                    $cn = 1;
                    foreach ($query as $r) {
                        $date = $r->date;
                        $explode = explode(' ', $date);
                        $date = explode('-', $explode['0']);
                        $time = explode(':', $explode['1']);

                        $datecreate = date_create("$date[0]-$date[1]-$date[2]");
                        $timecreate = date_create("$time[0]:$time[1]:$time[2]");
                        $format_date = date_format($datecreate, ca_template_setting('date_format'));
                        $format_time = date_format($timecreate, ca_template_setting('time_format'));
                        ?>
                        <li>
                            <div class="comentar">

                                <div class="com_cont" id="com_<?php echo $cn ?>">
                                    <?php $img = str_replace('middle', 'small', $r->photo); ?>
                                    <div class="com_left_img"> 
                                        <img src="<?php echo base_url() . "assets/images/member/$img" ?>" align="left"/> 
                                    </div>
                                    <?php
                                    $reg_exUrl = "/((((http|https|ftp|ftps)\:\/\/)|www\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/";
                                    $content = preg_replace($reg_exUrl, "<a target='_blank' href=\"$1\">$1</a> ", $r->content);
                                    ?>
                                    <div class="comment_content">

                                        <div class="com_tri">&nbsp;</div>
                                        <div class="real_cont">
                                            <div class="com_act">
                                                <span>&nbsp;<a href="<?php echo base_url() . "member/info/$r->member_id"; ?>">@<?php echo $r->username ?></a></span>
                                                &nbsp;<span id="time"><?php echo $format_date ?></span> <span><?php echo $format_time ?></span>
                                                <?php
                                                if (($this->session->userdata('member_id') == $r->member_id)) {
                                                    $lk = str_replace("/", ".", $this_link);
                                                    ?>
                                                    &nbsp;|&nbsp;<a href="javascript:void(0)" onclick="lightbox('comments/v_delete/<?php echo $r->id ?>/<?php echo $lk ?>')">(remove)</a>
                                                    <?php
                                                }
                                                ?> 
                                                <a href="#com_" class="act_tog" onclick="appen_smiley('<?php echo $r->username ?>')">&nbsp;</a>
                                            </div> 
                                            <div class="com_content"><?php echo $content; ?></div> 
                                        </div>
                                    </div>
                                </div>
                        </li>
                        <?php
                        $cn++;
                    }
                    ?>

                </ul>
                <?php
                if ($num_com > $limit) {
                    ?>
                    <div class="other_comment">
                        <?php
                        $next = intval($limit) + 5;
                        $uri = $num_com . "/" . $this_link . "/" . $id . "/" . $next;
                        ?>
                        <a href="javascript:void(0)" onclick="load('comments/comment_via/<?php echo $uri ?>', '.comment_via');"><center>more..</center></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>  

<script type="text/javascript">
    function appen_smiley(val){ 
        insertAtCaret('smiley','@'+val); 
    }     
    $(document).ready(function() {

        // add prettyprint class to all <pre><code></code></pre> blocks
        var prettify = false;
    
    
        $('.real_cont pre').find('br').remove() 
        $(".real_cont pre").each(function() {
            $(this).addClass('prettyprint'); 
            prettify = true;
        }); 

        // if code blocks were found, bring in the prettifier ...
        if ( prettify ) {
            $.getScript(site+"system/application/third_party/prettify/prettify.js", function() { prettyPrint() });
        }
    
    });
</script>
<?php $this->load->helper('js');
ca_vir_keyboard();
?> 
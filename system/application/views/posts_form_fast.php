<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');

/**
 * CodeAnalytic
 *
 * An open source application development cms support for php 4.3 and newest
 *
 * @package		CodeAnalytic
 * @author		CodeAnalytic Team Web Developer
 * @copyright           Copyright (c) 2012 , CodeAnalytic, Inc.
 * @license		http://codeanalytic.com/application-license
 * @link		http://codeanalytic.com
 * @since		Version 0.1
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Views 
 *
 * @package		CodeAnalytic
 * @subpackage          View
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/view/posts_form_fast
 * 
 */ 
?>
<?php
if (isUser() && isInsert()) {
    $rs = $this->mposts->get_cat();
    if ($rs->num_rows() > 0) {
        $cat_id[''] = "--category--";
        foreach ($rs->result() as $r) {
            $cat_id[$r->id] = $r->name;
        }
    }
    ?>
    <script type="text/javascript">
        $(function(){ 
            $('.title_permalink').keyup(function(){  
                $('input.permalink').val(($(this).val()));
            })
        })   
    </script>
    <form id="myform" method="post" onsubmit="return false" style="position: relative">
        <div class="main_left" style="width: 100%;">
            <div id="center_content" class="big_form"> 
                <p style="float:left; width: 35%; ">
                    <?php echo form_dropdown('cat_id', $cat_id, isset($default['cat_id']) ? $default['cat_id'] : '', "class='form_field' validation='required' style='width:100%;padding:4px; font-size:12px'"); ?>
                </p>
                <p style="float: left; width: 40%">
                    <input type="text" style="width: 100%; margin-left: 1%;font-size:12px"  name="title" <?php echo ca_auto_field('Insert title here ...') ?> class="form_field title_permalink" validation="required" value="Insert title here ...">
                </p>
                <p style="float: left; width: 15%; margin: 0px; padding: 0px;">
                    <span style="float: left; width: 100%" id="btn_submit" >
                        <a href="javascript:void(0)" class="button-red" style="position: absolute; top: 6px; right:-9px; padding: 0px 10px" onclick="ca_add_action('posts/do_insert',$(this).parent().parent().parent());" > <?php echo ca_translate("submit") ?></a> 
                    </span>
                </p>
                <input type="hidden" name="permalink" class="form_field permalink"  value="<?php echo set_value('permalink', isset($default['permalink']) ? $default['permalink'] : ''); ?>">
            </div>
            <p>
                <textarea id="content" class="tinymce" name="content" style="width: 97%; height: 150px"></textarea> 
            </p>             
        </div>   
    </form>  
    <?php
} else {
    ca_error_auth('insert', 'posts');
}
?>
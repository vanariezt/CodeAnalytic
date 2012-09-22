<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');  ca_right_top("polling", "polling form"); 

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
 * @link		http://docs.codeanalytic.com/view/polling_form
 */ 
?>
<div class="main_left" style="width: 60%"> 
    <?php
    if (isset($default['noofanswers']) && $default['noofanswers'] > 0) {
        echo "<script type='text/javascript'>$(function(){ca_poll('$default[noofanswers]')})</script>";
    } else {
        echo "<script type='text/javascript'>$(function(){ca_poll('3')})</script>";
    }
    ?>
    <div id="center_content"> 
        <form id="myform" method="post" onsubmit="return false;">
            <p>
                <label style="float: left; width: auto;"><?php echo ca_translate('number of answer');?></label>          
                <?php echo form_dropdown('noofanswers', $noofanswers, isset($default['noofanswers']) ? $default['noofanswers'] : '', "class = form_field validation='required' onchange='ca_poll_ans(this)'"); ?>
                <i><?php echo ca_translate('number of polling answer');?></i>
            </p>
            <p> 
                <textarea name="question" class="form_field  keyboardInput" validation="required" style="width: 94%" rows="5"  id='question'><?php echo set_value('question', isset($default['question']) ? $default['question'] : ''); ?></textarea>        
            </p> 
            <p id="ans1" class="p_ans">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 1');?></label>
                <input class="form_field  keyboardInput" validation="required" type="text" name="answer1" style="width: 63%" value="<?php echo set_value('answer1', isset($default['answer1']) ? $default['answer1'] : ''); ?>" />
            </p>
            <p id="ans2" class="p_ans" style="display: none">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 2');?></label><input class="form_field  keyboardInput" type="text" name="answer2" style="width: 63%" value="<?php echo set_value('answer2', isset($default['answer2']) ? $default['answer2'] : ''); ?>" />
                <a href="javascript:void(0)" class="button-red rounded" style="position: absolute; right: 16%; top:3" onclick="$('p#ans2').hide('slow')">-</a>
            </p>
            <p id="ans3" class="p_ans" style="display: none">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 3');?></label><input type="text" class="form_field  keyboardInput" name="answer3" style="width: 63%" value="<?php echo set_value('answer3', isset($default['answer3']) ? $default['answer3'] : ''); ?>" />
                <a href="javascript:void(0)" class="button-red rounded" style="position: absolute; right: 16%; top:3" onclick="$('p#ans3').hide('slow')">-</a>
            </p>
            <p id="ans4" class="p_ans" style="display: none">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 4');?></label><input class="form_field  keyboardInput" type="text" name="answer4" style="width: 63%" value="<?php echo set_value('answer4', isset($default['answer4']) ? $default['answer4'] : ''); ?>" />
                <a href="javascript:void(0)" class="button-red rounded" style="position: absolute; right: 16%; top:3" onclick="$('p#ans4').hide('slow')">-</a>
            </p>
            <p id="ans5" class="p_ans" style="display: none">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 5');?></label><input class="form_field  keyboardInput" type="text" name="answer5" style="width: 63%" value="<?php echo set_value('answer5', isset($default['answer5']) ? $default['answer5'] : ''); ?>" />
                <a href="javascript:void(0)" class="button-red rounded" style="position: absolute; right: 16%; top:3" onclick="$('p#ans5').hide('slow')">-</a>
            </p>
            <p id="ans6" class="p_ans" style="display: none">
                <label style="float: left; width: 20%; min-width: 100px"><?php echo ca_translate('answer 6')?></label><input class="form_field  keyboardInput" type="text" name="answer6" style="width: 63%"  value="<?php echo set_value('answer6', isset($default['answer6']) ? $default['answer6'] : ''); ?>" />
                <a href="javascript:void(0)" class="button-red rounded" style="position: absolute; right: 16%; top:3" onclick="$('p#ans6').hide('slow')">-</a>
            </p>
            <p id="p_submit">
                <a href="javascript:void(0)" style="left: 20.8%;" id="btn_submit" onclick="<?php echo isset($type) ? "ca_add_action('polling/$action_form',this);" : "ca_edit_action('polling/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
                <a id="btn_submit" href="javascript:void(0)"style="left: 21.2%;"  onclick="ca_load('polling/index/', '#cen_right')"><?php echo ca_translate('close'); ?></a>
            </p> 
        </form>
    </div>
</div>
<div class="main_right poll_swf" style="float: left; width: 36%; margin-left: 1%">
    <div id="bar_button" style="float: left; width: 100%; padding:0px;">
        <a href="javascript:void(0)" id="header" class="show" onclick="ca_slide_(this,'p.swf_')"><?php echo ca_translate('polling type');?></a>
    </div>
    <form style="float: left;margin-bottom: 30px;width: 100%;">
        <?php
        $swf = array('Doughnut2D','Pie2D');  
        for ($i = 0; $i < count($swf); $i++) { 
            ?>
                <p class="swf_">
                    <input type="radio"  <?php if (ca_setting("poll_swf") == $swf[$i]) { echo "checked='TRUE'"; } ?>
                           name="poll_swf" value="<?php echo $swf[$i] ?>" onclick="ca_change_polling(this)"><?php echo $swf[$i] ?>
                </p>
            <?php
        }
        ?> 
    </form>
   <div class="poll_view">
       <style type="text/css">
           .wi_title{
               padding: 5px;
               border-bottom: 1px solid #EBEBEB;
               font-size: 15px;
               font-weight: bold;
               text-transform: capitalize;
               
           }
       </style>
        <?php
        $this->load->widgets("fusion_polling");
        fusion_polling_wi();
        ?>
    </div>
</div>
<?php ca_vir_keyboard() ?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="logs_bar">
    <div class="tabs_bar" style="position: relative">
        <a onclick="ca_tabs(this,'.error404'); ca_load('logs/error404/on','.error404 > .content', 'n')" class="selected" href="javascript:void(0)">error404</a>
        <a onclick="ca_tabs(this,'.errorAuth'); ca_load('logs/errorAuth/on','.errorAuth > .content', 'n')" href="javascript:void(0)">errorAuth</a>
        <a onclick="ca_tabs(this,'.in_outUser'); ca_load('logs/userLogs/on','.in_outUser > .content', 'n')" href="javascript:void(0)">userLog</a>
        <a onclick="ca_tabs(this,'.in_outMember'); ca_load('logs/memberLogs/on','.in_outMember > .content', 'n')" href="javascript:void(0)">memberLog</a>
        <a href="javascript:void(0)" class="logs_max" onclick="ca_max_logs()" style="position: absolute; right: 0px; top:0px">max</a>
        <a href="javascript:void(0)" class="logs_min" onclick="ca_min_logs()" style="position: absolute; right: 0px; top:0px; display: none">min</a>
    </div>
    <div id="box_logs">
        <div id="tabs_bar">
            <div class="error404 box">
                <a href="javascript:void(0)" onclick="ca_removeLogs('404')" class="clear_logs"><?php echo ca_translate('clear'); ?></a>
                <a href="javascript:void(0)" class="clear_logs">&nbsp;|&nbsp;</a>
                <a href="javascript:void(0)" onclick="ca_print_element('#e404')" class="clear_logs" id="print"><span><?php echo ca_translate('print'); ?></span></a>
                <div class="content" id="e404">
                    <?php echo $e404 ?>
                </div>
            </div>
        </div>
        <div id="tabs_bar">
            <div class="errorAuth box"  style="display: none"> 
                <a href="javascript:void(0)" onclick="ca_removeLogs('auth')" class="clear_logs"><?php echo ca_translate('clear'); ?></a>
                <a href="javascript:void(0)" class="clear_logs">&nbsp;|&nbsp;</a>
                <a href="javascript:void(0)" onclick="ca_print_element('#auth')" class="clear_logs" id="print"><span><?php echo ca_translate('print'); ?></span></a>
                <div class="content" id="auth">
                    <?php echo $eAuth ?>
                </div>
            </div>
        </div>
        <div id="tabs_bar">
            <div class="in_outUser box"  style="display: none"> 
                <a href="javascript:void(0)" onclick="ca_removeLogs('user')" class="clear_logs"><?php echo ca_translate('clear'); ?></a>
                <a href="javascript:void(0)" class="clear_logs">&nbsp;|&nbsp;</a>
                <a href="javascript:void(0)" onclick="ca_print_element('#puser')" class="clear_logs" id="print"><span><?php echo ca_translate('print'); ?></span></a>
                <div class="content" id="puser">
                    <?php echo $uLogs ?>
                </div>
            </div>
        </div>
        <div id="tabs_bar">
            <div class="in_outMember box"  style="display: none"> 
                <a href="javascript:void(0)" onclick="ca_removeLogs('member')" class="clear_logs"><?php echo ca_translate('clear'); ?></a> 
                <a href="javascript:void(0)" class="clear_logs">&nbsp;|&nbsp;</a>
                <a href="javascript:void(0)" onclick="ca_print_element('#pmember')" class="clear_logs" id="print"><span><?php echo ca_translate('print'); ?></span></a>
                <div class="content" id="pmember">
                    <?php echo $mLogs ?>
                </div>
            </div>
        </div>
    </div> 
</div>

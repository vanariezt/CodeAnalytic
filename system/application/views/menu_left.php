<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/view/menu_left
 */
?>
<ul id="master_menu">      
    <li class="animated" ca-animation-name="pulse">
        <a class="selected" href="<?php echo base_url() ?>capanel" id="dashboard" onclick="ca_get_selected(this);ca_load('capanel', '')">
            <div class="icon_left" id="dashboard">&nbsp;</div><?php echo ca_translate("dashboard") ?>
        </a>
    </li>  
    <?php
    $rs = $this->mmodule->get('1');
    if ($rs->num_rows() > 0) {
        foreach ($rs->result() as $r) {
            ?>
            <li class="animated" ca-animation-name="pulse">
                <?php
                if($r->url<>'#'){
                    $link="ca_load('$r->url', '#cen_right')";
                }else{
                    $link='';
                }
                ?>
                <a href="javascript:void(0)" onclick="ca_get_selected(this);<?php echo $link ?>"> <div class="icon_left" id="<?php echo $r->name ?>">&nbsp;</div>  <?php echo ca_translate("$r->name") ?></a>
                <?php
                $rs1 = $this->mmodule->get_child($r->id, '1');
                if ($rs1->num_rows() > 0) {
                    ?>
                    <ul class="child_menu" style="display: none">
                        <?php
                        foreach ($rs1->result() as $r1) {
                            ?>
                            <li class="animated" ca-animation-name="pulse">
                                <a id="arrow" href="javascript:void(0)" onclick="ca_selected(this);ca_load('<?php echo $r1->url ?>', '#cen_right')"><?php echo ($r->name=='add-ons') ? $r1->name : ca_translate("$r1->name") ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
            }
            ?>
        </li>
        <?php
    }
    ?>


    <?php
    if (isSuperAdmin()) {
        ?>
        <li class="animated" ca-animation-name="pulse">

            <a href="javascript:void(0)" id="member" onclick="ca_get_selected(this);ca_load('member', '#cen_right')"><div class="icon_left" id="member">&nbsp;</div><?php echo ca_translate("member") ?></a>
            <ul class="child_menu" style="display: none">
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('comments', '#cen_right')"><?php echo ca_translate("comments") ?></a>
                </li>

            </ul>
        </li>
        <li class="animated" ca-animation-name="pulse">

            <a href="javascript:void(0)"  onclick="ca_get_selected(this);ca_load('user', '#cen_right')"> <div class="icon_left" id="user">&nbsp;</div><?php echo ca_translate("user") ?></a>
            <ul class="child_menu" style="display: none">
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('privileges', '#cen_right')"><?php echo ca_translate('privileges') ?></a>
                </li>
            </ul>
        </li>
        <li class="animated" ca-animation-name="pulse">

            <a href="javascript:void(0)" onclick="ca_get_selected(this);ca_load('settings/index', '#cen_right')"><div class="icon_left" id="setting">&nbsp;</div><?php echo ca_translate("settings") ?></a>
            <ul class="child_menu" style="display: none">
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('dir', '#cen_right')"><?php echo ca_translate("application") ?></a>
                </li>
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('languages','#cen_right')"><?php echo ca_translate('language') ?></a>
                </li>
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings/database','#cen_right')"><?php echo ca_translate('database') ?></a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings/email','#cen_right')"><?php echo ca_translate('email') ?></a>
                </li>
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings/general','#cen_right')"><?php echo ca_translate('general') ?></a>
                </li> 
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings', '#cen_right')"><?php echo ca_translate('info') ?></a>
                </li> 
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('third_party', '#cen_right')"><?php echo ca_translate('third party') ?></a>
                </li>
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings/social', '#cen_right')"><?php echo ca_translate('social') ?></a>
                </li>
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('settings/seo', '#cen_right')"><?php echo ca_translate('seo') ?></a>
                </li> 
                <li class="animated" ca-animation-name="pulse">
                    <a href="javascript:void(0)" id="arrow" onclick="ca_selected(this);ca_load('template', '#cen_right')"><?php echo ca_translate("template") ?></a>
                </li> 
                 
            </ul>
        </li> 
        <?php
    }
    ?> 
</ul>  
<div class="helpers">
    <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul#ca_helpers')"><?php echo ca_translate("help center"); ?></a> 
    <ul id="ca_helpers">
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-documentation" target="_blank"><?php echo ca_translate("documentation"); ?></a>
        </li>
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-language" target="_blank"><?php echo ca_translate("languages"); ?></a>
        </li>
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-mvc" target="_blank"><?php echo ca_translate("modules"); ?></a>
        </li>
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-theme" target="_blank"><?php echo ca_translate("themes"); ?></a>
        </li>
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-videos" target="_blank"><?php echo ca_translate("video"); ?></a>
        </li>
        <li class="animated" ca-animation-name="pulse">
            <a href="http://codeanalytic.com/codeanalytic-widgets" target="_blank"><?php echo ca_translate("widgets"); ?></a>
        </li>
    </ul>
</div>
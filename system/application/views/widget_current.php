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
 * @link		http://docs.codeanalytic.com/view/widget_current
 */
$rs = $this->mwidget->get_all($id, $id_template, $type)->result();
foreach ($rs as $r) {
    if ($r->id_htmlarea == '0') {
        if ($type == '0') {
            $this->ca_conf->load('widgets/config/', 'config_' . $r->name . EXT);
            $title = $this->ca_conf->item('title');
        } else {
            $this->ca_conf->load('widgets/mobile/mconfig/', 'config_' . $r->name . EXT);
            $title = $this->ca_conf->item('title');
        }
    } else {
        $title = $r->name;
    }
    ?>
    <li class="ui-state-default" style="display: block" id="id_<?php echo $r->id ?>">
        <?php ?>
        <div class="head_widget"> 
            <?php echo $title ?>
            <a class="icon ico_delete" onclick="ca_lightbox('widget/delete/<?php echo $r->id ?>')">&nbsp;</a>
            <?php
            if ($r->id_htmlarea <> '0') {
                ?> 
                <a class="icon ico_setting" onclick="ca_lightbox('htmlarea/update/<?php echo $r->id_htmlarea ?>')">&nbsp;</a>
                <?php
            } else {
                if ($type == '0') {
                    ?> 
                    <a class="icon ico_setting" onclick="ca_lightbox('widget/update/<?php echo $r->name ?>/0')">&nbsp;</a>
                    <?php
                } else {
                    ?> 
                    <a class="icon ico_setting" onclick="ca_lightbox('widget/update/<?php echo $r->name ?>/1')">&nbsp;</a>
                    <?php
                }
            }
            ?>

        </div> 
    </li>
    <?php
}
?>
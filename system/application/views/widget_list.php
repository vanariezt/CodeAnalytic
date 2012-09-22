<?php
if ($type == '0') {
    $dir_widget = './system/application/widgets/';
    $dir = opendir($dir_widget);
    while (false !== ($file = readdir($dir))) {
        if (strpos($file, '_wi', 1) && (!preg_match('/^config/', $file))) {
            $title = str_replace('_wi.php', '', $file);
            if ($title <> 'htmlarea') {
                if ($this->mwidget->get_name($title . '_wi', ca_theme_id())->num_rows() > 0) {
                    
                } else {
                    $dir_view = ".-system-application-widgets-";
                    $c_files = $dir_view . $file;
                    $conf_files = $dir_view . 'config-config_' . $file;
                    $x = explode(".", $file);
                    $widget = $x['0'];
                    ?>
                    <li class="ui-state-default" id="id_<?php echo str_replace('_', '#', $widget) ?>">
                        <div class="head_widget">
                            <?php echo $title ?> 
                            <a class="icon ico_delete" onclick="ca_lightbox('dir/delete/<?php echo $c_files ?>/wi/0')">&nbsp;</a>
                            <a class="icon ico_setting" onclick="ca_lightbox('widget/set_script/<?php echo $c_files . '/' . $conf_files ?>/0')">&nbsp;</a>
                        </div>
                        <div class="desc_widget"> 
                            <?php
                            if (is_file(APPPATH . 'widgets/config/config_' . $title . '_wi.php')) {
                                $this->ca_conf->load('widgets/config/', 'config_' . $title . '_wi');
                                echo character_limiter($this->ca_conf->item('description'), 40);
                            }
                            ?>
                        </div>

                    </li>
                    <?php
                }
            }
        }
    }
} else if ($type == '1') { 
    $dir_widget = './system/application/widgets/mobile/';
    $dir = opendir($dir_widget);
    while (false !== ($file = readdir($dir))) {
        if (strpos($file, '_wi', 1) && (!preg_match('/^mconfig/', $file))) {
           $title = str_replace('_wi.php', '', $file);
            if ($title <> 'htmlarea') {
                
                if ($this->mwidget->get_name($title . '_wi', ca_theme_id())->num_rows() > 0) {
                     
                } else {                     
                    $dir_view = ".-system-application-widgets-mobile-";
                    $c_files = $dir_view . $file;
                    $conf_files = $dir_view . 'mconfig-config_' . $file;
                    $x = explode(".", $file);
                    $widget = $x['0'];
                    ?>
                    <li class="ui-state-default" id="id_<?php echo str_replace('_', '#', $widget) ?>">
                        <div class="head_widget">
                            <?php echo $title ?> 
                            <a class="icon ico_delete" onclick="ca_lightbox('dir/delete/<?php echo $c_files ?>/wi/1')">&nbsp;</a>
                            <a class="icon ico_setting" onclick="ca_lightbox('widget/set_script/<?php echo $c_files . '/' . $conf_files ?>/1')">&nbsp;</a>
                        </div>
                        <div class="desc_widget"> 
                            <?php
                            if (is_file(APPPATH . 'widgets/mobile/mconfig/config_' . $title . '_wi.php')) {
                                $this->ca_conf->load('widgets/mobile/mconfig/', 'config_' . $title . '_wi');
                                echo character_limiter($this->ca_conf->item('description'), 40);
                            }
                            ?>
                        </div>

                    </li>
                    <?php
                }
            }
        }
    }
}
?>   
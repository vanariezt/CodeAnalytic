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
 * Widget 
 *
 * @package		CodeAnalytic
 * @subpackage          Widgets
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/widgets/polling
 */
/**
 * widgets for polling 
 */
if (!function_exists('fusion_polling_js')) {

    function fusion_polling_js() {
        ?>
        <script type="text/javascript">
            function take_poll(i,id,val){
                $.ajax({
                    type:"POST",
                    beforeSend: function(){
                        loading();
                    },
                    url : site+"polling/client_update",
                    data : "name="+$(i).attr("name")+"&id="+id+"&val="+val,
                    success : function(response){   
                        if(response==0){
                            lightbox('polling/info/0');
                        }else{
                            lightbox('polling/info/1');
                        }            
                    }
                })
            }
        </script>
        <?php
    }

}

if (!function_exists('fusion_polling_css')) {

    function fusion_polling_css() {
        
        $bg_header = ca_widget_setting('bg_header', 'fusion_polling');
        $background = ca_widget_setting('background', 'fusion_polling');
        $link_color = ca_widget_setting('link_color', 'fusion_polling');
        $margin = ca_widget_setting('margin', 'fusion_polling');
        $border_color = ca_widget_setting('border_color', 'fusion_polling');
        ?>
        <style type="text/css">
            .wi_title_fusion_polling{
                padding: 5px;
                color: <?php echo $link_color ?>;
                background: <?php echo $bg_header ?>;
                font-weight: bold;
                text-transform: uppercase;
            }
            ul.widget_fusion_polling{
                list-style: none;
                width: 98%;
                float: left;
            }
            ul.widget_fusion_polling li, ul.ca_categories li a{ 
                float: left;
                width: 98%;
                margin: 0px;
                list-style: none;
                text-transform: capitalize;
                color: <?php echo $link_color ?>;
            }
            ul.widget_fusion_polling li{
                padding: 5px 2px;  
            }
            .widget_fusion_polling{
                background: <?php echo $background ?>;
                margin: <?php echo $margin ?>;
                border: 1px solid <?php echo $border_color ?>
            }
            #polls{
                padding: 5px;
            }
        </style>
        <?php
    }

}

if (!function_exists('fusion_polling')) {

    function fusion_polling_wi() {
        echo"<div class='poll_box'>";
        $CA = & get_instance();
        $CA->load->model(array('mpolling', 'madmpoll'));
        $title = ca_widget_setting('title', 'fusion_polling');
        $width = ca_widget_setting('width', 'fusion_polling');
        echo "<div class='widget_fusion_polling' style='width:$width;float:left;'>";
        echo "<div class='wi_title_fusion_polling' id='fusion_polling'>$title</div>";
        $cmd = $CA->mpolling->get_poll_result();
        fusion_polling_js();
        fusion_polling_css();
        echo "<div id='polls'>";

        foreach ($cmd as $row) {
            echo "<div id='question_poll'>$row->question </div>";
            for ($i = 1; $i <= ($row->noofanswers); $i++) {
                switch ($i) {
                    case 1:
                        $background = '#98d900';
                        $ranswer = $row->ranswer1;
                        $answer = $row->answer1;
                        $name = "answer1";
                        break;
                    case 2:
                        $background = '#f1fe01';
                        $ranswer = $row->ranswer2;
                        $answer = $row->answer2;
                        $name = "answer2";
                        break;
                    case 3:
                        $background = '#81effc';
                        $ranswer = $row->ranswer3;
                        $answer = $row->answer3;
                        $name = "answer3";
                        break;
                    case 4:
                        $background = '#febf34';
                        $ranswer = $row->ranswer4;
                        $answer = $row->answer4;
                        $name = "answer4";
                        break;
                    case 5:
                        $background = '#9800dd';
                        $ranswer = $row->ranswer5;
                        $answer = $row->answer5;
                        $name = "answer5";
                        break;
                    case 6:
                        $background = '#000000';
                        $ranswer = $row->ranswer6;
                        $answer = $row->answer6;
                        $name = "answer6";
                        break;
                    default:
                        break;
                }
                echo "
                <div style='margin-left:15px; float:left; width:100%;'> 
                <span style='background-color:$background; width=10px;'>   </span>
                <input onclick='take_poll(this,\"$row->pid\",\"$ranswer\")' type='radio' name='$name' value='$answer' /> $answer<br/>
                </div>";
            }
        }
        echo "<div id='result_take_poll' style='width:100%;'></div></div>";
        ?>

        <script type="text/javascript" src="./system/application/third_party/charts/FusionCharts.js"></script> 
        <script type="text/javascript">
            FusionCharts.setCurrentRenderer('javascript')
            var chart = new FusionCharts("<?php echo base_url() ?>third_party/charts/<?php echo ca_setting("poll_swf") ?>.swf", "ChartId", "100%", "250", "0", "0");
            chart.setDataURL("<?php echo base_url() ?>polling/view_chart");		   
            chart.render("result_take_poll");      
            setInterval(function(){$('span._SmartLabel_Container').remove()},500); 
        </script> 
        <?php
        echo"</div>
            </div>";
    }

}
?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * users_statistic Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/users_statistic
 */
class users_statistic extends Controller {

    var $langfile = 'ca/user';
    function __construct() {
        parent::__construct(); 
        $this->load->helper(array('session','log','lang','app','date','form'));
        $this->load->library(array('session')); 
        $this->lang->index($this->langfile);
    }

    function get_($Y, $m) {
        if (isUser()) {
            if ($Y <> '' && $m <> '') {
                header("Content-Type:text/xml");
                $num_day = days_in_month($m, $Y);
                echo '<chart caption="Daily Visits Aplication By User Administrator ' . ca_setting('site_name') . '" subcaption="(from 1/' . $m . '/' . $Y . ' to ' . $num_day . '/' . $m . '/' . $Y . ')"
                    labelStep="4" showValues="0" showShadow="0" 
                    formatNumberScale="0" showLimits="0" canvasBorderAlpha="0" showBorder="0" divLineAlpha="30"
                    anchorRadius="4" anchorBgColor="0377D0" anchorBorderColor="FFFFFF" anchorBorderThickness="1" anchorAlpha="90"
                    showPlotBorder="1" plotBorderThickness="3" plotBorderColor="0377D0" plotFillColor="0377D0" 
                    plotGradientColor="" plotFillAlpha="20" bgColor="FFFFFF" showAlternateHGridColor="0" numVDivLines="2"
                    toolTipBgColor ="DEF1FF" toolTipBorderColor ="2C516D">';
                echo'<categories>';
                for ($i = 1; $i < $num_day; $i++) {
                    echo"<category label='$i/$m/$Y'/>";
                }
                echo'</categories>';
                $user = mysql_query("SELECT DISTINCT(user_id), username FROM ca_users");


                while ($row = mysql_fetch_array($user)) {
                    echo"<dataset seriesName='$row[username]' >";
                    for ($i = 1; $i < $num_day; $i++) {
                        $statistic = mysql_query("
                SELECT
                    count(s.user_id) as count,
                    u.username as username,
                    s.user_id
                FROM
                    ca_users as u,
                    ca_users_statistic as s
                WHERE
                    s.user_id = u.user_id AND
                    s.user_id = $row[user_id] AND
                    YEAR(s.date) = '$Y' AND
                    MONTH(s.date) = '$m' AND
                    DAY(s.date) = '$i'
                ") or die(mysql_error());
                        while ($row1 = mysql_fetch_array($statistic)) {

                            echo "<set value='$row1[count]'/>";
                        }
                    }
                    echo"</dataset>";
                }

                echo'<styles>
        <definition><style name="CaptionFont" type="font" size="12"/></definition>
        <application><apply toObject="CAPTION" styles="CaptionFont"/>
        <apply toObject="SUBCAPTION" styles="CaptionFont"/></application>
     </styles>';
                echo '</chart>';
            } else {
                ca_error404('page not found');
            }
        } else {
            ca_error_auth('view', 'member statistic');
        }
    }

    function index() {
        if (isUser()) {
            $data['Y'] = ($this->input->post("Y")) ? $this->input->post("Y") : date("Y");
            $data['m'] = ($this->input->post("m")) ? $this->input->post("m") : date("m");
            $this->load->view("users_statistic_index", $data);
        } else {
            ca_error_auth('show', 'statistic user');
        }
    }

    function find() {
        if (isUser()) {
            $month = array(
                '1' => "january", '2' => "february", '3' => "march", '4' => "april", '5' => "mei", '6' => "juny",
                '7' => "july", '8' => "agustus", '9' => "september", '10' => "october", '11' => "november", '12' => "december",
            );
            $data['m'][''] = 'Month';
            foreach ($month as $key => $value) {
                $data['m'][$key] = $value;
            }
            $data['Y'][''] = 'Years';
            for ($i = date('Y'); $i > (date('Y') - 20); $i--) {
                $data['Y'][$i] = $i;
            }
            $data['action_form'] = 'users_statistic/index';
            $this->load->view("users_statistic_find", $data);
        } else {
            ca_error_auth('search', 'statistic user');
        }
    }

}

?>
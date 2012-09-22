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
 * comments statistic Class
 *
 * @package		CodeAnalytic
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/comments_statistic
 */
class comments_statistic extends Controller {
    
    var $langfile = 'ca/comments';
    
    //put your code here
    function __construct() {
        parent::__construct();
        /**
         * load class language
         * @access public
         * @example libraries/language.php
         */
        $this->lang->index($this->langfile);
        /**
         *load class helper and library 
         */
        $this->load->helper(array('session','log','app','date','lang','form')); 

    }

    /**
     * 
     */
    function get_($Y) {
        if (isUser()) {
            if ($Y <> '') {
                header("Content-Type:text/xml");
               echo '<chart caption="Daily Comments Website In ' . $Y. '" 
                    labelStep="4" showValues="0" showShadow="0" 
                    formatNumberScale="0" showLimits="0" canvasBorderAlpha="0" showBorder="0" divLineAlpha="30"
                    anchorRadius="4" anchorBgColor="0377D0" anchorBorderColor="FFFFFF" anchorBorderThickness="1" anchorAlpha="90"
                    showPlotBorder="1" plotBorderThickness="3" plotBorderColor="0377D0" plotFillColor="0377D0" 
                    plotGradientColor="" plotFillAlpha="20" bgColor="FFFFFF" showAlternateHGridColor="0" numVDivLines="2"
                    toolTipBgColor ="DEF1FF" toolTipBorderColor ="2C516D">';
                echo'<categories>';
                for ($i = 1; $i < 13; $i++) {
                    $m = ca_get_month($i);
                    echo"<category label='$m'/>";
                }
                echo'</categories>';
                echo"<dataset seriesName='$Y' >";
                for ($i = 1; $i < 13; $i++) {
                    $statistic = $this->db->query("
                SELECT
                    count(id) as count, 
                    id
                FROM
                    ca_comments
                WHERE 
                    YEAR(date) = '$Y' AND
                    MONTH(date) = '$i' 
                ");
                    foreach ($statistic->result() as $row) {
                        echo "<set value='$row->count'/>";
                    }
                }
                echo"</dataset>";

                echo'<styles>
        <definition><style name="CaptionFont" type="font" size="12"/></definition>
        <application><apply toObject="CAPTION" styles="CaptionFont"/>
        <apply toObject="SUBCAPTION" styles="CaptionFont"/></application>
     </styles>';
                echo '</chart>';
            } else {
                ca_error404('url not found');
            }
        } else {
            ca_error_auth('view', 'comments statistic');
        }
    }

    function index() {
        if(isUser()){
        $data['Y'] = ($this->input->post("Y")) ? $this->input->post("Y") : date("Y"); 
        $data['today'] = $this->db->query("
                SELECT
                    id
                FROM 
                    ca_comments
                WHERE 
                    YEAR(date) = '" . date('Y') . "' AND
                    MONTH(date) = '" . date('m') . "' AND
                    DAY(date) = '" . date('d') . "'
                ")->num_rows();
        $yesterday = intval(date('d')) - 1;

        $data['yesterday'] = $this->db->query("
                SELECT
                    id
                FROM 
                    ca_comments
                WHERE 
                    YEAR(date) = '" . date('Y') . "' AND
                    MONTH(date) = '" . date('m') . "' AND
                    DAY(date) = '" . $yesterday . "'
                ")->num_rows();

        $lWeek = intval(date('d')) - 6;
        $lastWeek = "date BETWEEN '" . date('Y') . "-" . date('m') . "-$lWeek' AND '" . date('Y-m-d') . "'";

        $data['lastWeek'] = $this->db->query("
                SELECT
                    id
                FROM 
                    ca_comments
                WHERE 
                    $lastWeek
                ")->num_rows();
        $data['download'] = $this->db->query("
                SELECT
                    id
                FROM 
                    ca_comments 
                ")->num_rows();
        $this->load->view("comments_statistic_index", $data);
                
        }else {
            ca_error_auth('view', 'comments statistic');
        }
    }

    /**
     * function : find
     * is loaded when you load application banner for find
     * http://yourporoject/comments_statistic/find 
     */
    function find() {
        if (isUser()) { 
            $data['Y'][''] = 'Years';
            for ($i = date('Y'); $i > (date('Y') - 20); $i--) {
                $data['Y'][$i] = $i;
            }
            $data['action_form'] = 'comments_statistic/index';
            $this->load->view("comments_statistic_find", $data);
        }  else {
            ca_error_auth('search', 'comments statistic');
        }
    }

}

?>
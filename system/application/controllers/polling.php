<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
 * polling Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/polling
 */
class polling extends Controller {

    var $limit = 20;
    var $langfile = 'ca/polling';

    function __construct() {
        parent::__construct();
        /**
         * load class languange 
         * @example libraries/language
         */
        $this->lang->index($this->langfile);
        /**
         * load class helper, library and model 
         */
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app', 'widget'));
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('mpolling', 'madmpoll'));
    }

    function index($offset = 0) {
        if (isUser()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            $data['result'] = $this->madmpoll->get_all($limit, $offset)->result();
            $data['rows'] = $this->madmpoll->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("polling/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_content'] = ($this->input->post("s_content")) ? $this->input->post("s_content") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";

            /**
             * add logs 
             */
            ca_userLogs('view', 'Polling');
            $this->load->view("polling_index", $data);
        } else {
            ca_error_auth('view', 'polling');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array(
                "action_form" => "do_insert",
                "type" => "1"
            );
            $data['noofanswers'][0] = '0';
            for ($i = 1; $i < 7; $i++) {
                $data['noofanswers'][$i] = $i;
            }
            $data['default']['noofanswers'] = '3';
            /**
             * add logs 
             */
            ca_userLogs('view form input', 'Polling');
            $this->load->view("polling_form", $data);
        } else {
            ca_error_auth('insert', 'polling');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $question = $this->input->post("question");
            $answer1 = $this->input->post("answer1");
            $answer2 = $this->input->post("answer2");
            $answer3 = $this->input->post("answer3");
            $answer4 = $this->input->post("answer4");
            $answer5 = $this->input->post("answer5");
            $answer6 = $this->input->post("answer6");
            $noofanswers = $this->input->post("noofanswers");

            $pid = $order = $this->madmpoll->count() + 1;

            $data = array(
                "pid" => $pid,
                "question" => $question,
                "noofanswers" => $noofanswers,
                "answer1" => $answer1,
                "answer2" => $answer2,
                "answer3" => $answer3,
                "answer4" => $answer4,
                "answer5" => $answer5,
                "answer6" => $answer6,
                "publish" => '0'
            );
            $this->madmpoll->insert($data);
            $data1 = array(
                "pid" => $pid,
                "answer1" => 1,
                "answer2" => 1,
                "answer3" => 1,
                "answer4" => 1,
                "answer5" => 1,
                "answer6" => 1
            );
            /**
             * add logs 
             */
            ca_userLogs('insert', 'Polling');
            $this->madmpoll->insert1($data1);
        } else {
            ca_error_auth('insert', 'polling');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post('id');
            $data = array(
                "action_form" => "do_update/$id[0]",
                "title" => "UPDATE POLLING"
            );
            $data['noofanswers'][0] = '0';
            for ($i = 1; $i < 7; $i++) {
                $data['noofanswers'][$i] = $i;
            }
            $row = $this->madmpoll->get_by_id($id['0'])->row();
            $data['id'] = $id['0'];
            $data['default']['question'] = $row->question;
            $data['default']['noofanswers'] = $row->noofanswers;
            $data['default']['answer1'] = $row->answer1;
            $data['default']['answer2'] = $row->answer2;
            $data['default']['answer3'] = $row->answer3;
            $data['default']['answer4'] = $row->answer4;
            $data['default']['answer5'] = $row->answer5;
            $data['default']['answer6'] = $row->answer6;
            /**
             * add logs 
             */
            ca_userLogs('view form update', 'Polling');
            $this->load->view("polling_form", $data);
        } else {
            ca_error_auth('update', 'polling');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isInsert()) {
                $question = $this->input->post("question");
                $answer1 = $this->input->post("answer1");
                $answer2 = $this->input->post("answer2");
                $answer3 = $this->input->post("answer3");
                $answer4 = $this->input->post("answer4");
                $answer5 = $this->input->post("answer5");
                $answer6 = $this->input->post("answer6");
                $noofanswers = $this->input->post("noofanswers");

                $data = array(
                    "question" => $question,
                    "noofanswers" => $noofanswers,
                    "answer1" => $answer1,
                    "answer2" => $answer2,
                    "answer3" => $answer3,
                    "answer4" => $answer4,
                    "answer5" => $answer5,
                    "answer6" => $answer6
                );
                /**
                 * add logs 
                 */
                ca_userLogs('update', 'Polling');
                $this->madmpoll->update($id, $data);
            } else {
                ca_error_auth('update', 'polling');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'polling/do_delete';
            /**
             * add logs 
             */
            ca_userLogs('view from delete', 'Polling');
            $this->load->view("index_delete", $data);
        } else {
            ca_error_auth('delete', 'polling');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                $this->madmpoll->delete($id[$i]);
                echo "tr#id_$id[$i], ";
            }
            /**
             * add logs 
             */
            ca_userLogs('delete', 'Polling');
        } else {
            ca_error_auth('delete', 'polling');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->madmpoll->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            /**
             * add logs 
             */
            ca_userLogs('order', 'Polling');
        } else {
            ca_error_auth('order', 'polling');
        }
    }

    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isUser() && isPublish()) {
                if ($text == '1') {
                    $data = array(
                        "publish" => '0'
                    );
                } else {
                    $data = array(
                        "publish" => '1'
                    );
                }
                $this->db->update('ca_poll', array('publish' => '0'));
                $this->madmpoll->update($id, $data);
                if ($text == "1") {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('polling/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('polling/publish/$id/1',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('publish', 'Polling');
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'polling');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'polling/index';
            /**
             * add logs 
             */
            ca_userLogs('find', 'Polling');
            $this->load->view("polling_find", $data);
        } else {
            ca_error_auth('search', 'polling');
        }
    }

    function info($i) {
        if ($i == 0) {
            $data['message'] = 'Sorry you can not take polling again';
        } else {
            $data['message'] = 'Thank you for take polling';
        }
        $this->load->view("polling_info", $data);
    }

    function client_result() {
        $this->load->widgets("fusion_polling");
        fusion_polling_wi();
    }

    function client_update() {
        $pid = $this->input->post('id');
        $name = $this->input->post('name');
        $val = $this->input->post('val');
        $val = $val + 1;
        $data = array(
            "$name" => $val
        );
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($this->mpolling->cek_ip($pid, $ip) > 0) {
            echo "0";
        } else {
            $this->mpolling->insert_ip(array("pid" => $pid, "ip" => $ip));
            $this->mpolling->update($pid, $data);
            echo "1";
        }
    }

    function view_chart() {
        header("Content-Type:text/xml");
        $cmd = $this->mpolling->get_poll_result();
        foreach ($cmd as $row) {
            $crt = "";
            for ($i = 1; $i <= ($row->noofanswers); $i++) {
                switch ($i) {
                    case 1:
                        $background = '98d900';
                        $ranswer = $row->ranswer1;
                        $name = "I";
                        break;
                    case 2:
                        $background = 'f1fe01';
                        $ranswer = $row->ranswer2;
                        $name = "II";
                        break;
                    case 3:
                        $background = '81effc';
                        $ranswer = $row->ranswer3;
                        $name = "III";
                        break;
                    case 4:
                        $background = 'febf34';
                        $ranswer = $row->ranswer4;
                        $name = "IV";
                        break;
                    case 5:
                        $background = '9800dd';
                        $ranswer = $row->ranswer5;
                        $name = "V";
                        break;
                    case 6:
                        $background = '000000';
                        $ranswer = $row->ranswer6;
                        $name = "VI";
                        break;
                    default:
                        break;
                }
                $crt.="<set label='$name' value='$ranswer' color='$background' />";
            }
        }
        echo "<chart caption='' plotBorderAlpha='100' showPercentageInLabel='0' showLabels='0' plotBorderThickness='2' showShadow='0' borderColor='#FFFFFF' bgcolor='#FFFFFF' use3DLighting='0'  showValues='0'>" . $crt . "</chart>";
    }

    function view_setting() {
        $this->load->widgets("fusion_polling");
        fusion_polling_wi();
    }

    function setting() { 
        $poll_swf = $this->input->post("poll_swf");
        ca_set_setting('poll_swf', $poll_swf, ca_setting('poll_swf'),'codeanalytic'); 
    }

}

?>
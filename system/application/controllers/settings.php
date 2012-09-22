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
 * setting Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/setting
 */
class settings extends Controller {

    /**
     * define language file 
     * @var type 
     */
    var $langfile = 'ca/setting';

    /**
     * function constructor 
     */
    function __construct() {
        parent::__construct();
        /**
         * load models, helpers, lang
         */
        $this->load->helper(array('session', 'log', 'lang', 'app', 'date', 'form', 'js', 'mobile', 'template'));
        $this->lang->index($this->langfile);
        $this->load->model(array('msetting', 'mtemplate'));
    }

    /**
     * @access public 
     * get number of table rows taht will be show
     * @param type $num 
     */
    function page_view($num = '') {
        if ($num <> '') {
            if (isUser()) {
                ca_userLogs('change view page', 'Setting');
                $this->session->set_userdata('session_limiter', $num);
            } else {
                ca_error_auth('view', 'setting');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    /**
     * @access public
     * @link http://example.com/setting
     */
    function index() {
        if (isSuperAdmin()) {
            ca_userLogs('view info', 'Setting');
            $this->load->view('settings_index');
        } else {
            ca_error_auth('view', 'setting');
        }
    }

    /**
     * @access public 
     * get general data setting of application
     * where the file config in APPATH.'config/codeanalytic.php'
     */
    function general() {
        if (isSuperAdmin()) {
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['results_per_page'][$i] = $i;
                }
            }
            $data['default']['site_name'] = ca_setting('site_name');
            $data['default']['site_domain'] = ca_setting('site_domain');
            $data['default']['site_tag_line'] = ca_setting('site_tag_line');
            $data['default']['site_email'] = ca_setting('site_email');
            $data['default']['site_address'] = ca_setting('site_address');
            $data['default']['site_telp'] = ca_setting('site_telp');
            $data['default']['site_description'] = ca_setting('site_description');
            $data['default']['lang_default'] = ca_setting('lang_default');
            $data['default']['animation'] = ca_setting('animation');

            $data['default']['is_record_404'] = ca_setting('is_record_404', 'logs');
            $data['default']['is_record_auth'] = ca_setting('is_record_auth', 'logs');
            $data['default']['is_record_user'] = ca_setting('is_record_user', 'logs');
            $data['default']['is_record_member'] = ca_setting('is_record_member', 'logs');

            /**
             * add logs 
             */
            ca_userLogs('view general application', 'Setting');
            $this->load->view("settings_general", $data);
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * update general data setting of application
     * where the file config in APPATH.'config/codeanalytic.php'
     */
    function update_general() {
        if (isSuperAdmin()) {
            $site_name = $this->input->post("site_name");
            $site_domain = $this->input->post("site_domain");
            $site_tag_line = $this->input->post("site_tag_line");

            $site_email = $this->input->post("site_email");
            $site_address = $this->input->post("site_address");
            $site_telp = $this->input->post("site_telp");
            $site_description = $this->input->post("site_description");

            $lang_default = $this->input->post("lang_default");
            $animation = $this->input->post("animation");

            $is_record_404 = $this->input->post("is_record_404");
            $is_record_auth = $this->input->post("is_record_auth");
            $is_record_user = $this->input->post("is_record_user");
            $is_record_member = $this->input->post("is_record_member");

            ca_set_setting('is_record_404', $is_record_404, ca_setting('is_record_404', 'logs'), 'logs');
            ca_set_setting('is_record_auth', $is_record_auth, ca_setting('is_record_auth', 'logs'), 'logs');
            ca_set_setting('is_record_user', $is_record_user, ca_setting('is_record_user', 'logs'), 'logs');
            ca_set_setting('is_record_member', $is_record_member, ca_setting('is_record_member', 'logs'), 'logs');

            ca_set_setting('lang_default', $lang_default, ca_setting('lang_default'));
            ca_set_setting('animation', $animation, ca_setting('animation'));
            ca_set_setting('site_name', $site_name, ca_setting('site_name'));
            ca_set_setting('site_domain', $site_domain, ca_setting('site_domain'));
            ca_set_setting('site_tag_line', $site_tag_line, ca_setting('site_tag_line'));
            ca_set_setting('site_email', $site_email, ca_setting('site_email'));
            ca_set_setting('site_address', $site_address, ca_setting('site_address'));
            ca_set_setting('site_telp', $site_telp, ca_setting('site_telp'));
            ca_set_setting('site_description', $site_description, ca_setting('site_description'));

            /**
             * add logs 
             */
            ca_userLogs('update general application', 'Setting');
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * get social data setting of application
     * where the file config in APPATH.'config/social.php'
     */
    function social() {
        if (isSuperAdmin()) {
            $data['default']['fb_url'] = ca_setting('fb_url', 'social');
            $data['default']['twit_url'] = ca_setting('twit_url', 'social');
            $data['default']['gp_url'] = ca_setting('gp_url', 'social');

            $data['default']['fb_user_id'] = ca_setting('fb_user_id', 'social');
            $data['default']['fb_appl_id'] = ca_setting('fb_appl_id', 'social');
            /**
             * add logs 
             */
            ca_userLogs('view socail application', 'Setting');
            $this->load->view("settings_social", $data);
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * update social data setting of application
     * where the file config in APPATH.'config/social.php'
     */
    function update_social() {
        if (isSuperAdmin()) {
            $fb_url = $this->input->post("fb_url");
            $twit_url = $this->input->post("twit_url");
            $gp_url = $this->input->post("gp_url");

            $fb_user_id = $this->input->post("fb_user_id");
            $fb_appl_id = $this->input->post("fb_appl_id");

            ca_set_setting('fb_url', $fb_url, ca_setting('fb_url', 'social'), 'social');
            ca_set_setting('twit_url', $twit_url, ca_setting('twit_url', 'social'), 'social');
            ca_set_setting('gp_url', $gp_url, ca_setting('gp_url', 'social'), 'social');

            ca_set_setting('fb_user_id', $fb_user_id, ca_setting('fb_user_id', 'social'), 'social');
            ca_set_setting('fb_appl_id', $fb_appl_id, ca_setting('fb_appl_id', 'social'), 'social');
            /**
             * add logs 
             */
            ca_userLogs('update social application', 'Setting');
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * get seo data setting of application
     * where the file config in APPATH.'config/seo.php'
     */
    function seo() {
        if (isSuperAdmin()) {
            $data['default']['meta_title'] = ca_setting('meta_title', 'seo');
            $data['default']['meta_keyword'] = ca_setting('meta_keyword', 'seo');
            $data['default']['meta_description'] = ca_setting('meta_description', 'seo');
            $data['default']['meta_robot'] = ca_setting('meta_robot', 'seo');
            $data['default']['google_analytic_code'] = ca_get_content_text(BASEPATH . 'seo/google_analytic_code.txt');
            $data['default']['alexa_code'] = ca_get_content_text(BASEPATH . 'seo/alexa_code.txt');
            /**
             * add logs 
             */
            ca_userLogs('view seo application', 'Setting');
            $this->load->view("settings_seo", $data);
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * update seo data setting of application
     * where the file config in APPATH.'config/seo.php'
     */
    function update_seo() {
        if (isSuperAdmin()) {
            $meta_title = $this->input->post("meta_title");
            $meta_keyword = $this->input->post("meta_keyword");
            $meta_description = $this->input->post("meta_description");
            $meta_robot = $this->input->post("meta_robot");
            $this->input->use_xss_clean = FALSE;
            $google_analytic_code = $this->input->post("google_analytic_code", FALSE); 
            $alexa_code = $this->input->post("alexa_code", FALSE);
            ca_set_setting('meta_title', $meta_title, ca_setting('meta_title', 'seo'), 'seo');
            ca_set_setting('meta_keyword', $meta_keyword, ca_setting('meta_keyword', 'seo'), 'seo');
            ca_set_setting('meta_description', $meta_description, ca_setting('meta_description', 'seo'), 'seo');
            ca_set_setting('meta_robot', $meta_robot, ca_setting('meta_robot', 'seo'), 'seo');
            ca_write_content_text(BASEPATH . 'seo/google_analytic_code.txt', $google_analytic_code);
            ca_write_content_text(BASEPATH . 'seo/alexa_code.txt', $alexa_code);
            /**
             * add logs 
             */
            ca_userLogs('update seo application', 'Setting');
        } else {
            ca_error404('page not found');
        }
    }

    /**
     * @access public 
     * get database data setting of application
     * where the file config in APPATH.'config/database.php'
     */
    function database() {
        if (isSuperAdmin()) {
            $data['default']['db_name'] = ca_setting('database', 'database');
            $data['default']['db_user'] = ca_setting('username', 'database');
            $data['default']['db_pass'] = ca_setting('password', 'database');
            $data['default']['db_driver'] = ca_setting('dbdriver', 'database');

            $data['tables_name'] = $this->msetting->table_list();
            /**
             * add logs 
             */
            ca_userLogs('view database application', 'Setting');
            $this->load->view("settings_database", $data);
        }
    }

    /**
     * @access public 
     * update database data setting of application
     * where the file config in APPATH.'config/database.php'
     */
    function update_database() {
        if (isSuperAdmin()) {
            $db_name = $this->input->post("db_name");
            $db_pass = $this->input->post("db_pass");
            $db_user = $this->input->post("db_user");
            ca_set_setting('database', $db_name, ca_setting('database'), 'database');
            ca_set_setting('password', $db_pass, ca_setting('password'), 'database');
            ca_set_setting('username', $db_user, ca_setting('username'), 'database');
            /**
             * add logs 
             */
            ca_userLogs('update database application', 'Setting');
        }
    }

    /**
     * @access public 
     * get email data setting of application
     * where the file config in APPATH.'config/email.php'
     */
    function email() {
        if (isSuperAdmin()) {
            $this->load->helper('email');
            $data['default']['mailtype'] = ca_get_email_setting('mailtype');
            $data['default']['protocol'] = ca_get_email_setting('protocol');
            $data['default']['smtp_user'] = ca_get_email_setting('smtp_user');
            $data['default']['smtp_pass'] = ca_get_email_setting('smtp_pass');
            $data['default']['smtp_host'] = ca_get_email_setting('smtp_host');
            $data['default']['smtp_port'] = ca_get_email_setting('smtp_port');

            /**
             * add logs 
             */
            ca_userLogs('view email application', 'Setting');
            $this->load->view("settings_email", $data);
        }
    }

    /**
     * @access public 
     * update email data setting of application
     * where the file config in APPATH.'config/email.php'
     */
    function update_email() {
        if (isSuperAdmin()) {
            $this->load->helper('email');
            $mailtype = $this->input->post("mailtype");
            $protocol = $this->input->post("protocol");
            $smtp_user = $this->input->post("smtp_user");
            $smtp_pass = $this->input->post("smtp_pass");
            $smtp_host = $this->input->post("smtp_host");
            $smtp_port = $this->input->post("smtp_port");

            ca_set_email_setting('mailtype', $mailtype, ca_get_email_setting('mailtype'));
            ca_set_email_setting('protocol', $protocol, ca_get_email_setting('protocol'));
            ca_set_email_setting('smtp_user', $smtp_user, ca_get_email_setting('smtp_user'));
            ca_set_email_setting('smtp_pass', $smtp_pass, ca_get_email_setting('smtp_pass'));
            ca_set_email_setting('smtp_host', $smtp_host, ca_get_email_setting('smtp_host'));
            ca_set_email_setting('smtp_port', $smtp_port, ca_get_email_setting('smtp_port'));

            /**
             * add logs 
             */
            ca_userLogs('update email application', 'Setting');
        }
    }

    /**
     * @access public 
     * backup database your website
     * where the file backup in APPATH.'backup'
     */
    function db_backup() {
        if (isSuperAdmin()) {
            $base = APPPATH . "backup";
            $base = str_replace("\\", '/', $base);
            $new_dir = $base . "/" . date('Y.m.d.h.i.s');
            mkdir($new_dir, '0777');
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                $table = $id[$i];
                $result = mysql_query('SELECT * FROM ' . $table);
                $num_fields = mysql_num_fields($result);
                $return = '';
                // Second part of the output – create table
                $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
                $return .= "\n\n" . $row2[1] . ";\n";

                // Third part of the output – insert values into new table
                for ($x = 0; $x < $num_fields; $x++) {
                    while ($row = mysql_fetch_row($result)) {
                        $return.= 'INSERT INTO ' . $table . ' VALUES(';
                        for ($j = 0; $j < $num_fields; $j++) {
                            $row[$j] = addslashes($row[$j]);
                            if (isset($row[$j])) {
                                $return .= '"' . $row[$j] . '"';
                            } else {
                                $return .= '""';
                            }
                            if ($j < ($num_fields - 1)) {
                                $return.= ',';
                            }
                        }
                        $return.= ");\n";
                    }
                }
                $return.="\n\n\n";
                // Save the sql file
                $handle = fopen("$new_dir/$table.sql", 'w+');
                fwrite($handle, $return);
            }

            //fclose($handle);
            ca_userLogs("backup database [table]", 'Setting');

            /**
             * add logs 
             */
        } else {
            ca_error_auth('delete', 'pages');
        }
    }

    /**
     * @access public
     * restore database from path directori selected 
     */
    function db_restore() {
        if (isSuperAdmin()) {
            $dir = $this->input->post("dir");
            $base = APPPATH . "backup";
            $base = str_replace("\\", '/', $base);
            $new_dir = $base . "/" . $dir;
            $base_u = APPPATH . "backup";

            $ca = ca_list_dir($base_u . "/" . $dir);
            for ($j = 0; $j < count($ca); $j++) {
                $txt = explode("/", $ca[$j]);
                $text = str_replace('.sql', '', $txt[count($txt) - 1]);
                ca_userLogs("restore database [table]->$text", 'Setting');
                if ($this->db->query("DELETE FROM $text")) {
                    $sql_file = "$new_dir/$text.sql";
                    $FP = fopen($sql_file, 'r');
                    $READ = fread($FP, filesize($sql_file));
                    $READ = explode(";\n", $READ);
                    foreach ($READ AS $RED) {
                        mysql_query($RED);
                    }
                }
            }
        } else {
            ca_error_auth('delete', 'pages');
        }
    }

    /**
     * @access public 
     * remove file database 
     */
    function db_delete() {
        if (isSuperAdmin()) {
            $dir = $this->input->post("dir");
            $base_u = APPPATH . "backup/" . $dir;
            ca_userLogs("delete database backup in directory $dir", 'Setting');
            ca_recursive_delete($base_u);
        } else {
            ca_error_auth('delete', 'pages');
        }
    }

    /**
     * @access public
     * @param type $opt 
     * get content of message text
     */
    function content_email($opt) {
        if (isSuperAdmin()) {
            switch ($opt) {
                case 'comments':
                    $data['opt'] = 'comments';
                    $data['default']['content'] = ca_get_content_text(BASEPATH . "email/comments.txt");
                    $data['title'] = 'message content for comment';
                    break;
                case 'forgot_password':
                    $data['opt'] = 'forgot_password';
                    $data['default']['content'] = ca_get_content_text(BASEPATH . "email/forgot_password.txt");
                    $data['title'] = 'message content for password';
                    break;
                case 'news_letter':
                    $data['opt'] = 'news_letter';
                    $data['default']['content'] = ca_get_content_text(BASEPATH . "email/news_letter.txt");
                    $data['title'] = 'message content for news_letter';
                    break;
                case 'registration':
                    $data['opt'] = 'registration';
                    $data['default']['content'] = ca_get_content_text(BASEPATH . "email/registration.txt");
                    $data['title'] = 'message content for registration';
                    break;
                default:
                    break;
            }

            ca_userLogs('view email popup for editing content message', 'Setting');
            $this->load->view("settings_popup_email", $data);
        }
    }

    /**
     * @access public
     * @param type $opt
     * update message  
     */
    function email_popup_update($opt) {
        if (isSuperAdmin()) {
            $content = $this->input->post("content");
            switch ($opt) {
                case 'comments':
                    ca_write_content_text(BASEPATH . "email/comments.txt", $content);
                    break;
                case 'forgot_password':
                    ca_write_content_text(BASEPATH . "email/forgot_password.txt", $content);
                    break;
                case 'news_letter':
                    ca_write_content_text(BASEPATH . "email/news_letter.txt", $content);
                    break;
                case 'registration':
                    ca_write_content_text(BASEPATH . "email/registration.txt", $content);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * @access public
     * @param type $dir
     * download database with zip format 
     */
    function download_db($dir) {
        $this->load->library('zip');
        $path = APPPATH . 'backup/' . $dir . '/';

        $this->zip->read_dir($path);

        // Download the file to your desktop. Name it "$dir.zip"
        $this->zip->download($dir . '.zip');
    }

}

?>
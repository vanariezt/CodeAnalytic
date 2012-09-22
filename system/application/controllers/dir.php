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
 * dir Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/dir
 */
class dir extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/dir';

    /**
     * define limit view
     * @var type 
     */
    var $limit = 5;

    /**
     * function constructor 
     * @access public
     */
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
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app'));
        $this->load->library(array('form_validation', 'pagination'));
    }

    function index() {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $dir_php = './system/application/controllers/';
            $dir = opendir($dir_php);

            while (false !== ($f = readdir($dir))) {
                if (strpos($f, EXT, 1)) {
                    $title[] = $f;
                }
            }
            $file = $dir_php . $title['0'];
            $data['dir'] = $file;
            $data['file'] = str_replace("/", '-', $file);
            $data['text'] = ca_get_content_text($file);
            $data['base'] = "./system/application";
            /**
             * add logs 
             */
            ca_userLogs('view', 'Application Directory');
            $this->load->view("dir_index", $data);
        } else {
            ca_error_auth('update', 'apllication');
        }
    }

    function delete($file = '', $m = '', $type = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $data['file'] = str_replace('-', '/', $file);
                if (is_file($data['file'])) {
                    $data['act'] = $file;
                    $data['url'] = 'dir';
                    $data['m'] = $m;
                    $data['wi_type'] = $type;
                    /**
                     * add logs 
                     */
                    ca_userLogs("view form delete for file $data[file] in Directory ", 'Application Directory');
                    $this->load->view("dir_delete", $data);
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function do_delete($file = '', $m = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $filename = str_replace("-", "/", $file);
                $ex = explode('/', $filename);
                // delete for bowser widget
                $conf = 'config/config_' . $ex[count($ex) - 1];
                $ex_w = explode('widgets/', $filename);
                $config = $ex_w['0'] . 'widgets/' . $conf;
                if (is_file($config)) {
                    unlink($config);
                }
                // delete for mobile widget
                $conf = 'mconfig/config_' . $ex[count($ex) - 1];
                $ex_w = explode('widgets/mobile/', $filename);
                $mconfig = $ex_w['0'] . 'widgets/mobile/' . $conf;
                if (is_file($mconfig)) {
                    unlink($mconfig);
                }


                $all_file = str_replace('_wi.php', '', $ex[count($ex) - 1]);
                // drop table if exist 
                if ($m <> '') {
                    if (mysql_num_rows(mysql_query("SHOW TABLES LIKE 'ca_$all_file'")) == 1) {
                        $this->db->query("DROP TABLE ca_$all_file");
                    }
                    // delete  filed in table widget where name if find
                    $wi_name = $all_file . '_wi';
                    $this->db->query("DELETE FROM ca_widget WHERE name='$wi_name'");
                    $this->db->query("DELETE FROM ca_module WHERE name='$all_file'");
                    $this->db->query("DELETE FROM ca_add_ons WHERE title='$all_file'");
                }
                // delete controller if exists
                $controller = './system/application/controllers/' . $all_file . EXT;
                if (is_file($controller)) {
                    unlink($controller);
                    ca_userLogs("delete file $controller in Directory $m", 'Application Directory');
                }
                // delete model if exists
                $model = './system/application/models/m' . $all_file . EXT;
                if (is_file($model)) {
                    unlink($model);
                    ca_userLogs("delete file $model in Directory $m", 'Application Directory');
                }
                $view = './system/application/views/' . $all_file;
                if (is_dir($view)) {
                    ca_recursive_delete($view);
                    ca_userLogs("delete file $view in Directory $m", 'Application Directory');
                }
                $plugin = './system/application/plugins/' . $all_file;
                if (is_dir($plugin)) {
                    ca_recursive_delete($plugin);
                    ca_userLogs("delete file $plugin in Directory $m", 'Application Directory');
                }
                $third_party = './system/application/third_party/' . $all_file;
                if (is_dir($plugin)) {
                    ca_recursive_delete($third_party);
                    ca_userLogs("delete file $third_party in Directory $m", 'Application Directory');
                }
                $helper = './system/application/helpers/' . $all_file . '_helper' . EXT;
                if (is_file($helper)) {
                    unlink($helper);
                    ca_userLogs("delete file $helper in Directory $m", 'Application Directory');
                }
                if (is_file($filename)) {
                    unlink($filename);
                    ca_userLogs("delete file $filename in Directory $m", 'Application Directory');
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function view($file = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $this->load->helper('js');
                $fname = str_replace("-", "/", $file);
                if (is_file($fname)) {
                    $data['text'] = ca_get_content_text($fname);
                    $data['file'] = $file;
                    $data['dir'] = $fname;
                    /**
                     * add logs 
                     */
                    ca_userLogs("view file $fname", 'Application Directory');
                    $this->load->view("dir_view", $data);
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function view_image($file = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $this->load->helper('js');
                $fname = str_replace("-", "/", $file);
                if (is_file($fname)) {
                    $data['file'] = $fname;
                    /**
                     * add logs 
                     */
                    ca_userLogs("view file $fname", 'Application Directory');
                    $this->load->view("dir_view_image", $data);
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function pop_up($file = '', $c = '') {
        if ($file <> '' && $c <> '') {
            if (isSuperAdmin()) {
                $this->load->helper('js');
                $fname = str_replace("-", "/", $file);
                if (is_file($fname)) {
                    $data['text'] = ca_get_content_text($fname);
                    $data['file'] = $file;
                    $data['c'] = $c;
                    $data['text'] = ca_get_content_text($fname);
                    $data['action'] = $file;
                    /**
                     * add logs 
                     */
                    ca_userLogs("view file $file in Directory $c", 'Application Directory');
                    $this->load->view("dir_pop-up", $data);
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function change($file = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $fname = str_replace("-", "/", $file);
                if (is_file($fname)) {
                    $this->input->use_xss_clean = FALSE;
                    $content = $this->input->post("content", FALSE);
                    if (ca_write_content_text($fname, $content)) {
                        
                    }

                    /**
                     * add logs 
                     */
                    ca_userLogs("cahange file $fname", 'Application Directory');
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function upload() {
        if (isSuperAdmin()) {
            $file = $_FILES['userfile'];
            $new_path = ca_text_replace($file['name'], '-');
            $path = str_replace('-zip', '', $new_path);
            if (!is_dir('./assets/upload/' . $path)) {
                mkdir('./assets/upload/' . $path, 0777);
            }

            $parent = './assets/upload/' . $path . '/';
            @chmod($parent, 0777);
            $uploadfile = $parent . basename($file['name']);
            @chmod($uploadfile, 0777);
            if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                $zipfile = $uploadfile;
                if (unzip($zipfile, "./" . $parent)) {
                    if (is_dir($parent . 'query/')) {
                        $ca = ca_list_dir($parent . 'query/');
                        for ($j = 0; $j < count($ca); $j++) {
                            $sql_file = $ca[$j];
                            $FP = fopen($sql_file, 'r');
                            $READ = fread($FP, filesize($sql_file));
                            $READ = explode(";\n", $READ);
                            foreach ($READ AS $RED) {
                                $this->db->query($RED);
                            }
                        }
                    }
                    if (is_dir($parent . 'controllers/')) {
                        ca_recurse_copy($parent . 'controllers/', APPPATH . 'controllers/');
                    }
                    if (is_dir($parent . 'config/')) {
                        ca_recurse_copy($parent . 'config/', APPPATH . 'config/');
                    }
                    if (is_dir($parent . 'errors/')) {
                        ca_recurse_copy($parent . 'errors/', APPPATH . 'errors/');
                    }
                    if (is_dir($parent . 'widgets/')) {
                        ca_recurse_copy($parent . 'widgets/', APPPATH . 'widgets/');
                        if (is_dir($parent . 'widgets/config/')) {
                            ca_recurse_copy($parent . 'widgets/config/', APPPATH . 'widgets/config/');
                        }
                        if (is_dir($parent . 'widgets/mobile/')) {
                            ca_recurse_copy($parent . 'widgets/mobile/', APPPATH . 'widgets/mobile/');
                        }
                        if (is_dir($parent . 'widgets/mobile/mconfig')) {
                            ca_recurse_copy($parent . 'widgets/mobile/mconfig', APPPATH . 'widgets/mobile/mconfig');
                        }
                    }
                    if (is_dir($parent . 'helpers/')) {
                        ca_recurse_copy($parent . 'helpers/', APPPATH . 'helpers/');
                        ca_recursive_delete($parent . 'helpers/');
                    }
                    if (is_dir($parent . 'plugins/')) {
                        ca_recurse_copy($parent . 'plugins/', APPPATH . 'plugins/');
                        ca_recursive_delete($parent . 'plugins/');
                    }
                    if (is_dir($parent . 'third_party/')) {
                        ca_recurse_copy($parent . 'third_party/', APPPATH . 'third_party/');
                        ca_recursive_delete($parent . 'third_party');
                    }
                    if (is_dir($parent . 'libraries/')) {
                        ca_recurse_copy($parent . 'libraries/', APPPATH . 'libraries/');
                        ca_recursive_delete($parent . 'libraries/');
                    }
                    if (is_dir($parent . 'models/')) {
                        ca_recurse_copy($parent . 'models/', APPPATH . 'models/');
                        ca_recursive_delete($parent . 'models/');
                    }
                    if (is_dir($parent . 'language/')) {
                        ca_recurse_copy($parent . 'language/', APPPATH . 'language/');
                        ca_recursive_delete($parent . 'language/');
                    }
                    if (is_dir($parent . 'views/')) {
                        ca_recurse_copy($parent . 'views/', APPPATH . 'views/');
                        ca_recursive_delete($parent . 'views/');
                    }
                    ca_recursive_delete('./assets/upload/' . $path);
                }
            }
        } else {
            ca_error_auth('upload', 'apllication');
        }
    }

    function create_file($tempt = '', $m = '') {
        if ($tempt <> '') {
            if (isSuperadmin()) {
                $fname = str_replace('-', '/', $tempt);
                $data['temp'] = "$fname";
                $data['file'] = $tempt;
                $data['url'] = "dir";
                $data['m'] = $m;
                $ex = explode('-', $tempt);
                $data['ext'] = $ex[(count($ex) - 1)];
                switch ($data['ext']) {
                    case 'widgets':
                        $data['file_allowed'] = 'file allowed are .php with prefil _wi.php, Ex: abc_wi.php';
                        break;
                    case 'css':
                        $data['file_allowed'] = 'file allowed are .php|.css|.html|.js with prefil _wi.php, Ex: abc_wi.php';
                        break;
                    default:
                        $data['file_allowed'] = 'file allowed are .php|.html|.js, Ex: abc.php';
                        break;
                }
                ca_userLogs("view form create file $fname", 'Application Directory');
                $this->load->view("dir_create_file", $data);
            } else {
                ca_error_auth('create file ', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function do_create_file($tempt = '') {
        if ($tempt <> '') {
            if (isSuperadmin()) {
                $tempt = str_replace('-', '/', $tempt);
                $this->load->helpers("file");
                $file_name = $this->input->post("file_name");
                echo "$tempt/$file_name";
                write_file("$tempt/$file_name", "<!-- write script here -->");

                /**
                 * add logs 
                 */
                ca_userLogs("create file $file_name in Directory $tempt", 'Application Directory');
            } else {
                ca_error_auth('create file ', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function check_available_file($tempt = '') {
        if ($tempt <> '') {
            if (isSuperadmin()) {
                $tempt = str_replace('-', '/', $tempt);
                $this->load->helpers("file");
                $file_name = $this->input->post("file_name");
                if (is_file("$tempt/$file_name")) {
                    echo '0';
                } else {
                    echo '1';
                }
                /**
                 * add logs 
                 */
                ca_userLogs("check available file $file_name in Directory $tempt", 'Application Directory');
            } else {
                ca_error_auth('can not check available file ', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function tree() {
        $_POST['dir'] = urldecode($_POST['dir']);

        if (file_exists($_POST['dir'])) {
            $files = scandir($_POST['dir']);
            natcasesort($files);
            if (count($files) > 2) { /* The 2 accounts for . and .. */
                echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                // All dirs
                foreach ($files as $file) {
                    if (file_exists($_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($_POST['dir'] . $file)) {
                        echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
                        ?>
                        <li>
                            <a href="javascript:void(0)" class="file icon-pencil" style="padding-left: 15px" title="create new file in folder <?php echo $file; ?>" onclick="ca_lightbox('dir/create_file/<?php echo str_replace('/', '-', $_POST['dir'] . $file) ?>/')"><?php echo $file; ?></a>
                        </li>
                        <?php
                    }
                }
                // All files
                foreach ($files as $file) {
                    if (file_exists($_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($_POST['dir'] . $file)) {
                        $ext = preg_replace('/^.*\./', '', $file);
                        echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities(str_replace('/', '-', $_POST['dir'] . $file)) . "\">" . htmlentities($file) . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
    }

}
?>
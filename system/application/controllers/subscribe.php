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
 * subscribe Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/subscribe
 */
class subscribe extends Controller {

    var $limit = 5;

    public function __construct() {
        parent::__construct();
        $this->load->model("msubscribe");
    }

    function do_insert() {
        $this->load->helper('js');
        $email = $this->input->post("email"); 
        $query = array(
            "email" => $email
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run()) {
            $this->msubscribe->insert($query);
            ca_alert('Thanks for your email subscribe');
            ca_back();
        } else {
            ca_alert('Please insert valid email');
            ca_back();
        }
    }

    function do_delete() {
        $email = $this->input->post("email");
        $this->msubscribe->delete($email);
    }

}

?>
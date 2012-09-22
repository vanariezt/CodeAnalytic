<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lang_detect {

    var $obj;
    // make config item available locally
    var $lang_avail;
    // the user's language (directory name)
    var $lang_dir;

    /**
     * Constructor
     */
    function Lang_detect() {
        $this->obj = & get_instance();
        // load cookie helper if necessary
        // get list of supported languages
        $this->lang_avail = $this->obj->config->item('lang_avail');
        if (empty($this->lang_dir)) {
            // detect the user's language
            $this->lang_dir = $this->detectLanguage();
        }
        log_message('debug', "Lang_detect Class Initialized (using $this->lang_dir)");
    }

    /**
     * change the user's language.
     * The new language will be displayed at the next page.
     *
     * @param string $lang the language code, e.g. en
     * @return bool true if change was necessary.
     */
    function changeLang($lang = null) {
        log_message('debug', "Lang_detect.changeLang($lang)");
        if (empty($lang)) {
            return false;
        }

        // check whether we support the new language
        $language = $this->_checkLang($lang);
        if ($language === false) {
            log_message('error', "The selected language '$lang' is not supported, language change not possible!");
            return false;
        }
        // get currently selected language
        $_lang = $this->obj->config->item('lang_selected');
        if (($_lang === false) || ($_lang != $lang)) {
            log_message('debug', "Set language cookie");
            $this->obj->load->helper('cookie');
            // we have to change the language from the next request on
            set_cookie($this->obj->config->item('lang_cookie_name'), $lang, $this->obj->config->item('lang_expiration'), $this->obj->config->item('cookie_domain'), $this->obj->config->item('cookie_path'), $this->obj->config->item('cookie_prefix'));
            return true;
        }
        return false;
    }

    /**
     * determine user's language.
     * Use either the cookie's language code or determine the best
     * match of the browser's languages with the available languages.
     * If no match s found, the configured default language is taken.
     *
     * @return language directory name, e.g 'english'
     */
    function detectLanguage() {
        // if a language cookie available get its sanitized info
        $lang = $this->obj->input->cookie($this->obj->config->item('cookie_prefix') . $this->obj->config->item('lang_cookie_name'), true);
        $language = false;
        if ($lang !== false) {
            // check the cookie's language code
            $language = $this->_checkLang($lang);
        }
        if ($language === false) {
            // invalid or no cookie language code: check browser's languages
            $accept_langs = $this->obj->input->server('HTTP_ACCEPT_LANGUAGE');
            if ($accept_langs !== false) {
                //explode languages into array
                $accept_langs = strtolower($accept_langs);
                $accept_langs = explode(",", $accept_langs);
                //log_message('debug', "browser languages: ".print_r($accept_langs, true));
                // check all of them
                foreach ($accept_langs as $lang) {
                    //log_message('debug', "Check lang: $lang");
                    // remove all after ';'
                    $pos = strpos($lang, ';');
                    if ($pos !== false) {
                        $lang = substr($lang, 0, $pos);
                    }
                    // get CI language directory
                    $language = $this->_checkLang($lang);
                    // finish search if we support that language
                    if ($language !== false) {
                        break;
                    }
                }
            }
        }
        //log_message('debug', "Using language: $lang ($language)");
        if ($language === false) {
            // no base language available or no browser language match: use default
            $lang = $this->obj->config->item('lang_default');
            // of course the default language has to be supported!
            $language = $this->lang_avail[$lang];
        }
        // set the configuration for the CI_Language class
        $this->obj->config->set_item('language', $language);
        // store the language code too
        $this->obj->config->set_item('lang_selected', $lang);
        //log_message('debug', "Using language: $lang ($language)");
        return $language;
    }

    /**
     * determine language directory 
     *
     * @param string $lang language code, e.g. en_uk
     * @return string language directory or false if not found
     */
    function _checkLang(&$lang) {
        //log_message('debug', "checkLang trying '$lang'");
        if (!array_key_exists($lang, $this->lang_avail)) {
            if (strlen($lang) == 2) {
                // we had already the base language: not found so give up
                //log_message('debug', "checkLang '$lang' not found");
                return false;
            } else {
                // try base language
                $lang = substr($lang, 0, 2);
                //log_message('debug', "checkLang trying '$lang'");
                if (!array_key_exists($lang, $this->lang_avail)) {
                    // calculated base language also not found: give up
                    //log_message('debug', "checkLang '$lang' not found");
                    return false;
                }
            }
        }
        // get CI language directory
        //log_message('debug', "checkLang using '$lang'");
        return $this->lang_avail[$lang];
    }

}

?>
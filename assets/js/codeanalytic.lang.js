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
 * javascript library
 *
 * @package		CodeAnalytic
 * @subpackage          javascript/ js
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/javascript/lang
 * @location            ./assest/as/codeanalytic.lang.js
 */

/**
 * @notes
 * All javascript function in codeanalytic is prefix by ca_
 */

/**
 * @function ca_list_lang()
 * @return 
 * add new language list in your codeanalytic
 * @example
 *  switch(lan)
    {
        case 'en':
            document.getElementById('dlang').value='en';
            document.langForm.submit();
            break;
       case 'id':
           document.getElementById('dlang').value='id';
           document.langForm.submit();
           break;
        default:
            break;
        }
    }
 */
function ca_list_lang(lan){
    switch(lan)
    {
        case 'en':
            document.getElementById('dlang').value='en';
            document.langForm.submit();
            break;
        
        default:
            break;

    }
}

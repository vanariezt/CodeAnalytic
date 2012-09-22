<?php
if(!function_exists('ca_convert')){  
    function ca_convert($str, $ky = '') {
        if ($ky == '')
            return $str;
        $ky = base64_decode(md5(str_replace(chr(32), '', $ky)));
        if (strlen($ky) < 8)
            exit('key error');
        $kl = strlen($ky) < 32 ? strlen($ky) : 32;
        $k = array();
        for ($i = 0; $i < $kl; $i++) {
            $k[$i] = ord($ky{$i}) & 0x1F;
        }
        $j = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $e = ord($str{$i});
            $str{$i} = $e & 0xE0 ? chr($e ^ $k[$j]) : chr($e);
            $j++;
            $j = $j == $kl ? 0 : $j;
        }
        return $str;
    }   
}
if (!function_exists('ca_permitted')) {
    function ca_permitted() {
        // CA Version        
        $fname = "./system/codeanalytic/licenses.php";
        $fhandle = fopen($fname, 'r');
        $content = fread($fhandle, filesize($fname));
        $ext = explode("config['CA_KEY']", $content);
        $cc = explode('//--', $ext[1]);
        $ext_1 = str_replace("config['CA_PERMITTED'] ='", '_CA_', $cc['0']);
        $ar_rep = array('$config[', "='", "'; '", "';", "'");
        $kv = explode('$_CA_', str_replace($ar_rep, '', $ext_1));
        fwrite($fhandle, $content);
        fclose($fhandle);
        $str = trim($kv['1']);
        $key = trim($kv['0']);
        $en = ca_convert($str,$key);

        if (CA_ENGINE == $en) {
            return true;
        } else {
            return FALSE;
        }
    }

}
?>

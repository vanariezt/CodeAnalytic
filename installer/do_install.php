<?php
function recursiveChmod($path, $filePerm=0644, $dirPerm=0755)
   {
      // Check if the path exists
      if(!file_exists($path))
      {
         return(FALSE);
      }
      // See whether this is a file
      if(is_file($path))
      {
         // Chmod the file with our given filepermissions
         chmod($path, $filePerm);
      // If this is a directory...
      } elseif(is_dir($path)) {
         // Then get an array of the contents
         $foldersAndFiles = scandir($path);
         // Remove "." and ".." from the list
         $entries = array_slice($foldersAndFiles, 2);
         // Parse every result...
         foreach($entries as $entry)
         {
            // And call this function again recursively, with the same permissions
            recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
         }
         // When we are done with the contents of the directory, we chmod the directory itself
         chmod($path, $dirPerm);
      }
      // Everything seemed to work out well, return TRUE
      return(TRUE);
   }

$message = "";
if (!preg_match("/^[a-zA-Z0-9_*.]{3,32}$/", $_POST['db_name'])) {
    $message.= "DB NAME is required. Empty value is not allowed | min[3] max[32] | character[a-zA-Z0-9_*.]";
} else if (!preg_match("/^[a-zA-Z0-9_*.]{4,32}$/", $_POST['db_user'])) {
    $message.= "DB USER is required. Empty value is not allowed min[4] max[32] | character[a-zA-Z0-9_*.]";
} else if (!preg_match("/^[a-zA-Z0-9_]{6,12}$/", $_POST['username'])) {
    $message.= "Username of your Admin Panel is required min[6] max[12] | character[a-zA-Z0-9_]";
} else if (!preg_match("/^[a-zA-Z0-9_!@#$%^&*]{6,32}$/", $_POST['password'])) {
    $message.= "Password of your Admin Panel is required min 6 character | [a-zA-Z0-9_!@#$%^&*]";
} else if ($_POST['password'] <> $_POST['pass_confirm']) {
    $message.= "Password confirm is not match";
} else {
    $dir = DIRNAME($_SERVER['PHP_SELF']);
    $x = explode('/', $dir);
    $path_relative = '/' . $x[count($x) - 2] . '/';
    recursiveChmod($dir, 0777, 0777);
    $db_name = $_POST['db_name'];
    $db_pass = $_POST['db_password'];
    $db_user = $_POST['db_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $db_host = '';

    $db = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    if ($db == TRUE) {
        $fdb = './database.php';
        $content = file_get_contents($fdb);
        $content = str_replace('db_name', $db_name, $content);
        $content = str_replace('db_pass', $db_pass, $content);
        $content = str_replace('db_user', $db_user, $content);
        file_put_contents($fdb, $content);
        copy('./database.php', '../system/application/config/database.php');


        $fcon = './config.php';
        $content = file_get_contents($fcon);
        $content = str_replace('your_path_url', $path_relative, $content);
        file_put_contents($fcon, $content);
        copy('./config.php', '../system/application/config/config.php');

        $fcon = '../.htaccess';
        $content = file_get_contents($fcon);
        $content = str_replace('RewriteBase /', 'RewriteBase ' . $path_relative, $content);
        file_put_contents($fcon, $content);

        $sql_file = "./db.sql";
        $FP = fopen($sql_file, 'r');
        $READ = fread($FP, filesize($sql_file));

        $READ = explode(";\n", $READ);

        foreach ($READ AS $RED) {
            mysql_query($RED);
        }
        $id = time();
        mysql_query("insert into ca_users (user_id,priv_id,username,password) values ('$id','1','$username','$password')");
        mysql_query("update ca_posts set user_id = '$id'");
        mysql_query("update ca_pages set user_id = '$id'");
        mysql_query("update ca_gallery set user_id = '$id'");
        $message.="Your instalation is success. Please remove folder installer and visit your domain instalation in
        <a href='../' target='_blank'>$path_relative</a>
        Your username and password is <b>$username</b> and <b>$_POST[password]</b>. Then please config your application in
        <a href='../calogin' target='_blank'>calogin</a>";
    } else {
        $message.="Your configuration database is wrong. Please contact your administration or visit http://codeanalytic.com/doc-installation-codeanalytic";
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CodeAnalytic CMS ver 0.2.1 - Instalation prosess</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="wrapper">
            <div class="wrapp">
                <div class="header">
                    <p> CodeAnalytic CMS ver 0.2 - Instalation prosess </p>
                </div>
                <div class="shadow"></div>
                <div class="wrapp">
                    <div class="about">
                        <?php echo $message; ?>
                    </div>
                </div>
                <div class="footer">
                    <center>Copyright &copy; 2012 <a href="http://codeanalytic.com" target="_blank">CodeanAlytic CMS</a> (CMS Base Ajax And Codeigniter).
                        All Rights Reserved.<br/>
                        CodeanAlytic cms is Free Software released under the GNU/GPL License.-</center>

                </div>
            </div>
        </div>
    </body>
</html>
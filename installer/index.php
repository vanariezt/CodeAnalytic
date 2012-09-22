<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CodeAnalytic CMS ver 0.2.1 - Instalation process</title>
        <link type="text/css" rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div id="wrapper">
            <div class="wrapp">
                <div class="header">
                    <p> CodeAnalytic CMS ver 0.2.1 - Instalation process </p>
                </div>
                <div class="shadow"></div>
                <div class="about">
                    Welcome to CodeAnalytic CMS ver 0.2.1 - Instalation process. Please insert required data for instalation.
                    Be sure before you install. For more information visit  <a href="http://codeanalytic.com/doc-installing-codeanalytic" target="_blank"> http://CodeAnalytic.com/installation </a>
                </div>
                <form action="./do_install.php" method="post">
                    <div class="split">&nbsp;<a href="#step1">1</a></div>
                    <p id="step1">
                        <label>
                            DB Name<br/><i>Name of your database. Please create your database before instalation.</i>
                        </label>
                        <input type="text" class="field" name="db_name">
                    </p>
                    <p>
                        <label>
                            DB User<br/><i>User of database</i>
                        </label>
                        <input type="text" class="field" name="db_user">
                        
                    </p>
                    <p>
                        <label>
                            DB Password<br/><i>DB Password of user</i>
                        </label>
                        <input type="password" class="field" name="db_password">
                        
                    </p>
                    <div class="split">&nbsp;<a href="#step2">2</a></div>
                    <p id="step2">
                        <label>
                            Username <br/><i>Username of your Admin Panel</i>
                        </label>
                        <input type="text" class="field" name="username">                        
                    </p>
                    <p>
                        <label>
                            Password <br/><i>Password of your Admin Panel</i>
                        </label>
                        <input type="password" class="field" name="password">  
                    </p>
                    <p>
                        <label>
                            Confirm Password<br/><i>Confirm Password of your Admin Panel</i>
                        </label> 
                        <input type="password" class="field" name="pass_confirm">
                        
                    </p>
                    <div class="split">&nbsp;<a href="#step3">3</a></div>
                    <p id="step3">
                        <label>Install<br/><i>complete installation process</i></label>
                        <input type="submit" class="button" value="Install">
                    </p>

                </form>
                <div class="footer"> 

                    <center>Copyright &copy; 2012 <a href="http://codeanalytic.com" target="_blank">CodeAnalytic CMS</a> (CMS Base Ajax And Codeigniter).
                        All Rights Reserved.<br/>
                        CodeAnalytic cms is Free Software released under the GNU/GPL License.-</center>

                </div>
            </div>
        </div>
    </body>
</html>

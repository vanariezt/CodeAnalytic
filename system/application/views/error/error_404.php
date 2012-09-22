<html>
    <head>
        <title>CodeAnalytic - <?php echo isset($title) ? $title : '404 Page Not Found' ?></title>
        <style type="text/css">
            body{
                width: auto;
                margin: auto;
                background: #CCC;
            }
            #wrap_front{
                width: 100%;
                height: 320px;
                margin: auto;
                background-image: -moz-linear-gradient(top, #f9f9f9 , #BBB);
                background-image: -webkit-gradient(linear, center top, center bottom, from(#f9f9f9), to(#BBB));
                background-image: -o-linear-gradient(top, #f9f9f9 , #BBB);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#bbbbbb');
                -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#bbbbbb')";
                background-image: linear-gradient(top, #f9f9f9 , #f9f9f9);
                -moz-box-shadow: 0px 15px 50px #a0a0a0;
                -webkit-box-shadow: 0px 15px 50px #A0A0A0;
                box-shadow: 0px 15px 50px #A0A0A0;
                filter: progid:DXImageTransform.Microsoft.Shadow(strength=15, direction=180, color='#a0a0a0');
                -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(strength=15, Direction=180, Color='#a0a0a0')";
            }
            #content{
                margin: 10px auto;
                width:800px;
                
            }
            .top{
                margin-top: 10px;
                text-align: center;
                font-family: 'sans-serif';
                font-weight: 600;
                font-size: 36px;
                text-transform: capitalize;
                color: #333;
                float:left;
                width:100%;
            }
            .images{
                background: url("./assets/themes/panel/images/404.png") no-repeat;
                float: left;
                width: 500px;
                top:80px;
                left :18%;
                height: 220px;
                position: absolute;
            }
            .center{
                text-align: center;
                font-family: 'sans-serif';
                font-size: 20px;
                color: #333;
                margin-bottom: 40px;
                width:100%;
                padding: 5px;
            }
            .bottom{
                float:left;
                width:100%;
            }

            .bottom a{
                padding: 7px 15px;
                margin-left: 10px;
                border-radius: 3px;
                background-color: #e77817;
                background-image: linear-gradient(bottom, #ff6e12 6%, #e77817 53%);
                background-image: -o-linear-gradient(bottom, #ff6e12  6%, #e77817 53%);
                background-image: -moz-linear-gradient(bottom, #ff6e12  6%, #e77817 53%);
                background-image: -webkit-linear-gradient(bottom, #ff6e12  6%, #e77817 53%);
                background-image: -ms-linear-gradient(bottom,#ff6e12  6%, #e77817 53%); 
                border: 1px solid #e77817;
                box-shadow: #ff6e12 ;
                color: #F9F9F9;
                text-decoration: none;
                border-radius: 3px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                -o-border-radius: 3px;
                font-weight: bold;
            }
            .bottom a:hover {
                color: #fff;
                text-decoration: none;
                border: 1px solid #EBEBEB;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                -o-border-radius: 3px;
                font-weight: bold;
            }
            .search{
                float: right;
                position: relative;
                top:-10px;               
            }

            .form-type-textfield {
                background: url(./assets/themes/panel/images/bg_search.png) no-repeat 0 -30px;
                float: left;
                padding-left: 15px;
            }
            .form-text{
                background: url(./assets/themes/panel/images/bg_search.png) repeat-x 0 0;
                border: 0 none;
                color: #333;
                height: 30px;
                line-height: 30px;
                width: 174px;
                padding: 0;
                outline: none;
            }
            .form-actions {
                float: left;
                background: url(./assets/themes/panel/images/bg_search.png) no-repeat 100% -60px;
            }

            .form-submit {
                background: url(./assets/themes/panel/images/bg_search.png) no-repeat 0 -90px;
                border: 0 none;
                cursor: pointer;
                display: block;
                height: 30px;
                width: 27px;
                padding: 0;
                overflow: hidden;
                text-indent: -99999px;
            }
        </style>
    </head>
    <body>
        <div id="wrap_front">
            <div class="images"></div>
        </div>
        <div id="content">
            <div class="top"><?php echo $heading; ?></div>
            <div class="center"><?php echo $message; ?>
            </div>
            <div class="bottom">
      <a href="./home">Back to Home</a>
                <div class="search">
                    <form method="post" action="./posts/search">
                        <div class="form-type-textfield">
                            <input type="text" name="s_content" class="form-text" maxlength="128" size="25" value="Search" onblur="if(this.value=='') this.value='Search'" onfocus="if(this.value =='Search' ) this.value=''">
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="form-submit" value="" >
                        </div>     
                    </form>
                </div> 
            </div>
        </div>
    </body>
</html>
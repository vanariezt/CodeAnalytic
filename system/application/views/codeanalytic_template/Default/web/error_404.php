<html>
    <head>
        <title>CodeAnalytic - <?php echo isset($title) ? $title : '404 Page Not Found' ?></title>
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
      <a href="<?php echo base_url();?>">Back to Home</a>
                <div class="search">
                    <form method="post" action="<?php echo base_url();?>posts/search">
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
<?php
if (isUser()) {
            ?>
            <div class="information">
                <?php
                echo ca_translate("are you sure, want to delete table row was selected ?. <br/> choose one yes or no");
                ?>
            </div>
            <div class='footer'>
                <a class="button-red" onclick="ca_file_remove('<?php echo $page ?>','add_ons');"><?php echo ca_translate("yes"); ?></a>
                &nbsp;
                <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate("no"); ?></a>
            </div>
            <?php
        }
?>
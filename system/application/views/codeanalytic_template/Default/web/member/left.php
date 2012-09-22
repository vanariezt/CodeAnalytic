<ul>
    <div class="mem_photo mem" style="text-align: center">        
     <center>
            <img class="img_user" src="<?php echo base_url() . "assets/images/member/" . str_replace('small', 'middle', $m->photo) ?>" align="center"  href="javascript:void(0)">
        </center>
    </div>     
    <li>   <a href="javascript:void(0)" id="upload" class="btn_edit_image_member">Change Photo</a> </li>
    <li>
        <a href="javascript:void(0)" onclick="load('member/general','#mem_right')" class="mem_general">general</a>
    </li> 
    <li>
        <a href="javascript:void(0)" onclick="lightbox('member/change_password')" >password</a>
    </li> 
</ul>

<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload"), {
            action: site+'member/upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|gif)$/.test(ext))){
                    ca_notive('Only jpg|png|gif files are allowed');
                    return false;
                }  
                loading();
            },
            onComplete: function(file,res){ 
                /**
                 * using js funtion split, cause in any part of my time, I found bugs string in some case
                 * <div id="mediaScreenId"></div>
                 * so I try to split and get the right value
                 */
                x=res.split('<div');
                response=x['0'];    
                if(response!="error"){   
                    close_box();
                    $.ajax({ 
                        url:site+"member/image_thumb_small/"+response,
                        success: function(rs){
                            $("img.img_user").attr("src",'<?php echo base_url() ?>assets/images/member/'+response);
                        }
                        ,error : function(x,h,r){
                            alert(r.status);
                        }
                    }) 
                } else{
                    alert(response);
                }
            }
        });
    })
</script>

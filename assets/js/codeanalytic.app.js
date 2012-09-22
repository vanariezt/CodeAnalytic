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
 * @link		http://docs.codeanalytic.com/javascript/
 * @location            ./assest/as/codeanalytic.app.js
 */

/**
 * @notes
 * All javascript function in codeanalytic is prefix by ca_
 */

/**
 * @function ajaxSetup()
 * @example $.ajaxSetup({
 *    cache: flase,
 *    url: site,
 *    method: post
 * })
 * @return
 * set up all ajax return proccess where cache is false  
 * @author
 * - nugroho rahmat h.w (hadinug)
 */


$.ajaxSetup({
    cache:false
})
 
 
/**
 * play animation with css
 */
$(document).ready(function() {  
    $('.animated').hover(
        function() {
            var anim = $(this).attr('ca-animation-name'); 
            $(this).addClass(anim);
        },
        function() {
            var anim = $(this).attr('ca-animation-name');                                    
            $(this).removeClass(anim);
        }
        );
});
 
/**
 * @function ca_split()
 * @return 
 * return lenght of split in capanel
 * @author
 * nugroho rahmat h.w (hadinug)
 */
 
function ca_split(){
    /** load notes function click 
     * it's seem like lightbox 
     */
    
    // return height of element center left and center right
    var cen_left=$("#cen_left").height();
    var cen_right=$("#cen_right").height();
    // give condition
    if(cen_left > cen_right){
        $(".cen_split").css({
            height:cen_left+40
        }) 
    }else{
        $(".cen_split").css({
            height:cen_right+40
        }) 
    }
    // using hash javascript window
    window.location.href=site+'capanel#main';
    $(".notes").click(function(){
        $(this).remove();
    })
}
 
/**
 * @function ca_tabs
 * @return
 * selected a class and element 
 * this is simple tabs in codeanalytic
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_tabs(t,cls){
    $(".tabs_bar a").removeClass("selected");
    $("#tabs_bar p, #tabs_bar p.box, div.box").hide();
    $(t).addClass("selected");
    $("#tabs_bar p"+cls+", #tabs_bar div"+cls).slideDown("slow")
}

/**
 * @function ca_append_image()
 * @return 
 * append an image in current element
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_append_image(i){ 
    $('input.thumb').val(i.alt);
    $('div.img_thumb img').attr("src",i.src);
    ca_close_box()
}

/**
 * @function ca_remove_widget()
 * @return 
 * remove current widget witch selected
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_remove_widget(i,page){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        data : $("form").serialize(),
        success: function(response){
            ca_close_box(); 
            if(i=='1'||i=='2'||i=='3'||i=='4'||i=='5'){
                ca_load('widget/widget_list','ul.widget_list');
            }else{
                ca_load('widget/widget_list/1','ul.widget_list');
            }            
            ca_load('widget/get_current/'+i,"div.pos_"+i+" ul");
        },
        dataType:"html"
    });
    return false;
}

/**
 * @function ca_show_child()
 * @return 
 * show or hide the attribute selected
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_show_child(cls){
    stat=$(cls).css("display");
    switch(stat){
        case 'none':
            $(cls).show();
            break;
        default:
            $(cls).hide();
            break;
    } 
    ca_split();
}

/**
 * @function ca_action_publish_template()
 * @return
 * publish template in capanel
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_action_publish_template(page,i){
    $.ajax({
        type:"GET",
        beforeSend: function(){
            ca_loading();
        }, 
        url: site+page,
        success: function(response){ 
            ca_load('template', '#cen_right');
        }
    });
    return false;
}


/**
 * @function ca_light_delete()
 * @return
 * view lightbox delete in media in category image
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_light_delete(i){
    src=$(i).parent().find($("img")).attr('src'); 
    $.ajax({
        type:"POST",
        url: site+"media/delete",         
        data: "src="+src,
        success: function(response){
            $(".light_box").remove();
            $("body").append(
                "<div class=\"light_box\">"+
                "<div class='light_content'></div>"+
                "</div>"
                )
            $(".light_content").append(response)
            var l=$("body").width();
            var left=((l-$(".light_box").width())/2);
            var h=$(window).height();
            var height=((h-$(".light_box").height())/2);
            $(".light_box").css({
                left: left,
                top: height,
                "z-index":10
            })
            $('.loading').html('');
            $("#wrapper").css({
                opacity:0.1
            })
            ca_split();
        },
        error: function(xhr){
            alert(xhr)
        }
    });
    return false;
}

/**
 * @function ca_file_delete()
 * @return
 * view lightboc delete in media category file
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_file_delete(i){
    src=$(i).parent().find($("span")).attr('dir'); 
    $.ajax({
        type:"POST",
        url: site+"media/file_delete",         
        data: "src="+src,
        success: function(response){
            $(".light_box").remove();
            $("body").append(
                "<div class=\"light_box\">"+
                "<div class='light_content'></div>"+
                "</div>"
                )
            $(".light_content").append(response)
            var l=$("body").width();
            var left=((l-$(".light_box").width())/2);
            var h=$(window).height();
            var height=((h-$(".light_box").height())/2);
            $(".light_box").css({
                left: left,
                top: height,
                "z-index":10
            })
            $('.loading').html('');
            $("#wrapper").css({
                opacity:0.1
            })
            ca_split();
        },
        error: function(xhr){
            alert(xhr)
        }
    });
    return false;
}


/**
 * @function ca_this_delete()
 * @return 
 * remove image in media
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_this_delete(src){ 
    $.ajax({
        type:"POST",
        url: site+"media/do_delete",         
        data: "src="+src,
        success: function(response){
            if(response=='file selected is success for deleted'){
                $("img[src='"+src+"']").parent().parent().hide();  
            }
            ca_close_box(); 
            ca_notive(response)
            ca_split();
        },
        error: function(xhr){
            alert(xhr)
        }
    });
    return false;
}

/**
 * @function ca_this_file_delete()
 * @return 
 * remove file in media
 * @author
 * nugroho rahmat h.w (hadinug)
 */
function ca_this_file_delete(dir){ 
    $.ajax({
        type:"POST",
        url: site+"media/do_delete",         
        data: "src="+dir,
        success: function(response){
            $("span[dir='"+src+"']").parent().hide();  
            ca_close_box(); 
            ca_split();
        },
        error: function(xhr){
            alert(xhr)
        }
    });
    return false;
}

/**
 * @function ca_media()
 * @return 
 * view popup tinyMCE filebrowser
 * @author
 * nugroho rahmat h.w (hadinug)
 */

function ca_media (field_name, url, type, win) {
    var cmsURL = site+'media/place';
    if (cmsURL.indexOf("?") < 0) {
        cmsURL = cmsURL + "?type=" + type;
    }else {
        cmsURL = cmsURL + "&type=" + type;
    }
    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'CodeAnalytic tinyMCE Browser',
        width : 650,  // Your dimensions may differ - toy around with them!
        height : 400,
        resizable : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "no"
    }, {
        window : win,
        input : field_name
    });
    return false;
}

/**
 * @function ca_slide_account()
 * @return 
 * slide account
 * @author
 * Yasser Yazid M
 */
function ca_slide_account(i){
    var std =$(i).attr("class");
    switch(std){
        case 'show':
            $("#det_acount").css({
                'display': 'block'
            }).show("slow");
            $(i).removeClass("show").addClass("hide");
            $("span#ico-a").html("&Delta;");
            break;
        default:
            $("#det_acount").css({
                'display': 'none'
            }).hide("slow");
            $(i).removeClass("hide").addClass("show");
            $("span#ico-a").html("&nabla;");
            break;
    } 
}


/**
 * @function ca_slide_()
 * @return 
 * show hide slide in object
 * @author
 * Yasser Yazid M
 */
function ca_slide_(i,d){
    var std=$(i).attr("class");
    switch(std){
        case 'show':
            $(d).fadeIn('slow');
            $(i).removeClass("show").addClass("hide").css({
                'background':"url('"+site+"assets/themes/panel/images/small/asc.png') right no-repeat"
            })
            break;
        default:
            $(d).fadeOut('slow');
            $(i).removeClass("hide").addClass("show").css({
                'background':"url('"+site+"assets/themes/panel/images/small/desc.png') right no-repeat"
            })
            break;
    } 
}

/**
 * @function ca_slide()
 * @return 
 * show hide slide in object
 * @author
 * Yasser Yazid M
 */
function ca_check_all(v){
    var std=$(v).attr("id");
    switch(std){
        case '1':
            $("input.check[type='checkbox']").attr('checked',1);
            $("input[checked='checked']").parent().parent().css({
                "background":"#f1f9c2"
            })
            $(v).attr("id",'0') 
            break;
        default:
            $("input.check[type='checkbox']").attr('checked',0).removeAttr('checked');
            $("input.check").parent().parent().css({
                "background":"#ffffff"
            })
            $(v).attr("id",'1') 
            break;
    } 
}


/**
 * @function ca_get_selected(), ca_selected(), ca_selected_chart
 * @return 
 * menu management in left CA Panel
 * @author
 * Yasser Yazid M
 */

function ca_get_selected(i){ 
    $("ul#master_menu li a").removeClass("selected");
    $(i).addClass("selected");
    $("ul#master_menu li ul").hide();
    $(i).next($("ul")).slideDown("slow");
}
function ca_selected(i){ 
    $("ul#master_menu li ul li a").removeClass("selected");
    $(i).addClass("selected");
} 
function ca_selected_chart(i){
    $("div.tabs a").removeClass("selected");
    $(i).addClass("selected");
    $("div#cen_find").html("");
}


/**
 * @function ca_action_publish
 * @return 
 * publish and unpublish rows table selected
 * @author
 * Yasser Yazid M
 */

function ca_action_publish(page,i){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        success: function(response){ 
            $(i).replaceWith(response);
            ca_close_box();
        },
        error:function(xhr){
            alert(xhr)
        }
    });
    return false;
}

/**
 * @function ca__close_find()
 * @return 
 * close form seach in ca_panel
 * @author
 * Yasser Yazid M
 */
function ca_close_find(){
    $("#cen_find").html("");
}

/**
 * @function ca_find_action()
 * @return 
 * find content table
 * @author
 * Yasser Yazid M
 */
function ca_find_action(page,i){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        data: $("#cen_find form").serialize(),
        success: function(response){
            $(i).html(response); 
            $(".dinamic_tap span").html("result search");
            $("#search_content #right #s_info").html($("#cen_find form").serialize());
            $("#center_content #top_title").remove();
            $("#center_content #bar_button").remove();
            $("#center_content #top_tap").remove();            
            ca_close_box();  
            ca_split();
        },
        error:function(xhr){
            alert(xhr)
        }
    });
}

/**
 * @function ca_find_comments()
 * @return 
 * find comments
 * @author
 * Yasser Yazid M
 */
function ca_find_comments(page,i){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        data: $("#com_find form").serialize(),
        success: function(response){
            $(i).html(response); 
            $(".dinamic_tap span").html("result search");
            $("#search_content #right #s_info").html($("#com_find form").serialize());
            $("#center_content #top_title").remove();
            $("#center_content #bar_button").remove();
            $("#center_content #top_tap").remove();            
            ca_close_box();  
            ca_split();
        },
        error:function(xhr){
            alert(xhr)
        }
    });
}



/**
 * @function ca_show_list()
 * @return 
 * show number of table list or table rows
 * @author
 * Yasser Yazid M
 */
function ca_show_list(div){
    $("#show_max").change(function(){ 
        var xdata=$("form#s_order").serialize();
        switch (div){
            case 'gallery':
                div = 'gallery/data';
                break;
            default :
                break;
        }  
        val=$(this).val(); 
        page=site+'settings/page_view/'+val
        $.ajax({
            type:"POST",
            url: page, 
            beforeSend: function(){
                ca_loading();
            },
            success: function(response){ 
                $.ajax({
                    type:"POST",
                    url: site+div,
                    data: xdata,
                    beforeSend: function(){
                        ca_loading();
                    },
                    success: function(response){  
                        ca_close_box();
                        if($("#cen_find").html()==''){
                            $("#cen_right").html(response)
                        }else{
                            $("#center_content").html(response);
                            $("#center_content #top_title").remove();
                            $("#center_content #bar_button").remove();
                            $("#center_content #top_tap").remove(); 
                        }
                        switch (div){
                            case 'template':
                                $("#cen_right").html(response)
                                break;
                            default :
                                break;
                        } 
                        ca_split(); 
                    }
                })
            },
            dataType:"html"
        });
    })

}



/**
 * @function ca_load_pagging()
 * @return 
 * load_pagging
 * @author
 * Yasser Yazid M
 */
function ca_load_pagging(page,div){ 
    $.ajax({
        type:"post",
        beforeSend: function(){
            ca_loading();  
        },
        url: page,    
        data: $("form#s_order").serialize(),
        success: function(response){
            ca_close_box();            
            if($("#cen_find").html()==''){
                $(div).html(response);
            }else{
                $("#center_content").html(response);
                $("#center_content #top_title").remove();
                $("#center_content #bar_button").remove();
                $("#center_content #top_tap").remove(); 
            }
            var ui=page.split('/'); 
            if(ui['2']=='template'){
                $(div).html(response);                
            }
            ca_split();
        },
        error: function(xhr){
            alert(xhr)
        }
    });
    return false;
}




/**
 * @function ca_load()
 * @return 
 * load content of page
 * @author
 * Yasser Yazid M
 */
function ca_load(page,div,c){   
    $.ajax({
        url: site+page,
        beforeSend: function(){
            $(div).removeClass(ca_animate_);
            switch(c){
                case 'n':
                    break;
                default:
                    ca_loading();
                    break;
            }           
        },
        success: function(response){  
            switch(c){
                case 'n':
                    break;
                default:
                    ca_close_box();
                    break;
            }    
            $(div).addClass(ca_animate_).html(response).addClass('animated'); 
            ca_split();   
        }
    });
    return false;
}


/**
 * @function ca_notive()
 * @return 
 * show notification of codeanalytic
 * @author
 * Yasser Yazid M
 */
function ca_notive(txt,type){
    if(type=='tiny'){
        $("div#notive").html("<div id='c_notive'>"+txt+"</div>").css({
            "background": "#666",
            "border": "1px solid #555",
            "padding":"2px",
            "margin-left":($('body').width()-$('div#notive').width())/2
        }).click(function(){
            $(this).html("").css({
                "background": "FFF",
                "border": "none",
                "padding":"0px"
            })
        }).fadeIn("slow");    
    }else{
        $("div#notive").html("<div id='c_notive'>"+txt+"</div>").css({
            "background": "#666",
            "border": "1px solid #555",
            "padding":"2px",
            "margin-left":(($('body').width()-$('div#notive').width())/1.7)
        }).click(function(){
            $(this).html("").css({
                "background": "FFF",
                "border": "none",
                "padding":"0px"
            })
        }).fadeIn("slow");    
    }

}

 
/**
 * @function ca_edit_action()
 * @return 
 * edit database
 * @author
 * Yasser Yazid M
 */
function ca_edit_action(page,i){
    var myForm = $(i).parent().parent(); 
    myForm.validation();
    if(!myForm.validate()) {
        
    }else{
        data = myForm.serialize()
        $.ajax({
            type:"POST",
            beforeSend: function(){
                ca_loading();
            },
            url: site+page,
            data : data,
            success: function(response){ 
                ca_close_box();
                ca_notive("thanks to update data...")
                var ui=page.split('/');
                if(ui['0']=='dir' || ui['0']=='css' || ui['0']=='widget' || ui['0']=='htmlarea' || ui['0']=='languages'){    
                    
                }else{
                    if(ui['0']=='forum' || ui['0']=='gallery'){
                        ca_load(ui['0']+"/data","#cen_right")
                        $("#cen_right form input, #cen_right form select, #cen_right form textarea").val('');
                    }else{
                        ca_load(ui['0'],"#cen_right")
                        $("#cen_right form input, #cen_right form select, #cen_right form textarea").val('');
                    
                    }
                }
            }
        });
    }
    return false;
}

/**
 * @function ca_edit_user()
 * @return 
 * edit data user
 * @author
 * Yasser Yazid M
 */
function ca_edit_user(page){
    var myForm = $(".light_content form");
    myForm.validation();
    if(!myForm.validate()) {
        
    }else{
        data = $(".light_content form").serialize()
        $.ajax({
            type:"POST",
            beforeSend: function(){
                ca_loading();
            },
            url: site+page,
            data : data,
            success: function(response){
                ca_close_box();
                ca_notive("thanks to update your account")
            
            }
        });
    }
    return false;
}

/**
 * @function ca_add_action()
 * @return 
 * insert data to table
 * @author
 * Yasser Yazid M
 */
function ca_add_action(page,i){
    var myForm = $(i).parent().parent();  
    myForm.validation();
    if(!myForm.validate()) { 
    }else{ 
        data = myForm.serialize() 
        $.ajax({
            type:"POST",
            beforeSend: function(){
                ca_loading();
            },
            url : site+page,
            data : data,
            success : function(response){ 
                ca_close_box();
                ca_notive("thanks to submit data...")
                $("#cen_right form input, #cen_right form select, #cen_right form textarea").val('');
                var ui=page.split('/');
                if(myForm.parent().attr('class')=='light_content'){
                    if(ui['0']=='album'){
                        ca_load("gallery/data","#cen_right")
                    }
                    if(ui['0']=='album'){
                        ca_load("gallery/data","#cen_right")
                    }
                    if(ui['0']=='htmlarea'){
                        ca_load('widget/get_current/'+ui['2'],"div.pos_"+ui['2']+" ul"); 
                    }
                }else{
                    if(ui['0']=='forum' || ui['0']=='gallery'){
                        ca_load(ui['0']+"/data","#cen_right")
                    } 
                    else{
                        if(ui['0']=='dir' || ui['0']=='css' || ui['0']=='widgets' || ui['0']=='languages'){    
                        // do nothing
                        }else{
                            ca_load(ui['0'],"#cen_right")
                        }
                    }     
                }
            },
            error: function(xhr,x,c){
                alert(c)
            }
        })
    }
    return false;
}


/**
 * @function ca_edit_view()
 * @return 
 * show pop up edit
 * @author
 * Yasser Yazid M
 */
function ca_edit_view(page,div){ 
    field = document.getElementsByTagName("input");   
    if($("table#table_list td input:checked").length==0 || $("table#table_list td input:checked").length > 1){ 
        ca_notive('Please Check One');
    }else{
        for (i = 0; i < field.length; i++){
            if(field[i].checked == true){ 
                $.ajax({
                    type:"POST",
                    beforeSend: function(){
                        ca_loading();
                    },
                    url: site+page+"/",
                    data : $("#cen_right form").serialize(),
                    success: function(response){
                        ca_close_box();
                        $(div).html(response) 
                        ca_split()
                    }
                });
            }else{           
                
            }
        }
    }
    return false;
}

/**
 * @function ca_delete_view()
 * @return 
 * show pop up delete
 * @author
 * Yasser Yazid M
 */
function ca_delete_view(page){ 
    field = document.getElementsByTagName("input");   
    if($("table#table_list td input:checked, div.option_template input:checked").length==0){
        ca_notive('Please Check One');
    }else{
        ca_lightbox(page);
    }
    return false;
}


/**
 * @function ca_loading()
 * @return 
 * show loading animation in codeanalytic
 * @author
 * Yasser Yazid M
 */
function ca_loading(type){
    var t=$(window).height();
    var tt= $(".light_box").height();
    var top=((t-tt)/2);
    var l=$("#cen_right").width();
    var left=((l-350)/1.2);
    if(type=='tiny'){
        cmd= "<div class='light_box' style='padding:0px; background: transparent;  z-index:1000; margin-left:400px;' id='page_loading'>"+
        "<div class='light_content' style='background: transparent;' align='center'>"+loadImg+"</div>"+
        "</div>"; 
    }else{
        cmd= "<div class='light_box' style='padding:0px; background: transparent;  z-index:1000; margin-left:-45px;' id='page_loading'>"+
        "<div class='light_content' style='background: transparent;' align='center'>"+loadImg+"</div>"+
        "</div>";
    }
    $("#cen_right").css({ 
        opacity:0.1
    })
    $("body").append(cmd)
    $(".light_box").css({
        left: left,
        top: top 
    })
}


/**
 * @function ca_close_bo)
 * @return 
 * close all popup window
 * @author
 * Yasser Yazid M
 */
function ca_close_box(){
    $("div.light_box").remove();
    $("#cen_right,#wrapper").css({  
        opacity:1
    }) 
    $("div#notive").html("").css({
        "background": "FFF",
        "border": "none",
        "padding":"0px"
    })
}


/**
 * @function ca_lightbox()
 * @return 
 * open popup lightbox codeanalytic
 * @author
 * Yasser Yazid M
 */
function ca_lightbox(page){
    $.ajax({
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        success: function(response){
            $(".light_box").remove();
            $("body").append(
                "<div class=\"light_box\">"+
                "<div class='light_content'></div>"+
                "</div>"
                )
            $(".light_content").append(response)
            var l=$("body").width();
            var left=((l-$(".light_box").width())/2);
            var h=$(window).height();
            var height=((h-$(".light_box").height())/3);
            $(".light_box").css({
                left: left,
                top: height,
                "z-index":10
            })
            $('.loading').html('');
            $("#wrapper").css({
                opacity:0.1
            })
        },
        error: function(xhr){
            alert(xhr)
        },
        dataType:"html"
    });
    
    return false;
}


/**
 * @function ca_template_setting()
 * @return 
 * edit template
 * @author
 * Yasser Yazid M
 */
function ca_template_setting(page){
    $.ajax({
        cache:false,
        beforeSend: function(){
            ca_loading();
        },
        url: site+page,
        success: function(response){
            ca_close_box();
            $('div#template_setting').html(response).css({
                "background": "white",
                "border": "1px solid #EBEBEB"
            }).fadeIn("slow");
        },
        error: function(xhr){
            alert(xhr)
        },
        dataType:"html"
    });
    
    return false;
}
function ca_close_setting(){
    ca_load('template/index/', '#cen_right');
}


/**
 * @function ca_show_child()
 * @return 
 * show child
 * @author
 * Yasser Yazid M
 */
function ca_show_child(cls){
    stat=$(cls).css("display");
    switch(stat){
        case 'none':
            $(cls).show()
            break;
        default:
            $(cls).hide();
            break;
    }
}
/*
  |-----------------------------------------------------------------------------
  | js function : ca_action_remove
  |----------------------------------------------------------------------------- 
  | remove rows of table
  |-----------------------------------------------------------------------------
 */
/**
 * @function ca_action_remove()
 * @return 
 * remove rows of table
 * @author
 * Yasser Yazid M
 */
function ca_action_remove(page){
    $.ajax({
        type:"POST", 
        url: site+page,
        data : $("#cen_right form, div.table_list form").serialize(),
        success: function(response){  
            if(response=='0'){
                ca_notive('sory data can not removed...'); 
            }else{
                $(response).replaceWith('');
                ca_close_box();
                ca_notive('data has beed removed...')
            }
        },
        dataType:'html'
    });
    return false;
}


/**
 * @function ca_file_remove()
 * @return 
 * remove file
 * @author
 * Yasser Yazid M
 */
function ca_file_remove(page,m,wi_type){
    $.ajax({
        type:'POST', 
        data : $("#cen_right form, div.table_list form").serialize(),
        url: site+page+'/'+m, 
        success: function(response){
            ca_close_box();
            ca_notive('file has removed...');
            
            if(m==''){
                ca_load('dir/', '#cen_right');
            }else{
                switch(m){
                    case 'wi':
                        if(wi_type=='1'){
                            ca_load('widget/widget_list/1', 'ul.widget_list');
                        }else{
                            ca_load('widget/widget_list', 'ul.widget_list');
                        }                        
                        break;
                    case 'css':
                        ca_load('css/', '#template_setting');
                        break; 
                    case 'lang':
                        ca_load('languages/', '#cen_right');
                        break;
                    default:
                        ca_load(m, '#cen_right');
                        break;
                }
            }            
        },
        dataType:'html'
    });
    return false;
}


/**
 * @function ca_table_sort()
 * @return 
 * sort table click and drag
 * @author
 * Yasser Yazid M
 */
function ca_table_sort(page){
    $("table#table_list tbody, div.table_list div.option_template ul").sortable({
        opacity: 0.6,
        cursor: 'move',
        placeholder: "ui-state-highlight",
        cancel: ".ui-state-disabled",
        update: function() {
            var order = $(this).sortable("serialize");
            $.ajax({
                type:"POST",
                url: site+page,
                data: order,
                success: function(response){ 
                },
                dataType:"html"
            });
        }
    });
}

/**
 * @function ca_order_field()
 * @return 
 * order table rows with drag
 * @author
 * Yasser Yazid M
 */
function order_field(pages,order,by){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+pages, 
        data: $("form#s_order").serialize()+"&s_order="+order+"&s_by="+by,
        success: function(response){
            ca_close_box();            
            if($("#cen_find").html()==''){
                $("#cen_right").html(response);
            }else{
                $("#center_content").html(response);
                $("#center_content #top_title").remove();
                $("#center_content #bar_button").remove();
                $("#center_content #top_tap").remove(); 
            }
        }
    });
}

/**
 * @function ca_check_this()
 * @return 
 * check checkbox
 * @author
 * Yasser Yazid M
 */
function ca_check_this(i){  
    var x=$("#"+$(i).attr("id")+" input.check");  
    if(x.attr("checked")){ 
        x.removeAttr("checked")
        $(i).css({
            "background":"#ffffff"
        })
    }else{ 
        x.attr("checked","checked")
        $(i).css({
            "background":"#f1f9c2"
        })
    }
} 

/**
 * @function ca_check_table()
 * @return 
 * check checkbox for table backup
 * @author
 * Yasser Yazid M
 */
function ca_check_table(i){
    var x="#"+$($(i).parent()).attr('id'); 
    if($(i).attr("checked")){ 
        $(i).attr("checked","1")
        $(x).css({
            "background":"#f1f9c2"
        })        
    }else{ 
        $(i).removeAttr("checked")
        $(x).css({
            "background":"#ffffff"
        })        
    }
} 


/**
 * @function ca_edit_setting()
 * @return 
 * edit application setting
 * @author
 * Yasser Yazid M
 */
function ca_edit_setting_action(page){
    var myForm = $("#cen_right form");
    myForm.validation();
    if(!myForm.validate()) {
        
    }else{
        data = $("#cen_right form").serialize()
        $.ajax({
            type:"POST",
            beforeSend: function(){
                ca_loading();
            },
            url: site+page,
            data : data,
            success: function(response){
                ca_close_box();
                ca_notive("thanks to update data...") 
            }
        });
    }
    return false;
}

/**
 * @function ca_i_show()
 * @return 
 * show hide elemen in media box
 * @author
 * Yasser Yazid M
 */
function ca_i_show(i){
    $(".box-image").hide();
    $(i).slideDown("slow")
        
} 

/**
 * @function ca_do_create_file()
 * @return 
 * create file
 * @author
 * Yasser Yazid M
 */
function ca_create_file(dir,ext,m){
    var myForm = $(".light_box form");
    var durl='';
    var file_name=$(".light_box form input").val(); 
    if(ext=='widgets'){
        durl='dir/do_create_file/';
        curl='dir/check_available_file/';
        patern='^[a-z_]+(_wi)+(.php)+$';
        msg='file extention alowed only php<br/>and prefix _wi Ex:abc_wi.php';
    }else{
        if(ext=='css'){
            durl='css/do_create_file/';
            curl='css/check_available_file/';
            patern='^[a-z_]+(.php|.css|.html|.js)+$';
            msg='file extention alowed are (php|.css|.html|.js)';
        }else{         
            durl='dir/do_create_file/';
            curl='dir/check_available_file/';
            patern='^[a-z_]+(.php|.html|.js)+$';
            msg='file extention alowed are (.php|.html|.js)';
        
        }
    }
    var regexp= new RegExp(patern);
    if(file_name.length=='0') 
        ca_notive('this field input is required');
    else
    if(file_name.match(regexp)){
        myForm.validation();
        if(!myForm.validate()) {
        }else{
            data = $(".light_box form").serialize()
            $.ajax({
                type:"POST",
                beforeSend: function(){
                    ca_notive('loading...,,, check available file');
                },
                url : site+curl+dir,
                data : data,
                success : function(response){ 
                    if(response=='1'){
                        $.ajax({
                            type:"POST",
                            beforeSend: function(){
                                ca_loading();
                            },
                            url : site+durl+dir,
                            data : data,
                            success : function(response){                           
                                 
                                ca_load('dir/view/'+dir+'-'+file_name,'.css_content');
                                 
                                                                   
                            },
                            error: function(xhr,x,c){
                                alert(c)
                            }
                        })
                    }else{
                        ca_notive('file name is exists');
                    }    
                }
            })
        }
    }else{
        ca_notive(msg);
    }
    return false;
}


/**
 * @function ca_close_max_size()
 * @return 
 * close popup editor max
 * @author
 * Yasser Yazid M
 */
function ca_close_max_size(){
    $('form.max_dir textarea.editor').val($('#popup_max textarea.max_editor').val())
    $("#popup_max").remove();
    $("body").css({
        "overflow": "auto"
    })
}

/**
 * @function ca_max_application()
 * @return 
 * open popup max editor application
 * @author
 * Yasser Yazid M
 */
function ca_max_application(){  
    $.getScript(site+'assets/js/linked/jquery-linedtextarea.js', function() {
        $("body").append("\
    <div id='popup_max'>\n\
          <div class='header_max'><a href='javascript:void(0)' style='float:right;margin-right:10px;' class=\"button-red\" onclick='ca_close_max_size()'>[x]</a></div>\n\
          <textarea class='max_editor' style='float:left; width:100%; height:100%'>"+$('form.max_dir textarea.editor').val()+"</textarea>\n\
    </div>") 
        $("body").css({
            "overflow": "hidden"
        })
        $("#popup_max").css({
            position:"fixed",
            top:"0",
            left:"0",
            width:"100%",
            height:$(window).height(),
            "z-index":'100000',
            background:"#FCFCFC"
        })    
        $(".header_max").css({
            "float":"left", 
            "position":"relative",
            width:"100%", 
            "z-index":'31', 
            background:"#F0F0F0", 
            height:"30px"
        })
        $(".max_editor").linedtextarea(); 
    });
}


/**
 * @function ca_backupdb()
 * @return 
 * do backup database
 * @author
 * Yasser Yazid M
 */
function ca_backupdb(){ 
    field = document.getElementsByTagName("input");   
    if($("form#backup_db div.tables input:checked").length==0){ 
        ca_notive('Please Check One');
    }else{
        $.ajax({
            type:"POST",
            beforeSend: function(){
                ca_loading();
            },
            url: site+"settings/db_backup",
            data : $("form#backup_db").serialize(),
            success: function(response){
                ca_close_box();  
                ca_load('settings/database','#cen_right');
            }
        });  
    }
    return false;
}

/**
 * @function ca_dbrestore()
 * @return 
 * restore table
 * @author
 * Yasser Yazid M
 */
function ca_dbrestore(dir){
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+"settings/db_restore",
        data : 'dir='+dir,
        success: function(response){
            ca_close_box();  
            ca_notive('database restore is successfull');
            ca_load('settings/database','#cen_right');
        }
    });  
}

/**
 * @function ca_db_delete()
 * @return 
 * delete table backup
 * @author
 * Yasser Yazid M
 */
function ca_db_delete(dir,id){
    $.ajax({
        type:"POST", 
        url: site+"settings/db_delete",
        data : 'dir='+dir,
        success: function(response){ 
            $("div."+id+", ul."+id).remove().fadeOunt('slow');
        }
    });  
}

/**
 * @function ca_slide_log()
 * @return 
 * show hide log
 * @author
 * Yasser Yazid M
 */
function ca_slide_log(i){ 
    if($(i).attr("class")=='open'){
        $(i).attr('class','close');
        $(i).html('<span>Logs</span>')
        $.ajax({ 
            url: site+"logs/", 
            success: function(response){             
                $("#btn_fix_dest").html(response).css({
                    "height":'200px'
                }); 
                $('#bottom #bottom_right form').css({
                    'z-index':'0'
                })
            }
        });   
    }else{
        $(i).attr('class','open');
        $(i).html('<span>Logs</span>')
        $("#btn_fix_dest").html('').css({
            "height":'0px'
        });  
        $('#bottom #bottom_right form').css({
            'z-index':'20'
        })
    }
            
}

function switch_poll(std){
    switch (std){
        case '1' :
            $('p.p_ans').hide();
            $('p#ans1').fadeIn("fast");
            break;
        case '2' :
            $('p.p_ans').hide();
            $('p#ans1, p#ans2').fadeIn("fast");
            break;
        case '3' :
            $('p.p_ans').hide();
            $('p#ans1, p#ans2, p#ans3').fadeIn("fast");
            break;
        case '4' :
            $('p.p_ans').hide();
            $('p#ans1, p#ans2, p#ans3, p#ans4').fadeIn("fast");
            break;
        case '5' :
            $('p.p_ans').hide();
            $('p#ans1, p#ans2, p#ans3, p#ans4, p#ans5').fadeIn("fast");
            break;
        case '6' :
            $('p.p_ans').hide();
            $('p#ans1, p#ans2, p#ans3, p#ans4, p#ans5, p#ans6').fadeIn("fast");
            break;
        default  :
            alert("please select one")
            break
    }
}

/**
 * @function ca_poll_ans()
 * @return 
 * manage polling answer
 * @author
 * Yasser Yazid M
 */
function ca_poll_ans(i){
    var n_ans=$(i).val();
    switch_poll(n_ans)
}


/**
 * @function ca_poll()
 * @return 
 * manage poll input at first load
 * @author
 * Yasser Yazid M
 */
function ca_poll(i){ 
    switch_poll(i);
}

/**
 * @function ca_removeLogs()
 * @return 
 * remove logs
 * @author
 * Yasser Yazid M
 */
function ca_removeLogs(i){
    switch (i){
        case '404' :
            url=site+'logs/clear/404';
            div='.error404 > .content';
            break;
        case 'auth' :
            url=site+'logs/clear/auth';
            div='.errorAuth > .content';
            break;
        case 'user' :
            url=site+'logs/clear/user';
            div='.in_outUser > .content';
            break;
        case 'member' :
            url=site+'logs/clear/member';
            div='.in_outMember > .content';
            break;
        default  :
            alert("please select one")
            break
    }  
    $.ajax({ 
        beforeSend: function(){
            $(div).html('...loading.....')
        },
        url: url, 
        success: function(response){             
            $(div).html(response);
            ca_notive('success to clear logs')
        }
    });   
    
        
}


/**
 * @function ca_change_polling()
 * @return 
 * change polling vieww
 * @author
 * Yasser Yazid M
 */
function ca_change_polling(i){
    $.ajax({ 
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+'polling/setting',
        data:'poll_swf='+$(i).val(),
        success: function(response){ 
            ca_close_box();
            ca_load('polling/view_setting','div.poll_view'); 
            ca_notive('thanks to update') 
        }
    }); 
}



/**
 * @function ca_print_element()
 * @return 
 * print div element
 * @author
 * Yasser Yazid M
 */
function ca_print_element(id){ 
    $(id).show().printElement();
}
function ca_delete_ip(i){
    var ip=$(i).parent().find("span").html();
    $.ajax({
        type:"POST",
        beforeSend: function(){
            ca_loading();
        },
        url: site+'security/do_delete',
        data:'ip='+ip,
        success: function(response){ 
            $(i).parent().remove()
            ca_close_box();
        }
    })
}
 
/**
 * @function forgot password()
 * @return 
 * get new password
 * @author
 * Yasser Yazid M
 */
function forgot_pasword(){
    var myForm = $(".light_box form"); 
    var location=window.location;
    myForm.validation();
    if(!myForm.validate()) { 
    }else{
        $.ajax({
            type:"POST",
            beforeSend: function(){
                $("p#status").html("<span class='loading'><center>Loading....</center</></span>");
            },
            url : site+'user/recovery_password',
            data :$(".light_box form").serialize()+"&uri="+location,
            success : function(response){  
                if(response=='0'){
                    $("p#status").html("<span class='loading'>&nbsp; Email is not avilable</span>");
                }else{ 
                    $(".light_box form input").val('');
                    $("p#status").html("<span class='loading'><center>Password has been send to your email</center</></span>");  
                }                      
            },
            error: function(x,h,r){
                alert(r.status)  
            }
        })
                
    }
}

/**
 * @function ca_max_logs)
 * @return 
 * max log bar
 * @author
 * Yasser Yazid M
 */
function ca_max_logs(){ 
    $('a.logs_min').show();
    $('a.logs_max').hide();
    $('div#bottom_fix').css({
        width:$(window).width()+'px',
        top:'-30px',
        left:'0px',
        height:$(window).width()+'px'
    })
    $('div#btn_fix_dest').css({
        width:$(window).width()+'px', 
        height:$(window).width()-40+'px',
        'overflow-x':'auto'
    })
    
}

/**
 * @function ca_min_logs()
 * @return 
 * min ligs bar
 * @author
 * Yasser Yazid M
 */
function ca_min_logs(){ 
    $('a.logs_min').hide();
    $('a.logs_max').show();
    $('div#bottom_fix').attr('style','')
    $('div#btn_fix_dest').attr('style','').css({
        'height':'200px'
    })
}


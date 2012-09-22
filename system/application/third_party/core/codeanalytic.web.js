function ca_load_pagging(page,div){
    $.ajax({
        beforeSend: function(){
            loading();   
        },
        type:"post",
        url: page,         
        success: function(response){  
            close_box();            
            $(div).html(response);   
        },
        error: function(x,h,r){
            alert(r)
        }
    });
    return false;
} 

function font_plus(div){
    var cfs = $(div).css('font-size');
    var cfzn = parseFloat(cfs, 10);
    var newFontSize = cfzn*1.2;
    $(div).css('font-size', newFontSize); 
    return false
}
function font_min(div){
    var cfs = $(div).css('font-size');
    var cfzn = parseFloat(cfs, 10);
    var newFontSize = cfzn*0.8;
    $(div).css('font-size', newFontSize);
    return false
}

function load(page,div){
    $.ajax({
        url: site+page,
        beforeSend: function(){ 
            loading(); 
        },
        success: function(response){ 
            close_box(); 
            $(div).html(response);
            
        }
    });
    return false;
}
 
function change_password(){
    var location=window.location;
    var myForm = $(".light_box form");
    var old_password=$("input#old_password").val(); 
    myForm.validation();
    if(!myForm.validate()) {
    }else{
        $.ajax({
            type:"POST",
            beforeSend: function(){
                loading();
            },
            url : site+"member/cek_old_password",
            data :"old="+old_password,
            success: function(r){
                if(r=='1'){
                    $.ajax({
                        type:"POST",
                        url : site+"member/do_change_password",
                        data :$(".light_box form").serialize()+"&uri="+location,
                        success : function(response){                               
                            $(".light_content").html(
                                "<h2>PASSWORD TELAH BERHASIL DIRUBAH</h2>\n\
                            (jika dalam 5 detik halaman web tidak merefresh. mohon \n\
                            <a href='"+location+"' class='button_upload'>refresh</a> secara manual)");
                            setTimeout(function(){
                                window.location.href=location
                            },5000);
                                javascript:location.reload(true);
                        }
                    })
                }else{
                    $("input#old_password").parent().append("<span class='errorlist'>&nbsp; Password not match</span>");                           
                }
                close_box();
            }
        })
    }
}
function change_profile(){
    var location=window.location;
    var myForm = $(".light_box form"); 
    myForm.validation();
    if(!myForm.validate()) {
    }else{ 
        $.ajax({
            type:"POST",
            beforeSend: function(){
                loading();
            },
            url : site+"member/do_change_profile",
            data :$(".light_box form").serialize()+"&uri="+location,
            success : function(response){                               
                $(".light_content").html(
                    "<h2>PROFILE TELAH BERHASIL DIRUBAH</h2>\n\
                            (jika dalam 5 detik halaman web tidak merefresh. mohon \n\
                            <a href='"+location+"' class='button_upload'>refresh</a> secara manual)");
                setTimeout(function(){
                    window.location.href=location
                },5000);
                    javascript:location.reload(true);
                close_box();
            }
        })  
    }
}
function register_member(pages){
    var location=window.location;
    var myForm = $(".light_box form");
    var username=$("input#username").val();
    var password=$("input#password").val();
    var email=$("input#email").val();
    var c1=$("input#captcha").val();
    var c2=$("input#re_captcha").val();
    myForm.validation();
    if(c1==c2){
        
    }
    if(!myForm.validate()) {
    }else if(c1==c2){
        $.ajax({
            type:"POST",
            beforeSend: function(){
                $("p#status_login").html("<span class='loading'><center>Loading....</center</></span>");
            },
            url : site+"member/cek_username_avilable",
            data :"username="+username,
            success : function(response){   
                if(response=="1"){ 
                    $("p#status_login").html("");
                    $("input#username").parent().append("<span class='errorlist'>&nbsp; Username is not avilable</span>");
                }else{
                    $.ajax({
                        type:"POST", 
                        url : site+"member/cek_email_avilable",
                        data :"email="+email,
                        success : function(response){  
                            if(response=='1'){
                                $("p#status_login").html("");
                                $("input#email").parent().append("<span class='errorlist'>&nbsp; Email is not avilable</span>");
                            }else{
                                $.ajax({
                                    type:"POST",
                                    url : site+pages,
                                    data :$(".light_box form").serialize()+"&uri="+location,
                                    success : function(response){   
                                        $.ajax({
                                            type:"POST",
                                            url : site+"member/do_login",
                                            data :"email="+email+"&password="+password,
                                            success : function(response){   
                                                $("p#status_login").html("<span class='loading'><center>Success Register</center</></span>"); 
                                                window.location=location; 
                                                    javascript:location.reload(true);
                                            }
                                        })
                                    }
                                })
                            }
                        }
                    })                    
                }        
            }
        })
    }else{
        $("p#status_login").html("<span style='color:red'><center>Captcha is not match!!</center</></span>");
    } 
}
function login_member(page){
    var myForm = $(".light_box form"); 
    var location=window.location;
    myForm.validation();
    if(!myForm.validate()) { 
    }else{ 
        $.ajax({
            type:"POST",
            beforeSend: function(){
                $("p#status_login").html("<span class='loading'><center>Loading....</center</></span>");
            },
            url : site+page,
            data :$(".light_box form").serialize()+"&uri="+location,
            success : function(response){  
                if(response=='0'){
                    $("p#status_login").html("<span class='errorlist'>&nbsp; Email Or Password is not avilable</span>");
                }else{ 
                    $("p#status_login").html("<span class='loading'><center>Success login</center</></span>"); 
                    window.location=location; 
                        javascript:location.reload(true);

                }                      
            },
            error: function(x,h,r){
                alert(r.status)  
            }
        })
                
    }
}
function close_box(){
    $("div.light_box").remove();
    $("#wrapper").css({
        opacity:'1'
    })
    $("div#notive").html("").css({
        "background": "FFF",
        "border": "none",
        "padding":"0px"
    })
    
}
function loading(){
    var t=$(window).height();
    var tt= $(".light_box").height();
    var top=((t-tt)/3);
    var l=$("body").width();
    var left=((l-700)/2);
    cmd= "<div class='light_box' style='padding:0px; background: transparent;  z-index:1000; margin-left:150px;' id='page_loading'>"+
    "<div class='light_content' style='background: transparent;' align='center'>"+loadImg+"<br/> &nbsp;LOADING.........</div>"+
    "</div>";
    $("#wrapper").css({
        opacity:0.1
    })
    $("body").append(cmd)
    $(".light_box").css({
        left: left,
        top: top,
        "box-shadow": "none",
        "-moz-box-shadow": "none",
        "-webkit-box-shadow": "none",
        "-o-box-shadow": "none"
    })
}
function lightbox(page){ 
    $.ajax({
        beforeSend: function(){
            loading();
        },
        url: site+page,
        success: function(response){
            close_box();
            $("body").append(
                "<div class=\"light_box\">"+
                "<div class='light_content'></div>"+
                "</div>"
                )
            if($(".light_content").html('')){
                $(".light_content").html(response);
            }
            $(".light_content").html(response);
            
            var l=$("body").width();
            var left=((l-$(".light_box").width())/2);
            var h=$(window).height();
            var height=((h-$(".light_box").height())/2);
            $(".light_box").css({
                left: left,
                top: height,
                "z-index":'1000'
            })
            $('.loading').html('');
            $("#wrapper").css({
                opacity:0.1
            })
            $('.dateSimple').simpleDatepicker({
                x:0,
                appendTo:'.light_box'
            }); 
        },
        error: function(xhr){
            alert(xhr)
        },
        dataType:"html"
    });

    return false;
     
}
 
function ca_init_moving(target, position, topLimit) {
    if (!target)
        return false;

    var obj = target;
    obj.initTop = position;
    obj.topLimit = topLimit;

    obj.style.position = "absolute";
    obj.top = obj.initTop;
    obj.left = obj.initLeft;

    if (typeof(window.pageYOffset) == "number") {	//WebKit
        obj.getTop = function() {
            return window.pageYOffset;
        }
    } else if (typeof(document.documentElement.scrollTop) == "number") {
        obj.getTop = function() {
            return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        }
    } else {
        obj.getTop = function() {
            return 0;
        }
    }

    if (self.innerHeight) {	//WebKit
        obj.getHeight = function() {
            return self.innerHeight;
        }
    } else if(document.documentElement.clientHeight) {
        obj.getHeight = function() {
            return document.documentElement.clientHeight;
        }
    } else {
        obj.getHeight = function() {
            return 500;
        }
    }

    obj.move = setInterval(function() {
        if (obj.initTop > 0) {
            pos = obj.getTop() + obj.initTop;
        } else {
            pos = obj.getTop() + obj.getHeight() + obj.initTop;
        //pos = obj.getTop() + obj.getHeight() / 2 - 15;
        }

        if (pos < obj.topLimit)
            pos = obj.topLimit;
        if (pos > Math.max(document.documentElement.clientHeight, document.body.clientHeight))
            pos = Math.max(document.documentElement.clientHeight, document.body.clientHeight) - 1000;

        calc_pos = pos - topLimit;
        interval = obj.top - calc_pos ;
        if (calc_pos < 0) {
            obj.top = 0;
            obj.style.top = 0 + "px";
        } else {
            obj.top = obj.top - interval / 10;
            obj.style.top = obj.top + "px";
        }
    }, 30)
}
function ca_action_publish_template(page,i){
    $.ajax({
        type:"POST",
        url: site+page,
        success: function(response){
            $(i).replaceWith(response);
            window.location.href=window.location;
                javascript:location.reload(true);
        }
    });
    return false;
}

function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
        "ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        range.moveStart ('character', strPos);
        range.moveEnd ('character', 0);
        range.select();
    }
    else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}
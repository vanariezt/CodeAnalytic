this.media_tooltip = function(){
    xOffset = 10; // horizontal position
    yOffset = 30; // vertical position
    $("a.screenshot").hover(function(e){ // do function when hover
        $("#screenshot").remove();
        this.t = this.title; // get title of attribute selected 
        var c = (this.t != "") ? "<br/>" + this.t : ""; 
        act="<div class='media_image_action' style='float:right;padding:0px;'>"+ 
                "<!--<a href='javascript:void(0)' onclick='ca_light_delete(this)' class='button-red'>x</a><br/><br/>"+
                "<a href='javascript:void(0)' style='top:30px;' onclick='ca_image_setting(this)' class='button-red'>/</a>-->"+
             "</div>";
        img="<img src='"+ this.rel +"' align='middle' alt='url preview' />"
        $("body").append("<div id='screenshot'>"+act+img+"</div>");
        img_width=$('div#screenshot img').width();
        img_height=$('div#screenshot img').height();
        $("#screenshot").css({
            "top" : (e.pageY - (img_height/2)) + "px",
            "left":(e.pageX - (img_width/2)) + "px",
            "z-index":'10',
            "position":"absolute",
            "border":"1px solid #EBEBEB",
            "background":"#FFF",
            "padding":"5px",
            "color":"red"
        }).fadeIn("fast");
        $("#screenshot").hover(function(){}, function(){ 
            $(this).remove();
        });
    },
     
    function(){
        
        });
};
$(document).ready(function(){
    media_tooltip(); 
}); 

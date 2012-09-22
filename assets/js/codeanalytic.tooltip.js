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
 * @link		http://docs.codeanalytic.com/javascript/tooltip
 * @location            ./assest/as/codeanalytic.tootip.js
 */
 

this.tooltip = function(){
    xOffset = 10; // horizontal position
    yOffset = 30; // vertical position
    $("a.screenshot").hover(function(e){ // do function when hover
        $("#screenshot").remove();
        this.t = this.title; // get title of attribute selected
        var d = this.name; // get name of attribute selected
        var c = (this.t != "") ? "<br/>" + this.t : "";
        var img='';
        if(this.rel!=''){
            img="<img src='"+ this.rel +"' align='middle' alt='url preview' />"
            }else{
            img=''
            }
        $("body").append("<p id='screenshot'>"+img+c+ d +"</p>");
        $("#screenshot").css({
            "top" : (e.pageY - xOffset) + "px",
            "left":(e.pageX + yOffset) + "px",
            "z-index":10,
            "position":"absolute",
            "border":"1px solid #EBEBEB",
            "background":"#FFF999",
            "padding":"5px",
            "color":"red"
        }).fadeIn("fast");
    },
     
    function(){
        this.title = this.t;
        $("#screenshot").remove();
    });
     
};

$(document).ready(function(){
    tooltip();
    $("p.screenshot").remove();
}); 
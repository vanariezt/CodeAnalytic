/**

 * jquery script lined

 **/

(function($) {
    $.fn.script_linked = function(options) {
        // Get the Options
        var opts = $.extend({}, $.fn.script_linked.defaults, options);
       /*
		 * Helper function to make sure the line numbers are always

		 * kept up to the current system

		 */
        var fillOutLines = function(codeLines, h, lineNo){
            while ( (codeLines.height() - h ) <= 0 ){
                if ( lineNo == opts.selectedLine )
                    codeLines.append("<div class='lineno lineselect'>" + lineNo + "</div>");
                else
                    codeLines.append("<div class='lineno'>" + lineNo + "</div>");
        lineNo++;
           }
            return lineNo;
        };
    return this.each(function() {
           var lineNo = 1;
            var textarea = $(this); 
     /* Turn off the wrapping of as we don't want to screw up the line numbers */
            textarea.attr("wrap", "off");
            textarea.css({
                resize:'none'
            });
            var originalTextAreaWidth	= options.editorWidth;
           textarea.wrap("<div class='script_linked' style='width:" + (originalTextAreaWidth - 10) + "px'></div>");
            var linedDiv	= textarea.parent().wrap("<div class='linedwrap' style='width:" + originalTextAreaWidth + "px'></div>");
            var linedWrapDiv 			= linedDiv.parent();
           $(this).parent().prepend("<div class='scriptAction'>\n\
                        \n\<a class='scriptActionCode' href='javascript:void(0)' onclick='scriptCode(this)'> </a>\n\
                        <a class='scriptActionCopy' href='javascript:void(0)' onclick='scriptPrint(this)'> </a></div>");
     linedWrapDiv.prepend("<div class='lines' style='width:50px'></div>");
          var linesDiv	= linedWrapDiv.find(".lines");
            linesDiv.height( textarea.height() + 15 ); 
            /* Draw the number bar; filling it out where necessary */
            linesDiv.append( "<div class='codelines'></div>" );
            var codeLinesDiv	= linesDiv.find(".codelines");
            lineNo = fillOutLines( codeLinesDiv, linesDiv.height(), 1 );
         /* Move the textarea to the selected line */ 
            if ( opts.selectedLine != -1 && !isNaN(opts.selectedLine) ){
                var fontSize = parseInt( textarea.height() / (lineNo-2) );
                var position = parseInt( fontSize * opts.selectedLine ) - (textarea.height()/2);
                textarea[0].scrollTop = position;
           }

  /* Set the width */
            var sidebarWidth					= linesDiv.outerWidth();
            var paddingHorizontal 		= parseInt( linedWrapDiv.css("border-left-width") ) + parseInt( linedWrapDiv.css("border-right-width") ) + parseInt( linedWrapDiv.css("padding-left") ) + parseInt( linedWrapDiv.css("padding-right") );
            var linedWrapDivNewWidth 	= originalTextAreaWidth - paddingHorizontal;
            var textareaNewWidth			= originalTextAreaWidth - 20;
            textarea.width( textareaNewWidth );
            linedWrapDiv.width( linedWrapDivNewWidth );

         /* React to the scroll event */

            textarea.scroll( function(tn){
               var domTextArea		= $(this)[0];
                var scrollTop 		= domTextArea.scrollTop;
                var clientHeight 	= domTextArea.clientHeight;
                codeLinesDiv.css( {
                    'margin-top': (-1*scrollTop) + "px"
                    } );
                lineNo = fillOutLines( codeLinesDiv, scrollTop + clientHeight, lineNo );
            });
         /* Should the textarea get resized outside of our control */
            textarea.resize( function(tn){
                var domTextArea	= $(this)[0];
                linesDiv.height( domTextArea.clientHeight + 6 );
            });
        });
    };
    // default options
    $.fn.script_linked.defaults = {
        selectedLine: -1,
        selectedClass: 'lineselect',
        editorWidth:620
    };

})(jQuery);

function scriptPrint(i){ 
    $(i).parent().parent().find('code').show().printElement();
} 
function scriptCode(i,opt){ 
    var code=$(i).parent().parent().find('code').text(); 
    $("body").append(
        "<div class=\"light_box\">"+
        "<div class='light_content'><textarea style='width:400px' rows='5'></textarea><br/><div class='footer'><a class='button-red' href='javascript:void(0)' onclick='close_box()'>close</a></div></div>"+
        "</div>"
        )

    if($(".light_content textarea").html('')){
        $(".light_content textarea").html(code);
    }
    $(".light_content textarea").html(code);
    

    var l=$("body").width();
    var left=((l-$(".light_box").width())/2);
    var h=$(window).height();
    var height=((h-$(".light_box").height())/2);
    $(".light_box").css({
        left: left,
        top: height,
        "z-index":10
    })
} 
$(function(){
    $("code").script_linked({
        selectedLine: 1,
        selectedClass: 'lineselect',
        editorWidth:$('#wrap_center').width()-20
    });
})
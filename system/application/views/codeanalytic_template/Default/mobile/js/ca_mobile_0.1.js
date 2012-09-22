/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
function change_mobile_theme(i){ 
    $.ajax({
        type:"POST",
        data:"theme="+$(this).val(),
        url:site+"template/mobile_set",
        success: function(){
            window.location.back();
        }
    })
}

function m_menu(i){ 
    if($(i).attr('class')=='show'){
        $(i).removeClass('show').addClass('hide')
        $(i).hide()
    }else{
        $(i).removeClass('hide').addClass('show')
        $(i).show()
    }
}
/**
 * Created by Administrator on 2017/1/16 0016.
 */
$(function(){
    //计算pc端登陆框的上边距
    var loginForm=$("#login_box");
    var loginH=loginForm.outerHeight();
    loginForm.css('margin-top', -loginH / 2 - 20);

    var clientH = $(window).height();
    var topMenu = $("#top_menu").outerHeight();
    $("#main_content").outerHeight(clientH - topMenu);
});

/**
 * Created by Administrator on 2017/1/23 0023.
 */

$(function () {


    //导入顶部导航
    $("#main_top").load("topmenu.php", function (responseTxt, statusTxt, xhr) {
        if (statusTxt == "success") {
            //计算右侧主要内容的高度
            var clientH = $(window).height();
            var topMenu = $("#top_menu").outerHeight();
            $("#main_content").outerHeight(clientH - topMenu);
        }

    });

    loadSidebar();
});

//导入侧边栏
function loadSidebar() {
    $("#sidebar").load("sidebar.php", function (responseTxt, statusTxt, xhr) {
        if (statusTxt == "success") {

            //获取当前url
            var curUrl=window.location.href.split("=");
            var curSide=curUrl[curUrl.length-1];

            //为当前导航条添加类名
            $('#'+curSide).addClass("active");


            //侧边菜单二级菜单展开或关闭
            var sidelist=$("#sidemenu li");
            sidelist.find("h3").on("click",function () {
                $(this).next(".second_list").slideToggle();
                $(this).find(".open_icon").toggleClass("close");
            });
        }
    });
}



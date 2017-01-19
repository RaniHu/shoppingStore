/**
 *
 * Created by Administrator on 2017/1/19 0019.
 */

//添加类名
function addClass($obj,$parent,$removeObj,$event,$className) {
    $obj.on($event,function () {
       $(this).addClass($className).closest($parent).siblings().find($removeObj).removeClass($className);
       $(this).parent().siblings().find($removeObj).removeClass($className);
    });
}


/*function sideAction($obj,$event,$className) {
    $obj.on($event,function () {
        $(this).toggleClass($className);
    });
}*/

$(function () {

    //侧边菜单二级菜单展开或关闭
    var sidelist=$("#sidemenu li");
    sidelist.find("h3").on("click",function () {
        $(this).next(".second_list").slideToggle();
        $(this).find(".open_icon").toggleClass("close");
    });

});

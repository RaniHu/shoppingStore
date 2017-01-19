/**
 * Created by Administrator on 2017/1/16 0016.
 */
$(function(){
    //计算pc端登陆框的上边距
    var loginForm=$("#login_box");
    var loginH=loginForm.outerHeight();
    loginForm.css('margin-top', -loginH / 2 - 20);


});

//将窗口可视高度赋值给某个元素
function countHeight($targetH,$existH) {
    var clientH=$(window).height();
    var existH=$existH.outerHeight();
    $targetH.outerHeight(clientH-existH);
}

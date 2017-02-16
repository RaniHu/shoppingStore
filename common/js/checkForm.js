/**
 * Created by Administrator on 2017/1/17 0017.
 */
$(function () {
    var loginForm = $("#login_form");
    var prompt_mes = $("#prompt_mes");
    var required = loginForm.find("input.required");

    $("#username").blur(function () {
        if ($(this).val().length < 1) {
            $(this).css("border", "1px solid red");
            prompt_mes.text("请填写用户名");
        }
    });
    $("#pwd").blur(function () {
        if ($(this).val().length < 1) {
            $(this).css("border", "1px solid red");
            prompt_mes.text("请填写密码");
        }
    });
    $("#validate_code").blur(function () {
        if ($(this).val().length < 1) {
            $(this).css("border", "1px solid red");
            prompt_mes.text("请输入验证码");
        }
    });



});


function checkForm() {
    if($("#username").val()==""||$("#pwd").val()==""||$("#validate_code").val()==""){
        $("#prompt_mes").text("信息未填写完整!");
        return false;
    }
    else if($(".required").val()==""||null){
        $("#prompt_mes").text("信息未填写完整");
        return false;
    }else {
        $("#prompt_mes").text("");
        return true;
    }

}
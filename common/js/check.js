

//获取双字节的字符长度
function getLength(str) {
    return str.replace(/[^\x00-\xff]/g, "xx").length;                                         // \x00-xff代表单字节字符。
}

//正则验证
var nameReg = /^[\u4e00-\u9fa5A-Za-z0-9-_]{4,16}$/;                                         //用户名的正则表达式
var emailReg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;     //正确邮箱正则表达式
var chineseReg = /[\u4e00-\u9fa5]/g;                       //密码为中文的正则表达式;
var pwdReg = /[^A-Za-z0-9]{6,16}/g;                              //密码不是大小写字母加数字的正则表达式
var regL = /^[a-zA-Z]+$/g;                                 //密码为纯字母的正则表达式
var regN = /^[0-9]+$/g;                                    //密码为纯数字的正则表达式
var telReg = /^1\d{10}$/;                                    //手机号的正则表达式
//var emailtelReg=/^(13[0-9]|15[0-9]|17[678]|18[0-9]|14[57])[0-9]{8}$/;                   //手机号的正则表达式


//保存变量
var loginForm = $("#login_form");                    //真实姓名
var username = $("#username");                       //真实姓名
var pwd = $("#pwd");                                 //初次密码
var validate_code = $("#validate_code");             //验证码
var pwd2 = $("#pwd2");                               //确认密码
var email = $("#email");                             //邮箱
var prompt_mes = $("#prompt_mes");                   //提示信息

$(function () {

    //文本框获取焦点时
    inputFocus();
    //检查是否为空
    checkNull();

    //用户名失去焦点时
    username.blur(function () {
        //真实姓名为空
        if ($(this).val() == "") {
            prompt_mes.text("请填写用户名");
            $(this).css("border", "1px solid #fa3338");
        }
        //用户名不是中英文，数字，下划线，减号
        else if (!(nameReg.test($(this).val()))) {
            prompt_mes.text("用户名错误");
            $(this).css("border", "1px solid #fa3338");

        }
        //用户名长度超过16位或小于4位
        else if (getLength($(this).val()) > 16 || getLength($(this).val()) < 4) {
            prompt_mes.text("用户名长度错误");
        }
    });
    //邮箱失去焦点时
    email.blur(function () {
        checkEmail();
    });
    //密码
    pwd.blur(function () {
        checkPwd();

        /* //密码不符合大小写加数字
         else if (pwdReg.test(pwd.val())) {
         prompt_mes.html("密码应由大写、小写字母和数字组成");

         }
         //密码不能全为数字
         else if (regN.test(pwd.val())) {
         prompt_mes.html("密码不能全为数字");

         }
         //密码不能全为字母
         else if (regL.test(pwd.val())) {
         prompt_mes.html("密码不能全为字母");

         }
         //密码不能包含中文
         else if (chineseReg.test(pwd.val())) {
         prompt_mes.html("密码不能使用中文字符");
         }
         //密码长度少于6位或超过16位
         else if (getLength(pwd.val()) > 16 || getLength(pwd.val()) < 6) {
         prompt_mes.html("密码长度应在6-16位之间");
         }*/
    });


});



//得到焦点时
function inputFocus() {
    $("#login_form input.required").focus(function () {
        $(this).css("border", "1px solid #1679ce");
    });

}
//检查是否为空
function checkNull() {
    $("#login_form input.required").blur(function () {
       if($(this).val()==""){
           $(this).css("border", "1px solid #fa3338");
       }
    });
}

//用户名验证
function checkName() {

}

//邮箱验证
//纯数字，纯字母，带下划线_，带点.，带连接线-,邮箱域至少一个.和两个单词，不得特殊字符开头
function checkEmail() {
    var emailOk = emailReg.test($(this).val());
    //邮箱为空
    if (email.val() == "") {
        prompt_mes.html("邮箱不能为空");
    }
    //邮箱格式错误
    else if (!emailOk) {
        prompt_mes.html("请输入有效的邮箱");
    }else {
        return true;
    }
}

//密码验证
//密码为空
function checkPwd() {
    if (pwd.val() == "") {
        prompt_mes.html("密码不能为空");
    } else if (!(pwdReg.test(pwd.val()))) {
        prompt_mes.html("密码错误");
    }else {
        return true;
    }
}



//提交注册表单时检查
function checkForm() {
    checkNull();
    checkName();
    checkPwd();
    checkEmail();
}

/**
 * Created by Administrator on 2017/1/17 0017.
 */

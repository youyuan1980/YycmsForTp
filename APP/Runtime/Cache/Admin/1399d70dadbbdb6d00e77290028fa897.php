<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/css.css"/>
    <script>
    function changpwd () {
        var oldpwd=$("#oldpwd").attr("value");
        var userpwd=$("#userpwd").attr("value");
        var pwdtry=$("#pwdtry").attr("value");
        if (oldpwd==""||userpwd==""||pwdtry=="") {
            alert('密码不能为空');
            return false;
        }
        if (userpwd!=pwdtry) {
            alert('确认密码与新密码不一致');
            return false;
        }
        $("#form1").submit();
    }
    </script>
</head>
<body>
    <form id="form1" method="post" action="<?php echo U('user/doupdpwd');?>" >
    <div>
        <div class="PageHeader">
            <div class="PageTitle">当前位置 > 修改密码</div>
        </div>
        <div class="PageToolBar" id="PageToolBar">
        <img src="/yycmsfortp/Public/Images/edit.gif" /><a href="#" onclick="changpwd();" >保存</a>
            </div>
        <div id="container">
            <div id="content">
                <table border="0" id='userlist' class="GridTable">
                    <tr>
                            <td width="10%">
                                原密码</td>
                            <td>
                                <input type="password" id="oldpwd" name="oldpwd" width="300" />
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                初始密码</td>
                            <td>
                                <input type="password" id="userpwd" name="userpwd" width="300" />
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                确认密码</td>
                            <td>
                                <input type="password" id="pwdtry" name="pwdtry" width="300" />
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
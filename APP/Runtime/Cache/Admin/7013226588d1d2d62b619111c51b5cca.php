<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head><title></title>
    <meta charset="utf-8"/>
</head>
<body>
<form method="post" action="<?php echo U('login/dologin');?>">
    <table border="1">
        <tr>
            <td>用户名：</td>
            <td><input type="text" name="txt_userid"/></td>
        </tr>
        <tr>
            <td>帐号：</td>
            <td><input type="password" name="txt_pwd"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="登陆"/></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/css.css"/>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/Bootstrap/css/bootstrap.min.css"/>
</head>
<body>
    <form id="form1">
    <div>
        <div class="PageHeader">
            <div class="PageTitle">当前位置 > 用户基本信息</div>
        </div>
        <div id="container">
            <div id="content">
                <table border="0" id='userlist' class="table table-hover table-bordered table-condensed">
                    <tr>
                        <td width="126" height="23" class="tw">
                            用户名：
                        </td>
                        <td width="580" height="23" class="tw">
                            &nbsp;<?php echo ($UserID); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="126" height="23" class="tw">
                            用户姓名：
                        </td>
                        <td width="580" height="23" class="tw">
                            &nbsp;<?php echo ($UserName); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="126" height="23" class="tw">
                            拥有权限：
                        </td>
                        <td width="580" height="23" class="tw">
                            &nbsp;<?php echo ($UserRoles); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
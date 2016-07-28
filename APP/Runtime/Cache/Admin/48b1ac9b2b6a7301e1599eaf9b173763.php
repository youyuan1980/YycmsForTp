<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta charset="UTF-8">
    <title>无标题页</title>
    <link href="/yycmsfortp/Public/Css/css.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
</head>
<body>
    <form id="form1" method="post" action="">
        <div>
            <div class="PageHeader">
                <div class="PageTitle">
                    <?php echo ($title); ?>
                </div>
            </div>
            <div class="PageToolBar" id="PageToolBar">
                <img src="/yycmsfortp/Public/Images/add.gif" /><a id="c1" href="#" onclick="cl_Click();">保存</a>
            </div>
            <div id="container">
                <div id="content">
                    <table style="width: 100%" cellspacing="0" border="0" align="left" class="ContentTable"
                    id="LoginInfo">
                        <tr>
                            <td width="10%">用户ID</td>
                            <td>
                                <input type="text" name="userid" id="userid" width="300" value='<?php echo ($userid); ?>' />
                            </td>
                        </tr>
                        <tr id="a1">
                            <td width="10%">用户名称</td>
                            <td>
                                <input type="text" name="username" id="username" width="300" value='<?php echo ($username); ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td>权限</td>
                            <td>
                            <?php if(is_array($rolelist)): $i = 0; $__LIST__ = $rolelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($item["roleid"]); ?>" id=\"chkroles\" name="chkroles[]"  <?php echo ($item["ischecked"]); ?>   /><?php echo ($item["rolename"]); ?>
                                <br><?php endforeach; endif; else: echo "" ;endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
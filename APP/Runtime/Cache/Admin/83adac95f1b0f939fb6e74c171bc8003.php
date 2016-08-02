<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>无标题页</title>
    <link href="/yycmsfortp/Public/Css/css.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <script>
        function cl_Click()
        {
            var classid=$("#classid").attr("value");
            var title=$("#title").attr("value");
            if (classid==""||title=="")
            {
                alert('请输入栏目ID和栏目名称');
                return false;
            }
            $("#form1").submit();
        }
    </script>
</head>
<body>
    <form id="form1" method="post" action="<?php echo ($actionurl); ?>">
        <div>
            <div class="PageHeader">
                <div class="PageTitle">
                    <?php echo ($pagetitle); ?>
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
                            <td width="10%">父栏目</td>
                            <td>
                                <?php echo ($ptitle); ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">栏目ID</td>
                            <td>
                                <input type="text" name="classid" <?php echo ($classidreadonly); ?> id="classid" width="300" value='<?php echo ($classid); ?>' />
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">栏目名称</td>
                            <td>
                                <input type="text" name="title" id="title" width="300" value='<?php echo ($title); ?>' />
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="pid" id="pid" value="<?php echo ($pid); ?>" />
                </div>
            </div>
        </div>
    </form>
</body>
</html>
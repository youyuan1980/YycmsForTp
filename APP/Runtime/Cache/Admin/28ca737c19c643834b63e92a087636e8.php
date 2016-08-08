<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>无标题页</title>
    <link href="/yycmsfortp/Public/Css/css.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/yycmsfortp/Public/script/Common.js"></script>
    <script type="text/javascript" charset="utf-8" src="/yycmsfortp/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/yycmsfortp/Public/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/yycmsfortp/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script>
		function cl_Click () {
            var title=$("#title").attr("value");
            if (title=="")
            {
                alert('请输入标题');
                return false;
            };
            $("#form1").submit();
    	}
    </script>
    <style>
        .inputclass{width:600px;}
    </style>
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
                            <td width="10%">标题</td>
                            <td>
                                <input type="text" name="title" value="<?php echo ($title); ?>" id="title" class="inputclass"/>
                            </td>
                        </tr>
                        <tr id="a1">
                            <td width="10%">栏目</td>
                            <td>
                                <?php echo ($classtitle); ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">关键字</td>
                            <td>
                                <input type="text" name="keyword" id="keyword" value="<?php echo ($keyword); ?>"  class="inputclass"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">超链接</td>
                            <td>
                                <input type="text" name="linkurl" id="linkurl"  value="<?php echo ($linkurl); ?>"  class="inputclass"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">来源</td>
                            <td>
                                <input type="text" name="source" id="source"  value="<?php echo ($source); ?>"   class="inputclass"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">作者</td>
                            <td>
                                <input type="text" name="author" id="author" value="<?php echo ($author); ?>"   class="inputclass"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">首张图片</td>
                            <td>
                                <input type="text" name="titleimage" id="titleimage" value="<?php echo ($titleimage); ?>"   class="inputclass"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">信息状态</td>
                            <td>
                                <input type="checkbox" name="isimgnews" <?php echo ($isimgnews); ?> >&nbsp;是否图片新闻&nbsp;
                                <input type="checkbox" name="istop" <?php echo ($istop); ?>>&nbsp;是否置顶&nbsp;
                                <input type="checkbox" name="ishot" <?php echo ($ishot); ?>>&nbsp;是否热点&nbsp;
                            </td>
                        </tr>
						<tr>
							<td>信息</td>
							<td>
								<textarea id="editor" name="editor" type="text/plain" style="width:600px;height:300px;" ><?php echo ($content); ?></textarea>
							</td>
						</tr>
                    </table>
                    <input type="hidden" id="id" name="id" value="<?php echo ($id); ?>">
                    <input type="hidden" id="classid" name="classid" value="<?php echo ($classid); ?>">
                </div>
            </div>
        </div>
    </form>
</body>
</html>
<script>
	var ue = UE.getEditor('editor');
</script>
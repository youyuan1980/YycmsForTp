<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/Ext/resources/css/ext-all.css"/>
    <script type="text/javascript" src="/yycmsfortp/Public/Ext/adapter/ext/ext-base.js"></script>
    <script type="text/javascript" src="/yycmsfortp/Public/Ext/ext-all.js"></script>
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/default.css">
    <link rel="stylesheet" href="/yycmsfortp/Public/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script type="text/javascript" src="/yycmsfortp/Public/zTree/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="/yycmsfortp/Public/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript">
         var zNodes = <?php echo ($json); ?>;
    </script>
    <script src="/yycmsfortp/Public/Script/Default.js" type="text/javascript" ></script>
</head>
<body>
<form id="form1">
    <div id="west">
        <ul id="treeDemo" class="ztree"></ul>
    </div>
    <div id="north">
        <div id="top">
            <img src="images/top.jpg" align="left" width='90%' height='200'/>
            <?php echo ($username); ?>&nbsp;<a href="<?php echo U('login/logout');?>">退出系统</a><span
                style="margin-right: 30px;"></span></div>
    </div>
    <iframe height="100%" width="100%" src="<?php echo U('user/main');?>" name="main" frameborder="no" id="main" border="0">
    </iframe>
    <div id="south">
        <p style="text-align: center; padding-top: 15px;">
            版权所有： © 2015 水云间工作室 CopyRight All Rights Reserved. 技术支持：水云间工作室</p>
    </div>
</form>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/css.css"/>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/Bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <script>
    function del_user(userid)
	{
    	var msg = window.confirm("您确定删除吗?");
    	if (msg) {
    		var url='<?php echo U('user/deleteuser');?>';
    		var p='<?php echo I('get.p','');?>';
    		var tbuserid=$("#TbUserID").attr("value");
    		$.post(url, {p: p,tbuserid:tbuserid,userid:userid}, function(data) {
    			alert(data.info);
    			location.href=data.url;
    		});
    	}
    	else
    	{
    		return false;
    	}
    }
    function restuserpwd (userid) {
    	var msg = window.confirm("您确定重置密码吗?");
    	if (msg) {
    		var url='<?php echo U('user/restuserpwd');?>';
    		var p='<?php echo I('get.p','');?>';
    		var tbuserid=$("#TbUserID").attr("value");
    		$.post(url, {p: p,tbuserid:tbuserid,userid:userid}, function(data) {
    			alert(data.info);
    			location.href=data.url;
    		});
    	}
    	else
    	{
    		return false;
    	}
    }
    </script>
</head>
<body>
    <form action="<?php echo U('user/list');?>" method="get" >
        <div>
            <div class="PageHeader">
                <div class="PageTitle">用户管理 > 用户列表</div>
            </div>
            <div class="PageToolBar">
                <img src="/yycmsfortp/Public/Images/add.gif"><a href="<?php echo U('user/add');?>">添加用户</a>
            </div>
            <div id="PageTitle">
                    用户ID或用户姓名：
                  <input type="text" value="<?php echo ($TbUserID); ?>" id="TbUserID" name="TbUserID" width="83" />
                    &nbsp;
                    <img src="/yycmsfortp/Public/images/search.gif" alt="#" onclick="submit();" style=" cursor: hand; "/>
                </div>
            <div id="container">
                <div id="content">
                    <table border="0" id='userlist' class="table table-hover table-bordered table-condensed">
                    	<thead><tr><th>用户ID</th><th>用户名</th><th>操作</th></tr></thead>
						<tbody>
							<?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($item["userid"]); ?></td><td><?php echo ($item["username"]); ?></td>
								<td><a href="<?php echo U('user/edit',array('userid'=>$item[userid]));?>" >编辑</a>&nbsp;&nbsp;<a href="#" onclick="restuserpwd('<?php echo ($item["userid"]); ?>')">重置密码</a>&nbsp;&nbsp;<a href="#" onclick="del_user('<?php echo ($item["userid"]); ?>')">删除</a>&nbsp;&nbsp;</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
                    </table>
                    <table id="pager"><tr><td><div class="pages"><?php echo ($page); ?></div></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
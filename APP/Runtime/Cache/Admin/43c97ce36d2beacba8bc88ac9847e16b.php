<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/css.css"/>
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/Bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <script>
        function del_articleclass(id)
        {
            var msg = window.confirm("您确定删除吗?");
            if (msg) {
                var url='<?php echo U('articleclass/delarticleclass');?>';
                var p='<?php echo I('get.p','');?>';
                var pid='<?php echo I('get.pid','');?>';
                var tbtitle=$("#TbTitle").attr("value");
                $.post(url, {pid:pid,p: p,tbtitle:tbtitle,id:id}, function(data) {
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
    <form id='form1' method="get" action="<?php echo U('articleclass/articleclasslist');?>" >
        <div>
            <div class="PageHeader">
                <div class="PageTitle">栏目管理 > 栏目列表</div>
            </div>
            <div class="PageToolBar">
                <img src="/yycmsfortp/Public/Images/add.gif"><a href="<?php echo ($addurl); ?>">添加栏目</a>
            </div>
            <div id="PageTitle">
                <?php echo ($articleclassherf); ?>
                <br>
                    栏目名称：
                  <input type="text" value="<?php echo ($tbtitle); ?>" id="TbTitle" name="TbTitle" width="83"/>
                    &nbsp;
                    <img src="/yycmsfortp/Public/images/search.gif" alt="#" onclick="submit();" style=" cursor: hand; "/>
                </div>
            <div id="container">
                <div id="content">
                    <table border="0" id='articleclasslist' class="table table-hover table-bordered table-condensed">
                        <thead><tr><th>ID</th><th>标题</th><th>操作</th></tr></thead>
                        <tbody>
                            <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($item["id"]); ?></td>
                                <td><?php echo ($item["title"]); ?></td>
                                <td><a href="<?php echo U('articleclass/edit',array('id'=>$item[id],'pid'=>$item[parentid]));?>" >编辑</a>&nbsp;&nbsp;<a href="#" onclick="del_articleclass('<?php echo ($item["id"]); ?>')">删除</a>&nbsp;&nbsp;<a href="<?php echo U('articleclass/articleclasslist',array('pid'=>$item[id]));?>">管理项目</a></td>
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
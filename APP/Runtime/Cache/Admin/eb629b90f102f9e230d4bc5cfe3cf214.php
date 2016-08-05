<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/yycmsfortp/Public/css/css.css"/>
    <script type="text/javascript" src="/yycmsfortp/Public/script/jquery-1.7.2.min.js"></script>
    <script>
        function del_article (id) {
            // body...
            var msg=window.confirm('是否删除该条信息');
            var url='<?php echo U('article/delarticle');?>';
            var p='<?php echo I('get.p','');?>';
            var tbtitle=$("#TbTitle").attr("value");
            if (msg) {
                $.post(url, {tbtitle:tbtitle, p:p,id: id}, function(data) {
                    alert(data.info);
                    location.href=data.url;
                });
            }
            else{return false;}
        }
    </script>
</head>
<body>
    <form id='form1' >
        <div>
            <div class="PageHeader">
                <div class="PageTitle">信息管理 > 信息列表</div>
            </div>
            <div class="PageToolBar">
                <img src="/yycmsfortp/Public/Images/add.gif"><a href="#" onclick="add();">添加信息</a>
            </div>
            <div id="PageTitle">
                    <?php echo ($classurl); ?>
                    <br>标题：
                  <input type="text" value="<?php echo ($tbtitle); ?>" id="TbTitle" name="TbTitle" width="83"/>
                    &nbsp;
                    <img src="/yycmsfortp/Public/images/search.gif" alt="#" onclick="search();" style=" cursor: hand; "/>
                </div>
            <div id="container">
                <div id="content">
                    <table border="0" id='articlelist' class="GridTable">
                        <thead><tr><th>标题</th><th>操作</th></tr></thead>
                        <tbody>
                            <?php if(is_array($articlelist)): $i = 0; $__LIST__ = $articlelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($item["title"]); ?></td>
                                <td><a href="<?php echo U('article/edit',array('class'=>$item[classid],'id'=>$item[id]));?>" >编辑</a>&nbsp;&nbsp;<a href="#" onclick="del_article('<?php echo ($item["id"]); ?>')">删除</a>&nbsp;&nbsp;</td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <table id="pager"><tr><td><div class="pages"><?php echo ($page); ?></div></td></tr>
                    </table>
            </div>
        </div>
    </form>
</body>
</html>
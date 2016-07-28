//删除用户
function del(id)
{
    var isdel = window.confirm("您确定删除吗?");
    if (isdel) {
        $.ajax({
            url: "../Dal/ArticleClassAjax.php?&id="+id+"&action=del&time=" + new Date().getTime(),
            dataType: "text",
            async: false,
            error: function (text) {
                alert("error");
            },
            success: function (text) {
                search();
            }
        });
    }
}

//查询用户
function search()
{
    var pid=GetRequest("pid");
    if (pid=="") {pid="-1";}
    articleclasslist.KeyColumnName = "id";
    articleclasslist.CaptionColumnString = "标题";
    articleclasslist.ColumnString = "title";
    articleclasslist.TableId = "articleclasslist";
    articleclasslist.PagerId = "pager";
    articleclasslist.PageSize = 10;
    articleclasslist.ObjectName='articleclasslist';
    articleclasslist.url = "../Dal/ArticleClassAjax.php?action=list&pid="+pid+"&title="+escape($("#TbTitle").attr("value"));
    articleclasslist.PageIndex = 1;
    articleclasslist.IsShowPager=true;
    articleclasslist.CaptionColumnString_Custom="操作";
    articleclasslist.ColumnString_Custom="<a href=\"articleclass_edit.php?pid={parentid}&classid={id}\">编辑</a>&nbsp;<a href=\"#\" style=\"cursor:pointer;\" onclick=\"del('{id}')\" >删除</a>&nbsp;<a href=\"articleclass_list.php?pid={id}\">管理项目</a>&nbsp;";
    articleclasslist.Show();
}


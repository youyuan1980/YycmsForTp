//查询用户
function search()
{
    var classid=$("#classid").attr("value");
    articlelist.KeyColumnName = "id";
    articlelist.CaptionColumnString = "标题";
    articlelist.ColumnString = "title";
    articlelist.TableId = "articlelist";
    articlelist.PagerId = "pager";
    articlelist.PageSize = 20;
    articlelist.ObjectName='articlelist';
    articlelist.url = "../Dal/ArticleAjax.php?action=list&classid="+classid+"&title="+escape($("#TbTitle").attr("value"));
    articlelist.PageIndex = 1;
    articlelist.IsShowPager=true;
    articlelist.CaptionColumnString_Custom="操作";
    articlelist.ColumnString_Custom="<a href=\"articleedit.php?classid={class}&id={id}\">编辑</a>&nbsp;<a href=\"#\" style=\"cursor:pointer;\" onclick=\"del('{id}')\" >删除</a>";
    articlelist.Show();
}

function del(id)
{
    var isdel = window.confirm("您确定删除吗?");
    if (isdel) {
        $.ajax({
            url: "../Dal/ArticleAjax.php?&id="+id+"&action=del&time=" + new Date().getTime(),
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

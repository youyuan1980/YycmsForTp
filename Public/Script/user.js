//删除用户
function del_user(userid)
{
    var isdel = window.confirm("您确定删除吗?");
    if (isdel) {
        $.ajax({
            url: "../Dal/userajax.php?&userid="+userid+"&action=del&time=" + new Date().getTime(),
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

function resetpassowrd(userid)
{
    var isrest = window.confirm("您确定重置密码为123吗?");
    if (isrest) {
        $.ajax({
            url: "../Dal/userajax.php?&userid="+userid+"&action=restpassword&time=" + new Date().getTime(),
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
    userlist.KeyColumnName = "userid";
    userlist.CaptionColumnString = "用户ID,用户姓名";
    userlist.ColumnString = "userid,username";
    userlist.TableId = "userlist";
    userlist.PagerId = "pager";
    userlist.PageSize = 10;
    userlist.ObjectName='userlist';
    userlist.url = "../Dal/userajax.php?action=list&UserName="+escape($("#TbUserID").attr("value"));
    userlist.PageIndex = 1;
    userlist.IsShowPager=true;
    userlist.CaptionColumnString_Custom="操作";
    userlist.ColumnString_Custom="<a href=\"useredit.php?userid={userid}&username={username}\">编辑</a>&nbsp;<a href=\"#\" style=\"cursor:pointer;\" onclick=\"del_user('{userid}')\" >删除</a>&nbsp;<a href=\"#\" style=\"cursor:pointer;\" onclick=\"resetpassowrd('{userid}')\" >重置密码</a>";
    userlist.Show();
}  


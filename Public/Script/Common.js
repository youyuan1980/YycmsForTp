//获取Request参数值
function GetRequest(s) {
    var url = location.search;
    if (url.length == 0) {
        return "";
    }
    if (url.indexOf("?") != -1) {
        var str = url.substr(1)     //去掉?号
        var Request = new Object();
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            Request[strs[i].split("=")[0].toUpperCase()] = unescape(strs[i].split("=")[1]);
        }
    }
    return GetObjProperty(Request,s.toUpperCase());
}

function GetObjProperty(Obj,requestId)
{
    var value='';
    var PropertyCount=0;
    for(i in Obj){
        if(Obj.i ==null)
        {
            if (requestId.toUpperCase()==i) {value=Obj[requestId.toUpperCase()];break;}
        }
    }
    return value;
}

function log(s) {
    console.log(s);
}

/**
* 删除左右两端的空格
*/
String.prototype.trim=function()
{
     return this.replace(/(^\s*)(\s*$)/g, '');
}


function ts(text) {
    if (confirm(text))
    { return true; }
    else {return false;}
}

function back() {
    var url = GetRequest("source");
    location.href = url;
}

function select (obj,tableID,selectID,value) {
    $("#"+tableID+" tbody tr").removeClass("GridTableRowSelected");
    obj.className ="GridTableRowSelected";
    $("#"+selectID).attr("value",value);
}

function test()
{
    alert('111');
}

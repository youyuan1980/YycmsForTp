
function GridTable() {
    this.url = "";
    this.KeyColumnName = "";
    this.CaptionColumnString = "";
    this.ColumnString = "";
    this.IsShowPager = false;
    this.TableId = "";
    this.PagerId = "";
    this.PageSize = 20;
    this.PageIndex = 1;
    this.PagerSize = 5;
    this.CaptionColumnString_Custom="";
    this.ColumnString_Custom="";
    this.Pager = function (PageIndex) {
        this.PageIndex = PageIndex;
        this.Show();
    };
    this.GridRowClick = function (obj) {
    	$("#" + this.TableId + " tr:gt(0)").css("background","white");
    	$("#"+ obj.id ).css("background","#E8EDF3");
    }

    this.Show = function () {
        var CaptionColumns = new Array();
        CaptionColumns = this.CaptionColumnString.split(',');
        var Columns = new Array();
        Columns = this.ColumnString.split(',');
        //读取值
        var pageIndex = this.PageIndex;
        var keyColumnName = this.KeyColumnName;
        var tableId = this.TableId;
        var pagerId = this.PagerId;
        var isShowPager = this.IsShowPager;
        var pageSize = this.PageSize;
        var objectName = this.ObjectName;
        var pagerSize = this.PagerSize;
        var captionColumn_Customs = this.CaptionColumnString_Custom.split(',');
        var Column_Customs = this.ColumnString_Custom.split(',');
        var Url = this.url;

        //清除table内容并显示标题头
        $("#" + tableId + "").html('');
        $("#" + pagerId + "").html('');
        var title = '<thead><tr>';

        for (var i = 0; i < CaptionColumns.length; i++) {
            title += '<th>' + CaptionColumns[i] + '</th>';
        }

        for (var i = 0; i < captionColumn_Customs.length; i++) {
            title += '<th>' + captionColumn_Customs[i] + '</th>';
        }

        title += '</tr></thead>';
        $("#" + tableId + "").append(title);

        //显示数据
        $.ajax({
            url: Url + "&pagesize=" + pageSize + "&PageIndex=" + pageIndex + "&time=" + new Date().getTime(),
            dataType: "text",
            async: false,
            error: function (text) {
                alert("error");
            },
            success: function (text) {
                if (text.length == 0) {
                    alert()
                }
                var dataObj = eval("(" + text + ")");
                var row = "<tbody>";
                $.each(dataObj.items, function (idx, item) {
                    if (item[keyColumnName] != undefined) {
                        var row =  "<tr id='t" + item[keyColumnName] + "' onclick=\"javascript:" + objectName + ".GridRowClick(this);\">";
                        for (var j = 0; j < Columns.length; j++) {
                            row += '<td>' + item[Columns[j]] + '</td>';
                        }
                        /*增加自定义列*/
                        pattern =new RegExp("\\{(.| )+?\\}","igm");
                        for (var j = 0; j < Column_Customs.length; j++) {
                            var columnstr=Column_Customs[j];
                            var arr=columnstr.match(pattern);
                            for(var x=0;x<arr.length;x++)
                            {
                                var cdata=arr[x].substring(1,arr[x].length-1);
                                columnstr=columnstr.replace(arr[x],item[cdata]);
                            }
                            row += '<td>' + columnstr+ '</td>';
                        }

                        row += '</tr>';
                        $("#" + tableId + "").append(row);
                    }
                });

                $("#" + tableId + "").append("</tbody>");

                //分页
                if (isShowPager) {
                    var RowCount = dataObj.rowcount;
                    var SizeCount = 0;
                    if (RowCount != 0) {
                        SizeCount = Math.ceil(RowCount / pageSize);
                    }
                    pagestr = "<tr><td  valign=\"bottom\" align=\"left\" nowrap=\"true\" style=\"width:40%;\">记录数：" + RowCount + "条<span style=\"margin-left:5px;\"></span>每页显示：" + pageSize + "条 ";
                    pagestr += "当前页：第" + pageIndex + "页<span style=\"margin-left:5px;\"></span>总页数：" + SizeCount + "页<span style=\"margin-left:60px;\"></span>";
                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + pageIndex + ");\" style=\"margin-right:5px;\">&lt;&lt;</a>";

                    if (pageIndex <= pagerSize) {
                        if (pageIndex + pagerSize > SizeCount) {
                            for (var i = 1; i <= SizeCount; i++) {
                                if (pageIndex == i) {
                                    pagestr += "<span style=\"margin-right:5px;font-weight:Bold;color:red;\">" + i + "</span>";
                                }
                                else {
                                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + i + ");\" style=\"margin-right:5px;\">" + i + "</a>";
                                }
                            }
                        }
                        else {
                            for (var i = 1; i <= pageIndex + pagerSize; i++) {
                                if (pageIndex == i) {
                                    pagestr += "<span style=\"margin-right:5px;font-weight:Bold;color:red;\">" + i + "</span>";
                                }
                                else {
                                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + i + ");\" style=\"margin-right:5px;\">" + i + "</a>";
                                }
                            }
                        }
                    }
                    else {
                        if (pageIndex + pagerSize > SizeCount) {
                            for (var i = pageIndex - pagerSize; i <= SizeCount; i++) {
                                if (pageIndex == i) {
                                    pagestr += "<span style=\"margin-right:5px;font-weight:Bold;color:red;\">" + i + "</span>";
                                }
                                else {
                                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + i + ");\" style=\"margin-right:5px;\">" + i + "</a>";
                                }
                            }
                        }
                        else {
                            for (var i = pageIndex - pagerSize; i <= pageIndex + pagerSize; i++) {
                                if (pageIndex == i) {
                                    pagestr += "<span style=\"margin-right:5px;font-weight:Bold;color:red;\">" + i + "</span>";
                                }
                                else {
                                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + i + ");\" style=\"margin-right:5px;\">" + i + "</a>";
                                }
                            }
                        }
                    }
                    pagestr += "<a href=\"javascript:" + objectName + ".Pager(" + SizeCount + ");\" style=\"margin-right:5px;\">&gt;&gt;</a>";
                    pagestr += "</td></tr>";
                    $("#" + pagerId + "").append(pagestr);
                }
            }
        });
    }
}

<?php
namespace Admin\Model;
use Think\Model;
/**
*
*/
class MenuModel extends Model
{
	public function ShowMenuByJson($userid)
	{
		$json="[";
		$rows=$this->field("id,name,pid,isparent,url")
				   ->where("roleid ='' or roleid in ( select roleid from userinrole where userid='%s')",$userid)
				   ->order('menuorder')
				   ->select();

		foreach ($rows as $row) {
    		if ($json!="[") {
            $json=$json.",";
	        }
            $url="";
	        $id = $row["id"];
	        $pid = $row["pid"];
	        $name = $row["name"];
	        $isparent = "";
	        if ($row["isparent"]=="1") {
	            $isparent = ",isParent:true";
	        }
            if ($row["url"]!="") {
                $url=",url:\"" . U($row["url"]) . "\",target:\"main\"";
            }

	        $json = $json."{\"id\":\"" . $id . "\",\"pId\":\"" . $pid . "\",open:true,\"name\":\"" . $name . "\"" . $isparent . $url . "}";
    	}
    	$json=$json.']';
		return $json;
	}
}
 ?>
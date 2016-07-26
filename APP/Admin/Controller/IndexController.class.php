<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	session('userid','admin');
        session('username','超级管理员');
    	$userid=session("userid");
    	$json="[";
    	$sql="select id,name,pid,isparent,url from menu t where roleid ='' or roleid in ( select roleid from userinrole where userid='" .$userid."')  order by menuorder";
    	$db=M();
    	$rows=$db->query($sql);
    	foreach ($rows as $row) {
    		if ($json!="[") {
            $json=$json.",";
	        }
	        $id = $row["id"];
	        $pid = $row["pid"];
	        $name = $row["name"];
	        $isparent = "";
	        if ($row["isparent"]=="1") {
	            $isparent = ",isParent:true";
	        }
	        $url=",url:\"" . $row["url"] . "\",target:\"main\"";
	        $json = $json."{\"id\":\"" . $id . "\",\"pId\":\"" . $pid . "\",open:true,\"name\":\"" . $name . "\"" . $isparent . $url . "}";
    	}
    	$json=$json.']';
    	$this->assign('json',$json);
        $this->display();
    }
}
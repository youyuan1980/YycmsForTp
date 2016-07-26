<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller
{
	public function main()
	{
		$UserID=session("userid");
		$UserName=session("username");
		$UserRoles="";
		$db=M();
		$dt=$db->query("select a.rolename from userinrole t inner join roles a on a.roleid=t.roleid where userid='".$UserID."'");
		foreach ($dt as $row) {
	        if (strlen($UserRoles)!=0) {
	            $UserRoles=$UserRoles.",";
	        }
	        $UserRoles=$UserRoles.$row["rolename"];
        }
        $this->assign('UserID',$UserID);
        $this->assign('UserName',$UserName);
        $this->assign('UserRoles',$UserRoles);
		$this->display();
	}
}
 ?>
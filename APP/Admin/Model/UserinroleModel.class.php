<?php
namespace Admin\Model;
use Think\Model;
class UserinroleModel extends Model
{
	public function ShowUserRoles($userid)
	{
		$UserRoles='';
        $dt=$this->field("rolename")
                 ->join(" roles on roles.roleid=userinrole.roleid")
                 ->where(" userid='%s'",$userid)
                 ->select();
        foreach ($dt as $row) {
            if (strlen($UserRoles)!=0) {
                $UserRoles=$UserRoles.",";
            }
            $UserRoles=$UserRoles.$row["rolename"];
        }
        return $UserRoles;
	}
}
 ?>
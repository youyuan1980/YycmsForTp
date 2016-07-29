<?php
namespace Admin\Model;
use Think\Model;
class UsersModel extends Model
{
	//判断用户名和密码是否正确 ,返回1为登陆成功 ，2为密码错误，3为用户名错误
	public function login($userid,$userpwd)
	{
		$flag=$this->where("userid='%s'",$userid)->count();
		if($flag==1)
		{
			$data=$this->field("userid,userpassword")
					   ->where("userid='%s'",$userid)->find();
			$pwd=$data["userpassword"];
			if(!strcasecmp($pwd,md5($userpwd)))
			{
				return 1;
			}
			else
			{
				return 2;
			}
		}
		else
		{
			return 3;
		}
	}

	//判断用户名和密码是否正确 ,返回1为修改成功 ，2为密码错误，3为用户名错误
	public function updpwd($userid,$oldpwd,$userpwd)
	{
		$flag=$this->login($userid,$oldpwd);
		if ($flag==1) {
			$this->USERPASSWORD=md5($userpwd);
			$flag=$this->where("userid='%s'",$userid)->save();
		}
		return $flag;
	}
}
 ?>
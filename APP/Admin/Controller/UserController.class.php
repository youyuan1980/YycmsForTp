<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class UserController extends Controller
{
	public function UserList()
	{
		$p=I('get.p');
		if ($p=="") {
			$p=1;
		}
		$user=M('users');
		$tbuser=I('get.TbUserID');
		$count=$user->where("username like '%".$tbuser."%' or userid like '%".$tbuser."%'")
					->count();
		$page=new Page($count,10);
		$page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
	    $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	    $page->lastSuffix = false;//最后一页不显示为总页数
		$list=$user->where("username like '%".$tbuser."%' or userid like '%".$tbuser."%'")
				   ->order('uptime desc')
				   ->page($p.',10')
				   ->select();
		$this->assign('page',$page->show());
		$this->assign('userlist',$list);
		$this->display('userlist');
	}

	public function deleteuser()
	{
		echo I('get.userid');
	}

	public function main()
    {
        $UserID=session("userid");
        $UserName=session("username");
        $userinrole=D('Userinrole');
        $UserRoles=$userinrole->ShowUserRoles($UserID);
        $this->assign('UserID',$UserID);
        $this->assign('UserName',$UserName);
        $this->assign('UserRoles',$UserRoles);
        $this->display('main');
    }

	public function updpwd()
    {
        $this->display('updpwd');
    }

    public function doupdpwd()
    {
        if (IS_POST) {
            $oldpwd = I('post.oldpwd');
            $userpwd = I('post.userpwd');
            $user= D('users');
            $userid=session("userid");
            //1为修改成功 ，2为密码错误，3为用户名错误
            $flag=$user->updpwd($userid,$oldpwd,$userpwd);
            switch ($flag) {
                case '1':
                    $this->success('修改成功',U('user/updpwd'),3);
                    break;
                case '2':
                    $this->error('密码错误',U('user/updpwd'),3);
                    break;
                case '3':
                    $this->error('用户名错误',U('user/updpwd'),3);
                    break;
                default:
                    break;
            }
        }
        else
        {
            $this->error('非法操作',U('user/updpwd'),5);
        }
    }
}
?>
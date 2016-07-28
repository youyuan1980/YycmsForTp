<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	session('userid','admin');
        session('username','超级管理员');
    	$userid=session("userid");
    	$db=D('menu');
    	$json=$db->ShowMenuByJson($userid);
    	$this->assign('json',$json);
        $this->display('index');
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
                    $this->success('修改成功',U('index/updpwd'),3);
                    break;
                case '2':
                    $this->error('密码错误',U('index/updpwd'),3);
                    break;
                case '3':
                    $this->error('用户名错误',U('index/updpwd'),3);
                    break;
                default:
                    break;
            }
        }
        else
        {
            $this->error('非法操作',U('index/updpwd'),5);
        }
    }
}
<?php
namespace Admin\Controller;
use Think\Controller;
/**
*
*/
class BaseController extends Controller
{
	public function _initialize()
	{
		if (!session('userid')) {
			# code...
			$this->error('请重新登陆',U('login/login'));
		}
	}
}
 ?>
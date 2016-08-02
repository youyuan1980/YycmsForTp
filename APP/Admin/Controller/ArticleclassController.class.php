<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class ArticleclassController extends Controller
{
	public function ArticleClassList()
	{
		$pid=I('get.pid','-1');
		$tbtitle=I('get.TbTitle','');
		$articleclassherf="";
		$articleclass=M('article_classlist');
		if ($pid=="-1") {
			# code...
			$articleclassherf="上级目录：根目录";
		}
		else
		{
			$row=$articleclass->field('ID,TITLE')->where("ID='".$pid."'")->find();
			if ($row) {
				$url=U('articleclass/articleclasslist',array('pid'=>$row["pid"]));
				$articleclassherf="返回上级目录："."<a href='".$url."'>".$row["title"]."</a>&nbsp;&nbsp;";
			}
		}
		$count=$articleclass->where("title like '%".$tbtitle."%' and parentid='".$pid."'")
					->count();
		$page=new Page($count,C('PAGE_SIZE'));
		$page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
	    $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	    $page->lastSuffix = false;//最后一页不显示为总页数
		$list=$articleclass->field("ID,TITLE,PARENTID")->where("title like '%".$tbtitle."%' and parentid='".$pid."'")
				   ->order('uptime desc')
				   ->page($p.','.C('PAGE_SIZE'))
				   ->select();
		$this->assign('page',$page->show());
		$this->assign('userlist',$list);
		$this->assign('tbtitle',$tbtitle);
		$this->assign('addurl',U('articleclass/add',array('pid'=>$pid)));
		$this->assign('articleclassherf',$articleclassherf);
		$this->display('articleclasslist');
	}

	public function edit()
	{
		# code...
		$pid=I('get.pid','-1');
		$classid=I('get.id','');
		$title=I('get.title');
		if ($classid=="") {
			# code...
			$this->error('缺少参数',U('articleclass/articleclasslist',array("pid"=>$pid)),3);
		}
		else
		{
			$articleclass=M('article_classlist');
			$row=$articleclass->where("id='".$classid."'")->find();
			if ($row) {
				$this->assign('classid',$row[id]);
				$this->assign('title',$row[title]);
			}
			if ($pid=="-1") {
				$this->assign('ptitle','根目录');
			}
			else
			{
				$row=$articleclass->where("id='".$pid."'")->find();
				if ($row) {
					$this->assign('ptitle',$row["title"]);
				}
			}
			$this->assign('pid',$pid);
			$this->assign('actionurl',U('articleclass/doedit'));
			$this->assign('classidreadonly','readonly=true');
			$this->assign('pagetitle','编辑栏目信息');
			$this->display('articleclassedit');
		}
	}

	public function doedit()
	{
		$classid=I('post.classid');
		$title=I('post.title');
		$pid=I('post.pid');
		$articleclass=M('article_classlist');
		$flag=$articleclass->where("ID='".$classid."'")->setField(array("TITLE"=>$title,"UPTIME"=>date('Y-m-d H:i:s')));
		if ($flag) {
			$this->success("保存成功",U('articleclass/edit',array("id"=>$classid,"pid"=>$pid)),3);
		}
		else
		{
			$this->error("保存失败",U('articleclass/edit',array("id"=>$classid,"pid"=>$pid)),3);
		}
	}

	public function add()
	{
		# code...
		echo MM();
	}
}
 ?>
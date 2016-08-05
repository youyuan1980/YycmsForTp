<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class ArticleController extends Controller
{
	public function ArticleList()
	{
		# code...
		$p=I('get.p');
		if ($p=="") {
			$p=1;
		}
		$tbtitle=I('get.TbTitle','');
		$classid=I('get.classid','');
	    $curclasstitle='';
	    $childclassurl='';
	    $articleclass=M('article_classlist');
	    if ($classid=="-1"||$classid=="") {

	        $dt=$articleclass->where("PARENTID='-1'")
	        				 ->limit(1)
	        				 ->field('ID,TITLE,PARENTID')
	        				 ->find();
	        if ($dt) {
	        	$classid=$dt["id"];
	        	$curclasstitle=$dt["title"]."(根目录)";
	        	$dt1=$articleclass->where("PARENTID='".$dt["parentid"]."'")
	        					  ->field("TITLE,ID")
	        					  ->select();
		        foreach ($dt1 as $row) {
		        	$url=U('article/articlelist',array("classid"=>$row["id"]));
		            $childclassurl=$childclassurl."<a href='".$url."'>".$row["title"]."</a>&nbsp;&nbsp;";
		        }
	        }
	    }
	    else
	    {
	        $dt=$articleclass->where("id='".$classid."'")->field("ID,TITLE,PARENTID")->find();
	        if ($dt) {
	        	$curclasstitle=$dt["title"];
		        $childclassurl="<a href='".U('article/articlelist',array("classid"=>$dt["parentid"]))."'>上级目录</a>&nbsp;&nbsp;";
		        $dt1=$articleclass->where("PARENTID='".$classid."'")
	        					  ->field("TITLE,ID")
	        					  ->select();
		        foreach ($dt1 as $row) {
		        	$url=U('article/articlelist',array("classid"=>$row["id"]));
		            $childclassurl=$childclassurl."<a href='".$url."'>".$row["title"]."</a>&nbsp;&nbsp;";
		        }
	        }
	    }
	    $classurl="栏目：".$curclasstitle.'<br>请点击选择栏目：'.$childclassurl;
	    $this->assign('classurl',$classurl);
	    $article=M('article');
	    $count=$article->where("ISDELETE='0' and title like '%".$tbtitle."%' and classid='".$classid."'")
					->count();
		$page=new Page($count,C('PAGE_SIZE'));
		$page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	    $page->setConfig('prev', '上一页');
	    $page->setConfig('next', '下一页');
	    $page->setConfig('last', '末页');
	    $page->setConfig('first', '首页');
	    $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	    $page->lastSuffix = false;//最后一页不显示为总页数
		$list=$article->field("ID,TITLE,CLASSID")->where("ISDELETE=0 and title like '%".$tbtitle."%' and classid='".$classid."'")
				   ->order('uptime desc')
				   ->page($p.','.C('PAGE_SIZE'))
				   ->select();
		$this->assign('page',$page->show());
		$this->assign('articlelist',$list);
		$this->assign('tbtitle',$tbtitle);
		$this->display('articlelist');
	}

	public function delarticle()
	{
		# code...
		$p=I('p');
		$id=I('id');
		$tbtitle=I('tbtitle','');
		$article=M('article');
		$flag=$article->where("ID='".$id."'")
					  ->setField("ISDELETE",'1');
		if ($flag) {
			# code...
			$data["info"]="删除成功";
		}
		else
		{
			$data["info"]="删除失败";
		}
		$data["url"]=U('article/articlelist',array('p'=>$p,'tbtitle'=>$tbtitle));
		$this->ajaxReturn($data);
	}

	public function edit()
	{
		$id=I('get.id');
		$classid=I('get.classid');
		$this->display('articleedit');
	}
}
 ?>
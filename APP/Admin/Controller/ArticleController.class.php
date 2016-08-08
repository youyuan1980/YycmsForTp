<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class ArticleController extends BaseController
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
		$this->assign('addurl',U('article/add',array("class"=>$classid)));
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
		$class=I('get.class');
		$article=M('article');
		$this->assign('pagetitle','编辑信息');
		$this->assign('actionurl',U('article/doedit'));
		$this->assign('id',$id);
		$this->assign('classid',$class);
		$data=$article->where("ID='".$id."'")->find();
		if ($data) {
			$this->assign('title',$data["title"]);
			$this->assign('keyword',$data["keyword"]);
			$this->assign('linkurl',$data["linkurl"]);
			$this->assign('source',$data["source"]);
			$this->assign('author',$data["author"]);
			$this->assign('titleimage',$data["titleimage"]);
			$this->assign('isimgnews',$data["isimgnews"]=="1"?"checked=checked":"");
			$this->assign('istop',$data["istop"]=="1"?"checked=checked":"");
			$this->assign('ishot',$data["ishot"]=="1"?"checked=checked":"");
			$this->assign('content',html_entity_decode($data["content"]));
			$articleclass=M('article_classlist');
			$dt=$articleclass->where("ID='".$data["classid"]."'")->find();
			if ($dt) {
				$this->assign('classtitle',$dt["title"]);
			}
		}
		$this->display('articleedit');
	}

	public function doedit()
	{
		$data["TITLE"]=I('post.title');
		$data["KEYWORD"]=I('post.keyword');
		$data["LINKURL"]=I('post.linkurl');
		$data["SOURCE"]=I('post.source');
		$data["AUTHOR"]=I('post.author');
		$data["TITLEIMAGE"]=I('post.titleimage');
		$data["ISIMGNEWS"]=I('post.isimgnews')=='on'?"1":"0";
		$data["ISTOP"]=I('post.istop')=='on'?"1":"0";
		$data["ISHOT"]=I('post.ishot')=='on'?"1":"0";
		$data["CONTENT"]=I('post.editor');
		$data["UPTIME"]=date('Y-m-d H:i:s');
		$data["EDITUSERNAME"]=session("userid");
		$article=M('article');
		$flag=$article->where("ID='".I('post.id')."'")->data($data)->save();
		if ($flag!==false) {
			$this->success('保存成功',U('article/edit',array("class"=>I('post.classid'),"id"=>I('post.id'))));
		}
		else{
			$this->error('保存失败',U('article/edit',array("class"=>I('post.classid'),"id"=>I('post.id'))));
		}
	}

	public function add()
	{
		$class=I('get.class');
		$article=M('article');
		$this->assign('pagetitle','添加信息');
		$this->assign('actionurl',U('article/doadd'));
		$this->assign('classid',$class);
		$articleclass=M('article_classlist');
		$dt=$articleclass->where("ID='".$class."'")->find();
		if ($dt) {
			$this->assign('classtitle',$dt["title"]);
		}
		$this->display('articleedit');
	}

	public function doadd()
	{
		$data["ID"]=GetID();
		$data["TITLE"]=I('post.title');
		$data["CLASSID"]=I('post.classid');
		$data["KEYWORD"]=I('post.keyword');
		$data["LINKURL"]=I('post.linkurl');
		$data["SOURCE"]=I('post.source');
		$data["AUTHOR"]=I('post.author');
		$data["TITLEIMAGE"]=I('post.titleimage');
		$data["ISIMGNEWS"]=I('post.isimgnews')=='on'?"1":"0";
		$data["ISTOP"]=I('post.istop')=='on'?"1":"0";
		$data["ISHOT"]=I('post.ishot')=='on'?"1":"0";
		$data["CONTENT"]=I('post.editor');
		$data["ADDTIME"]=date('Y-m-d H:i:s');
		$data["UPTIME"]=date('Y-m-d H:i:s');
		$data["EDITUSERNAME"]=session("userid");
		$article=M('article');
		$flag=$article->data($data)->add();
		if ($flag!==false) {
			$this->success('保存成功',U('article/add',array("class"=>I('post.classid'))));
		}
		else{
			$this->error('保存失败',U('article/add',array("class"=>I('post.classid'))));
		}
	}
}
 ?>
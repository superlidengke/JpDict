<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$ongoing=array();
    	$ongoing[]=array(
					'title' => 'Java' , 
					'price' => 45 ,
					);
    	$ongoing[]=array(
    			'title' => 'Oracle' ,
    			'price' => 75 ,
    	);
    	$this -> assign('ongoing' , $ongoing);
    	$this->display();
	

    }
    public function upload(){
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728*30 ;// 设置附件上传大小 3M *3０
    	//不设置，则不限类型
    	//$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =     ''; // 设置附件上传（子）目录
    	// 上传文件
    	$info   =   $upload->uploadOne($_FILES['file']);
    	if(!$info) {// 上传错误提示错误信息
    		$this->error($upload->getError());
    	}else{// 上传成功
    		$this->success('上传成功！');
    		$file=$upload->rootPath.$info['savepath'].$info['savename'];
    		
    	}
    	 
    }
    public function insert(){
    	
//     	$User = M("query_word"); // 实例化User对象
//     	$data['name'] = 'ThinkPHP';
//     	$data['meaning_id'] = 'ThinkPHP@gmail.com';
//     	$User->add($data);
    }
}
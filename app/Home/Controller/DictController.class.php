<?php
namespace Home\Controller;
use Think\Controller;
load("@.dictFunction");
class DictController extends Controller {
    public function index(){
    	
    	$result=getSimpleMeaning("月");
    	$result=getStandardMeaning("月");
    	//echo "hello dict<br/>".$result;
    	$this->assign('result',$result);
    	$this->display();
    }
    
    public function simMean($name){   	 
    	$result=getSimpleMeaning($name);
    	return $result;
    }
    public function stdMean($name){
    	$result=getStandardMeaning($name);
    	return $result;
    }    
    public function insert(){
    	
    	$User = M("query_word"); // 实例化User对象
    	$data['name'] = 'ThinkPHP';
    	$data['meaning_id'] = 'ThinkPHP@gmail.com';
    	$User->add($data);
    }
}
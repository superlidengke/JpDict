<?php
namespace Home\Controller;
use Think\Controller;
class WordController extends Controller {
    public function index(){
    	$this->display();
    	
    }
    
    public function insert(){
    	$name=$_POST['name'];
    	//如果不为空
    	if(trim($name)){
    		$meaning=$_POST['meaning'];
    		save_word($name,$meaning);
    	}
    	
    }
}
<?php
namespace Home\Controller;
use Think\Controller;
load("@.dictFunction");
class DictManageController extends Controller {
    public function index(){
    	
    	$re=add_dict_todo('屑籠');
    	$this->assign('result',$re);
    	$this->display();
    	
    }
    
    /**
     * 查询单词解释并保存
     */
    public function loadWords(){
    	//找出id最小的未被查询单词
    	//id大于等于此值的1000个词
    	
    	$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
    	$words=$Model->query("select * from `dict_todo` where id >= (select min(id) from `dict_todo` where isDone = 0) order by id limit 1");
    	
    	
    	//循环，查询每一个词的解释并保存
    	foreach ($words as $word){
    		$todo_word=M('dict_todo');
    		
    		//不trim,单词首尾有空格
    		$name=trim($word['name']);
    		$simple=getSimpleMeaning($name);
    		if(empty($simple['html'])){
    			break;//此时可能没联网
    		}
    		$word['isDone']=1;
    		$todo_word->save($word);
    		//如果没查到
    		if(strstr($simple['meaning'],"对不起")){
    			continue;
    		}
    		$simple['id']=md5($simple['meaning']);
    		sleep(1);
    		$standard=getStandardMeaning($name);
    		if(empty($standard['html'])||strstr($standard['meaning'],"对不起")){
    			continue;
    		}
    		$standard['id']=md5($standard['meaning']);
    		save_dict_word($name,$simple,$standard);
    		$word['isFound']=1;
    		$todo_word->save($word);
    	}
    	$word_mode=M('dict_words');
    	$this->assign('msg','dict_words number:'.$word_mode->count()) ;
    	
    	$dict_todo=M('dict_todo');
    	$done_maxId=$dict_todo->where("isDone=1")->max('id');
    	$todo_maxId=$dict_todo->max('id');
    	$this->assign("done_maxId",$done_maxId);
    	$this->assign("todo_maxId",$todo_maxId);
    	
    	if(!$words){
    		$this->assign("warning","no word to do");
    	}
    	$this->display();
    }
    public function test(){
    	$dict_todo=M('dict_todo');
    	$done_maxId=$dict_todo->where("isDone=1")->max('id');
    	$todo_maxId=$dict_todo->max('id');
    	echo $dict_todo->getLastSql(),"<br/>";
    	var_dump($todo_maxId);
    }
    private function saveWordsFromFile($file){
    	echo $file;
	   //文件每行为一个元素
	    $f_arr=file($file);
	    echo "all words number:".sizeof($f_arr);
	    $f_arr=array_unique($f_arr);
	    echo "unique words number:".sizeof($f_arr);
	    $this->saveWords($f_arr);
   	 
    }
    
    private function saveWords($words_arr){
    	foreach ($words_arr as $word){
    		$re=add_dict_todo($word);
    		if($re==1){
    			echo $word,",";
    		}
    		
    	}
    }
    /**
     * 
     * @param unknown $words_arr
     */
    private function saveWordsBatch($words_arr){
    	//按1000个元素为一组，切割数组，构建一个二维数组
    	$arr_group=array_chunk($words_arr,1000);
    	$wordToDo=M('dict_todo');
    	foreach ($arr_group as $group){
    		//$group为一维数组
    		$words=array();
    		foreach ($group as $ele){
    			$words[]=array('name'=>trim($ele));
    		}
    		$wordToDo->addAll($words);
    	}
    }
    public function upload(){
    	$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    //不设置，则不限类型
	    //$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->uploadOne($_FILES['file']);
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	       // $this->success('上传成功！');
	       $file=$upload->rootPath.$info['savepath'].$info['savename'];
	       $this->saveWordsFromFile($file);
	    }
    	
    }
    
    
}
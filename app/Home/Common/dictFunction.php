<?php
function unicode2utf8($str){
	if(!$str) return $str;
	$decode = json_decode($str);
	if($decode) return $decode;
	$str = '["' . $str . '"]';
	$decode = json_decode($str);
	if(count($decode) == 1){
		return $decode[0];
	}
	return $str;
}

function getSimpleMeaning($name) {
	if(empty($name)){
		return;
	}
	$name=trim($name);
	$api = 'http://dict.hjenglish.com/services/simpleExplain/jp_simpleExplain.ashx?type=jc&w='; //接口地址
	$api=$api.$name;
	$meaning=array();
	//获取网页数据
	$contents= file($api); //获得页面的源代码
	
	$contents=array_shift($contents);
	$meaning['html']=$contents;
	$contents=substr($contents,30);
	$contents=substr($contents,0,strlen($contents)-101);
	$contents=unicode2utf8($contents);
	$meaning['meaning']=$contents; echo $contents;
	return $meaning;
}
function getStandardMeaning($name) {
	if(empty($name)){
		return;
	}
	$name=trim($name);
	$api = 'http://dict.hjenglish.com/services/huaci/jp_web_ajax.ashx?type=jc&w='; //接口地址
	$api=$api.$name;
	$meaning=array();
	//获取网页数据
	$contents= file($api); //获得页面的源代码

	$contents=array_shift($contents);
	$meaning['html']=$contents;
	$contents=substr($contents,30);
	$contents=substr($contents,0,strlen($contents)-32);
	$contents=unicode2utf8($contents);
	$meaning['meaning']=$contents;echo $contents;
	return $meaning;
}

//单词不存在时，保存
function save_dict_word($name,$simple,$standard) {
	if(empty($name)||(empty($simple)||empty($standard))){
		return ;
	}
	$dict_words=M('dict_words');
	if($dict_words->where("name='$name'")->find()){
		return ;
	}else{
		$dict_words->name=$name;
		$dict_words->simple_id=$simple['id'];
		$dict_words->standard_id=$standard['id'];
		$dict_words->add();
	}
	$Simple_mode=M('dict_simple_meaning');
	if(!$Simple_mode->find($simple['id'])){
		$Simple_mode->add($simple);
	}	
	$standard_mode=M('dict_std_meaning');
	if(!$standard_mode->find($standard['id'])){
		$standard_mode->add($simple);
	}	
}
function add_dict_todo($name){
	if(empty($name)){
		return;
	}
	$name=trim($name);
	$dict_todo=M('dict_todo');
	if($dict_todo->where("name='$name'")->find()){
		return "$name has existed";
	}else {
		$data['name']=$name;
		$dict_todo->add($data);
	}
	return 1;
}
/**
 * dict_do的单词在保存时没有trim，致使单词后有不可见字符，此方法用来去除数据库中单词两边的不可见字符
 */
function trim_dict_toDo_words(){
	$dict_todo=M('dict_todo');
	$maxId=$dict_todo->max('id');
	for($i=1;$i<$maxId;$i++){
		if($dict_todo->find($i)){
			$dict_todo->name=trim($dict_todo->name);
			$dict_todo->save();
			echo $dict_todo->name;
		}
	}
}

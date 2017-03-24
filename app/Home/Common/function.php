<?php
function getData(){
	return "get data"; 
}
//对应的名字是否存在
function is_word_exist($name){
	$result=M("query_word")->where('name=\''.$name.'\'')->getField('name');
	return $result!=null;
}
//单词不存在时，保存
function save_word($name,$meaning) {
	if(empty($name)||empty($meaning)){
		return ;
	}
	if(is_word_exist($name)){
		return;
	}
	$md5=md5($meaning);
	//保存到解释表
	save_meaning($meaning,$md5);
	//保存到已查询单词表
	$query_word = M("query_word"); // 实例化User对象
	$data['name'] = $name;
	$data['meaning_id'] = $md5;
	$query_word->add($data);
}
//对应解释的md5是否存在
function is_meaning_exist($md5){
	$result=M("simple_html_meaning")->where('id=\''.$md5."'")->getField('id');
	return $result!=null;
}
function save_meaning($meaning,$md5){
	//已经存在，直接返回
	if(is_meaning_exist($md5)){
		return ;
	}
	//否则保存
	$mode_meaning=M("simple_html_meaning");
	$data['id']=$md5;
	$data['meaning']=$meaning;
	$mode_meaning->add($data);
	
}

<?php
namespace Media\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $this->display();
    }
    public function audioWave(){
    	$this->display();
    }
}
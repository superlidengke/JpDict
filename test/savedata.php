
<?php
$arr=array();
$arr[]=1;
$arr[]=2;


class test{}

$obj = new test();
$obj->a = '1';
$obj->b = '2';

$obj = (string)$obj;
echo $obj;
?>


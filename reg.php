<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/7 0007
 * Time: 9:02
 */

//参数
$config=[
  "host"=>'127.0.0.1',
    'db'=>'exam1910',
    'user'=>'root',
    'pass'=>'root'
];
// new pdo
$dbh = new PDO("mysql:host=".$config['host'].";dbname=".$config['db'],$config['user'],$config['pass']);

//构造sql语句
$sql = "insert into user values(null,:name,:pass)";


$stmt = $dbh->prepare($sql);
//接收参数
$user = $_POST['name'];// get 或 post
$pass=$_POST['pass'];
//绑定参数
$stmt->bindValue(':name',$user);
$stmt->bindValue(':pass',$pass);
//执行预处理语句
if($stmt->execute()){
    echo "注册成功";
    Header("location:login.html");
}else{
    echo "注册失败";
    Header("location:index.html");
}

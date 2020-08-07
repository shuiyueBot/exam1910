<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/7 0007
 * Time: 9:27
 */
$config=[
    "host"=>'127.0.0.1',
    'db'=>'exam1910',
    'user'=>'root',
    'pass'=>'root'
];
// new pdo
$dbh = new PDO("mysql:host=".$config['host'].";dbname=".$config['db'],$config['user'],$config['pass']);


//构造sql语句
$sql = "select * from user where name=:name and pass=:pass";
//预处理
$stmt = $dbh->prepare($sql);
//接收参数
$user = $_POST['name'];// get 或 post
$pass=$_POST['pass'];   // get 或 post
//参数绑定
$stmt->bindParam(':name',$user);
$stmt->bindParam(':pass',$pass);
//执行sql
$stmt->execute();
//获取结果
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$redis = new Redis();
//连接
$redis = new Redis();
$redis->connect('192.168.118.99', 6379);
$redis->auth("redis");
if($res){
    echo "登陆成功"."<br/>";
    $redis->decr("num");
    $num=$redis->get("num");
    $redis->zadd("$user","$num",time());
    $record=$redis->zrange("$user",0,10);
    echo "过去登陆时间:<br/>";
    foreach($record as $k=>$v){
       echo date("Y-m-d H:i:s",$v)."<br/>";
    }
}else{
    echo "登陆失败";
    Header("location:login.html");
}

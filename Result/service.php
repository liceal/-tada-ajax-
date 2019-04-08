<?php
header("Content-Type:text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
require_once ('Staff.php');

//$_SERVER["REQUEST_METHOD"]请求类型
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    search();
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    create();
}elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
    change();
}elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    delete();
}

//查询
function search(){
    if (!isset($_GET["number"])||empty($_GET["number"])){
        echo '{"success":"true","msg":"参数错误"}';
        return;
    }
    $number = $_GET["number"];
    $staff = new Staff();
    $result = $staff->query($number);
    echo json_encode($result);
}

//创建
function create(){
    if (!isset($_POST["name"])||empty($_POST["name"])
    ||!isset($_POST["number"])||empty($_POST["number"])
    ||!isset($_POST["sex"])||empty($_POST["sex"])
    ||!isset($_POST["job"])||empty($_POST["job"])){
        echo '{"success":"false","msg":"参数错误,员工信息填写不全"}';
        return;
    }
    $add = [
        "name"=>$_POST["name"],
        "number"=>$_POST["number"],
        "sex"=>$_POST["sex"],
        "job"=>$_POST["job"]
    ];
    $staff = new Staff();
    if ($staff->addStaffsql($add)){
        echo '{"success":"true","msg":"员工：'.$_POST["name"].'信息保存成功！"}';
    }
}

//更改
function change(){
    //urldecode 解决乱码问题
    $data = urldecode(file_get_contents('php://input'));
    $data = explode('&',$data);
    $msglist = [];
    foreach ($data as $value){
        list($key,$val) = explode('=',$value);
        $msglist[$key] = $val;
    }
    $staff = new Staff();
    $result = $staff->update($msglist);
    if ($result){
        echo '员工编号：'.$msglist['number'].'信息更改成功！';
    }else{
        echo '员工编号：'.$msglist['number'].'更改失败！';
    }
}

//删除
function delete(){
    $data = file_get_contents("php://input");
    list($key,$number) = explode("=",$data);
    $staff = new Staff();
    $result = $staff->delete($number);
    if ($result){
        echo '员工编号：'.$number.'删除成功！';
    }else{
        echo '员工编号：'.$number.'删除失败！';
    }
}
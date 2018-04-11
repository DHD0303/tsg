<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="utf8">-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--    <title>Document</title>-->
<!--</head>-->
<!--<style>-->
<!--    td {-->
<!--        width: 200px;-->
<!--        border: 1px solid black;-->
<!--        text-align: center;-->
<!--    }-->
<!--</style>-->
<!--<body>-->
<!--<form action="tsgs.php" method="post">-->
<!--    账号: <input name="username" id="username" type="text" placeholder="账号"/>-->
<!--    密码: <input name="password" id="password" type="password" placeholder="密码"/>-->
<!--    日期: <input name="date" id="date" type="text" placeholder="2017-01-01"/>-->
<!--    <input type="submit" value="查询"/>-->
<!--</form>-->
<?php

header("Content-type: text/html; charset=utf-8");
$username = $_POST['username'];
$password = $_POST['password'];
//$date = $_POST['date'];
/**
 * Created by PhpStorm.
 * User: DHD
 * Date: 2018/4/9
 * Time: 12:04
 */
include "Snoopy.class.php";
$snoopy =  new snoopy();
$url = 'http://202.197.232.4:8081/opac_two/include/login_app.jsp';
$history_url = 'http://202.197.232.4:8081/opac_two/reader/jieshulishi.jsp';
$data = array('login_type'=>'',
    'barcode'=>$username,
    'password'=>$password);
$snoopy->submit($url,$data);
$res = $snoopy->results;
$snoopy->setcookies();
$datas = array (
    'library_id' => 'A%3A%C3%8F%C3%A6%C3%8C%C2%B6%C2%B4%C3%B3%C3%91%C2%A7%C3%8D%C2%BC%C3%8A%C3%A9%C2%B9%C3%9D',
    'fromdate' => $_POST['fromdate'],
    'todate' => $_POST['todate'],
    'b1' => '%BC%EC%CB%F7'
);
$snoopy->submit($history_url, $datas);
$history = $snoopy->results;
$history = iconv("gbk", "utf-8", $history);
$history = preg_replace("/\s|&nbsp|;/","", $history);
$mode = '/<tdalign=left>(.*?)<\/td>/';
$res = array();
preg_match_all($mode, $history, $res);
$i = 0;
$history = array(array());
foreach ($res[1] as $result) {
    $history[$i/5][$i%5] = $result;
    $i++;
}
$txt = '<table>';
    $txt = $txt.'<tr><td></td><td>书名</td><td>图书编码</td><td>事件</td><td>日期</td></tr>';
foreach ($history as $result) {
    $txt = $txt. "<tr>";
    for($i=0; $i<5; $i++) {
        $txt = $txt."<td>".$result[$i]."</td>";
    }
    $txt = $txt."</tr>";
}
$txt = $txt.'</table>';
echo $txt;
//$flag = 0;
//foreach ($history as $result) {
//    if( $result[4] == $date ) {
//        echo $result[4]."<br>".$result[3]."<br>".$result[1];
//        $flag = 1;
//        break;
//    }
//}
//if( $flag == 0 ) {
//    echo "这一天没有去图书馆";
//}
?>
<!--</body>-->
<!--</html>-->
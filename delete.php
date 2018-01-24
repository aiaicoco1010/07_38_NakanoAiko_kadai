<?php
//GETでid値を取得
$id = $_GET["id"];

//PDOでデータベース接続
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gs_db;charset=utf8",'root',''); //ID PASSの順番待ち
}catch (PDOException $e) {
    exit( 'データーベースに接続できませんでした' . $e->getMessage()); //えらー手掛かり
}

// 実行したいSQL文  :で文字を置き換える
$sql = 'DELETE FROM gs_an_table WHERE id=:id';

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id,PDO::PARAM_INT); //STRは文字列、数値はINT

//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]); //止めて表示する
}else{
    header('Location: select.php');  //実行完了した場合はentry.phpにリダイレクト
    exit();
}
?>
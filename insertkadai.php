<?php
//フォームのデータ受け取り
$name = $_POST["name"];
$url = $_POST["URL"];
$text = $_POST["text"];

//PDOでデータベース接続
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gs_db;charset=utf8",'root',''); //ID PASSの順番待ち
}catch (PDOException $e) {
    exit( 'DbConnectエラー:' . $e->getMessage()); //えらー手掛かり
}

// 実行したいSQL文  :で文字を置き換える
$sql = "INSERT INTO gs_an_table ( ID, name, URL, text, time ) VALUES ( NULL, :name, :url , :text, sysdate())";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name',$name,PDO::PARAM_STR); //STRは文字列、数値はINT
$stmt->bindValue(':url',$url,PDO::PARAM_STR);
$stmt->bindValue(':text',$text,PDO::PARAM_STR);

//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]); //止めて表示する
}else{
    header('Location: register.php');  //実行完了した場合はentry.phpにリダイレクト
    exit();
}

?>
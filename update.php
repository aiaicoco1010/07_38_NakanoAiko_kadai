<?php
//GETでid値を取得
$id = $_POST["id"];
$name = $_POST["name"];
$url = $_POST["url"];
$text = $_POST["text"];

//PDOでデータベース接続
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gs_db;charset=utf8",'root',''); //ID PASSの順番待ち
}catch (PDOException $e) {
    exit( 'データーベースに接続できませんでした' . $e->getMessage()); //えらー手掛かり
}

// 実行したいSQL文  :で文字を置き換える
$sql = 'UPDATE gs_an_table SET name=:name, url=:url, text=:text WHERE id=:id';

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name',$name,PDO::PARAM_STR); //STRは文字列、数値はINT
$stmt->bindValue(':url',$url,PDO::PARAM_STR); //STRは文字列、数値はINT
$stmt->bindValue(':text',$text,PDO::PARAM_STR); //STRは文字列、数値はINT
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録表示</title>
    <link rel="stylesheet" href="css/sanitize.css"> 
    <link rel="stylesheet" href="css/style.css">
    <style></style>
</head>
<body>
<div class="container">
    <h1>登録フォーム</h1>
<div>
    <div class="container jumbtron"><?=$view?></div>
</div>
</body>
</html>
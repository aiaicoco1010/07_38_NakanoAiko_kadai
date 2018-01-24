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
$sql = "SELECT * FROM gs_an_table WHERE id=:id";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':id',$id,PDO::PARAM_INT); //STRは文字列、数値はINT
//実際に実行
$flag = $stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
$view = "";
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]); //止めて表示する
}else{
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録フォーム</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>書籍登録フォーム</h1>
    <form action="update.php" method="post">
        <ul>
            <li class="form-item">
                <label for="name">●書籍名</label>
                <input type="text" name="name" id="name" class="uk-input" value="<?=$row["name"]?>">
            </li>
            <li class="form-item">
                <label for="URL">●書籍URL</label>
                <input type="text" name="URL" id="URL" class="uk-input" value="<?=$row["URL"]?>">
            </li>
            <li class="form-item">
                <label for="text">●本文</label>
                <textArea name="text" row="4" cols="40"><?=$row["text"]?></textArea>
            </li>
        </ul>
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        <input type="submit" value="修正">
    </form>    
</div>
</body>
</html>
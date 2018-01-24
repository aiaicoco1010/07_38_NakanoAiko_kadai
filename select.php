<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=gs_db;charset=utf8",'root',''); //ID PASSの順番待ち
}catch (PDOException $e) {
    exit( 'データーベースに接続できませんでした' . $e->getMessage()); //えらー手掛かり
}

//データ登録のSQL作成
$stmt = $pdo -> prepare ("SELECT * FROM gs_an_table");
$flag = $stmt -> execute();

//データ表示
$view = "";
if($flag == false){
    $error = $stmt -> errorinfo();
    exit("ErrorQuery:".$error[2]); //止めて表示する
}else{
    while ($result = $stmt -> fetch (PDO::FETCH_ASSOC)){
        $view .='<p>';
        $view .= '<a href="correct.php?id='.$result["ID"].'">';
        $view .=$result["TIME"]."/".$result["name"];
        $view .='</a>';
        $view .=' ';
        $view .= '<a href="delete.php?id='.$result["ID"].'">';
        $view .='「削除」';
        $view .='</a>';
        $view .='</p>';
    }
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
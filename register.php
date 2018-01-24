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
    <form action="insertkadai.php" method="post">
        <ul>
            <li class="form-item">
                <label for="name">●書籍名</label>
                <input type="text" name="name" id="name" class="uk-input">
            </li>
            <li class="form-item">
                <label for="URL">●書籍URL</label>
                <input type="text" name="URL" id="URL" class="uk-input">
            </li>
            <li class="form-item">
                <label for="text">●本文</label>
                <textarea name="text" id="text" cols="30" rows="10" class="uk-textarea"></textarea>
            </li>
        </ul>
        <input type="submit" value="送信">
    </form>    
</div>
</body>
</html>
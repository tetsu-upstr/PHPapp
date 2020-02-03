<?php
session_start();
require('db_connect.php');
require('function.php');

if (!isset($_SESSION['join'])) {
  header('Location: register.php');
  exit();
}

if(!empty($_POST)) {
  $statement = $pdo->prepare('INSERT INTO users SET name=?, email=?, password=?, created=NOW()');
  $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password']),
  ));
  
  unset($_SESSION['join']);
  header('Location: thanks.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>register check</title>
</head>

<body>
<div class="wrap">
  <header>
      <h2 >会員登録</h2>
  </header>

  <div class="register">
    <p >入力した情報が正しければ「登録」ボタンをクリックしてください。</p>
    <form action="" method="post">
      <input type="hidden" name="action" value="submit" />
      <dl>
        <dt><label for="name">名前</label></dt>
        <dd>
        <?php print(h($_SESSION['join']['name'])); ?>
        </dd>
        <dt><label for="email">メールアドレス</label></dt>
        <dd>
        <?php print(h($_SESSION['join']['email'])); ?>
        </dd>
         <dt><label for="password">パスワード</label></dt>
        <dd>
        【表示されません】
        </dd>
      </dl>
      <div><a href="register.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input class="btn" type="submit" value="登録" /></div>
    </form>
  </div>
</div>
  
</body>
</html>
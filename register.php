<?php
session_start();
require('db_connect.php');
require('function.php');

// エラーチェック
if (!empty($_POST)) {
  if ($_POST['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] === '') {
    $error['email'] = 'blank';
  }
  if (strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }
  if ($_POST['password'] === '') {
    $error['password'] = 'blank';
  }

  // 重複チェック
  if (empty($error)) {
    $users = $pdo->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email=?');
    $users->execute(array($_POST['email']));
    $record = $users->fetch();
    if ($record['cnt'] > 0 ) {
      $error['email'] = 'duplication';
    }
  }

  // エラーがなければ登録確認画面へジャンプ
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: register_check.php');
    exit();
  }
}

// 書き直す場合
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
  $_POST = $_SESSION['join'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>register</title>
</head>

<body>
<div class="wrap">
  <header>
      <h2 >会員登録</h2>
  </header>

  <div class="register">
    <p >会員情報を入力してください。</p>
    <form action="" method="post">
      <dl>
        <dt><label for="name">名前</label></dt>
        <dd>
         <input type="text" name="name" size="35" maxlength="255" value="<?php print h($_POST['name']); ?>" />
         <?php if($error['name'] == 'blank'): ?>
         <p class="error">名前を入力してください。</p>
         <?php endif; ?>
        </dd>

        <dt><label for="email">メールアドレス</label></dt>
        <dd>
         <input type="email" name="email" size="35" maxlength="255" value="<?php print h($_POST['email']); ?>" />
         <?php if($error['email'] == 'blank'): ?>
         <p class="error">メールアドレスを入力してください。</p>
         <?php endif; ?>
         <?php if($error['email'] == 'duplication'): ?>
         <p class="error">メールアドレスは既に登録されています。</p>
         <?php endif; ?>
         </dd>
         <dt><label for="password">パスワード</label></dt>
         <dd>
          <input type="password" name="password" size="35" maxlength="20" value="<?php print h($_POST['password']); ?>" />
          <?php if($error['password'] == 'blank'): ?>
          <p class="error">パスワードを入力してください。</p>
          <?php endif; ?>
          <?php if($error['password'] == 'length'): ?>
          <p class="error">パスワードは4文字以上にしてください。</p>
          <?php endif; ?>
        </dd>
      </dl>
      <div><input class="btn" type="submit" value="入力内容を確認する" /></div>
    </form>
  </div>
</div>
  
</body>
</html>
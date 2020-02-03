<?php
session_start();
require('db_connect.php');
require('function.php');

if ($_COOKIE['email'] !== '') {
  $email = $_COOKIE['email'];
}

// ログインチェック
if (!empty($_POST)) {

  // $_POSTがあれば$emailのクッキーの値を上書き
  $email = $_POST['email'];

  if ($_POST['email'] !== '' && $_POST['password'] !== '' ) {
    $login = $pdo->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));

    // データが返ってきていればログインが成功
    $user = $login->fetch();

    // $userの値が入っている（=ture）ならログイン処理
    if ($user) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['time'] = time();

      // メールアドレスをクッキーに14日間、保存
      if ($_POST['save'] === 'on') {
        setcookie('email', $_POST['email'], time()+60*60*24*14);
      }
      header('Location: index.php');
      exit();

    } else {
      $error['login'] = 'failed';
    }

  } else {
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <title>login</title>
</head>

<body>
<div class="wrap">
  <header>
      <h2 >ログイン</h2>
  </header>

  <div>
    <div>
      <p>メールアドレスとパスワードを記入してログインしてください。</p>
      <p><a href="register.php">会員登録はコチラ<i class="fas fa-external-link-alt fa-fw"></i></a></p>
    </div>
    <form action="" method="post">
      <dl>
        <dt>メールアドレス</dt>
        <dd>
          <input type="text" name="email" size="35" maxlength="255" value="<?php print h($email); ?>" />
          <?php if($error['login'] == 'blank'): ?>
          <p class="error">メールアドレスとパスワードを入力してください。</p>
          <?php endif; ?>
          <?php if($error['login'] == 'failed'): ?>
          <p class="error">ログインに失敗しました。正しくご記入ください。</p>
          <?php endif; ?>
        </dd>
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255" value="<?php print h($_POST['password']); ?>" />
        </dd>
        <dt>ログイン情報の記録</dt>
        <dd>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">自動ログイン</label>
        </dd>
      </dl>
      <div>
        <input class="btn" type="submit" value="ログイン" />
      </div>
    </form>
  </div>
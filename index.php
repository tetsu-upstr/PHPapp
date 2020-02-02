<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>Document</title>
</head>

<body>
<div class="wrap">
  <header>
    <div class="header">
      <h2 class="header__title">会員登録</h2>
    </div>
  </header>

  <div class="input-form">
    <p class="input__title">会員情報を入力してください。</p>
    <form action="" method="post">
      <dl>
        <dt><label class="input__label" for="email">メールアドレス</label></dt>
        <dd>
         <input type="email" name="email" size="35" maxlength="255" />
        </dd>
         <dt><label class="input__label" for="password">パスワード</label></dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="20" />
        </dd>
      </dl>
      <div><input class="btn" type="submit" value="入力内容を確認する" /></div>
    </form>
  </div>
</div>
  
</body>
</html>
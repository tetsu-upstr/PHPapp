<?php 
session_start();
require('db_connect.php');
require('function.php'); 

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
      <h2 >会員画面</h2>
  </header>
  <p>こんにちは<?php print h($user['name']); ?>さん<span><a href="logout.php">ログアウトする</a></span></p>

  <nav>
    <ul>
      <li>見積書</li>
      <li>商品</li>
    </ul>

  </nav>
  
  <div>
    
  
 
   
  </div>
</div>
  
</body>
</html>
<?php
try {
  // XAMMP ローカル接続
  $pdo = new PDO(
    'mysql:dbname=PHPapp;host=localhost;charset=utf8mb4',
    'root',
    '');
    
  // PDOのエラーレポートを表示
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
  var_dump($e);
}
?>
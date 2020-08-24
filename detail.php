<?php
require_once('dbc.php');

$result = getBlog($_GET['id']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ管理</title>
</head>
<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル:<?php echo $result['title']?></h3>
    <p>投稿日時:<?php echo $result['post_at']?></p>
    <p>カテゴリ:<?php echo setCategoryName($result['category']);?></p>
    <hr>
    <p>本文:<?php echo $result['content']?></p>
</body>
</html>

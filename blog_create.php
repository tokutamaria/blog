<?php
require('dbc.php');
ini_set('display_errors', 1);

$blogs = $_POST;

if (empty($blogs['title'])) {
    exit('タイトルを入力して下さい');
}
if (mb_strlen($blogs['title']) > 200) {
    exit('タイトルは200文字以下にして下さい');
}
if (empty($blogs['content'])) {
    exit('本文を入力して下さい');
}
if (empty($blogs['category'])) {
    exit('カテゴリーは必須です');
}
if (empty($blogs['publish_status'])) {
    exit('公開ステータスは必須です');
}

$sql = 'INSERT INTO
            blog (title, content, category, publish_status)
        VALUES (:title, :content, :category, :publish_status)';

$dbh = dbConnect();
$dbh->beginTransaction();
try {
    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
    $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
    $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
    $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_INT);
    $stmt->execute();
    $dbh->commit();
}catch(PDOException $e) {
    $dbh->rollBack();
    exit($e);
}


?>

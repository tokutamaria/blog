<?php
function dbConnect() {          //DB接続
    $dsn = 'mysql:host=localhost;port=3306;dbname=blog_app;charset=utf8';
    $user=  'blog_user';
    $pass= 'popmoka0721';

    try {
        $dbh = new PDO($dsn, $user, $pass,);
        }catch (PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        };
        return $dbh;
}

function getAllBlog() {         //ブログ記事取得
$dbh = dbConnect();

$sql = 'SELECT * FROM blog';
$stmt = $dbh->query($sql);

 $result = $stmt->fetchall(PDO::FETCH_ASSOC);

return $result;
$dbh = null;


}

$blogData = getAllBlog();           //取得したデータを表示

function setCategoryName($category) {           //カテゴリー別に分類
    if ($category === '1') {
        return 'ブログ';
    }elseif ($category === '2') {
        return '日常';
    } else {
        return 'その他';
    }
}

function getBlog($id) {
    if (empty($id)) {
    exit('IDが正しくありません。');
    }


    $dbh = dbConnect();
    $stmt = $dbh->prepare('SELECT * FROM blog WHERE id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        exit('ブログ記事がありません。');
    }
}

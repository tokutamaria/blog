<?php
function dbConnect () {
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

function getAllBlog() {
$dbh = dbConnect();

$sql = 'SELECT * FROM blog';
$stmt = $dbh->query($sql);

 $result = $stmt->fetchall(PDO::FETCH_ASSOC);

return $result;
$dbh = null;


}

$blogData = getAllBlog();

function setCategoryName($category) {
    if ($category === '1') {
        return 'ブログ';
    }elseif ($category === '2') {
        return '日常';
    } else {
        return 'その他';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>ブログ一覧</title>
</head>
<body>
    <h1>ブログ一覧</h1>
    <table>
        <tr>
            <th>No</th>
            <th>タイトル</th>
            <th>カテゴリ</th>
        </tr>
        <?php foreach($blogData as $column) :?>
        <tr>
            <td><?php echo $column['id'] ?></td>
            <td><?php echo $column['title'] ?></td>
            <td><?php echo setCategoryName($column['category'] )?></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>

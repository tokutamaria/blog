<?php
require_once('dbc.php');
ini_set('display_errors', "On");

Class Blog extends Dbc
{
    protected $table_name = 'blog';

    public function setCategoryName($category) {           //カテゴリー別に分類
        if ($category === '1') {
            return '日常';
        }elseif ($category === '2') {
            return 'プログラミング';
        } else {
            return 'その他';
        }
    }

     function blogCreate($blogs) {                         //新規作成
        $sql = 'INSERT INTO
                    blog (title, content, category, publish_status)
                VALUES (:title, :content, :category, :publish_status)';

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
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
    }
}
?>

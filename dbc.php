<?php
ini_set('display_errors', "On");

Class Dbc
{
    protected $table_name;

    protected function dbConnect() {          //DB接続
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

    public function getAll() {         //記事取得
        $dbh = $this->dbConnect();

        $sql = "SELECT * FROM $this->table_name";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
    }

    public function getById($id) {          //詳細を取得
        if (empty($id)) {
            exit('IDが正しくありません。');
        }

        $dbh = $this->dbConnect();
        // $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $dbh->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            exit('ブログ記事がありません。');
        }
    }
}

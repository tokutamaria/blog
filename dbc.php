<?php

Class Dbc {
    protected $table_name;

    protected function dbConnect() {
        $dbh = 'mysql:host=localhost;post=3306;dbname=blog_app;charset=utf8';
        $user = 'blog_user';
        $pass = 'popmoka0721';

        try {
            $dbh = new PDO($dbh,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);

            } catch(PDOException $e) {
                echo '接続失敗' . $e->getMessage();
                exit();
            }

            return $dbh;
        }

        public function getAll() {
            $dbh = $this->dbConnect();

            $sql = "SELECT * FROM $this->table_name";
            $stmt = $dbh->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            $dbh = null;
        }

        // $blogData = $this->getAllBlog();



        public function getById($id) {
            if(empty($id)) {
                exit('IDが不正です');
            }


            $dbh = $this->dbConnect();

            $stmt = $dbh->prepare("SELECT * FROM $this->table_name Where id = :id");
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$result) {
                exit('ブログがありません');
            }

            return $result;
        }
    }
        ?>

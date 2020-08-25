<?php
require_once('blog.php');

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

$blog = new Blog();
$blog->blogCreate($blogs);

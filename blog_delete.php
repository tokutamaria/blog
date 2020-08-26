<?php
require_once('blog.php');
// ini_set('display_errors', on);

$blog = new Blog();
$result = $blog->delete($_GET['id']);

?>

<p><a href="index.php">戻る</a></p>

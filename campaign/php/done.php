<?php

session_start();



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>応募フォーム</title>
  <link rel="stylesheet" href="css/style_base.css">
  <link rel="stylesheet" href="css/style_done.css">
</head>
<body>
  <div class="white_bg">
    <div class="contents">
      <div class="top_bg">
        <h1>ドーナツがもらえるキャンペーン</h1>
      </div>
      <div class="massage_done">
        <p>ご応募ありがとうございます。<br>結果確認用パスワードをお控え下さい</p>
      </div>
      <div class="pass_done">
        <p>結果確認用パスワード:</p>
        <p class="pass_red"><?php echo $_SESSION['password']; ?></p>
      </div>
      <div class="top_btn">
      <p>早速応募する！</p>
        <a href="login.php"></a>
      </div>
    </div>
  </div>
</body>
</html>
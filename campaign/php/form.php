<?php

require_once('config.php');
require_once('functions.php');

session_start();

if (($_SESSION['id']))
{
  header('Location: result.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $adnum_a = $_POST['adnum_a'];
  $adnum_b = $_POST['adnum_b'];
  $adress = $_POST['adress'];
  $checkbox = $_POST['checkbox'];
  $password = $_POST['password'];

  $errors = array();

    // バリデーション
  if ($name == '')
  {
    $errors['name'] = 'ユーザネームが未入力です';
  }

  if ($email == '')
  {
    $errors['email'] = 'メールアドレスが未入力です';
  }

  if ($adnum_a == '' || $adnum_b == '')
  {
    $errors['adnum'] = '郵便番号が未入力です';
  }

  if ($adress == '')
  {
    $errors['adress'] = '住所が未入力です';
  }

  if($checkbox == ''){
    $errors['checkbox'] = '応募規約に同意して下さい';
  }

    // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();

    $sql = "insert into users (name, email, adnum_a, adnum_b, adress,created_at,password) values (:name, :email, :adnum_a, :adnum_b, :adress, now(),:password);";
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":adnum_a", $adnum_a);
    $stmt->bindParam(":adnum_b", $adnum_b);
    $stmt->bindParam(":adress", $adress);
    $stmt->bindParam(":password",$password);
    $stmt->execute();

    $sql = "select * from users where name = :name and password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $row = $stmt->fetch();

    var_dump($row);

    $_SESSION['password'] = $row['password'];
    $_SESSION['id'] = $row['id'];

    header('Location: done.php');
    exit;

  }
}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>応募フォーム</title>
  <link rel="stylesheet" type="text/css" href="css/style_form.css">
</head>
<body>
  <div class="white_bg">
    <div class="contents">
      <div class="top_bg">
        <h1>ドーナツがもらえるキャンペーン</h1>
      </div>
      <div class="form">
        <form action="" method="post">
          <table>
            <tr>
              <th>お名前</th>
              <td>
                <input class="input" name="name" type="text"
                value="<?php echo $name?>">
                <p class="vali_red"><?php if ($errors['name']) : ?>
                  <?php echo h($errors['name']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
            <tr>
              <th>メールアドレス</th>
              <td>
                <input class="input" name="email"type="text"
                value="<?php echo $email?>">
                <p class="vali_red"><?php if ($errors['email']) : ?>
                  <?php echo h($errors['email']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
            <tr>
              <th>郵便番号</th>
              <td>
                <input class="input_a" name="adnum_a" type="text"
                value="<?php echo $adnum_a?>">
                -<input class="input_b" name="adnum_b" type="text"
                value="<?php echo $adnum_b?>">
                <p class="vali_red"><?php if ($errors['adnum']) : ?>
                  <?php echo h($errors['adnum']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
            <tr>
              <th>ご住所</th>
              <td>
                <input class="input" name="adress" type="text"
                value="<?php echo $adress ?>">
                <p class="vali_red"><?php if ($errors['adress']) : ?>
                  <?php echo h($errors['adress']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
          </table>
          <div class="message_form">
            <p>応募規約:<br>ドーナツは抽選で当たった方にプレゼントします</p>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="checkbox" value="1"> 応募規約に同意する
            <p class="vali_red_2"><?php if ($errors['checkbox']) : ?>
              <?php echo '※ ⇧' . h($errors['checkbox'] . '⇧ ※') ?>
            <?php endif; ?></p>
          </div>
          <div class="form_btn">
            <button type="submit">上記の内容でキャンペーンへ応募する</button>
          </div>
          <input type="hidden" name="password"
          value="<?php echo rand(0,9999999)?>">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
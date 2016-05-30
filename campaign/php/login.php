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
  $email = $_POST['email'];
  $password = $_POST['password'];

  $errors = array();

    // バリデーション
  if ($email == '')
  {
    $errors['email'] = 'メールアドレスが未入力です';
  }

  if ($password == '')
  {
    $errors['password'] = 'パスワードが未入力です';
  }

    // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();

    $sql = "select * from users where email = :email and password = :password";
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);

    $stmt->execute();

    $row = $stmt->fetch();

    if ($row)
    {
      $_SESSION['id'] = $row['id'];
      header('Location: result.php');
      exit;
    }
    else
    {
      $errors['emailandpassword'] = 'メールアドレスかパスワードが正しくありません';
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>応募フォーム</title>
  <link rel="stylesheet" href="css/style_base.css">
  <link rel="stylesheet" href="css/style_login.css">
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
              <th>メールアドレス</th>
              <td>
                <input class="input" name="email"type="text"
                value="<?php echo $email ?>">
                <p class="vali_red"><?php if ($errors['email']) : ?>
                  <?php echo h($errors['email']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
            <tr>
              <th>結果確認用パスワード</th>
              <td>
              <input class="input_a" name="password" type="text" value="<?php echo $password ?>">
                <p class="vali_red"><?php if ($errors['password']) : ?>
                  <?php echo h($errors['password']) ?>
                <?php endif; ?></p>
              </td>
            </tr>
          </table>
          <div class="form_btn">
            <button type="submit">結果確認</button>
          </div>
        </form>
        <p class="vali_red_2">
          <?php if ($errors['emailandpassword']) : ?>
            <?php echo h($errors['emailandpassword']) ?>
          <?php endif; ?>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
<?php



$result = rand(0,10);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>応募フォーム</title>
  <link rel="stylesheet" href="css/style_base.css">
  <link rel="stylesheet" href="css/style_result.css">
</head>
<body>
  <div class="white_bg">
    <div class="contents">
      <div class="top_bg">
        <h1>ドーナツがもらえるキャンペーン</h1>
      </div>
      <div class="result_message">
        <p>キャンペーン結果</p>
      </div>
      <div class="result">
        <p class="result_red">
        <?php if($result > 7) :?>
            <?php echo "おめでとうございます!<br>当たりです!" ?>
          <?php else : ?>
            <?php echo "残念...<br>ハズレです......." ?>
          <?php endif ; ?>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
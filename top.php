<?php
  // タイムゾーンの設定
  date_default_timezone_set('Asia/Tokyo');

  // 変数の初期化
  $message = array();
  $message_array = array();

  // DB接続
  $pdo = new PDO('mysql:host=localhost;dbname=shimane;charset=utf8', 'root', 'root');

  // 送信されたらDBに保存
  if (!empty($_POST['btn_submit'])) {
      $stmt = $pdo->prepare("INSERT INTO messages (view_name, message, post_date) VALUES (?, ?, NOW())");
      $stmt->execute([$_POST['view_name'], $_POST['message']]);
      // ✅ 完了メッセージ用のフラグを付けてリダイレクト
      header("Location: " . $_SERVER['PHP_SELF'] . "?status=ok");
      exit;
  }

  // データ取得
  $stmt = $pdo->query("SELECT view_name, message, post_date FROM messages ORDER BY post_date DESC");
  $message_array = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT BootCamp@島根</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ✅ 投稿完了メッセージ表示 -->
    <?php if (isset($_GET['status']) && $_GET['status'] === 'ok'): ?>
      <div class="container mt-3">
          <div class="alert alert-success text-center" role="alert">
              投稿が完了しました！
          </div>
      </div>
    <?php endif; ?>
    <!-- ヘッダー部分 -->
    <div class="container mt-5 text-center">
        <h1 class="fw-bold">SNSシステム</h1>
        <a href="admin.html" class="btn btn-success mt-3">登録画面</a>
    </div>

    <!-- 投稿一覧 -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-100"> <!-- ✅ 幅を広げる -->
                <?php foreach($message_array as $value) { ?>
                    <div class="card shadow-sm mb-3 w-100"> <!-- ✅ 横長にする -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($value["view_name"]); ?></h5>
                            <hr>
                            <p class="card-text"><?= nl2br(htmlspecialchars($value["message"])); ?></p>
                            <p class="text-end text-muted small"><?= htmlspecialchars($value["post_date"]); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

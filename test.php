<?php
    date_default_timezone_set('Asia/Tokyo');
    define("FILENAME","./data.txt");
    $message = array();
    $message_array = array();
    if(!empty($_POST['btn_submit'])) {
        if($file_handle = fopen(FILENAME,"a")){
            $now_date = date("Y-m-d H:i:s");
            $data = "'" . $_POST['view_name'] . "','" . $_POST['message'] . "','" . $now_date . "'\n";
            fwrite($file_handle, $data);
            fclose($file_handle);
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ受け取りページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="fw-bold">SNSシステム</h1>
        <a href="admin.html" class="btn btn-success mt-3">登録画面</a>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-100">
                <div class="card shadow-sm mb-3 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold"><?= $view_name;?></h5>
                        <hr>
                        <p class="card-text"><?= $message;?></p>
                        <p class="text-end text-muted small"><?= $now_date;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

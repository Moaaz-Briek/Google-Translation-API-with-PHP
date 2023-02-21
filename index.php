<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = "https://script.google.com/macros/s/AKfycbyd-UTboKK1lhU1kSVFiTdMJSZF3ZrsDuUjPrE6p0xaQa1mjpoPBOcg9b3f0GCBZg/exec";
    $data = curl_init($url);
    curl_setopt_array($data, [
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POSTFIELDS => http_build_query([
            'source_language' => $_POST['source_language'],
            'target_language' => $_POST['target_language'],
            'input' => $_POST['input'],
        ]),
    ]);
    $result = curl_exec($data);
    $result = json_decode($result, 1);
    if ($result['status'] === 'success') {
        $output = $result['TranslatedText'];
        $input = $_POST['input'];
    } else {
        $output = "Error : " . $result['message'];
    }
    curl_close($data);
}
?>
<!DOCTYPE>
<html>
    <head>
        <title>Translation</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container mt-5">
            <form action="" method="post">
                <div class="form-group">
                    <h3 class="form-label">Source Language</h3>
                    <select class="form-control" name="source_language">
                        <option value="auto">Auto Detect</option>
                        <option value="en">English</option>
                        <option value="ar">Arabic</option>
                        <option value="hi">Hindi</option>
                        <option value="es">Spanish</option>
                        <option value="ko">Korean</option>
                        <option value="pl">Polish</option>
                        <option value="ru">Russian</option>
                    </select>
                </div>
                <div class="form-group">
                    <h3 class="form-label">Target Language</h3>
                    <select class="form-control" name="target_language">
                        <option value="en">English</option>
                        <option value="ar">Arabic</option>
                        <option value="hi">Hindi</option>
                        <option value="es">Spanish</option>
                        <option value="ko">Korean</option>
                        <option value="pl">Polish</option>
                        <option value="ru">Russian</option>
                    </select>
                </div>
                <div class="form-group">
                    <h3 class="form-label">Input</h3>
                    <textarea class="form-control" name="input"><?= isset($input) ? $input : '' ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary mt-2">Translate</button>
                </div>
            </form>
            <div class="form-group">
                <h3 class="form-label">Output</h3>
                <textarea class="form-control" name="output"><?= isset($output) ? $output : '' ?></textarea>
            </div>
        </div>
    </body>
</html>
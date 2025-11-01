<?php
// === CONFIGURATION ===
$botToken = "7501008142:AAEdZxcN569y9k2Bdlh-3UBE9amZ-jQS8WI";  // ← Yahan apna token daalo
$filePath = "file-sender/Flying Modi.apk";     // ← Jo file bhejna hai, uska path
$telegramApi = "https://api.telegram.org/bot$botToken/sendDocument";
// =====================

if ($_POST['chat_id']) {
    $chatId = $_POST['chat_id'];

    // File upload ke liye CURL
    $postFields = [
        'chat_id' => $chatId,
        'document' => new CURLFile(realpath($filePath))
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramApi);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result['ok']) {
        echo "<h2>Success! File bhej di gayi hai aapke Telegram pe!</h2>";
        echo "<p>Chat ID: <b>$chatId</b></p>";
        echo "<a href='index.html'>Wapas Jao</a>";
    } else {
        echo "<h2>Error!</h2>";
        echo "<p>Galat Chat ID ya bot issue.</p>";
        echo "<pre>" . print_r($result, true) . "</pre>";
    }
} else {
    echo "Chat ID nahi mila!";
}

?>

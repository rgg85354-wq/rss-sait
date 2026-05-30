<?php
// save_news.php - сохраняет новости в файл news.json
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$newsFile = 'news.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['news'])) {
        file_put_contents($newsFile, json_encode($data['news'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No news data']);
    }
} else {
    // GET запрос - просто возвращаем новости
    if (file_exists($newsFile)) {
        echo file_get_contents($newsFile);
    } else {
        echo json_encode([]);
    }
}
?>
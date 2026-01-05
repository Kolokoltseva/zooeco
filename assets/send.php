<?php
// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Получаем данные из формы
    $fio = isset($_POST['fio']) ? trim($_POST['fio']) : '';
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
    $com = isset($_POST['com']) ? trim($_POST['com']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    // Безопасная обработка
    $fio = htmlspecialchars($fio, ENT_QUOTES, 'UTF-8');
    $tel = htmlspecialchars($tel, ENT_QUOTES, 'UTF-8');
    $com = htmlspecialchars($com, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    
    
    // Формируем тему письма
    $subject = "Новая заявка с сайта от " . date('d.m.Y H:i');
    
    // Формируем тело письма
    $message = "
    <html>
    <head>
        <title>Заявка с сайта</title>
    </head>
    <body>
        <h2>Новая заявка с сайта</h2>
        <p><strong>Дата:</strong> " . date('d.m.Y H:i') . "</p>
        <p><strong>ФИО:</strong> $fio</p>
        <p><strong>Телефон:</strong> $tel</p>
        " . (!empty($email) ? "<p><strong>Email:</strong> $email</p>" : "") . "
        <p><strong>Комментарий:</strong><br>$com</p>
    </body>
    </html>
    ";
    
    // Заголовки письма
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: Сайт <noreply@вашсайт.ru>\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Отправляем письмо
    $to = "kolokol200423@mail.ru";
    
    if (mail($to, $subject, $message, $headers)) {
        //  показать сообщение на той же странице:
        echo "<script>alert('Письмо успешно отправлено!'); window.location.href = '../index.html';</script>";
    } else {
        echo "Ошибка при отправке сообщения. Пожалуйста, попробуйте позже.";
    }
    
} else {
    // Если кто-то пытается открыть файл напрямую
    header('Location: index.html');
}
?>
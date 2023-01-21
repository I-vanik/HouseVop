<?php
try{
    // продключение к БД
    $dsn = 'mysql:host=www.db4free.net;dbname=housevop';
    $user = 'mimikss';
    $passw = '13133535';

    $conn = new PDO($dsn, $user, $passw);     

    // Проверка на заполненность поля
    if(empty($_POST['name'])) exit("Поле не заполнено");
    if(empty($_POST['tel'])) exit("Поле не заполнено");

    $query = "INSERT INTO message VALUES (NULL, :name, NOW())";
    $msg = $conn->prepare($query); 
    $msg->execute(['name' => $_POST['name']]);

    $msg_id = $conn->lastInsertId();

    $query = "INSERT INTO message_content VALUES (NULL, :content_tel, :message_id)";
    $msg = $conn->prepare($query);
    $msg->execute(['content_tel' => $_POST['tel'], 'message_id' => $msg_id]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
catch (PDOException $e)
{
    echo"error" .$e->getMessage();
}
?>
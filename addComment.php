<?php
if (isset($_POST['idPost'])) {
    $idPost = $_POST['idPost'];
    $comment = $_POST['comment'];
    $comment = htmlspecialchars($comment);
    $queryAddComment = "INSERT INTO komentarze (wpis_id, uzytkownik_id, komentarz) VALUES ('$idPost', NULL, '$comment');";
    $resultAddComment = $connect->query($queryAddComment);
    echo "Dodano komentarz";

}
?>
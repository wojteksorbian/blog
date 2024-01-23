<?php
if (!preg_match("/^[1-9]*$/", $id)) {
    echo "Podaj prawidłowe id posta";
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $editPost = "SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id WHERE wpisy.id=  '$id';";
        $result = mysqli_query($connect, $editPost);
        $rowPosts = mysqli_fetch_assoc($result);
        echo '<div class="card mb-4">
    <div class="card-header">Edytuj post</div>
    <div class="card-body">
        <form method="post" action="">
            <div class="input-group">
                <input class="form-control" placeholder="Tytuł artykułu" name="title" type="text" maxlength="100" value=" ' . $rowPosts['tytul'] . ' "required/>
            </div>
            <textarea class="form-control"id="description" placeholder="Treść artykułu" name="description" rows="3"  maxlength="1000" required>' . $rowPosts['zawartosc'] . '</textarea>
            <button class="btn btn-primary" id="button-search" name="edit" type="submit">Zaktualizuj post</button>
        </form>
    </div>
    </div>';
        if (isset($_POST['edit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $title = htmlspecialchars($title);
            $description = htmlspecialchars($description);
            $updatePost = "UPDATE wpisy SET tytul='$title', zawartosc='$description' WHERE id='$id';";
            if ($connect->query($updatePost) == TRUE) {
                echo "Post został zaktualizowany";
            } else {
                echo "Wystąpił błąd podczas aktualizowania posta";
            }
        }
    }
}
?>
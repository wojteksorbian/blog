<?php
if (!preg_match("/^[1-9]*$/", $id)) {
    echo "Podaj prawidłowe id posta";
} else {
    echo '<div class="card mb-4">
<div class="card-header">Dodaj post</div>
<div class="card-body">
    <form method="post" action="">
        <div class="input-group">
            <input class="form-control" name="title" type="text" placeholder="Tytuł posta" maxlength="100" required oninput="check(this)"/>
        </div>
        <p id="length"> </p>
        <textarea class="form-control" placeholder="Treść artykułu" id="description" name="description" rows="3" maxlength="1000" required oninput="check2(this)"></textarea>
        <p id="length2"> </p>
        <button class="btn btn-primary" id="button-search" name="add" type="submit">Dodaj post</button>
    </form>
</div>
</div>';
    if (isset($_POST['add'])) {
        $date = date("Y-m-d");
        $title = $_POST['title'];
        $description = $_POST['description'];
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $addPost = "INSERT INTO `wpisy` (`id`, `tytul`, `data_publikacji`, `zawartosc`, `uzytkownik_id`) VALUES (NULL, '$title', '$date', '$description', NULL);";
        if ($connect->query($addPost) == TRUE) {
            echo "Post został dodany";
        } else {
            echo "Błąd związany z dodawaniem posta";
        }
    }
}
?>
<script>
function check(input) {
    document.getElementById("length").innerText = "Do wpisania pozostało: " + (100 - input.value.length) + " znaków";
}
function check2(input){
    document.getElementById("length2").innerText = "Do wpisania pozostało: " + (1000 - input.value.length) + " znaków";
}

</script>
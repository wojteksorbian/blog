<?php
$akcja = isset($_GET["akcja"]) ? $_GET["akcja"] : "";
$typ = isset($_GET["typ"]) ? $_GET["typ"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
if ($akcja == "pokaz") {
    if ($typ == "wpis") {
        if (!preg_match("/^[1-9]*$/", $id)) {
            echo "Podaj prawidłowe id posta";
        } else {
            $queryPosts = "SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc, wpisy.data_publikacji, uzytkownicy.nazwa FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id WHERE wpisy.id=  '$id';";
            $resultPosts = $connect->query($queryPosts);
            while ($rowPosts = $resultPosts->fetch_assoc()) {
                echo '<div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                            alt="..." /></a>
                        <div class="card-body">
                        <p> Post wyświetlony po url </p>
                        <div class="small text-muted">Autor: ' . $rowPosts['nazwa'] . '</div>
                        <div class="small text-muted">Data dodania posta: ' . $rowPosts['data_publikacji'] . '</div>
                        <h2 class="card-title">' . $rowPosts['tytul'] . '</h2>
                        <p class="card-text">' . $rowPosts['zawartosc'] . '</p>
                        <a class="btn btn-primary" href="index.php?akcja=pokaz&typ=wpis&id=' . $rowPosts['id'] . '">Read more →</a><br>';
                        $postId = $rowPosts['id'];
                        $queryTag = "SELECT tagi.tag FROM tagi WHERE tagi.wpis_id = '$postId';";
                        $resultTag = $connect->query($queryTag);
                        echo "Tagi: <br>";
                        while ($rowTag = $resultTag->fetch_assoc()){
                            echo "-" . $rowTag["tag"] . "<br>";
                        }
                        $queryCategory = "SELECT kategorie.kategoria FROM kategorie WHERE kategorie.wpis_id = '$postId';";
                        $resultCategory = $connect->query($queryCategory);
                        echo "Kategorie: <br>";
                        while ($rowCategory = $resultCategory->fetch_assoc()){
                            echo "-" . $rowCategory["kategoria"] . "<br>";
                        }
                        echo '<p class="card-text">Komentarze: </p>';

                $postId = $rowPosts['id'];
                $queryComments = "Select komentarze.komentarz, komentarze.uzytkownik_id, uzytkownicy.nazwa FROM komentarze LEFT JOIN uzytkownicy ON komentarze.uzytkownik_id=uzytkownicy.id WHERE komentarze.wpis_id =  '$postId';";
                $resultComments = $connect->query($queryComments);
                while ($rowComments = $resultComments->fetch_assoc()) {
                    echo '<p class="card-text"> ' . $rowComments['nazwa'] . ': ' . $rowComments['komentarz'] . '</p>';
                }

                echo '<form action="" method="post">
                        <input type="hidden" name="idPost" value="' . $rowPosts['id'] . '">
                        <div class="form-group">
                        <textarea class="form-control" placeholder="Treść komentarza" id="comment" name="comment" rows="3" maxlength="1000" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Dodaj komentarz">
                    </form>

                    </div>
                </div>';
            }
        }
    } else if ($typ == "kategoria") {
        include("categories.php");
    } else if ($typ == "tag") {
        include("tags.php");
    }
} else if ($akcja == "edytuj") {
    if ($typ == "wpis") {
        include "editPost.php";
    }
} else if ($akcja == "dodaj") {
    if ($typ == "wpis") {
        include "addPost.php";
    }
}
?>
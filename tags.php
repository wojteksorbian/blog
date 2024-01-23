<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = htmlspecialchars($id);
    $searchTags = "SELECT wpisy.id, wpisy.tytul, uzytkownicy.nazwa, wpisy.data_publikacji, wpisy.zawartosc, tagi.tag FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id LEFT JOIN tagi ON wpisy.id=tagi.wpis_id WHERE tagi.tag= '$id';";
    $resultTags = $connect->query($searchTags);
    while ($rowPosts = $resultTags->fetch_assoc()) {
        echo '<div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                                alt="..." /></a>
                            <div class="card-body">
                            <div class="small text-muted">Post znaleziony po tagu</div>
                            <div class="small text-muted">Autor: ' . $rowPosts['nazwa'] . '</div>
                            <div class="small text-muted">Data dodania posta: ' . $rowPosts['data_publikacji'] . '</div>
                            <h2 class="card-title">' . $rowPosts['tytul'] . '</h2>
                            <p class="card-text">' . $rowPosts['zawartosc'] . '</p>
                            <a class="btn btn-primary" href="index.php?akcja=pokaz&typ=wpis&id=' . $rowPosts['id'] . '">Read more →</a>
                            <p class="card-text">Komentarze: </p>';

        $postId = $rowPosts['id'];
        $queryComments = "Select komentarze.komentarz, komentarze.uzytkownik_id, uzytkownicy.nazwa FROM komentarze LEFT JOIN uzytkownicy ON komentarze.uzytkownik_id=uzytkownicy.id WHERE komentarze.wpis_id =  '$postId';";
        $resultComments = $connect->query($queryComments);
        while ($rowComments = $resultComments->fetch_assoc()) {
            echo '<p class="card-text"> ' . $rowComments['nazwa'] . ': ' . $rowComments['komentarz'] . '</p>';
        }

        echo '<form action="" method="post">
                            <input type="hidden" name="idPost" value="' . $rowPosts['id'] . '">
                            <div class="form-group">
                            <textarea class="form-control" placeholder="Treść komentarza" id="comment" name="comment" maxlength="1000" rows="3" required></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Dodaj komentarz">
                        </form>
                        </div>
                    </div>';

    }
}



?>
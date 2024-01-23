<?php
$queryPosts = 'SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc, wpisy.data_publikacji, uzytkownicy.nazwa FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id;';
$resultPosts = $connect->query($queryPosts);
while ($rowPosts = $resultPosts->fetch_assoc()) {
    echo '<div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                            alt="..." /></a>
                        <div class="card-body">
                        <div class="small text-muted">Autor: ' . $rowPosts['nazwa'] . '</div>
                        <div class="small text-muted">Data dodania posta: ' . $rowPosts['data_publikacji'] . '</div>
                        <h2 class="card-title">' . $rowPosts['tytul'] . '</h2>
                        <p class="card-text text">' . $rowPosts['zawartosc'] . '</p>
                        <a class="btn btn-primary" href="index.php?akcja=pokaz&typ=wpis&id=' . $rowPosts['id'] . '">Read more →</a><br>';
    $postId = $rowPosts['id'];
    $queryTag = "SELECT tagi.tag FROM tagi WHERE tagi.wpis_id = '$postId';";
    $resultTag = $connect->query($queryTag);
    echo "Tagi: <br>";
    while ($rowTag = $resultTag->fetch_assoc()) {
        echo "-" . $rowTag["tag"] . "<br>";
    }
    $queryCategory = "SELECT kategorie.kategoria FROM kategorie WHERE kategorie.wpis_id = '$postId';";
    $resultCategory = $connect->query($queryCategory);
    echo "Kategorie: <br>";
    while ($rowCategory = $resultCategory->fetch_assoc()) {
        echo "-" . $rowCategory["kategoria"] . "<br>";
    }
    echo '<br><p class="card-text">Komentarze: </p>';

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



?>
<script>
    const text = document.querySelectorAll('.text');
    text.forEach((text) => {
        const fullText = text.innerText + '<br>Zwiń artykuł';
        const cutText = text.innerText.substr(0, 100) + '...<br> Wcisnij na tekst aby go rozwinąć';
        text.innerHTML = cutText;
        text.addEventListener('click', () => {
            if (text.innerHTML == cutText) {
                text.innerHTML = fullText;
            } else {
                text.innerHTML = cutText;
            }
        });
    });

    
    

</script>
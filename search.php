<?php

if (isset($_POST['search'])) {
    $text = $_POST['text'];
    $text = htmlspecialchars($text);

    $querySearch = "SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc, uzytkownicy.nazwa, uzytkownicy.id, wpisy.data_publikacji FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id WHERE wpisy.tytul LIKE '%$text%'";
    $resultSearch = $connect->query($querySearch);

    if ($resultSearch->num_rows == 0) {
        $querySearch = "SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc, uzytkownicy.nazwa, uzytkownicy.id, wpisy.data_publikacji FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id WHERE wpisy.zawartosc LIKE '%$text%'";
        $resultSearch = $connect->query($querySearch);

        if ($resultSearch->num_rows == 0) {
            $querySearch = "SELECT wpisy.id, wpisy.tytul, wpisy.zawartosc, uzytkownicy.nazwa, uzytkownicy.id, wpisy.data_publikacji FROM wpisy LEFT JOIN uzytkownicy ON wpisy.uzytkownik_id=uzytkownicy.id WHERE uzytkownicy.nazwa LIKE '%$text%'";
            $resultSearch = $connect->query($querySearch);
        }
        if ($resultSearch->num_rows > 0) {
            while ($rowSearch = $resultSearch->fetch_assoc()) {
                echo '<div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                        alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">' . $rowSearch['data_publikacji'] . '</div>
                    <h2 class="card-title">' . $rowSearch['tytul'] . '</h2>
                    <p class="card-text">' . $rowSearch['zawartosc'] . '</p>
                    <a class="btn btn-primary" href="index.php?akcja=pokaz&typ=wpis&id=' . $rowSearch['id'] . '">Read more →</a>
                </div>
            </div>';

            }
        }

        if ($resultSearch->num_rows == 0) {
            echo 'Nie znaleziono żadnego posta';
        }

    }




}

?>
<div class="row">
    <?php
    foreach ($db->osszesTV() as $row) {
        $image = null;
        if (file_exists("./tvkepek/" . $row['tv_neve'] . ".jpg")) {
            $image = "./tvkepek/" . $row['tv_neve'] . ".jpg";
        } else if (file_exists("./tvkepek/" . $row['tv_neve'] . ".jpeg")) {
            $image = "./tvkepek/" . $row['tv_neve'] . ".jpeg";
        } else if (file_exists("./tvkepek/" . $row['tv_neve'] . ".png")) {
            $image = "./tvkepek/" . $row['tv_neve'] . ".png";
        } else {
            $image = "./images/noimage.jpg";
        }
        if($_SESSION['login']){
            $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['tv_neve'] . '</h5>' .
                
                '<h5 class="card-text">' . $row['ar'] . '</h5>' .
                '<p class="card-text">Márka: ' . $row['marka'].  '</p>' .
                '<p class="card-text">Képátló: ' . $row['kepatlo'].  'cm</p>' .
                '<p class="card-text">Képfrissítés: ' . $row['hz'] . 'Hz</p>' .
                '<p class="card-text">Felbontás: ' . $row['felbontas'] . '</p>' .
                '<p class="card-text">Kijelző: ' . $row['kijelzo'] . '</p>' .
                '<p class="card-text">' . $row['megjegyzes'] . '</p>' .
                '<a href="index.php?menu=home&id=' . $row['tvid'] . '" class="btn btn-primary">Vásárlás</a>
                    </div>
                </div>
            ';
        }
        else{
            $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['tv_neve'] . '</h5>' .
                
                '<h5 class="card-text">' . $row['ar'] . '</h5>' .
                '<p class="card-text">Márka: ' . $row['marka'].  '</p>' .
                '<p class="card-text">Képátló: ' . $row['kepatlo'].  'cm</p>' .
                '<p class="card-text">Képfrissítés: ' . $row['hz'] . 'Hz</p>' .
                '<p class="card-text">Felbontás: ' . $row['felbontas'] . '</p>' .
                '<p class="card-text">Kijelző: ' . $row['kijelzo'] . '</p>' .
                '<p class="card-text">' . $row['megjegyzes'] . '</p>' .
                '<a href="index.php?menu=login" class="btn btn-primary">Vásárlás</a>
                    </div>
                </div>
            ';
        }
        echo $card;
    }
    ?>

</div>
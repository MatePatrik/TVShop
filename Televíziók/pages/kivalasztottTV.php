<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    $tvid = filter_input(INPUT_POST, "tvid", FILTER_SANITIZE_NUMBER_INT);
    $tv_neve = htmlspecialchars(filter_input(INPUT_POST, "tv_neve"));
    $ar = filter_input(INPUT_POST, "ar");
    $marka = filter_input(INPUT_POST, "marka");
    $kepatlo = filter_input(INPUT_POST, "kepatlo");
    $hz = filter_input(INPUT_POST, "hz");
    $felbontas = filter_input(INPUT_POST, "felbontas");
    $kijelzo = filter_input(INPUT_POST, "kijelzo");
    $megjegyzes = filter_input(INPUT_POST, "megjegyzes");
    $from = null;
    $to = null;
    if ($_FILES['kepfajl']['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpg";
                break;
            default:
                break;
        }
        $from = $_FILES['kepfajl']['tmp_name'];
        $to = dir(getcwd());
        $to = $to->path . DIRECTORY_SEPARATOR . "tvkepek" . DIRECTORY_SEPARATOR . $tv_neve . $kiterjesztes;
        if (copy($from, $to)) {
            echo '<p>A kép feltöltés sikeres</p>';
        } else {
            echo '<p>A kép feltöltés sikertelen!</p>';
        }
    }
    if ($db->setKivalasztottTV( $tv_neve, $ar, $marka, $kepatlo, $hz, $felbontas, $kijelzo, $megjegyzes, $tvid)) {
        echo '<p>Az adatok módosítása sikeres</p>';
        header("Location: index.php?menu=home");
    } else {
        echo '<p>Az adatok módosítása sikertelen!</p>';
    }
    } else {
        $adatok = $db->getKivalasztottTV($id);
    }
?>
<form method="post" action="index.php?menu=home&id=<?php echo $adatok['tvid']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="tvid" value="<?php echo $adatok['tvid']; ?>">
    <div class="mb-3">
        <label for="tv_neve" class="form-label">TV neve</label>
        <input type="text" class="form-control" name="tv_neve" id="tv_neve" value="<?php echo $adatok['tv_neve']; ?>"required>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="ar" class="form-label">Ár</label>
            <input type="text" class="form-control" name="ar" id="ar" value="<?php echo $adatok['ar']; ?>"required>
        </div>
        <div class="mb-3 col-6">
            <label for="marka" class="form-label">Márka</label>
            <select id="marka" name="marka" class="form-select"required>
                <?php
                foreach ($db->getMarka() as $value) {
                    if ($adatok['marka'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="kepatlo" class="form-label">Képátló(cm)</label>
            <input type="text" class="form-control" name="kepatlo" id="kepatlo" value="<?php echo $adatok['kepatlo']; ?>"required>
        </div>
        <div class="mb-3 col-6">
            <label for="hz" class="form-label">Képfrissítés</label>
            <input type="text" class="form-control" name="hz" id="hz" value="<?php echo $adatok['hz']; ?>"required>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="felbontas" class="form-label">Felbontás</label>
            <input type="text" class="form-control" name="felbontas" id="felbontas" value="<?php echo $adatok['felbontas']; ?>"required>
        </div>
        <div class="mb-3 col-4">
            <label for="kijelzo" class="form-label">Kijelző</label>
            <input type="text" class="form-control" name="kijelzo" id="kijelzo" value="<?php echo $adatok['kijelzo']; ?>"required>
        </div>
        <div class="mb-3 col-4">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <input type="text" class="form-control" name="megjegyzes" id="megjegyzes" value="<?php echo $adatok['megjegyzes']; ?>">
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>

    </div>
    <button type="submit" class="btn btn-success" value="1" name="Adatmodositas">Módosítás</button>
    <a href="index.php?menu=Vasarlas&id=<?php echo $id; ?>&tvid=<?php echo $adatok['tvid']; ?>" class="btn btn-primary">Vásárlás</a>
</form>
<?php ?>
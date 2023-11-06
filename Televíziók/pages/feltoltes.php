<?php

if (filter_input(INPUT_POST, "Adatfeltoltes", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) 
{
    $tv_neve = htmlspecialchars(filter_input(INPUT_POST, "tv_neve"));
    $ar = filter_input(INPUT_POST, "ar");
    $marka = filter_input(INPUT_POST, "marka");
    $kepatlo = filter_input(INPUT_POST, "kepatlo");
    $hz = filter_input(INPUT_POST, "hz");
    $felbontas = filter_input(INPUT_POST, "felbontas");
    $kijelzo = filter_input(INPUT_POST, "kijelzo");
    $megjegyzes = filter_input(INPUT_POST, "megjegyzes");
    $kepfajl = filter_input(INPUT_POST, "kepfajl");
    var_dump($kepfajl);
    if ($db->tvRegister($tv_neve, $ar, $marka, $kepatlo, $hz, $felbontas, $kijelzo, $megjegyzes, $kepfajl)) {
        header("Location: index.php?menu=home");
    }
}
?>
<form action="#" method="post">
    <div class="mb-3">
        <label for="tv_neve" class="form-label">TV neve</label>
        <input type="text" class="form-control" name="tv_neve" id="tv_neve" required>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="ar" class="form-label">Ár</label>
            <input type="text" class="form-control" name="ar" id="ar" required>
        </div>
        <div class="mb-3 col-6">
            <label for="marka" class="form-label">Márka</label>
            <input type="text" class="form-control" name="marka" id="marka" required>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="kepatlo" class="form-label">Képátló(cm)</label>
            <input type="number" class="form-control" name="kepatlo" id="kepatlo" required>
        </div>
        <div class="mb-3 col-6">
            <label for="hz" class="form-label">Képfrissítés</label>
            <input type="number" class="form-control" name="hz" id="hz" required>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="felbontas" class="form-label">Felbontás</label>
            <input type="text" class="form-control" name="felbontas" id="felbontas" required>
        </div>
        <div class="mb-3 col-4">
            <label for="kijelzo" class="form-label">Kijelző</label>
            <input type="text" class="form-control" name="kijelzo" id="kijelzo" required>
        </div>
        <div class="mb-3 col-4">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <input type="text" class="form-control" name="megjegyzes" id="megjegyzes" >
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" >
        </div>

    </div>
    <button type="submit" class="btn btn-success" name="Adatfeltoltes" value="true">Feltöltés</button>
</form>
<?php ?>
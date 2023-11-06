<h1>A vásárlás kezdete</h1>

<?php
    
    $userid= $_SESSION['user']['userid'];
    $tvid= filter_input(INPUT_GET, "tvid");
    $tv=$db->getKivalasztottTV($tvid);
    if (filter_input(INPUT_POST, "vasarlas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
        $button = filter_input(INPUT_POST, "vasarlas");
        var_dump($button);
        $tvid= filter_input(INPUT_POST, "tvid", FILTER_VALIDATE_INT);
        $userid= filter_input(INPUT_POST, "userid", FILTER_VALIDATE_INT);
        $db->Vasarlas($tvid, $_SESSION['user']['userid']);
        header("Location: index.php?menu=sikeres");
    }
    echo '<p>Valóban szeretné a '.$tv['tv_neve'].' nevű tvt megvásárolni?</p>';
  
?>
<form method="POST" action="#">
    <input type="hidden" name="userid" value="<?php echo $_SESSION['user']['userid']; ?>">
    <input type="hidden" name="tvid" value="<?php echo $tvid; ?>">
    <button type="submit" class="btn btn-danger" name="vasarlas" value="true">Igen</button>
    <a href="index.php?menu=home" class="btn btn-light" >Nem</a>
</form>
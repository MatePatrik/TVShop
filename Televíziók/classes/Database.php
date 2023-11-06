<?php

class Database {

    private $db = null;
    public $error = false;

    public function __construct($host, $username, $pass, $db) {
        try {
            $this->db = new mysqli($host, $username, $pass, $db);
            $this->db->set_charset("utf8");
        } catch (Exception $exc) {
            $this->error = true;
            echo '<p>Az adatbázis nem elérhető!</p>';
            exit();
        }
    }

    public function login($name, $pass) {
        //-- jelezzük a végrehajtandó SQL parancsot
        $stmt = $this->db->prepare('SELECT * FROM users WHERE users.username LIKE ?;');
        //-- elküldjük a végrehajtáshoz szükséges adatokat
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            //-- sikeres végrehajtás után lekérjük az adatokat
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($pass == $row['password']) {
                //-- felhasználónév és jelszó helyes
                $_SESSION['user'] = $row;
                $_SESSION['login'] = true;
            } else {
                $_SESSION['username'] = '';
                $_SESSION['login'] = false;
            }
            // Free result set
            $result->free_result();
            header("Location:index.php");
        }
        return false;
    }

    public function register($nev, $emailcim, $username, $password) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`userid`, `nev`, `emailcim`, `username`, `password`) VALUES (NULL,?,?,?,?)");
        $stmt->bind_param("ssss", $nev, $emailcim, $username, $password);
        try {
            if ($stmt->execute()) {
                //echo $stmt->affected_rows();
                $_SESSION['login'] = true;
                //header("Location: index.php");
            } else {
                $_SESSION['login'] = false;
                echo '<p>Rögzítés sikertelen!</p>';
            }
        } catch (Exception $exc) {
            $this->error = true;
        }
    }

    public function tvRegister($tv_neve, $ar, $marka, $kepatlo, $hz,$felbontas, $kijelzo, $megjegyzes, $kepfajl) {
        $stmt = $this->db->prepare("INSERT INTO `tv`(`tv_neve`, `ar`, `marka`, `kepatlo`, `hz`, `felbontas`, `kijelzo`, `megjegyzes`,`kep`) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiissss", $tv_neve, $ar, $marka, $kepatlo, $hz,$felbontas, $kijelzo, $megjegyzes, $kepfajl);
        $stmt->execute();
    }

    public function osszesTV() {
        $result = $this->db->query("SELECT * FROM `tv`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKivalasztottTV($id) {
        $result = $this->db->query("SELECT * FROM `tv` WHERE tvid=".$id);
       return $result->fetch_assoc();
    }

    public function setKivalasztottTV($tv_neve, $ar, $marka, $kepatlo, $hz,$felbontas, $kijelzo, $megjegyzes, $kepfajl, $tvid) {
        $stmt = $this->db->prepare("UPDATE `tv` SET `tv_neve`= ?,`ar`= ?,`marka`= ?,`kepatlo`= ?,`hz`= ?,`felbontas`= ?,`kijelzo`= ?,`megjegyzes`= ?, `kep`= ? WHERE tvid= ?");
        $stmt->bind_param('sssiisssi', $tv_neve, $ar, $marka, $kepatlo, $hz,$felbontas, $kijelzo, $megjegyzes, $kepfajl, $tvid);
        return $stmt->execute();
    }

    public function getMarka() {
        $result = $this->db->query("SELECT DISTINCT `marka` FROM `tv`;");
        return $result->fetch_all();
    }
    
    public function Vasarlas($tvid, $userid) {
        $stms=$this->db->prepare("INSERT INTO `vasarlas` (`tvid`, `userid`) VALUES(?,?);");
        $stms->bind_param("ii", $tvid, $userid);
        try {
            if ($stms->execute()) {
                //echo $stmt->affected_rows();
                $_SESSION['login'] = true;
                //header("Location: index.php");
            } else {
                $_SESSION['login'] = false;
                echo '<p>Rögzítés sikertelen!</p>';
            }
        } catch (Exception $exc) {
            $this->error = true;
        }
    } 
}

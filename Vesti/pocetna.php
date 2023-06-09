<?php
    require_once("funkcije.php");
    $db = konekcija();
    if(!$db){
        exit();
    }
    session_start();
    if(!login()){
        echo "Morate se ulogovati da prisustvovali stranici!<br>";
        echo "<a href='login.php'>Uloguj se</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pocetna.css"></link>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/objava.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="left-div">
        <h4>Prijavljeni ste kao</h2>
        <h3 id="status" data-status="<?php echo $status; ?>">
        <?php
        $emailKorisnika = $_SESSION['email'];
        $upit = "SELECT * FROM korisnici where email = '{$emailKorisnika}'";
        $rez = mysqli_query($db, $upit);
        $status = "";
        if(mysqli_num_rows($rez) == 1){
            $korisnik = mysqli_fetch_assoc($rez);
            $korisnik_id = $korisnik['korisnik_id'];
            $ime = $korisnik['ime'];
            $prezime = $korisnik['prezime'];
            $status = $korisnik['status'];
        }
        echo $ime." ".$prezime." (".$status.")";
        $date = array(
            'korisnik_id' => $korisnik_id,
            'ime' => $ime,
            'prezime' => $prezime,
            'status' => $status
        );
        $dataJson = json_encode($date);
        ?></h3><br>
            <form action="pocetna.php" method="post">
                Naslov: <input type="text" name="naslov" id="naslov"><br><br>
                <textarea name="objava" id="objava" cols="40" rows="5" placeholder="Unesite tekst objave"></textarea><br><br>
                <button id="objavi">Objavi</button><br><br>
            </form>
            <?php
                echo "<a href='login.php?odjava'>Odjavi se</a>";   
            ?>
        </div>
        <div class="right-div">
        <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status'] === 'Administrator'){
                    $upit1 = "SELECT * FROM vest";
                    $rez1 = mysqli_query($db, $upit1);
                    while($red = mysqli_fetch_assoc($rez1)){
                        echo "<div style='border: 1px solid black; padding: 10px;'><b>".$red['naslov']."</b><br><br>".$red['tekst']."<br><br><button onclick='obrisi(".$red['id'].")'>Obrisi</button></div>";
                    }
                }
                if($_SESSION['status'] === 'Korisnik'){
                    $upit2 = "SELECT * FROM vest";
                    $rez2 = mysqli_query($db, $upit2);
                    while($red1 = mysqli_fetch_assoc($rez2)){
                        echo "<div style='border: 1px solid black; padding: 10px;'><b>".$red1['naslov']."</b><br><br>".$red1['tekst']."<br><br></div>";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>


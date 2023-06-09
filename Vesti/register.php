<?php
    require_once("funkcije.php");
    $db = konekcija();
    if(!$db){
        exit();
    }
    session_start();
    if(login()){ 
        header("Location: pocetna.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>
<body>
    <h1>Registracija</h1><br>
    <form action="register.php" method="post">
        <input type="text" name="ime" id="ime" placeholder="Unesite ime"><br><br>
        <input type="text" name="prezime" id="prezime" placeholder="Unesite prezime"><br><br>
        <input type="email" name="email" id="email" placeholder="user@gmail.com"><br><br>
        <input type="password" name="lozinka" id="lozinka" placeholder="*********"><br><br>
        <select name="sel" id="sel">
            <option value="0">--Izaberitte status--</option>
            <option value="1">Korisnik</option>
            <option value="2">Administrator</option>
            <option value="3">Urednik</option>
        </select><br><br>
        <textarea name="komentar" id="komentar" cols="20" rows="5" placeholder="Dodajte komentar"></textarea><br><br>
        <button name="dugme" id="dugme">Registruj se!</button>
    </form><br><br>
    Imas nalog?<a href="login.php"> Uloguj se</a>
    <?php
        if(isset($_POST['dugme'])){
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            $status = $_POST['sel'];
            $komentar = $_POST['komentar'];
            if($ime != "" || $prezime != "" || $email != "" || $lozinka != "" || $status != "0"){
                $upit = "INSERT INTO korisnici(ime,prezime,email,lozinka,status,komentar) 
                VALUES ('$ime','$prezime','$email','$lozinka','$status','$komentar')";
                $rez = mysqli_query($db, $upit);
                $_SESSION['email'] = $email;
                $_SESSION['lozinka'] = $lozinka;
                $_SESSION['status'] = $status;
                setcookie("email", $ime, time()+86400, "/");
                setcookie("lozinka", $lozinka, time()+86400, "/");
                setcookie("status", $status, time()+86400, "/");
                header("Location: pocetna.php");
            }
            else 
                echo "Morate popuniti sva polja za registraciju!";
        }
    ?>
</body>
</html>
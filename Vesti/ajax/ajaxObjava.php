<?php
    if(isset($_GET['funkcija'])){
        require_once("C:/xampp/htdocs/Vesti/funkcije.php");
        $db = konekcija(); 
        if(!$db){
            exit();
        }
        $funkcija = $_GET['funkcija'];
        if($funkcija == 'objava'){
            $korisnik_id = $_POST['korisnik_id']
            $naslov = $_POST['naslov'];
            $tekst = $_POST['tekst'];
            if($naslov != "" && $tekst != ""){
                $upit = "INSERT INTO vest(korisnik_id,naslov,tekst) VALUES ('{$korisnik_id}','{$naslov}','{$tekst}')";
                $rez = mysqli_query($db, $upit);
                if($rez){
                    $upit2 = "SELECT * FROM vest,korisnik where korisnik.korisnik_id=vest.korisnik_id";
                    $rez2 = mysqli_query($db,$upit2);
                    while($red3 = mysqli_fetch_assoc($rez2)){
                        echo "<div style='border: 1px solid black; padding: 10px;'><b>".$red3['naslov']."</b><br><br>".$red3['tekst']."<br><br>Autor: ".$red3['ime']." ".$red3['prezime']."<button onclick='obrisi(".$red3['id'].")'>Obrisi</button></div>";
                    }
                }
                else {
                   echo "Neuspesno izvrsen upit!";
                }
            }
            else{
                echo "Morate uneti naslov i tekst da bi objavili vas materijal";
            }
        }
        if($funkcija == 'objavaK'){
            $naslov = $_POST['naslov'];
            $tekst = $_POST['tekst'];
            if($naslov != "" && $tekst != ""){
                $upit = "INSERT INTO vest(naslov,tekst) VALUES ('{$naslov}','{$tekst}')";
                $rez = mysqli_query($db, $upit);
                if($rez){
                    $upit2 = "SELECT * FROM vest";
                    $rez2 = mysqli_query($db,$upit2);
                    while($red3 = mysqli_fetch_assoc($rez2)){
                        echo "<div style='border: 1px solid black; padding: 10px;'><b>".$red3['naslov']."</b><br><br>".$red3['tekst']."<br><br></div>";
                    }
                }
                else {
                   echo "Neuspesno izvrsen upit!";
                }
            }
            else{
                echo "Morate uneti naslov i tekst da bi objavili vas materijal";
            }
        }
    }
?>
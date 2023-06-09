<?php
    if(isset($_GET['funkcija'])){
        require_once("C:/xampp/htdocs/Vesti/funkcije.php");
        $db = konekcija();
        if(!$db){
            exit();
        }
        $funkcija = $_GET['funkcija'];  
        if($funkcija == 'obrisi'){
            $vest = $_POST['vest'];
            $upit = "DELETE FROM vest where id = '{$vest}' ";
            $rez = mysqli_query($db, $upit);
            if($rez){
                $upit1 = 'SELECT * FROM vest';
                $rez1 = mysqli_query($db, $upit1);
                while($red = mysqli_fetch_assoc($rez1)){
                    echo "<div style='border: 1px solid black; padding: 10px;'><b>".$red['naslov']."</b><br><br>".$red['tekst']."<br><br><button onclick='obrisi(".$red['id'].")'>Obrisi</button></div>";
                }
            }
        }
    }
?>
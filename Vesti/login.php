    <?php
        require_once("funkcije.php");
        $db = konekcija();
        if(!$db){
            exit();
        }
        session_start();
        if(isset($_GET['odjava'])){
            logout();
        }
        if(isset($_SESSION['email']) && isset($_SESSION['lozinka'])){
            header("Location: pocetna.php");
        }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Login</h1><br>
        <form action="login.php" method="post">
            <input type="email" name="email" id="email" placeholder="nnikolic@gmail.com"><br><br>
            <input type="password" name="lozinka" id="lozinka" placeholder=**********><br><br>
            <button name="dugmeLog">Uloguj se</button>
        </form>
        <br>
        Nemate nalog?<a href="register.php"> Registruj se</a>
        <?php
            if(isset($_POST['dugmeLog'])){
                $email = $_POST['email'];
                $lozinka = $_POST['lozinka'];
                if($email != "" or $lozinka != ""){
                    $upit = "SELECT * FROM korisnici WHERE email = '{$email}' and lozinka = '{$lozinka}'";
                    $rez = mysqli_query($db,$upit);
                    if(mysqli_num_rows($rez) == 1){
                        $_SESSION['email'] = $email;
                        $_SESSION['lozinka'] = $lozinka;
                        setcookie("email", $ime, time()+86400, "/");
                        setcookie("status", $status, time()+86400, "/");
                        $korisnik = mysqli_fetch_assoc($rez);
                        $status = $korisnik['status'];
                        if($status == "Administrator"){
                            $_SESSION['status'] = "Administrator";
                            setcookie("status", "Administrator", time()+86400, "/");
                            header("Location: pocetna.php");
                        }
                        if($status == "Korisnik"){
                            $_SESSION['status'] = "Korisnik";
                            setcookie("status", "Korisnik", time()+86400, "/");
                            header("Location: pocetna.php");
                        }
                    }
                    else{
                        echo "<br><br>Pogresan email ili lozinka, probajte ponovo!";
                    }
                }
                else{
                    echo "<br>Morate uneti podatke!";
                }
            }
        ?>
    </body>
    </html>
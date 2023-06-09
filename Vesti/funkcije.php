<?php
    function konekcija(){
        $db = @mysqli_connect("localhost", "root", "", "vesti");
        if(!$db){
            return false;
        }
        mysqli_query($db, "SET NAMES utf8");
        return $db;
    }
    function logout(){
        setcookie("status", "Administrator", time()-1, "/");
        setcookie("status", "Korisnik", time()-1, "/");
        session_unset();
        session_destroy();
    }
    function login(){
        if(isset($_SESSION['email']) and isset($_SESSION['lozinka'])){
            return true;
        }
        else{
            if(isset($_COOKIE['email']) and isset($_COOKIE['lozinka'])){
                $_SESSION['email'] = $_COOKIE['email'];
                $_SESSION['lozinka'] = $_COOKIE['lozinka'];
                return true;
            }
            else{
                return false;
            }
        }
    }
    /*function konekcija(){

    }*/
?>
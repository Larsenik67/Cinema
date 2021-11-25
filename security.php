<?php
session_start();
include "functions.php";
include "db-security.php";

$action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
    "options" => [
        "regexp" => "/login|register|logout/"
    ]
]);

if($action){

    switch($action){
        case "login":
            if (isset($_POST['submit'])) {
                $credentials = filter_input(INPUT_POST, "credentials",FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_STRING);

                if ($credentials && $password) {
                    if (($user = findByUsernameOrEmail($credentials, $credentials))
                        && password_verify($password, $user['password'])) {
                            $_SESSION['user'] = $user;
                            setMessage('success', "Bienvenue ".$user['username']);
                            redirect('index.php');
            
                    }else{
                        setMessage('success', "Mauvais identifiants ou mots de passe");
                    }
                }else setMessage('success', "Champs invalide");
                
            }
            redirect('login.php');
            break;
            
        case "register":
            if(isset($_POST["submit"])){

                $username = filter_input(INPUT_POST, "username", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^[A-Za-z0-9]{6,50}$/"
                    ]
                ]);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"
                    ]
                ]);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_DEFAULT);

                if($username && $email && $pass1){
                    if($pass1 === $pass2){
                        if(!findByUsernameOrEmail($username, $email)){
                            $hash = password_hash($pass1, PASSWORD_ARGON2ID);
                            if(insertUser($username, $email, $hash)){
                                setMessage("success","CA Y EST !!! T'es inscrit !!!");
                                redirect("login.php");
                            }
                            else  setMessage("error","erreur de BDD");
                        }
                        else  setMessage("error","Un utilisateur possède déjà cet email ou ce pseudo...");
                    }
                    else setMessage("error","pas les mm mots de passe");
                }
                else setMessage("error","passe pas les filtres");

            }
            redirect("register.php");
            break;
        case "logout":
            unset($_SESSION['user']);
            setMessage("success","A bientôt !");
            redirect("index.php");
            break;
    }
}


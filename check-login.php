<?php
   session_start();

// DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);


    if(isset($_POST['username']) && isset($_POST['password']))
    {
       // connection local
      //   $db_username = 'root';
      //   $db_password = '';
      //   $db_name     = 'login';
      //   $db_host     = 'localhost';
        
        // connexion serveur
        $db_username = 'soniah';
        $db_password = 'mW3SxOh6/3S+gQ==';
        $db_name     = 'soniah_login';
        $db_host     = 'localhost';
        $messages = array();
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
        
        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
        
        if($username !== "" && $password !== "")
        {
            $requete = "SELECT count(*) FROM users where username = '".$username."' and password = '".$password."' ";
            $exec_requete = mysqli_query($db,$requete);
            $reponse      = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
          
            if($count!=0) // nom d'utilisateur et mot de passe correctes
            {
               $_SESSION['username'] = $username;
               header('Location: listing.php');
               $_SESSION['login'] = true;

            }
            else
            {
               header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
               
            }
        }
        else
        {
           header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
        }
    }
    else
    {
        
       header('Location: index.php');
     
    }
    mysqli_close($db); // fermer la connexion


<?PHP 
session_start();
    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    // Connexion à la base de données
?>
<!-- header -->
<?php include 'header.php';?>

<body>
    <div id="form-login">
        <!-- Form-login -->
        <div class="container">
            <h1>CONNECT</h1>
            <form action="check-login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" spellcheck="false">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
                 <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                ?>
                    
            </form>
    
        <!-- footer -->
        <?php include 'footer.php';?>
        </div>
    </div>
</body>
</html>
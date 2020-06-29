<?PHP 
session_start();
    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>

<?php 
    // test user deconnected
    if(isset($_GET['deconnexion'])){ 
        if($_GET['deconnexion']==true){  
            $_SESSION['login'] = false;
            session_unset();
        }
    }
    // user is connected
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
        header('Location: listing.php');
        exit;
    }

    // header 
    include 'header.php';?>

<body>
    <div class="backg-login">
        <div id="form-login">
            <!-- Form-login -->
            <div class="login">
                <h1 class="text-center">CONNECT</h1>
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
                                echo "<div class='logged-user color-incorrect text-center'><p>Incorrect user or password</p></div>";
                        }
                    ?>
                        
                </form>
        
            <!-- footer -->
            <?php include 'footer.php';?>
            </div>
        </div>
    </div>
</body>
</html>
<?PHP 
// Connexion à la base de données
    require_once('db.php');

    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<!-- header -->
<?php include 'header.php';?>

<body>
    <div id="form-login">
        <!-- Form-login -->
        <div class="container">
            <h1>CONNECT</h1>
            <form id="connect">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="username" name="username" spellcheck="false">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                
                    <button type="submit" class="btn btn-primary">Login</button>
            </form>
    
        <!-- footer -->
        <?php include 'footer.php';?>
        </div>
    </div>
</body>
</html>
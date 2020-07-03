<?PHP 
session_start();

    require_once('db.php');

    $username = '';
    $password = '';


    if(isset($_POST['submit'])){   
        if(!empty($_POST['username']) && !empty($_POST['username'])){
        $sql='SELECT username, password FROM users WHERE username=:username';
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $sth->execute();
        $data = $sth->fetch();

        $username = $data['username'];
        $password = $data['password'];
        
        if($_POST['username'] == $username && $_POST['password'] == $password){
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $username;
            header('Location: listing.php');
        }
        // incorrect username and password
        else{
           header('Location: index.php?erreur=1');  
        } 
     } 
     else{
        header('Location: index.php?erreur=2');  
     }

    }

    // header 
    include 'header.php';
    
    ?>

<body>
    <div class="backg-login">
        <div id="form-login">
            <!-- Form-login -->
            <div class="login">
                <h1 class="text-center">CONNECT</h1>
                
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <!-- Entry username -->
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" spellcheck="false">
                    </div>
                    <div class="form-group">
                        <!-- Entry password -->
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                        <!-- button submit -->
                        <button type="submit" class="btn btn-primary" name="submit">Login</button>
                        <?php
                            // if exists 'erreur' display message error
                            if(isset($_GET['erreur'])){
                                $err = $_GET['erreur'];
                                if($err==1 || $err==2){
                                    echo "<div class='logged-user color-incorrect text-center'><p>Incorrect user or password</p></div>";
                                }
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
<?php
    require_once('db.php');

    //  Initialisation des variables
    $date_change = '';
    $floor = '';
    $position = '';
    $power = '';
    $brand = '';
    $id = '';
    $error = false;


    if( isset($_GET['id']) && isset($_GET['edit'])){
        $sql = 'select id, date_change, floor, position, power, brand, from light_change where id=:id';
        
        $sth = $dbh->prepare( $sql );
        
        $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        
        $sth->execute();
        
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        
        //Si pas de resultat de la requête
        //data est boolean
        if( gettype($data) === "boolean"){
            //on redirige la personne sur la page index
            header('Location: index.php');
        
            //on arrête le script
            exit;
        }

        // on met entre crochets les noms correspondants à la base de données
        $date_change = $data['date_change'];
        $floor = $data['floor'];
        $position = $data['position'];
        $power = $data['power'];
        $brand = $data['brand'];
        // htmlentities : Convertit tous les caractères éligibles en entités HTML
        $id = htmlentities($_GET['id']);
    }


    // Verification if receive form
    // "trim" - Remove space, start and end the string of characters
    // "strlen" - Calculate the size the string of characters 
    if ( count($_POST) > 0){
        // date_change
        if (strlen(trim($_POST['date_change']))!== 0){
            $date_change = trim($_POST['date_change']);
        }
        else{
            $error = true;
        }
        // floor
        if (strlen(trim($_POST['floor']))!== 0){
            $floor = trim($_POST['floor']);
        }
        else{
            $error = true;
        }
        // position
        if (strlen(trim($_POST['position']))!== 0){
            $position = trim($_POST['position']);
        }
        else{
            $error = true;
        }
        // power
        if (strlen(trim($_POST['power']))!== 0){
            $power = trim($_POST['power']);
        }
        else{
            $error = true;
        }
        // brand
        if (strlen(trim($_POST['brand']))!== 0){
            $brand = trim($_POST['brand']);
        }
        else{
            $error = true;
        }
        
        // if no error insert in the database with markers
        if( $error === false){
            if( isset($_POST['edit']) && isset($_POST['id'])){
                $sql = 'UPDATE light_change set date_change=:date_change, floor=:floor, position=:position, power=:power, brand=:brand where id=:id';
        }
        else{
            // on insère
            $sql = "INSERT INTO stagiaire(date_change,floor, position, power, brand VALUES(:date_change, :floor, :position, :power, :brand)";
        }

        $sth = $dbh->prepare($sql);

        // avert data fake "bindParam"
        $sth->bindValue(':date_change', strftime("%Y-%m-%d", strtotime($date_change)), PDO::PARAM_STR);
        $sth->bindParam(':floor', $floor, PDO::PARAM_STR);
        $sth->bindParam(':position', $position, PDO::PARAM_STR);
        $sth->bindParam(':power', $power, PDO::PARAM_STR);
        $sth->bindParam(':brand', $brand, PDO::PARAM_STR);

        // en mode edith je bind ce paramètre
        if( isset($_POST['edit']) && isset($_POST['id'])){
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
        }

        // execute
        $sth->execute();

        // Redirection après insertion
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <!-- link boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
    
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
        <h2>Add light change</h2>

        <!-- dashboard light change of the common building -->
        <form action="" method="post">

        <!-- date change -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date_change">Date change</label>
                <input type="date" class="form-control" id="date_change" name="date_change">
            </div>
        </div>
        
        <div class="form-row">
            <!-- floor -->
            <div class="form-group col-md-6">
                <label for="floor">Floor</label>
                <input type="text" class="form-control" id="floor" name="floor" placeholder="floor 1, floor 2...">
            </div>
            <!-- location -->
            <div class="form-group col-md-6">
                <label for="position">Location</label>
                <select id="position" class="form-control" name="position">
                    <option selected>Choose...</option>
                    <option>left</option>
                    <option>right</option>
                    <option>background</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <!-- location -->
            <div class="form-group col-md-6">
                <label for="power">Light power</label>
                <input type="text" class="form-control" id="power" name="power" placeholder="25W, 60W, 85W...">
            </div>
            <div class="form-group col-md-6">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Edith</button>

        <?php 
            // pour modifier et non pas ajouter
            if( isset($_GET['id']) && isset($_GET['edit'])){
        ?>
            <input type="hidden" name="edit" value="1">
            <input type="hidden" name="id" value="<?=$id ?>">
        <?php 
            }
        ?>
        </form>
</div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
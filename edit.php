<?php
    require_once('db.php');

    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    //  Initialisation des variables
    $date_change = '';
    $floor = '';
    $position = '';
    $power = '';
    $brand = '';
    $id = '';
    $error = false;


    if( isset($_GET['id'])){
        $sql = 'select id, date_change, floor, position, power, brand from light_change where id=:id';
        
        $sth = $dbh->prepare( $sql );
        
        $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        
        $sth->execute();
        
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        
        // //Si pas de resultat de la requête
        // //data est boolean
        // if( gettype($data) === "boolean"){
        //     //on redirige la personne sur la page index
        //     header('Location: index.php');
        
        //     //on arrête le script
        //     exit;
        // }

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
            if( isset($_POST['edit'])){
                $sql = 'UPDATE light_change set date_change=:date_change, floor=:floor, position=:position, power=:power, brand=:brand where id=:id';
            }
        
        $sth = $dbh->prepare($sql);

        // avert data fake "bindParam"
        $sth->bindValue(':date_change', strftime("%Y-%m-%d", strtotime($date_change)), PDO::PARAM_STR);
        $sth->bindParam(':floor', $floor, PDO::PARAM_STR);
        $sth->bindParam(':position', $position, PDO::PARAM_STR);
        $sth->bindParam(':power', $power, PDO::PARAM_STR);
        $sth->bindParam(':brand', $brand, PDO::PARAM_STR);

        // en mode edith je bind ce paramètre
        if( isset($_POST['edit'])){
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
        }

        // execute
        $sth->execute();

        // Redirection après insertion
        header('Location: listing.php');
    }
}
?>

<?php include 'header.php';?>

<body>
    
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
    <div class="d-flex align-items-center">
            <p><img src="img/favicon-dashboard.png" alt="Logo dashboard"></p>
            <h2>Edit Light Change</h2>
        </div>

        <!-- dashboard light change of the common building -->
        <form action="" method="post">

        <!-- date change -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date_change">Date change</label>
                <input type="date" class="form-control" id="date_change" name="date_change" value="<?=$date_change;?>">
            </div>
        </div>
        
        <div class="form-row">
            <!-- floor -->
            <div class="form-group col-md-6">
                <label for="floor">Floor</label>
                <input type="text" class="form-control" id="floor" name="floor" placeholder="floor 1, floor 2..." value="<?=$floor;?>">
            </div>
            <!-- location -->
            <div class="form-group col-md-6">
                <label for="position">Location</label>
                <select id="position" class="form-control" name="position" >
                    <option selected >Choose...</option>
                    <option <?php if ($position =='left'){echo "selected";}?> >left</option>
                    <option <?php if ($position =='right'){echo "selected";}?> >right</option>
                    <option <?php if ($position =='background'){echo "selected";}?> >background</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <!-- location -->
            <div class="form-group col-md-6">
                <label for="power">Light power</label>
                <input type="text" class="form-control" id="power" name="power" placeholder="25W, 60W, 85W..." value="<?=$power;?>" >
            </div>
            <div class="form-group col-md-6">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?=$brand;?>">
            </div>
        </div>
        <div class="d-flex btn-header align-items-center justify-content-between">
            <a href="listing.php"><span class="far fa-arrow-alt-circle-left"></span></a>
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>

            <?php 
            // pour modifier et non pas ajouter
                if( isset($_GET['id'])){
            ?>
                    <input type="hidden" name="edit" value="1">
                    <input type="hidden" name="id" value="<?=$id;?>">
            <?php 
                }
            ?>
        </form>

    <?php include 'footer.php';?>
</div>
</body>
</html>
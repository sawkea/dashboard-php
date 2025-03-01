<?php
    session_start();

    require_once('db.php');
    // DEBUG_________________________________________________________________________________________________________
     // display php errors
     error_reporting(E_ALL);
     ini_set("display_errors", 1);

    // test if variable Empty for access file listing.php
    if(empty($_SESSION['username'])&& empty($_SESSION['password'])){
         header('Location: index.php');
    }

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
                <select id="floor" class="form-control" name="floor" >
                    <option selected >Floor...</option>
                    <option <?php if ($floor =='Floor 1'){echo "selected";}?> >Floor 1</option>
                    <option <?php if ($floor =='Floor 2'){echo "selected";}?> >Floor 2</option>
                    <option <?php if ($floor =='Floor 3'){echo "selected";}?> >Floor 3</option>
                    <option <?php if ($floor =='Floor 4'){echo "selected";}?> >Floor 4</option>
                    <option <?php if ($floor =='Floor 5'){echo "selected";}?> >Floor 5</option>
                    <option <?php if ($floor =='Floor 6'){echo "selected";}?> >Floor 6</option>
                    <option <?php if ($floor =='Floor 7'){echo "selected";}?> >Floor 7</option>
                    <option <?php if ($floor =='Floor 8'){echo "selected";}?> >Floor 8</option>
                    <option <?php if ($floor =='Floor 9'){echo "selected";}?> >Floor 9</option>
                    <option <?php if ($floor =='Floor 10'){echo "selected";}?> >Floor 10</option>
                    <option <?php if ($floor =='Floor 11'){echo "selected";}?> >Floor 11</option>
                </select>
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
                <select id="power" class="form-control" name="power" >
                    <option selected >Power...</option>
                    <option <?php if ($power =='25W'){echo "selected";}?> >25W</option>
                    <option <?php if ($power =='40W'){echo "selected";}?> >40W</option>
                    <option <?php if ($power =='60W'){echo "selected";}?> >60W</option>
                    <option <?php if ($power =='75W'){echo "selected";}?> >75W</option>
                    <option <?php if ($power =='100W'){echo "selected";}?> >100W</option>
                </select>
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
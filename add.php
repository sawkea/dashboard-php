<?php
    session_start();

    if(isset($_SESSION['login']) && $_SESSION['login']===true){
        
    require_once('db.php');

    //  Initialisation des variables
    $date_change = '';
    $floor = '';
    $position = '';
    $power = '';
    $brand = '';
    $id = '';
    $error = false;


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
            $sql = "INSERT into light_change(date_change,floor,position,power,brand) VALUES(:date_change, :floor, :position, :power, :brand)";
        }
        $sth = $dbh->prepare($sql);
        // avert data fake "bindParam"
        $sth->bindValue(':date_change', strftime("%Y-%m-%d", strtotime($date_change)), PDO::PARAM_STR);
        $sth->bindParam(':floor', $floor, PDO::PARAM_STR);
        $sth->bindParam(':position', $position, PDO::PARAM_STR);
        $sth->bindParam(':power', $power, PDO::PARAM_STR);
        $sth->bindParam(':brand', $brand, PDO::PARAM_STR);



        // execute
        $sth->execute();

        // Redirection après insertion
        header('Location: listing.php');
    }
?>

<?php include 'header.php';?>

<body>
    
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
    <div class="d-flex align-items-center">
            <p><img src="img/favicon-dashboard.png" alt="Logo dashboard"></p>
            <h2>Add Light Change</h2>
        </div>

        <!-- dashboard light change of the common building -->
        <form method="post">

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
                <select id="floor" class="form-control" name="floor" >
                    <option selected >Choose...</option>
                    <option <?php if ($floor =='floor 1'){echo "selected";}?> >Floor 1</option>
                    <option <?php if ($floor =='floor 2'){echo "selected";}?> >Floor 2</option>
                    <option <?php if ($floor =='floor 3'){echo "selected";}?> >Floor 3</option>
                    <option <?php if ($floor =='floor 2'){echo "selected";}?> >Floor 4</option>
                    <option <?php if ($floor =='floor 3'){echo "selected";}?> >Floor 5</option>
                    <option <?php if ($floor =='floor 2'){echo "selected";}?> >Floor 6</option>
                    <option <?php if ($floor =='floor 3'){echo "selected";}?> >Floor 7</option>
                    <option <?php if ($floor =='floor 2'){echo "selected";}?> >Floor 8</option>
                    <option <?php if ($floor =='floor 3'){echo "selected";}?> >Floor 9</option>
                    <option <?php if ($floor =='floor 2'){echo "selected";}?> >Floor 10</option>
                    <option <?php if ($floor =='floor 3'){echo "selected";}?> >Floor 11</option>
                </select>
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
        <div class="d-flex btn-header align-items-center justify-content-between">
            <a href="listing.php"><span class="far fa-arrow-alt-circle-left"></span></a>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>

    <?php include 'footer.php';
    
}
else{
    header("location: index.php");
    exit;
}
?>
</div>
</body>
</html>
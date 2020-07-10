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
                <input type="date" class="form-control" id="date_change" name="date_change" required>
            </div>
        </div>
        
        <div class="form-row">
            <!-- floor -->
            <div class="form-group col-md-6">
                <label for="floor">Floor</label>
                <select id="floor" class="form-control" name="floor" required>
                    <option selected >Floor...</option>
                    <option>Floor 1</option>
                    <option>Floor 2</option>
                    <option>Floor 3</option>
                    <option>Floor 4</option>
                    <option>Floor 5</option>
                    <option>Floor 6</option>
                    <option>Floor 7</option>
                    <option>Floor 8</option>
                    <option>Floor 9</option>
                    <option>Floor 10</option>
                    <option>Floor 11</option>
                </select>
            </div>
            <!-- location -->
            <div class="form-group col-md-6">
                <label for="position">Location</label>
                <select id="position" class="form-control" name="position" required>
                    <option selected>Location...</option>
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
                <select id="power" class="form-control" name="power" required>
                <option selected>Power...</option>
                    <option>25W</option>
                    <option>40W</option>
                    <option>60W</option>
                    <option>75W</option>
                    <option>100W</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
        </div>
        <div class="d-flex btn-header align-items-center justify-content-between">
            <a href="listing.php"><span class="far fa-arrow-alt-circle-left"></span></a>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>

    <?php include 'footer.php';?>

</div>
</body>
</html>
<?PHP
session_start();
// test if variable exist with value true for access file listing.php
if(isset($_SESSION['login']) && $_SESSION['login']===true){
    
// Connection database
    require_once('db.php');
    
    // DEBUG_________________________________________________________________________________________________________
    // display php errors
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    // file header
    include 'header.php';
?>

<body>
<div class="container">
    <!-- Titles of the dashboard -->
    <div id="m-queries-header">
        <h1>COMMON BUILDING</h1>
                <div id="off-hidden" class="btn-header">
                    <!-- Link off -->
                    <a href='index.php?deconnexion=true'><span class="fas fa-power-off"></span></a>
                </div>
    </div>
        <div class="d-flex align-items-center">
            <p><img src="img/favicon-dashboard.png" alt="Logo dashboard"></p>
            <h2>Listing Light Change</h2>
        </div>
        <div id="connection" class="d-flex justify-content-between align-items-end mr-bottom1">

        <?php
            if($_SESSION['username'] !== ""){
                $user = $_SESSION['username'];
                // display this message if connection 
                echo "<div class='logged-user'><br>Welcome<span class='user'> $user </span>, you are connected !</div>";
            }
        ?>
            <div class="btn-header">
                <?php   
                    // link add
                    echo '<a href="add.php"><span class="fas fa-plus-circle"></span></a>';
                ?>
                <!-- Link off -->
                <a href='index.php?deconnexion=true'><span id="btn-off" class="fas fa-power-off"></span></a>
            </div>
        </div>
        
    
            <!-- Listing of the dashboard -->
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Date change</td>
                            <td scope="col">Floor</td>
                            <td scope="col">Location</td>
                            <td scope="col">Power</td>
                            <td scope="col">Brand</td>
                            <td scope="col"></td>
                            <td scope="col"></td>
                        </tr>
    
                <?php 
                    // Preparation request
                    $sql = 'SELECT id, date_change, floor, position, power, brand FROM light_change';
                    $sth = $dbh->prepare($sql);
                    // Execution request
                    $sth->execute();
                    // Recover result request
                    $result =$sth->fetchAll(PDO::FETCH_ASSOC);
    
                    // French date format management
                    $intlDateFormater = new IntlDateFormatter('fr_fr', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
    
                    // print data with foreach loop
                    foreach( $result as $row){
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</td>';
                        echo '<td>'.$intlDateFormater->format(strtotime($row['date_change'])).'</td>';
                        echo '<td>'.$row['floor'].'</td>';
                        echo '<td>'.$row['position'].'</td>';
                        echo '<td>'.$row['power'].'</td>';
                        echo '<td>'.$row['brand'].'</td>';
                        // link edit
                        echo '<td><a href="edit.php?id='.$row['id'].'"><span class="far fa-edit"></span></a></td>';
                        // link delete
                        echo '<td><a href="delete.php?id='.$row['id'].'" class="btn_delete"><span id="btn-delete" class="fas fa-trash-alt"></span></a></td>';
                        // echo '<td><a href="#" onClick="confirmation('.$row['id'].')"><span id="btn-delete" class="fas fa-trash-alt"></span></a></td>';
                        // echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></td>'
                        echo '<tr>';
                    }  
                    ?>
                    </thead>
                </table>
            </div>

            <!-- modal -->
    <div id="modal" class="hidden">
        <div id="modal_dialogue">
            <p id="modal_text">Are you sure you want to delete the line ?</p>    
            <div id="modal_area_btn">
                <button id="modal_btn_no">Cancel</button>
                <button id="modal_btn_yes">Yes</button>
            </div>
        </div>
    </div>
            <?php 
            // Si le nombre d'élément dans le tableau
            // Alors tableau vide - donc pas d'enregistrement
            if( count($result) === 0){
                echo '<p>no work</p>';
            }
            ?>  

    <?php include 'footer.php';
    
}
else{
    header("location: index.php");
    exit;
}
?>
</div>

<script src="script.js"></script>
</body>
</html>
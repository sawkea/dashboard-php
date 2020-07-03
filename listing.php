<?PHP
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

    // file header
    include 'header.php';
    ?>

<body>
<div class="container">
    <!-- Titles of the dashboard -->
    <div id="m-queries-header">
        <h1>COMMON BUILDING</h1>
            <div id="off-hidden" class="btn-header">
                <!-- Link off for version mobile-->
                <a href='logout.php'><span id="btn-off-mobile" class="fas fa-power-off"></span></a>
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
                <a href='logout.php'><span id="btn-off" class="fas fa-power-off"></span></a>
            </div>
        </div>
        
    
            <!-- Listing of the dashboard -->
            <div class="table-responsive">
                <table class="table" data-toggle="table" data-search="true" >
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" data-sortable="true">#</th>
                            <th scope="col" data-sortable="true">Date change</th>
                            <th scope="col" data-sortable="true">Floor</th>
                            <th scope="col" data-sortable="true">Location</th>
                            <th scope="col" data-sortable="true">Power</th>
                            <th scope="col" data-sortable="true">Brand</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>    
                    <tbody>
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
                        echo '<td><a href="delete.php?id='.$row['id'].'"><span class="fas fa-trash-alt"></span></a></td>';
                        // echo '<td><a href="#" onClick="confirmation('.$row['id'].')"><span id="btn-delete" class="fas fa-trash-alt"></span></a></td>';
                        // echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></td>'
                        echo '<tr>';
                    }  
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- modal -->
            <div id="modal" class="hidden">
                <div id="modal_dialogue">
                    <p id="warning"><span class="fas fa-exclamation-triangle"></span>Warning</p>
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

    <?php include 'footer.php';?>

</div>

<script src="script.js"></script>

</body>
</html>
<?PHP 
// Connexion à la base de données
    require_once('db.php');

    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>

<?php include 'header.php';?>

<body>
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
        <div class="d-flex align-items-center">
            <p><img src="img/favicon-dashboard.png" alt="Logo dashboard"></p>
            <h2>Listing Light Change</h2>
        </div>
            <!-- Listing of the dashboard -->
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
                    echo '<td><a href="edit.php?id='.$row['id'].'"><span class="far fa-edit"></span></a></td>';
                    echo '<td><a href="delete.php?id='.$row['id'].'" ><span class="fas fa-trash-alt"></span></a></td>';
                    echo '<tr>';
                }  
                ?>
                </thead>
            </table>

            <?php 
                // Buttons add, edit and delete 
                echo '<a href="add.php"><button type="submit" class="btn btn-primary">Add</button></a>';
            
            // Si le nombre d'élément dans le tableau
            // Alors tableau vide - donc pas d'enregistrement
            if( count($result) === 0){
                echo '<p>no work</p>';
            }
            ?>  

    <?php include 'footer.php';?>

</div>
</body>
</html>
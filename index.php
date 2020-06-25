<?PHP 
// Connexion à la base de données
    require_once('db.php');

    // DEBUG_________________________________________________________________________________________________________
    //afficher les erreurs PHP
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- link favicon -->
    <link rel="icon" type="image/png" href="img/favicon-dashboard.png" />
    <!-- link font -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500&display=swap" rel="stylesheet">
    <!-- link boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- link styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
        <div class="d-flex">
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

            
</div>







    <script src="https://kit.fontawesome.com/d5dcbc8efb.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
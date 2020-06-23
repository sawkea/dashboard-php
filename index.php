<?PHP 
// Connexion à la base de données
    require_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
        <h2>Listing Light Change</h2>
            <!-- Listing of the dashboard -->
            <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col" type="checkbox">check</th>
                <th scope="col">#</th>
                <th scope="col">Date change</th>
                <th scope="col">Floor</th>
                <th scope="col">Location</th>
                <th scope="col">Power</th>
                <th scope="col">Brand</th>
                </tr>
            </thead>
            <tbody>

            </table>
            <a href="add.php"><button type="submit" class="btn btn-primary">Add</button></a>
            <a href="edit.php"><button type="submit" class="btn btn-primary">Edit</button></a>
            <a href=""><button type="submit" class="btn btn-primary">Delete</button></a>

</div>








    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
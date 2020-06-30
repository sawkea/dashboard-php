<?php
    session_start();

    require_once('db.php');
    

    // test if the variable exists
    if( isset( $_GET['id'])){
    
        // request delete
        $sql = 'delete from light_change where id=:id';

        $sth = $dbh->prepare( $sql);

        $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        $sth->execute();
        
        header('Location: listing.php');
    }    
    
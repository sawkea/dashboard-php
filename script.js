// script modal confirm line delete
function confirmation(argument) {
    var msg = "Are you sure you want to delete this line ?";
    if (confirm(msg)){
        location.replace('delete.php?id='+argument);
    }
}
    
    
    

   

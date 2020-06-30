// var btnDelete = document.getElementById('btn-delete');
// btnDelete.addEventListener("click", function(){
//     confirmation();
// }); 

function confirmation() {
    var msg = "Are you sure you want to delete this line ?";
    if (confirm(msg))
    location.replace('delete.php');
    }
    
    // function confirmation(ok) {
    //     var msg = confirm("Are you sure you want to delete this line ?");
    //     if (confirm(msg)){
    //         location.replace('delete.php?id=ok');

    //     }
        
    // }
    

   

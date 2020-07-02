// // script modal confirm line delete
// function confirmation(argument) {
//     var msg = "Are you sure you want to delete this line ?";
//     if (confirm(msg)){
//         location.replace('delete.php?id='+argument);
//     }
// }
    
// $.confirm({
//     title: 'Confirm!',
//     content: 'Simple confirm!',
//     buttons: {
//         confirm: function (argument) {
//             $.alert('Confirmed!');
//             location.replace('delete.php?id='+argument);
// },
//         cancel: function () {
//             $.alert('Canceled!');
//         },
//         somethingElse: {
//             text: 'Something else',
//             btnClass: 'btn-blue',
//             keys: ['enter', 'shift'],
//             action: function(){
//                 $.alert('Something else?');
//             }
//         }
//     }
// });
    
// $('#myModal').on('hidden.bs.modal', function (e) {
//     location.replace('delete.php?id='+argument);
//   })


// Selectionne le button no 
const btnNo = document.getElementById('modal_btn_no');
const btnYes = document.getElementById('modal_btn_yes');


//Mettre un ecouteur sur l'ensemble du doc
document.addEventListener('click', function(e){

 
 //On récupère quelle élément est cliqué
 const elementHasCliked = event.target;

 //On vériffie que l'on n'a cliquez sur un span
 if(elementHasCliked.tagName === 'SPAN'){

    //On vérifie que le span cliqué contien tla classe de l'icône corbeille
     if( elementHasCliked.classList.contains('fa-trash-alt') ){
         e.preventDefault();
         
         //on réucpère le parent qui est le lien a
         const elementParent = elementHasCliked.parentElement;
         
         // retirer la classe Hidden pour voir la boite de dialogue remove ou toggle
         const modal = document.getElementById('modal');
         modal.classList.remove('hidden');

        // Ajout de la classe ready-to-delete au lien 
        elementParent.classList.add('ready-to-delete');
     }
 }
});
// Boucle qui va affecter l'évenement clic à tous les liens a ayant la classe btn_delete
// à tous les élements qui sont dans notre sélection(collectionHTML) deleteLinks

// pour chaque element (singulier) d'un tout (contenant plusieurs elements) -> du coup je trouve ça plus logique


// Ajout de l'évènement clic au button no
btnNo.addEventListener('click', function(){
    const modal = document.getElementById('modal');
    // rajout de la classe hidden au clic du button no
    modal.classList.add('hidden');

    // selection du lien ayant la classe ready-to-delete
    const elementsToDelete = document.getElementsByClassName('ready-to-delete');
    for( elementToDelete of elementsToDelete){
        // on retire la classe ready-to-delete
        elementToDelete.classList.remove('ready-to-delete');
    }
});

// Ajout de l'évènement clic au button yes
btnYes.addEventListener('click', function(){
    const modal = document.getElementById('modal');
    // rajout de la classe hidden au clic du button no
    modal.classList.add('hidden');
    const elementsToDelete = document.getElementsByClassName('ready-to-delete');
    for( elementToDelete of elementsToDelete){
        location.href = elementToDelete.getAttribute('href');
    }
});

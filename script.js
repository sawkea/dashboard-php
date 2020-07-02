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

// Selecteurs
// Selection des liens delete
const deleteLinks = document.getElementsByClassName('btn_delete');
// Selectionne le button no 
const btnNo = document.getElementById('modal_btn_no');
const btnYes = document.getElementById('modal_btn_yes');

// Boucle qui va affecter l'évenement clic à tous les liens a ayant la classe btn_delete
// à tous les élements qui sont dans notre sélection(collectionHTML) deleteLinks

// pour chaque element (singulier) d'un tout (contenant plusieurs elements) -> du coup je trouve ça plus logique
for( deleteLink of deleteLinks ){
    // Affecte l'évenement click
    // sur click s'executera une fonction sans nom (dite anonyme)
    deleteLink.addEventListener('click', function(e){
        // pour ne pas executer les évènements par défauts (là aller sur la page delete.php)
        e.preventDefault();

        // Selectionne l'élément ayant ID modal
        const modal = document.getElementById('modal');
        console.log(modal);
        // retirer la classe Hidden pour voir la boite de dialogue remove ou toggle
        modal.classList.remove('hidden');

        // Ajout de la classe ready-to-delete au lien que l'on vient de cliquer
        this.classList.add('ready-to-delete');
    });
}

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


let editform = document.getElementById('editForm');
let action = document.getElementById('action');
let entry = document.getElementById('entry');
let textarea = document.getElementById('text');
function showForm(id){
    editform.style.display='inline';
    action.style.display='none';
    entry.style.display='none';
     
}

function hideForm(){
   editform .style.display = 'none';
   action.style.display='inline';
   entry.style.display='inline';
}

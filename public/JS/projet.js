var groupes = document.getElementById("groupes");
var id = document.getElementById("idProjet").innerText;
var groupeId = document.getElementById("groupeId");
var projet = document.getElementById("idProjet");

console.log(groupeId);


groupes.addEventListener('change',function(){
  var groupeValue = groupes[groupes.selectedIndex].value;
  console.log(groupeValue);
  groupeId.value = groupeValue;
  console.log(groupeId);
  console.log(projet);
});

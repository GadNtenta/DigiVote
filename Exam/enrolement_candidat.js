function genererNumero() {
  const numeroIdentite = Math.floor(Math.random() * 100000000);
  document.getElementById("identite").value = numeroIdentite;
}

document
  .getElementById("formulaireCandidat")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    alert("Candidat enregistré avec succès!");
    this.reset();
  });

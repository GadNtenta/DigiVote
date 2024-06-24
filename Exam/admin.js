let candidateNumber = 1;
let chronoInterval;
let startTime;

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    tabcontent[i].classList.remove("active");
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  document.getElementById(tabName).classList.add("active");
  evt.currentTarget.className += " active";
}

function demarrerVote() {
  const dateDebut = document.getElementById("dateDebut").value;
  const heureDebut = document.getElementById("heureDebut").value;

  if (dateDebut && heureDebut) {
    const debutVote = new Date(`${dateDebut}T${heureDebut}`);
    const maintenant = new Date();

    if (debutVote > maintenant) {
      alert("La date et l'heure de début doivent être dans le passé.");
      return;
    }

    startTime = new Date();
    chronoInterval = setInterval(updateChrono, 1000);
  } else {
    alert("Veuillez remplir la date et l'heure de début.");
  }
}

function updateChrono() {
  const now = new Date();
  const diff = now - startTime;
  const heures = String(Math.floor(diff / 3600000)).padStart(2, "0");
  const minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, "0");
  const secondes = String(Math.floor((diff % 60000) / 1000)).padStart(2, "0");
  document.getElementById(
    "chrono"
  ).textContent = `${heures}:${minutes}:${secondes}`;
}

function arreterVote() {
  clearInterval(chronoInterval);
  const finVote = new Date();
  document.getElementById("chrono").textContent = "00:00:00";
  document.getElementById(
    "finVote"
  ).textContent = `Vote terminé à : ${finVote.toLocaleString()}`;
}

document
  .getElementById("formulaireCandidat")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    document.getElementById("numCandidat").value = candidateNumber++;
    alert("Candidat enregistré avec succès!");
    this.reset();
    document.getElementById("numCandidat").value = candidateNumber;
  });
document.getElementById("numCandidat").value = candidateNumber;

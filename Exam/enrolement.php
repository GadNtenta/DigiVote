<?php
include("conn_base.php");

// Récupérer les données du formulaire
$nom = $_POST['lastName'];
$prenom = $_POST['firstName'];
$postnom = $_POST['postnom'];
$adresse = $_POST['Adress'];
$numero_identite = $_POST['uniqueCode'];

// Vérifier que le numéro d'identité est généré
if (empty($numero_identite)) {
    echo "Vous devez générer un numéro d'identité avant de vous enregistrer.";
} else {
    // Préparer et exécuter la requête SQL d'insertion
    $sql = "INSERT INTO enregistrement (nom, prenom, postnom, adresse, numero_identite)
            VALUES ('$nom', '$prenom', '$postnom', '$adresse', '$numero_identite')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();

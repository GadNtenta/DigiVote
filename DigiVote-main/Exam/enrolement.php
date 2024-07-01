<?php
include("conn_base.php");

// Récupérer les données du formulaire
$nom = $_POST['lastName'];
$prenom = $_POST['firstName'];
$postnom = $_POST['postnom'];
$adresse = $_POST['Adress'];
$numero_identite = $_POST['uniqueCode'];
$photoPath = '';

// Vérifier que le numéro d'identité est généré
if (empty($numero_identite)) {
    echo "Vous devez générer un numéro d'identité avant de vous enregistrer.";
} else {
    // Traitement du téléchargement de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoTmpPath = $_FILES['photo']['tmp_name'];
        $photoName = basename($_FILES['photo']['name']);
        $uploadDir = 'uploads/';

        // Vérifiez si le répertoire existe, sinon créez-le
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $photoPath = $uploadDir . $photoName;

        // Déplacer le fichier téléchargé dans le répertoire de destination
        if (move_uploaded_file($photoTmpPath, $photoPath)) {
            // Photo téléchargée avec succès
        } else {
            // Échec du téléchargement de la photo
            echo 'Erreur lors du téléchargement de la photo.';
            exit;
        }
    }

    // Préparer et exécuter la requête SQL d'insertion
    $sql = "INSERT INTO enregistrement (nom, prenom, postnom, adresse, numero_identite, photo)
            VALUES ('$nom', '$prenom', '$postnom', '$adresse', '$numero_identite', '$photoPath')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();

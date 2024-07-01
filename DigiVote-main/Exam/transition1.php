<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DigiVote - Transition</title>
    <style>
        body {
            background-color: #ECEFFF;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100%;
            margin-left: 50px;
            margin-right: 50px;
        }
        .left-section, .right-section {
            width: 50%; /* Moitié de l'écran */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            box-sizing: border-box;
        }
        .left-section {
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .right-section {
            background-color: #ECEFFF;
            margin-top: -50px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%; /* Ajustement pour meilleure apparence */
            height: 310px; /* Hauteur réduite */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }
        .card-header, .card-footer {
            background-color: #AAD3FF;
            border-radius: 8px 8px 0 0;
        }
        .card-footer {
            border-radius: 0 0 8px 8px;
            text-align: center;
            padding: 10px;
            margin-top: -13px;
        }
        .card-footer p {
            font-size: 15px;
        }
        .card-content {
            display: flex;
            flex: 1;
            justify-content: space-between;
            padding: 20px;
            margin-top: 10px;
            margin-bottom: 0;

        }
        .card-content p {
            font-size: 10px;
        }
        .card img {
            width: 100px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            margin: 20px;
        }
        .card-info {
            flex: 1;
            text-align: left;
            margin-left: 20px;
        }
        .card h5, .card p {
            margin: 0;
        }
        .card p {
            font-weight: normal;
           
        }
        .overlay {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .overlay .ok {
            color: green;
            font-size: 100px;
        }
        .overlay p {
            font-size: 24px;
            color: #000;
            margin: 20px 0;
        }
        .overlay button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 20px;
        }
        .print-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            display: block; /* Assurez-vous qu'il est visible par défaut */
        }

        @media print {
            .print-button {
                display: none; /* Masquer le bouton lors de l'impression */
            }
        }
        .print-button.hide {
            display: none !important;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="card" id="cardContent">
                <div class="card-header">
                    <h2 style="text-align:center">Carte d'identité</h2>
                </div>
                <div class="card-content">
                    <?php
                    include("conn_base.php");

                    // Récupérer les informations de l'utilisateur depuis la base de données
                    $sql = "SELECT nom, prenom, postnom, numero_identite, photo, adresse FROM enregistrement ORDER BY id DESC LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Afficher les données de l'utilisateur
                        while($row = $result->fetch_assoc()) {
                            echo '<div>';
                            echo '<img src="' . $row["photo"] . '" alt="Photo" style="margin-top:-2px">';
                            echo '<h5 style="text-align:center; font-weight:bold; margin-top:-15px">' . $row["numero_identite"] . '</h5>';
                            echo '</div>';
                            echo '<div class="card-info">';
                            echo '<p>Nom</p><h5>' . $row["nom"] . '</h5>';
                            echo '<p>Postnom</p><h5>' . $row["postnom"] . '</h5>';
                            echo '<p>Prénom</p><h5>' . $row["prenom"] . '</h5>';
                            echo '<p>Adresse</p><h5>' . $row["adresse"] . '</h5>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Aucune donnée trouvée.</p>';
                    }

                    // Fermer la connexion à la base de données
                    $conn->close();
                    ?>
                    <div><img src="vote1.png" alt="Vote" style="margin-top:0px"></div>
                </div>
                <div class="card-footer">
                    <p>DigiVote - Système de Vote Électronique</p>
                </div>
                <button class="print-button" onclick="imprimerCarte()">Imprimer</button>
            </div>
        </div>
        <div class="right-section">
            <div class="overlay">
                <div class="ok">✔</div>
                <p>Enregistrement effectué avec succès !</p>
                <p>Cliquez sur OK pour continuer</p></br>
                <button id="continueButton">OK</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById('continueButton').addEventListener('click', function() {
            window.location.href = 'connexion_enrol.php'; // Rediriger vers la page suivante
        });

        function imprimerCarte() {
            // Sélectionner l'élément de la carte
            const cardContent = document.getElementById('cardContent');
            // Sélectionner le bouton d'impression
            const printButton = document.querySelector('.print-button');

            // Ajouter une classe pour cacher temporairement le bouton d'impression
            printButton.classList.add('hide');

            // Options pour la génération du PDF
            const options = {
                margin: 10,
                filename: 'carte_identite.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Générer le PDF à partir de l'élément sélectionné
            html2pdf().from(cardContent).set(options).save();

            // Supprimer la classe hide après la génération du PDF
            printButton.classList.remove('hide');
        }

    </script>
</body>
</html>

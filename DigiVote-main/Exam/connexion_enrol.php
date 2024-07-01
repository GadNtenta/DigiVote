<?php
include("conn_base.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['lastName'];
    $numero_identite = $_POST['uniqueCode'];

    // Préparer la requête SQL
    $query = "SELECT * FROM enregistrement WHERE nom = ? AND numero_identite = ?";
    $stmt = $conn->prepare($query);
    
    // Vérifier si la préparation a réussi
    if ($stmt === false) {
        die('Erreur de préparation de la requête SQL : ' . $conn->error);
    }

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param('ss', $nom, $numero_identite);
    $stmt->execute();
    
    // Récupérer le résultat de la requête
    $result = $stmt->get_result();
    
    // Vérifier si un utilisateur correspondant a été trouvé
    if ($result->num_rows > 0) {
        // Authentification réussie, rediriger vers une autre page par exemple
        header("Location: transition.php");
        exit;
    } else {
        // Afficher un message d'erreur par exemple
        $error_message = "Identifiants incorrects. Veuillez réessayer.";
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DigiVote - Connexion</title>
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
        }
        .left-section {
            background-color: #ECEFFF; 
            width: 66.67%; /* 2/3 */
            display: flex;
            align-items: center;
            padding: 150px;
            box-sizing: border-box;
        }
        .right-section {
            background-color: #AAD3FF; 
            width: 33.33%; /* 1/3 */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 18px;
            box-sizing: border-box;
        }
        header {
            width: 100%;
            background-color: #007BFF;
            color: #fff;
            text-align: left;
            position: absolute;
            top: 0;
        }
        header h1 {
            margin: 1% 1% 1% 1%;
            font-size: 23px;
        }
        .main-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            width: 100%;
            margin-top: 20px;
        }
        .enrolment-container {
            background-color: #fff;
            padding: 18px;
            border-radius: 8px;
            margin-left: 270px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 13px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 13.5px;
            width: calc(63.5% - 16px);
            height: 31px;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:disabled,
        button.disabled {
            background-color: #ccc;
            cursor: default;
        }

        input[type="text"] {
            padding: 8px;
            width: calc(60% - 16px);
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1.9px solid #cce5ff;
            border-radius: 20px;
            height: 8px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        #uniqueCodeDisplay {
            font-weight: bold;
            color: #007BFF;
            margin-top: 10px;
        }
        .message-box {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            width: 60%;
            box-sizing: border-box;
            text-align: center;
            font-size: 13.5px;
        }
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
        .image-container {
            position: absolute;
            top: 50%;
            left: 62%;
            transform: translate(-50%, -50%);
            width: 200px; 
            height: auto;
            z-index: 1;
        }
        .image-container img {
            max-width: 180%;
            height: auto;
        }
        form {
            width: 680px;
        }
    </style>
</head>
<body>
    <header>
        <h1>DigiVote</h1>
    </header>
    <div class="container">
        <div class="left-section">
            <form id="enrolmentForm" action="connexion_enrol.php" method="post">
                <h1>Bienvenue ! <br> Connectez-vous afin de procéder au vote</h1>
                <?php if (!empty($error_message)): ?>
                    <div class="message-box error-box" id="errorMessage">
                    <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
                <label for="lastName">Nom</label>
                <input type="text" id="lastName" name="lastName" required>
                <br>
                <label for="uniqueCode">Votre numéro d'identité </label>
                <input type="text" id="uniqueCode" name="uniqueCode" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
        <div class="right-section">
        </div>
        <div class="image-container">
            <img src="vote1.png">
        </div>
    </div>
    <script>
    // Sélection de l'élément du message d'erreur
    var errorMessage = document.getElementById('errorMessage');

    // Vérification si le message d'erreur est présent
    if (errorMessage) {
        // Masquer le message d'erreur après 2 secondes
        setTimeout(function() {
            errorMessage.style.display = 'none';
        }, 2000);
    }
</script>

</body>
</html>

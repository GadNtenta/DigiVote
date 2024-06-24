<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DigiVote</title>
    <style>
        body {
            background-color: #ECEFFF;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="overlay">
        <div class="ok">✔</div>
        <p>Enregistrement effectué avec succès !</p>
        <p>Cliquez sur OK pour continuer</p></br>
        <button id="continueButton">OK</button>
    </div>
    <script>
        document.getElementById('continueButton').addEventListener('click', function() {
            window.location.href = 'connexion_enrol.php'; // Rediriger vers la page suivante
        });
    </script>
</body>
</html>

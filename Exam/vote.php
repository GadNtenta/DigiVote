<?php
include("conn_base.php");

function generateUniqueCode($conn) {
    $uniqueCode = bin2hex(random_bytes(5)); // 10 caractères hexadécimaux
    $stmt = $conn->prepare("INSERT INTO unique_codes (code) VALUES (?)");
    $stmt->bind_param("s", $uniqueCode);
    $stmt->execute();
    $stmt->close();
    return $uniqueCode;
}

function verifyIdentityNumber($conn, $identityNumber) {
    $stmt = $conn->prepare("SELECT * FROM enregistrement WHERE numero_identite = ?");
    $stmt->bind_param("s", $identityNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $isValid = $result->num_rows > 0;
    $stmt->close();
    return $isValid;
}

function getVoteCounts($conn) {
    $voteCounts = ["Option 1" => 0, "Option 2" => 0, "Option 3" => 0];
    $result = $conn->query("SELECT option_name, COUNT(*) as count FROM votes GROUP BY option_name");

    while ($row = $result->fetch_assoc()) {
        $voteCounts[$row['option_name']] = (int)$row['count'];
    }
    
    return $voteCounts;
}

function getTotalVotes($conn) {
    $result = $conn->query("SELECT COUNT(*) as total FROM votes");
    $row = $result->fetch_assoc();
    return (int)$row['total'];
}

function getTotalVoters($conn) {
    $result = $conn->query("SELECT COUNT(DISTINCT numero_identite) as total FROM enregistrement");
    $row = $result->fetch_assoc();
    return (int)$row['total'];
}

function getVotes($conn) {
    $votes = getVoteCounts($conn);
    return $votes;
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'generate_code':
            $uniqueCode = generateUniqueCode($conn);
            echo json_encode(["uniqueCode" => $uniqueCode]);
            break;
        
        case 'check_identity':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $identityNumber = $_POST['identityNumber'];
        
                if (verifyIdentityNumber($conn, $identityNumber)) {
                    echo json_encode(["valid" => true]);
                } else {
                    echo json_encode(["valid" => false, "message" => "Numéro d'identité invalide."]);
                }
            } else {
                echo json_encode(["valid" => false, "message" => "Méthode de requête non valide."]);
            }
            break;
        
        case 'vote':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $option = $_POST['option'];
                $uniqueCode = $_POST['uniqueCode'];
                $identityNumber = $_POST['identityNumber'];

                // Vérifier si le code unique est valide
                $stmt = $conn->prepare("SELECT * FROM unique_codes WHERE code = ?");
                $stmt->bind_param("s", $uniqueCode);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 0) {
                    echo json_encode(["success" => false, "message" => "Numéro unique invalide."]);
                    
                    exit();
                }

                $stmt->close();

                // Vérifier si l'utilisateur a déjà voté avec ce numéro d'identité
                $stmt = $conn->prepare("SELECT * FROM votes WHERE numero_identite = ?");
                $stmt->bind_param("s", $identityNumber);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo json_encode(["success" => false, "message" => "Vous avez déjà voté."]);
                    exit();
                }

                $stmt->close();

                // Enregistrer le vote
                $stmt = $conn->prepare("INSERT INTO votes (option_name, unique_code, numero_identite) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $option, $uniqueCode, $identityNumber);
                $stmt->execute();
                $stmt->close();

                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Méthode de requête non valide."]);
            }
            break;

        case 'results':
            $votes = getVotes($conn);
            $totalVotes = getTotalVotes($conn);
            $totalVoters = getTotalVoters($conn);
            echo json_encode([
                "votes" => $votes,
                "totalVotes" => $totalVotes,
                "totalVoters" => $totalVoters
            ]);
            break;

        default:
            echo json_encode(["success" => false, "message" => "Action non valide."]);
            break;
    }
    $conn->close();
    exit();
}

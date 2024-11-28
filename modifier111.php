<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "ista";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = "";
$data = null;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matStagiare = $_POST['matStagiare'];

    if (!empty($matStagiare)) {
        // Query to fetch data for the given matricule
        $sql = "SELECT * FROM stagiares WHERE matStagiare = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $matStagiare);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the data
            $data = $result->fetch_assoc();
        } else {
            $error = "Matricule not found.";
        }
        $stmt->close();
    } else {
        $error = "Please enter a matricule.";
    }
}

// Handle the update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $matStagiare = $_POST['matStagiare'];
    $nomStagiare = $_POST['nomStagiare'];
    $prenomStagiare = $_POST['prenomStagiare'];
    $filiereStagiare = $_POST['filiereStagiare'];
    $anneeEtude = $_POST['anneeEtude'];
    $typeBac = $_POST['typeBac'];
    $anneeBac = $_POST['anneeBac'];

    // Validate inputs
    if (!empty($matStagiare) && !empty($nomStagiare) && !empty($prenomStagiare)) {
        // Update query
        $sql = "UPDATE stagiares SET 
                    nomStagiare = ?, 
                    prenomStagiare = ?, 
                    filiereStagiare = ?, 
                    anneeEtude = ?, 
                    typeBac = ?, 
                    anneeBac = ? 
                WHERE matStagiare = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssi", 
            $nomStagiare, 
            $prenomStagiare, 
            $filiereStagiare, 
            $anneeEtude, 
            $typeBac, 
            $anneeBac, 
            $matStagiare
        );

        if ($stmt->execute()) {
            echo "<p class='success'>Stagiaire updated successfully!</p>";
        } else {
            echo "<p class='error'>Error updating stagiaire: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}




$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Stagiaire</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js" defer></script>
    <style>
        form input {
            color: black;
        }

        .navContainer {
            width: 85%;
        }

        .container {
            width: 50%;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 60px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container button {
            width: 100%;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            color: black;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        footer .FooterContainer {
            margin-bottom: 75px;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700 min-h-screen text-white flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md text-gray-800">
        <div class="navContainer mx-auto flex justify-between items-center p-4">
            <a href="index.html" class="text-2xl font-bold flex items-center">
                <i class="fas fa-graduation-cap mr-2 text-blue-600"></i>
                Gestion Des Stagiaires
            </a>
            <ul class="flex space-x-6 font-semibold">
                <li><a href="ajouter.php" class="hover:text-blue-600 transition">Ajouter</a></li>
                <li><a href="consult.php" class="hover:text-blue-600 transition">Consulter</a></li>
                <li><a href="modifier.php" class="hover:text-blue-600 transition">Modifier</a></li>
            </ul>
        </div>
    </nav>
    <br>

    <div class="container">
        <h2>Search Stagiaire</h2>
        <!-- Search Form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="matStagiare">Matricule:</label>
                <input type="text" id="matStagiare" name="matStagiare" value="<?= htmlspecialchars($_POST['matStagiare'] ?? '') ?>">
            </div>
            <button type="submit">Rechercher</button>
        </form>

        <!-- Display error message -->
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Display form with stagiaire data if available -->
        <?php if ($data): ?>
            <h3>Stagiaire Details</h3>
            <form method="POST" action="modifier.php">
                <div class="form-group">
                    <label for="nomStagiare">Nom:</label>
                    <input type="text" id="nomStagiare" name="nomStagiare" value="<?= htmlspecialchars($data['nomStagiare']) ?>">
                </div>
                <div class="form-group">
                    <label for="prenomStagiare">Prénom:</label>
                    <input type="text" id="prenomStagiare" name="prenomStagiare" value="<?= htmlspecialchars($data['prenomStagiare']) ?>">
                </div>
                <div class="form-group">
                    <label for="filiereStagiare">Filière:</label>
                    <input type="text" id="filiereStagiare" name="filiereStagiare" value="<?= htmlspecialchars($data['filiereStagiare']) ?>">
                </div>
                <div class="form-group">
                    <label for="anneeEtude">Année d'étude:</label>
                    <input type="date" id="anneeEtude" name="anneeEtude" value="<?= htmlspecialchars($data['anneeEtude']) ?>">
                </div>
                <div class="form-group">
                    <label for="typeBac">Type de Bac:</label>
                    <input type="text" id="typeBac" name="typeBac" value="<?= htmlspecialchars($data['typeBac']) ?>">
                </div>
                <div class="form-group">
                    <label for="anneeBac">Année de Bac:</label>
                    <input type="date" id="anneeBac" name="anneeBac" value="<?= htmlspecialchars($data['anneeBac']) ?>">
                </div>
                <input type="hidden" name="matStagiare" value="<?= htmlspecialchars($data['matStagiare']) ?>">
                <button type="submit" name="modifier" class="w-full mt-3">Modifier</button>
            </form>
        <?php endif; ?>
    </div>

    <footer class="bg-gray-900 py-6">
        <div class="FooterContainer mx-auto text-center">
            <p class="text-gray-400">
                Créé par 
                <span class="text-white font-bold">OUBARGHOUZ</span>, 
                <span class="text-white font-bold">OUBA</span>, 
                <span class="text-white font-bold">BOUINCHA</span>, et 
                <span class="text-white font-bold">BENALLA</span>.
            </p>
        </div>
    </footer>
</body>

</html>
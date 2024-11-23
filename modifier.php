<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestion Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js" defer></script>
    <style>

    </style>
</head>

<body class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700 min-h-screen text-white flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md text-gray-800">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="index.html" class="text-2xl font-bold flex items-center">
                <i class="fas fa-graduation-cap mr-2 text-blue-600"></i>
                Gestion Des Stagaires
            </a>
            <ul class="flex space-x-6 font-semibold">
                <li>
                    <a href="ajouter.php" class="hover:text-blue-600 transition">Ajouter</a>
                </li>
                <li>
                    <a href="consult.php" class="hover:text-blue-600 transition">Consulter</a>
                </li>
                <li>
                    <a href="parFiliere.php" class="hover:text-blue-600 transition">Étudiants par Filière</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>

    <!-- Login Form Section -->
    <main class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier les donnees d'un stagaires</h1>
            <form action="modifier.php" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="matricule">Matricule</label>
                    <input type="text" name="matricule" placeholder="Entrez le matricule" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="nom">Nom</label>
                    <input type="text" name="nom" placeholder="Entrez le nouveau nom" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="prenom">Prénom</label>
                    <input type="text" name="prenom" placeholder="Entrez le nouveau prénom" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="filiere">Filière</label>
                    <input type="text" name="filiere" placeholder="Entrez la nouvelle filière" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="anneeEtude">Année d'étude</label>
                    <input type="text" name="anneeEtude" placeholder="Entrez la nouvelle année d'étude" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="typeBac">Type de Bac</label>
                    <input type="text" name="typeBac" placeholder="Entrez le type de Bac" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="anneeBac">Année de Bac</label>
                    <input type="text" name="anneeBac" placeholder="Entrez l'année de Bac" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold shadow-md hover:bg-blue-700 transition">Modifier</button>
            </form>

        </div>
    </main>
    <br>

    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">
                Créé par <span class="text-white font-bold">OUBARGHOUZ</span> et <span class="text-white font-bold">OUBA</span> et <span class="text-white font-bold">BOUINCHA</span> et <span class="text-white font-bold">BENALLA</span>
            </p>
        </div>
    </footer>
</body>

</html>


<?php
include('config1.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricule = $_POST['matricule'] ?? null;

    // Initialize an array for fields to update
    $fields = [];
    $params = ['matricule' => $matricule];

    // Add fields dynamically based on submitted data
    if (!empty($_POST['nom'])) {
        $fields[] = "nomStagiare = :nom";
        $params['nom'] = $_POST['nom'];
    }
    if (!empty($_POST['prenom'])) {
        $fields[] = "prenomStagiare = :prenom";
        $params['prenom'] = $_POST['prenom'];
    }
    if (!empty($_POST['filiere'])) {
        $fields[] = "filiereStagiare = :filiere";
        $params['filiere'] = $_POST['filiere'];
    }
    if (!empty($_POST['anneeEtude'])) {
        $fields[] = "anneeEtude = :anneeEtude";
        $params['anneeEtude'] = $_POST['anneeEtude'];
    }
    if (!empty($_POST['typeBac'])) {
        $fields[] = "typeBac = :typeBac";
        $params['typeBac'] = $_POST['typeBac'];
    }
    if (!empty($_POST['anneeBac'])) {
        $fields[] = "anneeBac = :anneeBac";
        $params['anneeBac'] = $_POST['anneeBac'];
    }

    try {
        // Check if student exists
        $stmt = $conn->prepare("SELECT * FROM stagiares WHERE matStagiare = :matricule");
        $stmt->execute(['matricule' => $matricule]);

        if ($stmt->rowCount() > 0) {
            if (!empty($fields)) {
                // Construct the dynamic UPDATE query
                $query = "UPDATE stagiares SET " . implode(', ', $fields) . " WHERE matStagiare = :matricule";
                $updateStmt = $conn->prepare($query);

                // Execute the update
                if ($updateStmt->execute($params)) {
                    echo "<script>alert('Détails de l\'étudiant mis à jour avec succès !');</script>";
                } else {
                    echo "<script>alert('Échec de la mise à jour des détails de l\'étudiant.');</script>";
                }
            } else {
                echo "<script>alert('Aucun champ à mettre à jour.');</script>";
            }
        } else {
            echo "<script>alert('Matricule non trouvé !');</script>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
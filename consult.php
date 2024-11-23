<?php
// Include the database connection
include('config2.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $matricule = $_POST['matricule'];

    try {
        // Prepare the SQL query to search for the student by matricule
        $stmt = $conn->prepare("SELECT * FROM stagiares WHERE matStagiare = :matricule");
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();

        // Check if the student was found
        if ($stmt->rowCount() > 0) {
            // Fetch the student data
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error_message = "Matricule non trouvé ! Veuillez vérifier et réessayer.";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation - Gestion Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js" defer></script>
</head>

<body class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700 min-h-screen text-white flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md text-gray-800">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="index.html" class="text-2xl font-bold flex items-center">
                <i class="fas fa-graduation-cap mr-2 text-blue-600"></i>
                Gestion Des Stagiaires
            </a>
            <ul class="flex space-x-6 font-semibold">
                <li><a href="ajouter.html" class="hover:text-blue-600 transition">Ajouter</a></li>
                <li><a href="modifier.html" class="hover:text-blue-600 transition">Modifier</a></li>
                <li><a href="parFiliere.html" class="hover:text-blue-600 transition">Étudiants par Filière</a></li>
            </ul>
        </div>
    </nav>
    <br>

    <!-- Login Form Section -->
    <main class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Consultation des données d'un stagiaire</h1>

            <!-- Display error message if matricule not found -->
            <?php if (isset($error_message)): ?>
                <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                    <?= $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Display student data if found -->
            <?php if (isset($student)): ?>
                <div class="text-gray-800 mb-6">
                    <p><strong>Matricule:</strong> <?= $student['matStagiare']; ?></p>
                    <p><strong>Nom:</strong> <?= $student['nomStagiare']; ?></p>
                    <p><strong>Prénom:</strong> <?= $student['prenomStagiare']; ?></p>
                    <p><strong>Filière:</strong> <?= $student['filiereStagiare']; ?></p>
                    <p><strong>Année d'Étude:</strong> <?= $student['anneeEtude']; ?></p>
                    <p><strong>Type de Bac:</strong> <?= $student['typeBac']; ?></p>
                    <p><strong>Année du Bac:</strong> <?= $student['anneeBac']; ?></p>
                </div>
            <?php endif; ?>

            <form action="consult.php" method="POST">
                <!-- Matricule Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Matricule de stagiaire</label>
                    <input type="text" name="matricule" placeholder="Entrez le matricule"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold shadow-md hover:bg-blue-700 transition">
                    Chercher
                </button>
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
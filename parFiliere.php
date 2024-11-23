<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestion Étudiants</title>
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
                <li><a href="ajouter.php" class="hover:text-blue-600 transition">Ajouter</a></li>
                <li><a href="consult.php" class="hover:text-blue-600 transition">Consulter</a></li>
                <li><a href="modifier.php" class="hover:text-blue-600 transition">Modifier</a></li>
            </ul>
        </div>
    </nav>
    <br>

    <!-- Main Section -->
    <main class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Consultation des données des stagiaires par filière</h1>
            <form action="parFiliere.php" method="POST">
                <!-- Filière Selection -->
                <div class="mb-4">
                    <label for="filiere" class="block text-gray-700 font-semibold mb-2">Filière de stagiaire</label>
                    <select id="filiere" name="filiere" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black" required>
                        <option value="DEV">DEV</option>
                        <option value="Infrastructure">Infrastructure digitale</option>
                        <option value="Mechanique">Mechanique</option>
                        <option value="Electricite">Electricité</option>
                    </select>
                </div>
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold shadow-md hover:bg-blue-700 transition">
                    Chercher
                </button>
            </form>
        </div>

        <!-- Placeholder for PHP Output -->
        <div class="bg-white text-black mt-6 p-6 rounded-lg shadow-lg w-full max-w-5xl">
            <?php
            // Database connection details
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'ista';

            // Connect to the database
            $conn = new mysqli($host, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if form was submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the selected filière
                $filiere = $conn->real_escape_string($_POST['filiere']);

                // Query to fetch stagiaires for the selected filière
                $query = "SELECT * FROM stagiares WHERE filiereStagiare = '$filiere'";
                $result = $conn->query($query);

                // Check if any results were found
                if ($result->num_rows > 0) {
                    echo "<h2 class='text-xl font-bold mb-4'>Liste des stagiaires pour la filière: $filiere</h2>";
                    echo "<table class='table-auto w-full text-left border-collapse'>";
                    echo "<thead><tr class='bg-gray-200'>
                            <th class='p-2 border'>Matricule</th>
                            <th class='p-2 border'>Nom</th>
                            <th class='p-2 border'>Prénom</th>
                            <th class='p-2 border'>Filière</th>
                            <th class='p-2 border'>Année d'étude</th>
                            <th class='p-2 border'>Type de Bac</th>
                            <th class='p-2 border'>Année de Bac</th>
                          </tr></thead><tbody>";

                    // Fetch and display results
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='p-2 border'>{$row['matStagiare']}</td>
                                <td class='p-2 border'>{$row['nomStagiare']}</td>
                                <td class='p-2 border'>{$row['prenomStagiare']}</td>
                                <td class='p-2 border'>{$row['filiereStagiare']}</td>
                                <td class='p-2 border'>{$row['anneeEtude']}</td>
                                <td class='p-2 border'>{$row['typeBac']}</td>
                                <td class='p-2 border'>{$row['anneeBac']}</td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-red-500 font-bold'>Aucun stagiaire trouvé pour la filière: $filiere</p>";
                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>
    <br>
    <br>
    <br>
    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center">
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




<?php
// Database connection details
$host = 'localhost'; // Adjust as needed
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'ista'; // Database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected filière
    $filiere = $conn->real_escape_string($_POST['filiere']);

    // Query to fetch stagiaires for the selected filière
    $query = "SELECT * FROM stagiares WHERE filiereStagiare = '$filiere'";
    $result = $conn->query($query);

}

// Close the database connection
$conn->close();
?>

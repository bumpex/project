<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestion Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js" defer></script>

    <style>
        .mb-4 input{
            color: black;
        }
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
                    <a href="consult.php" class="hover:text-blue-600 transition">Consulter</a>
                </li>
                <li>
                    <a href="modifier.php" class="hover:text-blue-600 transition">Modifier</a>
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
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Ajouter un stagiaire</h1>
            <form action="ajouter.php" method="POST">
                <div class="mb-4">
                    <!-- Matricule -->
                    <label class="block text-gray-700 font-semibold mb-2" for="matricule" name="matricule">Matricule de stagiaire</label>
                    <input 
                        type="text" 
                        id="matricule" 
                        name="matricule" 
                        placeholder="Entrez le matricule" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                   
                    <!-- Nom -->
                    <label class="block text-gray-700 font-semibold mb-2" for="nom" >Nom de stagiaire</label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        placeholder="Entrez le nom" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    
                    <!-- Prénom -->
                    <label class="block text-gray-700 font-semibold mb-2" for="prenom" name="prenom">Prénom de stagiaire</label>
                    <input 
                        type="text" 
                        id="prenom" 
                        name="prenom" 
                        placeholder="Entrez le prénom" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    
                    <!-- Filière -->
                    <label class="block text-gray-700 font-semibold mb-2" for="filiere" name="filiere">Filière de stagiaire</label>
                    <select 
                        id="filiere" 
                        name="filiere" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                        <option value="DEV">DEV</option>
                        <option value="Infrastructure">Infrastructure digitale</option>
                        <option value="Mechanique">Mechanique</option>
                        <option value="Electricite">Electricite</option>
                    </select>

                    <!-- Année d'Étude -->
                    <label class="block text-gray-700 font-semibold mb-2" for="annee" name="annee">Année d'étude</label>
                    <select 
                        id="annee" 
                        name="annee" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black">
                        <option value="1">Première année</option>
                        <option value="2">Deuxième année</option>
                        <option value="3">Troisième année</option>
                    </select>

                    <!-- Type de Bac -->
                    <label class="block text-gray-700 font-semibold mb-2" for="bac" name="bac">Type de bac</label>
                    <input 
                        type="text" 
                        id="bac" 
                        name="bac" 
                        placeholder="Entrez le type de bac" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>

                    <!-- Année de Bac -->
                    <label class="block text-gray-700 font-semibold mb-2" for="annee_bac" name="annee_bac">Année de bac</label>
                    <input 
                        type="date" 
                        id="annee_bac" 
                        name="annee_bac" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-black"
                        required>
                </div>
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold shadow-md hover:bg-blue-700 transition">
                    Ajouter
                </button>
            </form>
        </div>
    </main>
    <br>

    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">
                Créé par <span class="text-white font-bold">OUBARGHOUZ</span>, <span class="text-white font-bold">OUBA</span>, <span class="text-white font-bold">BOUINCHA</span>, et <span class="text-white font-bold">BENALLA</span>
            </p>
        </div>
    </footer>

    <?php
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $matricule = $_POST['matricule'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $filiere = $_POST['filiere'];
            $annee = $_POST['annee'];  
            $type_bac = $_POST['bac'];  
            $annee_bac = $_POST['annee_bac'];

            if (empty($matricule) || empty($nom) || empty($prenom) || empty($filiere) || empty($annee) || empty($type_bac) || empty($annee_bac)) {
                echo "<script>alert('Veuillez remplir tous les champs.');</script>";
            } else {
                include 'config.php';

                $stmt = $conn->prepare(
                    "INSERT INTO	stagiares(matStagiare,nomStagiare,prenomStagiare,filiereStagiare,anneeEtude,typeBac,anneeBac) VALUES (?, ?, ?, ?, ?, ?, ?)"
                );

                if ($stmt === false) {
                    die("ERREUR !!! : " . $conn->error);
                }

                $stmt->bind_param("sssssss", $matricule, $nom, $prenom, $filiere, $annee, $type_bac, $annee_bac);

                if ($stmt->execute()) {
                    echo "<script>alert('Stagiaire ajouté avec succès.');</script>";
                } else {
                    echo "<script>alert('Erreur lors de l'ajout du stagiaire.');</script>";
                }

                $stmt->close();
            }
        }
    ?>
</body>
</html>


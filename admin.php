
<?php
$fichier = 'tombes.csv';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Souvenir Français — Comité de Poligny</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            max-width: 1100px;
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        h1 {
            color: #003366;
            border-bottom: 2px solid #003366;
            padding-bottom: 10px;
        }
        h2 {
            color: #003366;
            margin-top: 30px;
        }
        ul {
            margin-bottom: 20px;
        }
        li {
            margin-bottom: 8px;aAdmin.php
Sébastien Robin
vous
<?php
session_start();

// Mot de passe d'accès à l'administration
$mot_de_passe_secret = "Poligny2026!"; 
$fichier = 'tombes.csv';

// Gestion de la connexion / déconnexion
if (isset($_POST['password'])) {
    if ($_POST['password'] === $mot_de_passe_secret) {
        $_SESSION['logged_in'] = true;
    } else {
        $erreur = "Mot de passe incorrect.";
    }
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Si l'utilisateur n'est pas connecté, afficher le formulaire de connexion
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Connexion Admin</title></head>
<body style="font-family: Arial; margin: 50px;">
    <h2>Espace Administration — Souvenir Français</h2>
    <?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
    <form method="post">
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
<?php
    exit;
}

// Traitement 1 : Ajout manuel d'une tombe
if (isset($_POST['ajouter_tombe'])) {
    $nouvelle_ligne = [
        $_POST['commune'],
        $_POST['nom'],
        $_POST['emplacement'],
        $_POST['responsabilite'],
        $_POST['date_veille'],
        $_POST['etat']
    ];
    $handle = fopen($fichier, 'a');
    fputcsv($handle, $nouvelle_ligne, ';');
    fclose($handle);
    $message = "Sépulture ajoutée avec succès.";
}

// Traitement 2 : Remplacement complet via fichier Excel / CSV
if (isset($_FILES['fichier_csv']) && $_FILES['fichier_csv']['error'] === UPLOAD_ERR_OK) {
    move_uploaded_state($_FILES['fichier_csv']['tmp_name'], $fichier);
    move_uploaded_file($_FILES['fichier_csv']['tmp_name'], $fichier);
    $message = "Le fichier de données a été mis à jour avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panneau d'administration - Souvenir Français</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .box { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; background: #f9f9f9; }
        label { display: inline-block; width: 150px; margin-bottom: 10px; }
        input, select { padding: 5px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <p><a href="admin.php?action=logout">Se déconnecter</a> | <a href="index.php" target="_blank">Voir le site public</a></p>
    <h1>Administration des Sépultures</h1>

    <?php if (isset($message)) echo "<p style='color:green; font-weight:bold;'>$message</p>"; ?>

    <!-- Formulaire d'ajout rapide -->
    <div class="box">
        <h2>Ajouter une sépulture</h2>
        <form method="post">
            <label>Commune :</label><input type="text" name="commune" required><br>
            <label>Nom & Prénom :</label><input type="text" name="nom" required><br>
            <label>Emplacement :</label><input type="text" name="emplacement"><br>
            <label>Responsabilité :</label>
            <select name="responsabilite">
                <option value="Comité">Comité</option>
                <option value="Famille">Famille</option>
            </select><br>
            <label>Date de veille :</label><input type="date" name="date_veille" value="<?php echo date('Y-m-d'); ?>"><br>
            <label>État :</label><input type="text" name="etat" placeholder="Ex: Bon état, À rénover..."><br>
            <button type="submit" name="ajouter_tombe">Enregistrer la tombe</button>
        </form>
    </div>

    <!-- Téléversement direct depuis Excel/CSV -->
    <div class="box">
        <h2>Remplacer la liste complète via Excel/CSV</h2>
        <p>Préparez votre tableau dans Excel, enregistrez-le au format <strong>CSV (séparateur point-virgule)</strong> et envoyez-le ici :</p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="fichier_csv" accept=".csv" required>
            <button type="submit">Mettre à jour la base</button>
        </form>
    </div>

</body>
</html>


Envoyé à partir de Outlook pour Android
        }
        
        /* Tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Badges de couleur pour la responsabilité */
        .badge-comite {
            color: #d9534f;
            font-weight: bold;
        }
        .badge-famille {
            color: #337ab7;
            font-weight: bold;
        }

        /* Style pour la grille des communes */
        .table-communes td {
            width: 33%;
            background-color: #f4f6f9;
        }
    </style>
</head>
<body>

    <h1>Bienvenue sur le site du Souvenir Français — Comité de Poligny et son secteur</h1>

    <p>Le Souvenir Français veille à ce qu’aucun soldat mort pour la France ne soit oublié. Notre action locale s'articule autour de missions précises de sauvegarde et d'entretien du patrimoine mémoriel.</p>

    <h2>Nos missions fondamentales</h2>
    <ul>
        <li><strong>La veille mémorielle annuelle</strong> : un suivi régulier pour recenser les sépultures et s'assurer qu'aucune tombe de soldat « Mort pour la France » ne fasse l'objet d'un relèvement lorsqu'elle est constatée en état d'abandon.</li>
        <li><strong>L'entretien des tombes</strong> :
            <ul>
                <li><strong>Tombes sous la responsabilité du comité</strong> : la rénovation et la prise en charge directe des sépultures en déshérence ou sans famille.</li>
                <li><strong>Tombes à la charge des familles</strong> : le suivi et l'incitation auprès des ayants droit, qui conservent la responsabilité légale de l'entretien des concessions familiales.</li>
            </ul>
        </li>
    </ul>

    <h2>Notre secteur d'intervention</h2>
    <p>Notre comité intervient sur les 26 communes du territoire :</p>

    <table class="table-communes">
        <tbody>
            <tr><td>Abergement-le-Petit</td><td>Champrougier</td><td>Miéry</td></tr>
            <tr><td>Aumont</td><td>Le Chateley</td><td>Molain</td></tr>
            <tr><td>Barretaine</td><td>Chemenot</td><td>Montholier</td></tr>
            <tr><td>Bersaillin</td><td>Colonne</td><td>Neuvilley</td></tr>
            <tr><td>Besain</td><td>Fay-en-Montagne</td><td>Oussières</td></tr>
            <tr><td>Biefmorin</td><td>Grozon</td><td>Picarreau</td></tr>
            <tr><td>Bonnefontaine</td><td>Plasne</td><td>Poligny</td></tr>
            <tr><td>Brainans</td><td>Tourmont</td><td>Vaux-sur-Poligny</td></tr>
            <tr><td>Buvilly</td><td>Villers-les-Bois</td><td></td></tr>
            <tr><td>Chamole</td><td></td><td></td></tr>
        </tbody>
    </table>

    <p>Chaque tombe préservée garantit le respect du devoir de mémoire. Rejoignez-nous pour nous aider à protéger ce patrimoine historique commun.</p>

    <hr style="margin: 40px 0; border: 0; border-top: 1px solid #ccc;">

    <!-- SECTION D'AFFICHAGE DU TABLEAU ISSU DU CSV / EXCEL -->
    <h2>Inventaire et recensement des sépultures</h2>

    <table>
        <thead>
            <tr>
                <th>Commune</th>
                <th>Nom & Prénom</th>
                <th>Emplacement</th>
                <th>Responsabilité</th>
                <th>Dernière veille</th>
                <th>État de la tombe</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (file_exists($fichier) && ($handle = fopen($fichier, "r")) !== FALSE) {
                // Sauter la ligne d'en-tête du CSV
                fgetcsv($handle, 1000, ";");

                while (($ligne = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    if (count($ligne) >= 6) {
                        $respClass = (trim($ligne[3]) === 'Comité') ? 'badge-comite' : 'badge-famille';
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($ligne[0]) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne[1]) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne[2]) . "</td>";
                        echo "<td class='{$respClass}'>" . htmlspecialchars($ligne[3]) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne[4]) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne[5]) . "</td>";
                        echo "</tr>";
                    }
                }
                fclose($handle);
            } else {
                echo "<tr><td colspan='6'>Aucune donnée de recensement disponible pour le moment.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>


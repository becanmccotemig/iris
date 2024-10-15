<?php
    include "../../model/investor.php";
    include "../../database/database.php"; 

    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }

    $all_startups = getStartups($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Home Page</title>
</head>
<body>
<h1 class="title-home">Home</h1>
<section class="section">

    <?php 
        foreach ($all_startups as $row) { // Alterado para foreach
    ?>

    <div class="card">
        <div class="card-container">
            <div class="card-post-header">
                <h2 class='card-startup-name'> <?php echo htmlspecialchars($row["nomeStartup"]); ?> </h2>
                <h4 class='card-startup-area'> <?php echo htmlspecialchars($row["setor"]); ?> </h4>
            </div>

            <div class="card-startup-container">
                <p class='card-startup-desc'> <?php echo htmlspecialchars($row["descricao"]); ?> </p>
            </div>
            
            <div class="card-startup-footer">
                <p class='card-startup-website'> <?php echo htmlspecialchars($row["website"]); ?> </p>
                <p class='card-startup-email'> <?php echo htmlspecialchars($row["emailStartup"]); ?> </p>
                <p class='card-startup-contact'> <?php echo htmlspecialchars($row["contato"]); ?> </p>
            </div>

            <?php 
                $startup_id = $row['id'];
                $url = "details-startup.php?id=" . urlencode($startup_id);
                echo "<a href='$url' class='btn btn-primary'>Ver mais</a>";
            ?>
        </div>
    </div>
    <?php 
        }
    ?>

</section>
    
</body>
</html>

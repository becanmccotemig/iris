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
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/investor/header.css">
    <link rel="stylesheet" href="../../components/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/home.css">
    <link rel="stylesheet" href="../../design/global/global.css">

    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Home Page</title>
</head>

<body>

    <?php
    include_once '../../components/investor/header.php';
    ?>
    <h1 class="title-home">HOME</h1>
    <section class="section">
        <?php
        foreach ($all_startups as $row) {// Alterado para foreach
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


                    <?php
                    $startup_id = $row['id'];
                    $url = "details-startup.php?id=" . urlencode($startup_id);
                    echo "<a href='$url' class='btn btn-primary'>Ver mais</a>";
                    ?>

                    <div class="card-startup-footer">
                        <p class='card-startup-website'> <?php echo htmlspecialchars($row["website"]); ?> </p>
                        <p class='card-startup-email'> <?php echo htmlspecialchars($row["emailStartup"]); ?> </p>
                        <p class='card-startup-contact'> <?php echo htmlspecialchars($row["contato"]); ?> </p>
                    </div>


                </div>
            </div>
            <?php
        }
        ?>
    </section>
    <?php
    include_once '../../components/investor/footer.php';
    ?>
</body>

</html>
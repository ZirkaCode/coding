<?php
require_once('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../normalize.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Médiathèque</title>
</head>
<body>
    <header>
        <form action="index.php" method="get" id="recherche">
            <input type="text" name="search" value="<?php echo $search ?>" placeholder="Rechercher..." id="search">
            <button type="submit"><i class="fas fa-search"></i></button> 
        </form>
       
    </header>
    <div class="wrapper">
        <main>
            <section>
                    <?php navigation($page, $search, $max) ?>
               
            </section>
            <?php selection($tab, $page) ?>
        </main>
    

        <footer>
            <?php footer($search, $max) ?>
        </footer>
    </div>
</body>
</html>
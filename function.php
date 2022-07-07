<?php

    function connexion(){
        $dbh = null;

        $dbh = new PDO(
            "mysql:dbname=mediatheque;host=localhost;port=3308",
            "root",
            "",
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );

        return $dbh;
    }

    function select($dbh, $sql){
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        return $stmt -> fetchAll();	
    }

    function selection($tab, $page){
        if(!empty($tab)){
        for($i = ($page - 1) * 10; $i < $page * 10 && $i < count($tab); $i++){
            $row = $tab[$i];
            // $id = $row["films_id"];
            echo "
            <article>
                
                <h2>", $row['films_titre'], "</h2>
                <div class='bloc_article'>
                    <div>
                        <img src='img/".$row['films_affiche']."' alt='".$row['films_affiche']."'>", "</img>
                    </div>
                    <div class='description'>
                        <p>", $row['films_resume'], "</p>
                        
                        <h3>Réaliser par : ", $row['real_nom'], "</h3>
                        
                        <p>Genre : ", $row['genres_nom'], "</p>
                        <p>Durée : ", $row['films_duree'], "</p>
                        <p>Année de sortie : ", $row['films_annee'], "</p>
                        <p>Acteurs : ", $row['acteurs_nom'], "</p>
                    </div>
                </div>
            </article>
            <hr>
            ";
        }
    }else{
        echo "<h2 class='title-center'>Pas de résultat </h2>";
    }

    }

    function navigation($page, $search, $max){
        if($page > 1){
            $next = $page - 1;
            echo "<a href='index.php?page=$next&search=$search'>Précédent</a>";
        }
        else{
            echo "<p class='hidden'>Précédent</p>";
        }
        echo "<p> Page : $page sur $max </p>";

        if($page < $max){
            $next = $page + 1;
            echo "<a href='index.php?page=$next&search=$search'>Suivant</a>";
        }else{
            echo "<p class='hidden'>Suivant</p>";
        }
    }

    function footer($search, $max){
        for($i = 1; $i <= $max; $i++){
            echo "<a href='index.php?page=$i&search=$search'>$i</a>";
        }
    }
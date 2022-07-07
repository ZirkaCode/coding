<?php
require_once('function.php');

$page = isset($_GET['page'])?
    $_GET['page'] : 1;

$search = isset($_GET['search'])?
    $_GET['search'] : "";

try{
    $dbh = connexion();
    
    $sql = "
        select films_id, films_titre, films_resume, films_annee, films_affiche, films_duree, real_nom, group_concat(distinct genres_nom) as genres_nom, group_concat(acteurs_nom) as acteurs_nom
        from films
        
        join realisateurs on real_id = films_real_id
        join films_genres on fg_films_id = films_id
        join genres on genres_id = fg_genres_id
        join films_acteurs on fa_films_id = films_id
        join acteurs on acteurs_id = fa_acteurs_id
        where films_titre rlike '^.*".$search.".*$' OR acteurs_nom rlike '^.*".$search.".*$' OR real_nom rlike '^.*".$search.".*$' OR genres_nom rlike '^.*".$search.".*$'
        group by films_id, films_titre;
    ";
    $tab = select($dbh, $sql);

    $max = (count($tab)%10 <= 5)?
        count($tab)/10 + 1 : count($tab)/10;
    $max = number_format($max, 0);

}catch (Exception $ex) {
    die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
    //die affiche un message puis stoppe l’exécution du script puisqu’on a un grave pb de DB
}









require_once('template.php');
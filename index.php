<?php 
require_once "console.php";
require_once "club.php";
require_once "sponsor.php";


while(true){
    echo "menu\n";
    echo "======Club:=========\n";
    echo "1. Ajouter un club\n";
    echo "2. Modifier un club\n";
    echo "3. Suppimer un club\n";
    echo "4. Afficher un club\n";
    echo "======Sponsor:=========\n";
    echo "5. Afficher un sponsor\n";
    echo "6. Modifier un sponsor\n";
    echo "7. Supprimer un sponsor\n";
    echo "7. Afficher un sponsor\n";

    

    $cpnsole = new Console();

    $choix = $cpnsole->input("Entre votre choix");
    echo $choix;
    switch ($choix) {
        case '1':
            $c = new Club();
            $c->name = $cpnsole->input("Votre nom");
            $c->ville = $cpnsole->input("Votre ville");
            $c->create();
            break;
        case '3':
            $c = new Club();
            $c->id = $cpnsole->input("ID de club");
            $c->delete();
            break;
        case '4':
           $c = new Club();
           $rows = $c->getAll();
           foreach ($rows as $row) {
               echo "Nom : " . $row['name'] . "\n";
               echo "Ville : " . $row['ville'] . "\n";
               echo "------------------\n";
            }
            break;
        case '5':
            $sponsor = new Sponsor();
            $rows = $sponsor->getAll();
            
            foreach ($rows as $row) {
                echo "Nom : " . $row['name'] . "\n";
                echo "Contribution : " . $row['ctrb_financiere'] . "\n";
                echo "Tournoi ID : " . $row['tournoi_id'] . "\n";
                echo "------------------\n";
            }
            break;
        default:
            echo "YOUR CHOICE IS INVALIDE!!";
            break;
    }

    $cpnsole->clear();
}
?>

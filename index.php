<?php
require_once "database.php";
require_once "console.php";
require_once "club.php";
require_once "sponsor.php";
require_once "equipe.php";
require_once "joueur.php";
require_once "tournoi.php";
// spl_autoload_register(function($class) {
//     require $class.".php";
// })
// $console = new Equipe();

$console = new Console();
$connect=new Database();
$cnx=$connect->getConnection();

$v=new Club("safaa","casa");
$v->getAll($cnx);
/* ===== MENUS ===== */

function menuPrincipal() {
    echo "\n===== MENU PRINCIPAL =====\n";
    echo "1. Organisateur\n";
    echo "2. Admin Club\n";
    echo "0. Quitter\n";
}

function menuOrganisateur() {
    echo "\n--- Organisateur ---\n";
    echo "1. Sponsor\n";
    echo "2. Tournoi\n";
    echo "3. Matches\n";
    echo "4. Liste des clubs\n";
    echo "0. Retour\n";
}

function menuAdminClub() {
    echo "\n--- Admin Club ---\n";
    echo "1. Club\n";
    echo "2. Equipe\n";
    echo "3. Joueur\n";
    echo "0. Retour\n";
}

function menuCRUD($entity) {
    echo "\n--- $entity : CRUD ---\n";
    echo "1. Ajouter\n";
    echo "2. Afficher\n";
    echo "3. Modifier\n";
    echo "4. Supprimer\n";
    echo "0. Retour\n";
}

/* ===== PROGRAMME ===== */

while (true) {

    menuPrincipal();
    $choixPrincipal = $console->input("Votre choix");

    if ($choixPrincipal == 0) {
        echo "Programme terminé.\n";
        break;
    }

    /* ===== ORGANISATEUR ===== */
    if ($choixPrincipal == 1) {
        do {
            menuOrganisateur();
            $choixOrg = $console->input("Votre choix");

            /* ===== SPONSOR ===== */
            if ($choixOrg == 1) {
                do {
                    menuCRUD("Sponsor");
                    $crud = $console->input("Votre choix");

                    $sponsor = new Sponsor();

                    switch ($crud) {
                        case 1: // CREATE
                            $sponsor->name = $console->input("Nom");
                            $sponsor->ctrb_financiere = $console->input("Contribution");
                            $sponsor->tournoi_id = $console->input("ID Tournoi");
                            $sponsor->create();
                            break;

                        case 2: // READ
                            foreach ($sponsor->getAll() as $row) {
                                echo "{$row['name']} | {$row['ctrb_financiere']} | Tournoi {$row['tournoi_id']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $sponsor->id = $console->input("ID Sponsor");
                            $sponsor->name = $console->input("Nouveau nom");
                            $sponsor->ctrb_financiere = $console->input("Nouvelle contribution");
                            $sponsor->update();
                            break;

                        case 4: // DELETE
                            $sponsor->id = $console->input("ID Sponsor");
                            $sponsor->delete();
                            break;
                    }

                } while ($crud != 0);
            }

            /* ===== LISTE CLUBS (READ) ===== */
            if ($choixOrg == 4) {
                $club = new Club();
                foreach ($club->getAll() as $row) {
                    echo "Nom: {$row['name']} | Ville: {$row['ville']}\n";
                }
            }

        } while ($choixOrg != 0);
    }

    /* ===== ADMIN CLUB ===== */
    if ($choixPrincipal == 2) {
        do {
            menuAdminClub();
            $choixAdmin = $console->input("Votre choix");

            /* ===== CLUB ===== */
            if ($choixAdmin == 1) {
                do {
                    menuCRUD("Club");
                    $crud = $console->input("Votre choix");

                    $club = new Club();

                    switch ($crud) {
                        case 1: // CREATE
                            $club->name = $console->input("Nom du club");
                            $club->ville = $console->input("Ville");
                            $club->create();
                            break;

                        case 2: // READ
                            foreach ($club->getAll() as $row) {
                                echo "{$row['name']} - {$row['ville']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $club->id = $console->input("ID Club");
                            $club->name = $console->input("Nouveau nom");
                            $club->ville = $console->input("Nouvelle ville");
                            $club->update();
                            break;

                        case 4: // DELETE
                            $club->id = $console->input("ID Club");
                            $club->delete();
                            break;
                    }

                } while ($crud != 0);
            }

        } while ($choixAdmin != 0);
    }

    $console->clear();
}

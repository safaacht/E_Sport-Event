<?php

spl_autoload_register(function ($class) {
    require_once $class . ".php";
});


$console = new Console();
$connect=new Database();
$cnx=$connect->getConnection();

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
    echo "1. Gestion du Club\n";
    echo "2. Gestion d' Equipe\n";
    echo "3. Gestion du Joueur\n";
    echo "4. Envoyer demande de participation\n";
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
                            $sponsor->setName($console->input("Nom du sponsor")) ;
                            $sponsor->setContribution ($console->input("Contribution financière")) ;
                            $sponsor->setTournoiId ((int)$console->input("Tournoi id ")) ;
                            $sponsor->create($cnx);
                            break;
                            

                        case 2: // READ
                            foreach ($sponsor->getAll($cnx) as $row) {
                                echo "{$row['name']} - {$row['contribution_finan']} - {$row['tournoi_id']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $sponsor->setId((int)$console->input("ID Sponsor"));
                            $sponsor->setName($console->input("Nouveaua nom du sponsor")) ;
                            $sponsor->setContribution ($console->input("Nouvelle contribution financière")) ;
                            $sponsor->setTournoiId ((int)$console->input("Nouveau tournoi id ")) ;
                            $sponsor->update($cnx);
                            break;

                        case 4: // DELETE
                            $sponsor->setId($console->input("ID Sponsor")) ;
                            $sponsor->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }

             /* ===== TOURNOI ===== */
            if ($choixOrg == 2) {
                do {
                    menuCRUD("Tournoi");
                    $crud = $console->input("Votre choix");

                    $tournament = new Tournament();

                    switch ($crud) {
                        case 1: // CREATE
                            $tournament->setTitre($console->input("Titre du tournoi")) ;
                            $tournament->setCashprize ($console->input("Cashprize")) ;
                            $tournament->setFormat ($console->input("Format")) ;
                            $tournament->setTournoiDate ($console->input("Tournoi date")) ;
                            $tournament->create($cnx);
                            break;
                            

                        case 2: // READ
                            foreach ($tournament->getAllEvents($cnx) as $t) {
                                echo "ID: {$t['id']} | ";
                                echo "Titre: {$t['titre']} | ";
                                echo "Cashprize: {$t['cashprize']} | ";
                                echo "Format: {$t['format']} | ";
                                echo "Date: {$t['tounoi_date']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $tournament->setId($console->input("ID Tournoi")) ;
                            $tournament->setTitre($console->input("Nouveau titre du tournoi")) ;
                            $tournament->setCashprize ($console->input("Nouveau cashprize")) ;
                            $tournament->setFormat ($console->input("Nouvelle format")) ;
                            $tournament->setTournoiDate ($console->input("Nouvelle date")) ;
                            $tournament->update($cnx);
                            break;

                        case 4: // DELETE
                            $tournament->setId($console->input("ID Tournoi")) ;
                            $tournament->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }

             /* ===== MATCHE ===== */
            if ($choixOrg == 3) {
                do {
                    menuCRUD("Matches");
                    $crud = $console->input("Votre choix");

                    $matches = new Matches();

                    switch ($crud) {
                        case 1: // CREATE
                            $club->setName($console->input("Nom du club")) ;
                            $club->setVille ($console->input("Ville")) ;
                            $club->create($cnx);
                            break; 

                        case 2: // READ
                            foreach ($club->getAll($cnx) as $row) {
                                echo "{$row['name']} - {$row['ville']}\n";
                            }
                            break;


                        case 4: // DELETE
                            $matches->setId($console->input("ID Match")) ;
                            $matches->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }


            /* ===== LISTE CLUBS (READ) ===== */
            if ($choixOrg == 4) {
                $club = new Club();
                foreach ($club->getAll($cnx) as $row) {
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
                    $data = $club->getAll($cnx);

                    switch ($crud) {
                        case 1: // CREATE
                            $club->setName($console->input("Nom du club"));
                            $club->setVille($console->input("Ville"));
                            $club->create($cnx);
                           
                            
                            break;

                        case 2: // READ
                            echo "Total clubs: " . $data['total_clubs'] . "\n";
                            foreach ($data['clubs'] as $c) {
                                echo "{$c['id']} - {$c['name']} - {$c['ville']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $club->setId((int)$console->input("ID Club"));
                            $club->setName($console->input("Nouveau nom"));
                            $club->setVille($console->input("Nouvelle ville"));
                            $club->update($cnx);
                            break;

                        case 4: // DELETE
                            $club->setId((int)$console->input("ID Club")) ;
                            $club->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }

             /* ===== EQUIPE ===== */
            if ($choixAdmin == 2) {
                do {
                    menuCRUD("Equipe");
                    $crud = $console->input("Votre choix");

                    $equipe = new Equipe();

                    switch ($crud) {
                        case 1: // CREATE
                            $equipe->setName($console->input("Nom d'equipe"));
                            $equipe->setJeu($console->input("Jeu"));
                            $equipe->setClub((int)$console->input("Your club id"));
                            $equipe->create($cnx);
                            break;
                            

                        case 2: // READ
                            foreach ($equipe->getAll($cnx)as $row){
                                echo "{$row['name']} - {$row['jeu']} - {$row['club_id']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $equipe->setId((int)$console->input("ID Equipe"));
                            $equipe->setName($console->input("Nouveau nom"));
                            $equipe->setJeu($console->input("Nouveau jeu"));
                            $equipe->setClub((int)$console->input("Nouveau club id"));
                            $equipe->update($cnx);
                            break;

                        case 4: // DELETE
                            $equipe->setId($console->input("ID Equipe"));
                            $equipe->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }

             /* ===== JOUEUR ===== */
            if ($choixAdmin == 3) {
                do {
                    menuCRUD("Joueur");
                    $crud = $console->input("Votre choix");

                    $joueur = new Joueur();

                    switch ($crud) {
                        case 1: // CREATE
                            $joueur->setPseudo($console->input("Entrer votre pseudo"));
                            $joueur->setRole($console->input("Entrer votre role"));
                            $joueur->setSalaire((int)$console->input("Entrer votre salaire"));
                            $joueur->setTeamId($console->input("Entrer team id"));
                            $joueur->creat($cnx);
                            break;
                            

                        case 2: // READ
                            foreach ($joueur->getAll($cnx) as $row) {
                                echo "{$row['pseudo']} - {$row['role']} - {$row['salaire']} - {$row['team_id']}\n";
                            }
                            break;

                        case 3: // UPDATE
                            $joueur->setId((int)$console->input("ID Joueur"));
                            $joueur->setPseudo($console->input("Entrer le nouveau pseudo"));
                            $joueur->setRole($console->input("Entrer le nouveau role"));
                            $joueur->setSalaire((int)$console->input("Entrer le nouveau salaire"));
                            $joueur->setTeamId($console->input("Entrer le nouveau team id"));
                            $joueur->update($cnx);
                            break;

                        case 4: // DELETE
                            $joueur->setId((int)$console->input("ID Joueur"));
                            $joueur->delete($cnx);
                            break;
                    }

                } while ($crud != 0);
            }

            if ($choixAdmin == 4){

                $club = new Club();
                $data = $club->getAll($cnx);
                $tournoi=new Tournament();


                foreach ($data['clubs'] as $c) {
                        echo " Id: {$c['id']} \t-Name: {$c['name']}\n";
                }

                $club->setId((int)$console->input("ID Club"));
                
                
                $tournoi->affichage($cnx);
                $tournoi->setId((int)$console->input("ID Tournoi"));


            }


        } while ($choixAdmin != 0);
    }

    $console->clear();
}

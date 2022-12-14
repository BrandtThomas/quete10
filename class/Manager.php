<?php

use LDAP\Result;

class Manager
{

    private $dbConnect;

    public function __construct()
    {
        $this->dbConnect = Database::dbConnect();
    }


    function tableVerif($table)
    {
        $sql = "SHOW TABLES LIKE '{$table}'";
        $result = $this->dbConnect->query($sql);

        if ($result->rowCount() > 0)
            return TRUE;
        else
            return FALSE;
    }


    public function createTable($table)
    {
        $sql = "CREATE TABLE $table( 
            id INT NOT NULL AUTO_INCREMENT, 
            champion VARCHAR(64) NOT NULL, 
            description VARCHAR(256) NOT NULL, 
            age INT NOT NULL, size FLOAT NOT NULL, 
            img VARCHAR(256) NOT NULL, 
            PRIMARY KEY ( id )) ENGINE=InnoDB;";

        $query = $this->dbConnect->prepare($sql);
        $query->execute();
    }

    public function readAll($table)
    {
        $sql = "SELECT * FROM $table";
        $query = $this->dbConnect->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteAll($table)
    {
        $sql = "DELETE FROM $table";
        $query = $this->dbConnect->prepare($sql);

        $query->execute();
    }

    public function deleteTable($table)
    {
        $sql = "DROP TABLE $table";
        $query = $this->dbConnect->prepare($sql);
        $query->execute();
    }


    public function readByAge($table)
    {
        $sql = "SELECT * FROM $table ORDER BY age DESC";
        $query = $this->dbConnect->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteRandom($table)
    {
        $sql = "SELECT * FROM $table";
        $query = $this->dbConnect->prepare($sql);
        $query->execute();
        $list = $query->fetchAll();
        if (empty($list)) {
            return 0;
        } else {
            $count = count($list);
            $selectId = $list[rand(0, $count - 1)]['id'];

            $sql = "DELETE FROM $table WHERE id = :param1";
            $query = $this->dbConnect->prepare($sql);

            $query->bindParam(':param1', $selectId, PDO::PARAM_INT);

            $query->execute();
            return 1;
        }
    }

    public function updateIntoHulk($table, Learner $learner, $selectId)
    {

        $champion = $learner->getChampion();
        $description = $learner->getDescription();
        $age = $learner->getAge();
        $size = $learner->getSize();
        $img = $learner->getImg();

        $sql = "UPDATE $table SET `champion`= :param1 , `description` = :param2, `age`= :param3, `size`= :param4, `img` = :param5 WHERE `id` = :param6";
        $query = $this->dbConnect->prepare($sql);

        $query->bindParam(':param1', $champion, PDO::PARAM_STR);
        $query->bindParam(':param2', $description, PDO::PARAM_STR);
        $query->bindParam(':param3', $age, PDO::PARAM_INT);
        $query->bindParam(':param4', $size, PDO::PARAM_STR);
        $query->bindParam(':param5', $img, PDO::PARAM_STR);
        $query->bindParam(':param6', $selectId, PDO::PARAM_INT);

        $query->execute();
    }

    public function creatChampion($table, Learner $learner)
    {

        $champion = $learner->getChampion();
        $description = $learner->getDescription();
        $age = $learner->getAge();
        $size = $learner->getSize();
        $img = 'img/champImg/imgPlaceholder.png';

        $sql = "INSERT INTO $table (`champion`, `description`, `age`, `size`, `img`) VALUES (:param1, :param2, :param3, :param4, :param5)";
        $query = $this->dbConnect->prepare($sql);

        $query->bindParam(':param1', $champion, PDO::PARAM_STR);
        $query->bindParam(':param2', $description, PDO::PARAM_STR);
        $query->bindParam(':param3', $age, PDO::PARAM_INT);
        $query->bindParam(':param4', $img, PDO::PARAM_STR);
        $query->bindParam(':param5', $size, PDO::PARAM_STR);

        $query->execute();
    }


    public function createAll()
    {


        $sql = "INSERT INTO `champion` (`id`, `champion`, `description`, `age`, `size`, `img`) VALUES
        (1, 'Aatrox', 'Aatrox lib??re sa forme d??moniaque, effrayant les sbires ennemis proches et augmentant ses d??g??ts d\'attaque, ses soins et sa vitesse de d??placement.', 5000, 6.78, 'img/champImg/aatrox.png'),
        (2, 'Ahri', 'Dot??e d\'un lien inn?? avec le pouvoir naturel de Runeterra, Ahri est une Vastaya capable de modeler la magie pour en faire des orbes d\'??nergie pure.', 30, 1.67, 'img/champImg/ahri.png'),
        (3, 'Akali', 'Ayant abandonn?? l\'Ordre Kinkou et le titre de Poing de l\'ombre, Akali combat aujourd\'hui seule, pr??te ?? devenir l\'arme mortelle dont son peuple a besoin.', 22, 1.6, 'img/champImg/akali.png'),
        (4, 'Akshan', 'Akshan tire un grappin qui se plante dans le premier ??l??ment de terrain touch??. Une fois le grappin plant??, il peut relancer la comp??tence pour se balancer le long du terrain dans la direction vis??e tout en infligeant des d??g??ts physiques ?? l\'ennemi le plu', 25, 1.7, 'img/champImg/akshan.png'),
        (5, 'Alistar', 'Alistar est le plus puissant des guerriers n??s dans les tribus de Minotaures de la Grande barri??re et il a prot??g?? sa tribu contre les nombreux dangers de Valoran, jusqu\'?? l\'arriv??e de l\'arm??e noxienne.', 200, 3.2, 'img/champImg/alistar.png'),
        (6, 'Anivia', 'Anivia est un ??tre issu du plus glacial hiver, une incarnation mystique de la magie du givre, un protecteur antique de Freljord.', 10000, 137, 'img/champImg/anivia.png'),
        (7, 'Annie', 'Annie a la particularit?? de r??agir vite aux situations les plus stressantes ! Ind??pendante, elle sait se d??brouiller sans l\'aide de personne. Annie aime plaire et appr??cie quand on s\'int??resse ?? elle.', 9, 1.27, 'img/champImg/annie.png'),
        (8, 'Aphelios', 'Aphelios manie 5 armes de Lunari forg??es par sa s??ur Alune. Il peut en porter deux ?? la fois : une principale et une secondaire. ', 25, 1.83, 'img/champImg/aphelios.png'),
        (9, 'Ashe', 'Chef de guerre sublim?? de la tribu des Avarosans, Ashe est ?? la t??te de la plus vaste horde des terres du nord.', 21, 1.75, 'img/champImg/ashe.png'),
        (10, 'Aurelion Sol', 'Autrefois, Aurelion Sol fa??onnait des merveilles c??lestes dont il parsemait le vide infini du cosmos. ?? pr??sent, il est forc?? d\'utiliser ses pouvoirs extraordinaires pour le compte d\'un empire de l\'espace qui s\'est jou?? de lui et l\'a r??duit en esclavage.', 90000, 24000, 'img/champImg/aurelionSol.png'),
        (11, 'Azir', 'Azir fut l\'empereur mortel de Shurima en des temps tr??s lointains, un homme fier dress?? au bord de l\'immortalit??. Son orgueil lui valut d\'??tre trahi et assassin?? ?? l\'heure de son triomphe.', 2000, 2.56, 'img/champImg/azir.png'),
        (12, 'Bard', 'Voyageur d\'au-del?? des ??toiles, Bard est un messager des bons augures qui combat pour maintenir l\'??quilibre entre la cr??ation et l\'indiff??rence du chaos.', 80000, 10000, 'img/champImg/bard.png'),
        (13, 'Bel\'Veth', 'Bel\'Veth est un jungler capable de multiplier les attaques dans un d??lai de temps tr??s court', 650, 48, 'img/champImg/belveth.png'),
        (14, 'Blitzcrank', 'Blitzcrank est un gigantesque golem de vapeur quasi indestructible, construit ?? l\'origine pour manipuler les d??chets dangereux de Zaun. ', 6, 2.74, 'img/champImg/blitzcrank.png'),
        (15, 'Brand', 'Autrefois membre d\'une tribu de Freljord, Kegan Rodhe est devenu l\'??tre que l\'on conna??t sous le nom de Brand ?? force de convoiter des pouvoirs toujours plus grands.', 250, 1.78, 'img/champImg/brand.png'),
        (16, 'Braum', 'Dot?? de biceps ??normes, et d\'un c??ur plus grand encore, Braum est un h??ros admir?? par tout Freljord. Lors de tous les banquets au nord de Frostheld, on rend hommage ?? sa force l??gendaire.', 45, 2.26, 'img/champImg/braum.png'),
        (17, 'Caitlyn', 'Caitlyn est la plus c??l??bre gardienne de la paix ?? Piltover, mais elle est aussi la plus apte ?? d??barrasser la ville de ses criminels les plus insaisissables.', 28, 1.7, 'img/champImg/caitlyn.png'),
        (18, 'Camille', 'Camille est un agent d\'??lite, au service des hautes sph??res, qui travaille ?? maintenir l\'ordre dans Piltover. C\'est son d??vouement ?? son devoir qui a conduit l\'Ombre d\'acier ?? transformer son corps.', 70, 2.08, 'img/champImg/camille.png'),
        (19, 'Cassiopeia', 'Cassiopeia est une cr??ature meurtri??re qui excelle dans l\'art de la manipulation. Elle ??tait la plus jeune et la plus belle des filles de la famille noxienne Du Couteau.', 26, 3.96, 'img/champImg/cassiopeia.png'),
        (20, 'Amumu', 'La l??gende veut qu\'Amumu soit une ??me solitaire et m??lancolique de la Shurima antique et qu\'il parcoure le monde ?? la recherche d\'un ami.', 8000, 1.09, 'img/champImg/amumu.png');";
        $query = $this->dbConnect->prepare($sql);



        $query->execute();
    }
}

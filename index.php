<?php
include 'class/Manager.php';
include 'class/Learner.php';
include 'class/Tool.php';
include 'config/Database.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud POO - Quete 10</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="public/styles/style.css">
</head>

<body>
    <?php include 'templates/header.php'; ?>

    <section class="container">
        <div class="row justify-content-center">
            <?php
            $manager = new Manager('champion');
            if (isset($_POST['tableRead'])) {

                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    $list = $manager->readAll('champion');
                    if (!empty($list)) {
                        foreach ($list as $value) { ?>

                            <div class="cardRead m-2 col-12 col-sm-3 text-center text-light p-4 flex-column">
                                <img class="col-12" src="<?php echo $value['img']; ?>" alt="img champ">
                                <div>
                                    <h3><?php echo $value['id']; ?> - <?php echo $value['champion']; ?></h3>
                                    <p><?php echo $value['description']; ?></p>
                                    <div class="row text-center">
                                        <div class="col-3">age</div>
                                        <div class="col-3"><?php echo $value['age']; ?></div>
                                        <div class="col-3">taille</div>
                                        <div class="col-3"><?php echo $value['size']; ?></div>
                                    </div>
                                </div>
                            </div>

                        <?php    }
                    } else {
                        include 'templates/messages/table/emptyTable.php';
                    }
                }
            }

            if (isset($_POST['tableVider'])) {

                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    $list = $manager->readAll('champion');

                    if (!empty($list)) {
                        $manager->deleteALL('champion');
                        include 'templates/messages/table/cleanTable.php';
                    } else {
                        include 'templates/messages/table/alreadyEmptyTable.php';
                    }
                }
            }

            if (isset($_POST['tableCreate'])) {

                if ($manager->tableVerif('champion') == TRUE) {
                    include 'templates/messages/table/alreadyExistTable.php';
                }

                if ($manager->tableVerif('champion') == FALSE) {
                    $manager->createTable('champion');
                    include 'templates/messages/table/createTable.php';
                }
            }

            if (isset($_POST['tableDelete'])) {

                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    $manager->deleteTable('champion');
                    include 'templates/messages/table/deleteTable.php';
                }
            }

            if (isset($_POST['champCreateForm'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    include 'templates/form/createForm.php';
                }
            }

            if (isset($_POST['submitAddChampion'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    $learner = new Learner;
                    $array = [
                        'champion' => $_POST['addChampionInput'],
                        'description' => $_POST['addDescriptionInput'],
                        'age' => $_POST['addAgeInput'],
                        'size' => $_POST['addSizeInput']
                    ];
                    $learner->hydrate($array);
                    $manager->creatChampion('champion', $learner);
                    include 'templates/messages/addChampion.php';
                }
            }

            if (isset($_POST['champRead'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }

                if ($manager->tableVerif('champion') == TRUE) {
                    $tool = new Tool;
                    $list = $manager->readAll('champion');

                    if (!empty($list)) {
                        $list = $tool->getRandomFromArray($list);
                        ?>

                        <div class="cardRead m-2 col-12 col-sm-3 text-center text-light p-4 flex-column">
                            <img class="col-12" src="<?php echo $list['img']; ?>" alt="img champ">
                            <div>
                                <h3><?php echo $list['id']; ?> - <?php echo $list['champion']; ?></h3>
                                <p><?php echo $list['description']; ?></p>
                                <div class="row text-center">
                                    <div class="col-3">age</div>
                                    <div class="col-3"><?php echo $list['age']; ?></div>
                                    <div class="col-3">taille</div>
                                    <div class="col-3"><?php echo $list['size']; ?></div>
                                </div>
                            </div>
                        </div>

                        <?php } else {
                        include 'templates/messages/table/emptyTable.php';
                    }
                }
            }

            if (isset($_POST['champTransformHulk'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }

                if ($manager->tableVerif('champion') == TRUE) {
                    $learner = new Learner;
                    $list = $manager->readAll('champion');

                    if (!empty($list)) {
                        if (count($list) <= 4) {
                            include 'templates/messages/champion/lessThanFiveChampHulk.php';
                        } else {
                            if ($list[4]['champion'] == 'Hulk') {
                                include 'templates/messages/champion/fifthAlreadyHulk.php';
                            } else {
                                $array = [
                                    'champion' => 'Hulk',
                                    'description' => 'Je suis devenu giga balaise et je suis tout vert ! Bouh !!!!!',
                                    'age' => 50,
                                    'size' => 2.4,
                                    'img' => "img/champImg/hulk.png"
                                ];
                                $learner->hydrate($array);
                                $manager->updateIntoHulk('champion', $learner, $list[4]['id']);
                                include 'templates/messages/champion/transformIntoHulk.php';
                            }
                        }
                    } else {
                        include 'templates/messages/table/emptyTable.php';
                    }
                }
            }

            if (isset($_POST['champDeleteRand'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }

                if ($manager->tableVerif('champion') == TRUE) {
                    $list = $manager->readAll('champion');
                    if (!empty($list)) {
                        $manager->deleteRandom('champion');
                        include 'templates/messages/table/deleteRandom.php';
                    } else {
                        include 'templates/messages/table/emptyTable.php';
                    }
                }
            }

            if (isset($_POST['champReadAge'])) {
                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }

                if ($manager->tableVerif('champion') == TRUE) {
                    $list = $manager->readByAge('champion');
                    if (!empty($list)) {
                        foreach ($list as $value) { ?>
                            <div class="cardRead m-2 col-12 col-sm-3 text-center text-light p-4 flex-column">
                                <img class="col-12" src="<?php echo $value['img']; ?>" alt="img champ">
                                <div>
                                    <h3><?php echo $value['id']; ?> - <?php echo $value['champion']; ?></h3>
                                    <p><?php echo $value['description']; ?></p>
                                    <div class="row text-center">
                                        <div class="col-3">age</div>
                                        <div class="col-3"><?php echo $value['age']; ?></div>
                                        <div class="col-3">taille</div>
                                        <div class="col-3"><?php echo $value['size']; ?></div>
                                    </div>
                                </div>
                            </div>
            <?php }
                    } else {
                        include 'templates/messages/table/emptyTable.php';
                    }
                }
            }

            if (isset($_POST['createAll'])) {

                if ($manager->tableVerif('champion') == FALSE) {
                    include 'templates/messages/table/noTable.php';
                }
                if ($manager->tableVerif('champion') == TRUE) {
                    $list = $manager->readAll('champion');
                    if (!empty($list)) {
                        include 'templates/messages/table/mustCleanTable.php';
                    } else {
                        $manager->createAll();
                        include 'templates/messages/champion/addAllChampions.php';
                    }
                }
            }
            ?>
        </div>
    </section>

</body>

</html>
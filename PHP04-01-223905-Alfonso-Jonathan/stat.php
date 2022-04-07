<?php

    ///// SCHOOL /////

    class School {
        private $_id;

        public function __construct(array $schoolData) {
            $this->setId($schoolData['id']);
        }

        public function setId($id) {
            if ((is_int($id)) AND ($id > 0)) {
                $this->_id = $id;
            }
        }

        public function getId() {
            return $this->_id;
        }
    }

    class schoolManager {
        private $_db;

        public function __construct($db) {
            $this->setDb($db);
        }

        public function setDb(PDO $dbh) {
            $this->_db = $dbh;
        }

        public function getSchoolId($id = '') {
            $sql = 'SELECT id FROM highschool';
            $stmnt = $this->_db->prepare($sql);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                while ($row = $stmnt->fetch()) {
                    $school_data['id'] = $row['id'];
                    echo 'L\'ID ' . $school_data['id'] . ' a été sélectionné dans la base de données. <br>';
                }
            }
        }
    }


    ///// PUPIL /////

    class Pupil {
        private $_name;
        private $_school_id;

        public function __construct(array $pupilData) {
            $this->setName($pupilData['name']);
            $this->setSchoolId();
        }

        public function setName($name) {
            if (is_string($name)) {
                $names = array(
                    'John', 'Kelly', 'James', 'Frederic', 'Linda', 'William', 'Lucy', 'Tom', 'Ash', 'Mark', 'Olivia', 'Kurt', 'Jai', 'Adriana', 'Mike', 'Li', 'Joshua', 'Vinh', 'Isaac', 'Douglas', 'Malcolm', 'Jerome', 'Grace', 'Alice', 'Margaret', 'Roma', 'Otto', 'Victor', 'Robert', 'Leon', 'August', 'Jane', 'Shane', 'Adam', 'Min', 'Paul', 'Dunn', 'Hong', 'Jones', 'Lincoln', 'Tashi', 'Naiya', 'Vladimir', 'Sarah', 'Carlo', 'Gabriel', 'Tedra', 'Anthony', 'Scott', 'Jameson', 'Edward', 'Holly', 'Olympia', 'Horatio', 'Sean', 'Carter', 'Catherine', 'Jun', 'Emile', 'Jorge', 'Thom', 'Rosenda', 'Jonah', 'Roland', 'Cortana', 'Isabel', 'Vergil', 'Serina', 'Nero', 'Lorelei', 'Cleo', 'Juliana', 'Kalmiya', 'Sloan', 'Mack', 'Avery', 'Gladys', 'Kevin', 'Janissary', 'Daisy', 'Naomi', 'Leon', 'Randall', 'Anton', 'Keiichi', 'Serin', 'Soren', 'Cassandra', 'René', 'Musa', 'Ralph', 'Jonathan', 'Gordon', 'Henry', 'Morgan', 'Leslie', 'Shannon', 'Taylor', 'Lani', 'Cameron', 'Emerson', 'Devon', 'Dennis', 'Andrew', 'Aine', 'Douglas', 'Ellen', 'Lulu', 'Terrence', 'Donald', 'Alexander'
                );

                $rand_pupil = array_rand($names, 2);
                $name = $names[$rand_pupil[0]];
                $this->_name = $name;
            }
        }

        public function setSchoolId() {
            $school_id = rand(1, 3);
            $this->_school_id = $school_id;
        }

        public function getName() {
            return $this->_name;
        }

        public function getSchoolId() {
            return $this->_school_id;
        }
    }

    class pupilManager {
        private $_db;

        public function __construct($db) {
            $this->setDb($db);
        }

        public function setDb(PDO $dbh) {
            $this->_db = $dbh;
        }

        public function addPupil(Pupil $pupil) {
            $sql = 'INSERT INTO pupils (name, school_id) 
                    VALUES (:name, :school_id)';
            $stmnt = $this->_db->prepare($sql);
            $pupilName = htmlspecialchars($pupil->getName());
            $schoolId = $pupil->getSchoolId();
            $stmnt->bindParam(':name', $pupilName);
            $stmnt->bindParam(':school_id', $schoolId);
            if ($stmnt->execute()) {
                return $this->_db->lastInsertId();
            }
            return false;

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                echo 'L\'élève ' . $pupil->getName() . ' a été généré aléatoirement et enregistré dans la base de données. <br>';
            }
        }

        public function getPupilBySchool() {
            try {
                $bdh = new PDO('mysql:host=localhost; dbname=php04-01-223905', 'root', '');
            } catch (Exception $e) {
                echo 'Message erreur SQL : ' . $e->getMessage() . '<br>';
                exit;
            }

            $sql = 'SELECT school_name, COUNT(p.id) AS total
                    FROM pupils AS p
                    INNER JOIN highschool AS h
                    WHERE p.school_id = h.id
                    GROUP BY school_id';
            $stmnt = $bdh->prepare($sql);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                while ($row = $stmnt->fetch()) {
                    $pupil_data['school_name'] = $row['school_name'];
                    $pupil_data['total'] = $row['total'];

                    echo $pupil_data['school_name'] = $row['school_name'] . ' : ' . $pupil_data['total'] = $row['total'] . ' élèves. <br>';
                }
            }
        }
    }


    ///// SPORT /////

    class Sport {
        private $_pupil_id;
        private $_sport_id;

        public function __construct(array $sportData) {
            $this->setPupilId($sportData['pupil_id']);
            $this->setSportId();
        }

        public function setPupilId($pupil_id) {
            if ((is_int($pupil_id)) AND ($pupil_id > 0)) {
                $this->_pupil_id = $pupil_id;
            }
        }

        public function setSportId() {
            $sport_id = rand(1, 5);
            $this->_sport_id = $sport_id;
        }

        public function getPupilId() {
            return $this->_pupil_id;
        }

        public function getSportId() {
            return $this->_sport_id;
        }
    }

    class sportManager {
        private $_db;

        public function __construct($db) {
            $this->setDb($db);
        }

        public function setDb(PDO $dbh) {
            $this->_db = $dbh;
        }

        public function addSport(Sport $sport) {
            $sql = 'INSERT INTO pupil_sport (pupil_id, sport_id)
                    VALUES (:pupil_id, :sport_id)';
            $stmnt = $this->_db->prepare($sql);
            $pupilId = $sport->getPupilId();
            $sportId = $sport->getSportId();
            $stmnt->bindParam(':pupil_id', $pupilId);
            $stmnt->bindParam(':sport_id', $sportId);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                echo 'Le sport ' . $sport->getSportId() . ' a été généré aléatoirement pour l\'élève dont l\'id est ' . $sport->getPupilId() . ' et enregistré dans la base de données. <br>';
            }
        }

        public function atLeastOneSport() {
            try {
                $dbh = new PDO('mysql:host=localhost; dbname=php04-01-223905', 'root', '');
            } catch (Exception $e) {
                echo 'Message erreur SQL ' . $e->getMessage() . '<br>';
                exit;
            }

            $sql = 'SELECT COUNT(DISTINCT pupil_id) AS student
                    FROM pupil_sport';
            $stmnt = $dbh->prepare($sql);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                while ($row = $stmnt->fetch()) {
                    $pupil_data['student'] = $row['student'];

                    echo 'Il y a ' . $pupil_data['student'] = $row['student'] . ' élèves pratique au moins un sport.';
                }
            }
        }

        public function numbersSports() {
            try {
                $bdh = new PDO('mysql:host=localhost; dbname=php04-01-223905', 'root', '');
            } catch (Exception $e) {
                echo 'Message erreur SQL ' . $e->getMessage() . '<br>';
                exit;
            }

            $sql = 'SELECT COUNT(DISTINCT sport_id, pupil_id) AS totalActivities
                    FROM pupil_sport';
            $stmnt = $bdh->prepare($sql);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                while ($row = $stmnt->fetch()) {
                    $pupil_data['totalActivities'] = $row['totalActivities'];

                    echo 'Il y a ' . $pupil_data['totalActivities'] = $row['totalActivities'] . ' activités physiques pratiquées. <br>';
                }
            }
        }

        public function eachSportList() {
            try {
                $dbh = new PDO('mysql:host=localhost; dbname=php04-01-223905', 'root', '');
            } catch (Exception $e) {
                echo 'Message erreur SQL ' . $e->getMessage() . '<br>';
                exit;
            }

            $sql = 'SELECT sport, COUNT(DISTINCT pupil_id, sport) AS totalBySport
                    FROM sports AS s
                    INNER JOIN pupil_sport AS u
                    WHERE u.sport_id = s.id
                    GROUP BY sport
                    ORDER BY totalBySport ASC';
            $stmnt = $dbh->prepare($sql);
            $stmnt->execute();

            $errors = $stmnt->errorInfo();
            if ($errors[0] != '00000') {
                echo 'Erreur SQL ' . $errors[2];
            } else {
                while ($row = $stmnt->fetch()) {
                    $pupil_data['sport'] = $row['sport'];
                    $pupil_data['totalBySport'] = $row['totalBySport'];

                    echo $pupil_data['sport'] = $row['sport'] . ' : ' . $pupil_data['totalBySport'] = $row['totalBySport'] . ' élèves pratiquent ce sport. <br>';
                }
            }
        }
    }
?>
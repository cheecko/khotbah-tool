<?php 
    class Sermon {
        public function __construct() {
            $host = "localhost";
            $dbname = "ficg";
            $username = "root";
            $password = "";

            $dsn = "mysql:host={$host}; dbname={$dbname}";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo = $pdo;
        }

        public function reconstructAudioData($data) {
            foreach($data as $key=>$value) {
                $result[$key] = $value[0]; 
            }
            return $result;
        }

        public function getSermon() {
            $sql = "SELECT s.id, DATE_FORMAT(s.date, '%d.%m.%Y') as `date`, s.title, s.album, s.speaker as speaker_id, m.name as speaker, s.audio_file 
                    FROM sermon s
                    JOIN member m
                    ON s.speaker = m.id
                    ORDER BY s.date desc";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        public function getSpeaker() {
            $sql = "SELECT id, name FROM member WHERE speaker = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        public function setSermon($data) {
            if(!isset($data["date"]) || !isset($data["title"]) || !isset($data["album"]) || !isset($data["artist"]) || !isset($data["filename"])) {
                throw new Exception("Some meta data is missing!");
            }

            $date = date("Y-m-d", strtotime($data["date"]));
            $title = $data["title"];
            $album = $data["album"];
            $speaker = $data["artist"];
            $audio_file = $data["filename"];

            $sql = "INSERT INTO sermon (`date`, title, album, speaker, audio_file) 
                    SELECT ?, ?, ?, id, ?
                    FROM member
                    WHERE name = ? AND speaker = 1
                    ON DUPLICATE KEY UPDATE `date` = ?";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute(["$date", "$title", "$album", "$audio_file", "$speaker", "$date"]);

            return $result;
        }
    }
?>
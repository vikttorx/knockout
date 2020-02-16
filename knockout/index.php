<?php

class db
{
    function __construct($localhost, $username, $password, $database)
    {
        $host = $localhost;
        $db = $database;
        $user = $username;
        $pass = $password;
        $charset = 'utf8mb4';

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        try {
            $pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

//new db('localhost', 'root', '', 'knockout');

class Matching {

    /**
     * `id`,
     * `win_by_player_id`,
     * `player_id_1`,
     * `player_id_2`,
     * `round_type_id`,
     * `day`,
     * `in_time`,
     * `end_time`
     */

    protected $pdo;
    function __construct()
    {
        $this->pdo = new db('localhost', 'root', '', 'knockoutt');
    }


    function id($id = 0){

    }

    function update_win_by($id, $player_id){
        $sql = "UPDATE matching SET win_by_player_id=? where id=?";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$player_id, $id]);
    }

    function get_roundtype($round_type_id){
        //return roundtype by join
        $rounds = new Rounds();
        $rounds->getRoundType($round_type_id);
    }

    function getDate(){
        // return day time in and time end for alarm
    }
}

class Maxpoints {
    /**
     * `id`,
     * `amount`,
     * `player_id`
     */

    function check180($value){
        if($value == 180){
            //insert into using player id and add amount (iterate by sql)
            return true;
        }
    }
}

class Player {
    /**
     * `id`,
     * `name`
     */
    function createPlayer(){
        // insert into values
    }
    function removePlayer($id){
        //delete from player where id = $id
    }
    function updatePlayer($id){
        //update where id = $id
    }
    function getPlayer(){
        // select all from player
    }
}

class Rounds {
    /**
     * `id`,
     * `round_type`
     */
    function getRoundType($id){
        // select * from rounds where id = $id;
    }
}

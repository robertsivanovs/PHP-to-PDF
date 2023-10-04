<?php

/**
 * user model @author Roberts Ivanovs
 * Satur medoti un SQL vaicājumu datubāzes atjaunošanai.
 */
include_once '../Classes/Database.php';

class User extends Database
{
    /**
     * createUser
     * 
     * Metode pievieno lietāja ievadīto pamatinformāciju (Vārdu, uzvārdu, dzimšanas datumu, epastu) datu bāzē.
     * Tiek atjaunota 'users' tabula.
     *
     * @param  String $name
     * @param  String $surename
     * @param  mixed $date
     * @param  mixed $email
     *
     * @return void
     */
    public function createUser($name, $surename, $date, $email)
    {
        try {
            $sql = "INSERT INTO users (names, surename, email, birthdate) VALUES (:names, :surename, :email, :birthdate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':names', $name);
            $stmt->bindValue(':surename', $surename);
            $stmt->bindValue(':birthdate', $date);
            $stmt->bindValue(':email', $email);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
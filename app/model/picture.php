<?php

/**
 * picture model @author Roberts Ivanovs
 * 
 * Satur medoti un SQL vaicājumu datubāzes atjaunošanai.
 */
include_once '../classes/Database.php';

class Picture extends Database
{

    /**
     * addPicture
     * Metode ievieto lietotāja augšupielādēto attēlu datu bāzē.
     * Atjauno tabulu 'pictures'
     * 
     * Papildu arī saņem parametru ar lietotāja vārdu identifikācijai.
     * @param  imgage $image
     * @param  String $name
     *
     * @return void
     */
    public function addPicture($image, $name)
    {
        try {
            $sql = "INSERT INTO pictures (picture, user) VALUES (:picture, :user)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':picture', $image);
            $stmt->bindValue(':user', $name);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
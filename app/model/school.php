<?php

/**
 * school model @author Roberts Ivanovs
 * Satur medoti un SQL vaicājumu datubāzes atjaunošanai.
 */

include_once '../classes/database.php';

class school extends database {
    /**
     * addSchools
     *
     * Metode ievieto masīvu elementu vērtības datubāzē.
     * Tiek atjaunota 'schools' tabula.
     * 
     * @param  array $skolas
     * @param  array $no
     * @param  array $lidz
     * @param  array $spec
     *
     * @return void
     */
    public function addSchools($skolas, $no, $lidz, $spec){
        $izmers = sizeof($skolas);
        try{
            for($i = 0; $i < $izmers; $i++){
                $sql = "INSERT INTO schools (school, startdate, enddate, spec) VALUES (:school, :startdate, :enddate, :spec)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':school' , $skolas[$i]);
                $stmt->bindValue(':startdate' , $no[$i]);
                $stmt->bindValue(':enddate' , $lidz[$i]);
                $stmt->bindValue(':spec' , $spec[$i]);
                $result = $stmt->execute();
            } 
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}
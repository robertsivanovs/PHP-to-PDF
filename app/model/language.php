<?php

/**
 * language model @author Roberts Ivanovs
 * Satur medoti un SQL vaicājumu datubāzes atjaunošanai.
 */

include_once '../classes/Database.php';

class Language extends Database
{

    /**
     * updateLanguages
     *
     * Metode ievieto masīvu elementu vērtības datubāzē.
     * Tiek atjaunota 'languages' tabula.
     * 
     * @param  array $valodas[]
     * @param  array $runat_prasme[]
     * @param  array $lasit_prasme[]
     * @param  array $rakstit_prasme[]
     * 
     * @throws PDOException $e
     * @return void
     */
    public function updateLanguages($valodas, $runat_prasme, $lasit_prasme,  $rakstit_prasme)
    {
        $izmers = sizeof($valodas);
        try {
            for ($i = 0; $i < $izmers; $i++) {
                $sql = "INSERT INTO languages (languages, talking, reading, writing) VALUES (:languages, :talking, :reading, :writing)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':languages', $valodas[$i]);
                $stmt->bindValue(':talking', $runat_prasme[$i]);
                $stmt->bindValue(':reading', $lasit_prasme[$i]);
                $stmt->bindValue(':writing', $rakstit_prasme[$i]);
                $result = $stmt->execute();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
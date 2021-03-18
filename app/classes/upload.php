<?php

/**
 * class upload @author Roberts Ivanovs
 * 
 * Klase satur nepieciešamās metodes, lai veiksmīgu tiktu veikta augšupielādētā lietotāja foto validācija un 
 * saglabāšana direktorijā.
 */
class Upload
{
    public $target_dir = "../../uploads/"; // Direktorija, kur tiks augšupielādēts attēls.
    public $uploadError = array(); // Masīvs, kas saturēs visus kļūdas paziņojumus.

    /**
     * checkFake
     * Metode pārbaudei, vai tiek augšupielādēts reāls dokuments.
     *
     * @return void
     */
    public function checkFake()
    {
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if (!$check) {
                $this->uploadError = "Nekorekts fails!";
            }
        }
    }

    /**
     * checkFileSize
     * Metode pārbaudei, vai augšupielādētas attēls atbilst noteiktajam izmēram.
     * @return void
     */
    public function checkFileSize()
    {
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $this->uploadError = "Bilde ir pārāk liela!";
        }
    }

    /**
     * checkFormat
     * Atļautie attēla formāti ir .jpg .png .jpeg 
     * Metode pārbauda vai attēls atbilst šiem formātiem.
     * @return void
     */
    public function checkFormat()
    {
        $target_file = $this->target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $this->uploadError = "Atļautie faila formāti: .jpg .jpeg .png";
        }
    }

    /**
     * uploadImage
     * Ja attēls atbilst visiem noteikumiem (Validēts), tad tas tiek augšupielādēts noteiktajā direktorijā
     *
     * @return void
     * @return boolean $result
     */
    public function uploadImage()
    {
        $target_file = $this->target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (!empty($this->uploadError)) {
            $result = false;
            return $result;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $result = true;
                return $result;
            } else {
                $this->uploadError = "Notikusi kļūda, mēģiniet vēlreiz!";
                $result = false;
                return $result;
            }
        }
    }

    /**
     * getErrors
     * Metode, lai atgrieztu masīvā ievietotos kļūdas paziņojumus, ja tādi ir.
     * @return array $uploadError[]
     */
    public function getErrors()
    {
        return $this->uploadError;
    }
}
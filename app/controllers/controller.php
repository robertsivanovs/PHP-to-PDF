<?php

/**
 * Main controller
 * @author Roberts Ivanovs
 * 
 * Galvenais kontrolieris, kas organizē lapas darbību.
 */

spl_autoload_register(function($class) {
    $klases = '../classes/' . $class . '.php';
    $modeli = '../model/' . $class . '.php';
    if(file_exists($klases)) {
        require $klases;
    } else if(file_exists($modeli))
    require $modeli;
});

// Pārbaude vai notiek formas apstirpināšana.
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST["main-button__submit"])) {

        /* DATU IEVĀKŠANA */

        /* Tiek iegūti lietotāja ievadītie dati no Pamatinformācijas daļas
        * (Vārds, uzvārds, dzimšanas datums, e-pasta adrese un telefona nummurs */

        $name = ($_POST["name"]);
        $surename = ($_POST["surename"]);
        $date = ($_POST["bdate"]);
        $email = ($_POST["email"]);
        $phone = ($_POST["phone"]);

        /* Saņemts lietotāja augšupielādētais attēls */
        $image = basename($_FILES["fileToUpload"]["name"]);

        /* Masīvi, kuros tiek saglabāti lietotāja ievadītie dati par:
        * Valodas - (Latviešu, Krievu, Angļu obligāti, papildu pēc izvēles)
        * Izvēlētās valodas Lasītprasme, runātprasme un rakstītprasme */
        $valodas = array();
        $runat_prasme = array();
        $lasit_prasme = array();
        $rakstit_prasme = array();
        /* Skaitītājs, kas skaita to cik valodas tiek pievienotas */
        $daudzums = $_POST['language-counter'];

        /* Tiek veidots cikls, lai masīvos saglabātu nepieciešamo valodu, prasmju skaitu tālākai apstrādei */
        for ($i = 1; $i < $daudzums+1; $i++){
            $valodas[] = ($_POST["val-".$i]);
            $runat_prasme[] = ($_POST["runat-".$i]);
            $lasit_prasme[] = ($_POST["lasit-".$i]);
            $rakstit_prasme[] = ($_POST["rakstit-".$i]);
        }        

        /* Masīvi, kuros tiek saglabāti lietotāja ievadītie dati par:
        * Skolām, Mācību sākuma, beigu datumiem un iegūto specialitāti katrā no iestādēm */

        $daudzums_skolas = $_POST['school-counter']; // HTML skaitītajs, kas uzskaita to cik skolas tiek pievienotas.
        $skolas = array();
        $no = array();
        $lidz = array();
        $spec = array();

        /* Tiek veidots cikls, lai masīvos saglabātu nepieciešamo skolu skaitu, datumumiem un specialitātēm tālākai apstrādei */
        for ($i = 1; $i < $daudzums_skolas+1; $i++){
            $skolas[]=$_POST['skola-'.$i];
            $no[]=$_POST['from-'.$i];
            $lidz[] = $_POST['to-'.$i];
            $spec[]=$_POST['spec-'.$i];
        }

        /* DATU IEVĀKŠANAS BEIGAS */


        /* VALIDĀCIJA */

        /* Šajā kontrolierī netiek aprakstītas metodes lietotāja ievades validācijai, tam tiek izmantota atsevišķa klase
        /* validator.php */
        $V1 = new validator(); // Validācijas klases izsaukšana, objekta izveide.

        /* Skolu un valodu bloki */
        /* Lietotāja ievdīto datu validācija skolu un valodu blokos */
        foreach($valodas as $value) {
            $V1->setField("Valoda")->setValue($value)->sanitizeField()->checkEmpty(); // Paņēmiens - "Chaining"
        }
        foreach($runat_prasme as $value) {
            $V1->setField("Runatprasme")->setValue($value)->sanitizeField()->checkEmpty();
        }
        foreach($lasit_prasme as $value) {
            $V1->setField("Lasitprasme")->setValue($value)->sanitizeField()->checkEmpty();
        }
        foreach($rakstit_prasme as $value) {
            $V1->setField("Rakstitprasme")->setValue($value)->sanitizeField()->checkEmpty();
        }
        foreach($skolas as $value) {
            $V1->setField("Skola")->setValue($value)->sanitizeSchools()->checkEmpty();
        }
        foreach($no as $value) {
            $V1->setField("Sakuma gads")->setValue($value)->checkDates()->checkEmpty();
        }
        foreach($lidz as $value) {
            $V1->setField("Beigu gads")->setValue($value)->checkDates()->checkEmpty();
        }
        foreach($spec as $value) {
            $V1->setField("Specialitate")->setValue($value)->sanitizeSchools()->checkEmpty();
        }

        /* Pamatinformācijas bloka validācija */
        /* Tiek validēti lietotāja ievadītie dati pamatinformācijas blokā */
        $V1->setField("Vards")->setValue($name)->sanitizeField()->checkEmpty();
        $V1->setField("Uzvārds")->setValue($surename)->sanitizeField()->checkEmpty();
        $V1->setField("Dzimšanas datums")->setValue($date)->checkDates()->checkEmpty();
        $V1->setValue($email)->checkEmail();
        $V1->setField("Telefons")->setValue($phone)->sanitizeField()->checkEmpty();

        /* Attēla validācija */
        $P1 = new upload();
        $P1->checkFake();
        $P1->checkFileSize();
        $P1->checkFormat();

        /* VALIDĀCIJAS BEIGAS */

        /* DATU NOSŪTĪŠANA SAGLABĀŠANAI DATU BĀZĒ UN .PDF FAILA IZVEIDE */
        
        if ($P1->uploadImage() && $V1->valid()) { // Ja datu un attēla validācija noritējusi veiksmīgi {

            $S1 = new school(); // 'schools' modelis. Nepieciešams, lai skolas, datumus, specialitātes saglabātu 'schools' tabulā.
            $L1 = new language(); // 'languages' modelis. Nepieciešams, lai skolas, datumus, specialitātes saglabātu 'languages' tabulā.
            $B1 = new builder(); // builder class. Klase atbild par .PDF dokumenta izveidi.
            $U1 = new user(); // 'user' Modelis. Nepieciešams, lai lietotāja pamatinformāciju saglabātu 'users' tabulā.
            $P1 = new picture(); // 'picture' Modelis, nepieciešams, lai augšupielādētā attēla nosaukumu saglabātu 'pictures' tabulā.

            /* Datu saglabāšana tabulās */
            $S1->addSchools($skolas, $no, $lidz, $spec);
            $L1->updateLanguages($valodas, $runat_prasme, $lasit_prasme, $rakstit_prasme);
            $U1->createUser($name, $surename, $date, $email);
            $P1->addPicture($image, $name);
            /* PDF dokumenta izveide */
            $B1->buildAll($name, $surename, $date, $email, $phone, $image, $valodas, $runat_prasme, $lasit_prasme, $rakstit_prasme, $skolas, $no, $lidz, $spec);
        } else {
            /* Kļūdas gadījumā lietotājs tiek atgriezts atpakaļ uz index.php ar kļūdas paziņojumu */
            session_start();
            $_SESSION["basic_info_error"] = $V1->getErrors();
            $_SESSION["photo_upload_error"] = $P1->getErrors();
            header("Location: ../../index.php");
        }
    }
}


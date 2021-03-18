<?php

require './app/classes/UserSkill.php';
/**
 * Pārbaude vai validācija noritējusi veiksmīgi, 
 * Ar JS paziņojumu (alert) tiek atgriezta kļūda pēc lauku validācijas, 
 * 
 * Kļūda atgriezta no validator.php klases.
 */
session_start();
if (!empty($_SESSION['basic_info_error'])) {
    echo '<script>alert(' . '"' . $_SESSION['basic_info_error'] . '"' . ');</script>';
    session_destroy();
} else if (!empty($_SESSION['photo_upload_error'])) {
    echo '<script>alert(' . '"' . $_SESSION['photo_upload_error'] . '"' . ');</script>';
    session_destroy();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script/script.js"></script>
    <title>
        CV ģenerēšanas forma!
    </title>
</head>

<body>
    <h1 class="header">CV ģenerēšanas forma!</h1>
    <div class="container">
        <!-- Pamatinformācijas bloks -->
        <div class="main">
            <form id="form" action="app/controllers/controller.php" method="POST" enctype="multipart/form-data">
                <h2>Pamatinformācija</h2>
                <input type="text" class="main-name__input" name="name" placeholder="Ievadiet Jūsu vārdu" required>
                <input type="text" class="main-surename__input" name="surename" placeholder="Ievadiet Jūsu uzvārdu" required>
                <input type="date" class="main-bdate__input" name="bdate" min="1930-01-01" max="2006-01-01" title="Dzimšanas gads" required>
                <input type="email" class="main-email__input" name="email" placeholder="Ievadiet Jūsu e-pasta adresi" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <input type="text" class="main-phone__input" name="phone" placeholder="Ievadiet Jūsu telefona nummuru" required>
                <input type="button" value="Turpināt" class="main-button__step1">
        </div>
        <!-- Lietotāja foto bloks -->
        <div class="photo" hidden>
            <h2>Pievienot Foto:</h2>
            <p class="photo-upload__paragraph">Spiediet "izvēlēties failu" lai augšupielādētu foto</p>
            <img class="photo__image" src="#" alt="Jūsu foto parādīsies šeit">
            <!-- Lietotāja augšupielādētās foto paraugs tiks attēlots šeit -->
            <input type="file" name="fileToUpload" class="photo-image__input" accept="image/*" onchange="loadFile(event)" required><br />
            <input type="button" value="Atpakaļ" class="photo-button__return-to-step1">
            <input type="button" value="Turpināt" class="photo-button__step2">

        </div>
        <!-- Lietotāja valodu/pievienot valodu bloks -->
        <div class="languages" hidden>
            <h2> Valodu prasmes: </h2>
            <label> Valoda: Lasīšana: Runāšana: Rakstīšana: </label>
            <!-- Nepieciešamās 3 valodas -->
            <input type="text" name="val-1" value="Latviešu" required readonly>
            <?= userSkill::getDropdown("runat-1"); ?>
            <?= userSkill::getDropdown("lasit-1"); ?>
            <?= userSkill::getDropdown("rakstit-1"); ?>

            <input type="text" name="val-2" value="Krievu" required readonly>
            <?= userSkill::getDropdown("runat-2"); ?>
            <?= userSkill::getDropdown("lasit-2"); ?>
            <?= userSkill::getDropdown("rakstit-2"); ?>

            <input type="text" name="val-3" value="Angļu" required readonly>
            <?= userSkill::getDropdown("runat-3"); ?>
            <?= userSkill::getDropdown("lasit-3"); ?>
            <?= userSkill::getDropdown("rakstit-3"); ?>

            <!-- Apslēpts teksta lauks, kurš uzskaita cik valodu lauki tiek pievienoti, tiek kontrolēts ar addLanguage(); metodi - sctipt.js-->
            <input type="hidden" class="language-counter" value="3" name="language-counter">
            <input type="button" class="languages-add__button" Value="Pievienot papildu" onClick="addLanguage();">
            <input type="button" value="Atpakaļ" class="languages-button__return-to-step2">
            <input type="button" value="Turpināt" class="languages-button__step3">
            <input type="button" class="languages-remove__button" Value="Noņemt papildu" onClick="deleteLanguage();" hidden>

        </div>
        <!-- Lietotāja izglītības iestažu/pievienot iestādes bloks -->
        <div class="schools" hidden>
            <h2>Pievienojiet izglītības iestādes:</h2>
            <input type="text" name="skola-1" placeholder="Ievadiet skolas nosaukumu" required>
            <label>Piem.: Rīgas 62.vidusskola</label>
            <input type="date" name="from-1" min="1930-01-01" max="2021-01-01" required>
            <label>Sākuma gads</label>
            <input type="date" name="to-1" min="1930-01-01" max="2021-01-01" required>
            <label>Beigu gads</label>
            <input type="text" name="spec-1" placeholder="Specialitāte" required>
            <input type="button" class="schools-add__button" value="Pievienot papildu" onClick="addSchool();">
            <input type="button" value="Atpakaļ" class="schools-button__return-to-step3">
            <input type="submit" class="main-button__submit" value="IESNIEGT" name="main-button__submit">
            <input type="button" class="schools-remove__button" value="Noņemt papildu" onClick="deleteSchool();" hidden>

            <!-- Apslēpts teksta lauks, kurš uzskaita cik skolas tiek peivienotas, tiek kontrolēts ar addSchool(); metodi - sctipt.js-->
            <input type="hidden" class="school-counter" value="1" name="school-counter">
            </form>
        </div>
    </div>
</body>
<!-- Javascript kods, lai bildes paraugu attēlotu "<div class="photo"> Blokā -->
<script>
    var loadFile = function(event) {
        var output = document.getElementsByClassName('photo__image');
        output[0].src = URL.createObjectURL(event.target.files[0]);
        output[0].style.height = "265px";
        output[0].style.maxWidth = "280px";
    };
</script>

</html>
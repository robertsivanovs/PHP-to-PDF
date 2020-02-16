<?php
/**
 * class validator @author Roberts Ivanovs
 * 
 * Šajā klasē tiek aprakstītas visas metodes, lai veiksmīgi varētu pārbaudīt lietotāja ievadītos datus.
 * Tiek atgriezti kļūdas paziņojumi, ja tādi ir.
 */

class validator {
    
    private $field;
    private $value;
    private $isValid = []; // Masīvs, kas saturēs visus kļūdas paziņojumus.

    /**
     * setField
     * Tiek noteikts lauka nosaukums, kas tiek validēts. Šī metode ir nepeiciešama tikai, lai lietotājam 
     * tiktu atgriezts lauka nosaukums, kurā ir atrasta kļūda.
     * 
     * Lietotājs šo metodi nevar ietekmēt.
     * @param  mixed $field
     *
     * @return void
     */
    public function setField($field){
        $this->field = $field;
        return $this;
    }

    /**
     * setValue
     * Lietotāja ievadītā informācija tiek ievietota $value mainīgajā turpmākai validācijai.
     * @param  mixed $value
     *
     * @return void
     */
    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    /**
     * checkEmpty
     * Metode pārbauda, vai lietotaja aizpildītais lauks ir tukšs.
     * @return void
     */
    public function checkEmpty(){
        if(empty($this->value)){
            $this->isValid[] = "$this->field lauks nevar būt tukšs!";
        }
        return $this;
    }

    /**
     * sanitizeField
     * Metode pārbauda, vai simbolu virkne atbilst atļautajiem simbliem
     * Atgriez kļūdas paziņojumu, ja neatbilst.
     * 
     * Atļautie simboli - Burti no A-Z un Ā-Ž, cipari 0-9
     * 
     * @return void
     */
    public function sanitizeField(){
        if (preg_match("/[^A-Za-z0-9\\\pā-žĀ-Ž]/", $this->value)) {
            $this->isValid[] = "$this->field lauks satur neatļautus simbolus!";
        }
        return $this;
    }

    /**
     * sanitizeSchools
     * 
     * Metode pārbauda, vai skolu nosaukumi satur simbolus, kas varētu kaitēt datubāzei.
     * Ņemot vērā, ka skolu nosaukumos tiek izmantotas atstarpes un punkti, tad šie simboli ir atļauti.
     * 
     * Atļautie simboli - Burti no A-Z, Ā-Ž, punkts (.) atstarpe (white space) un cipari 0-9
     *
     * @return void
     */
    public function sanitizeSchools(){
        if (preg_match("/[^A-Za-z0-9 .\\\pā-žĀ-Ž]/", $this->value)) {
            $this->isValid[] = "$this->field lauks satur neatļautus simbolus";
        }
        return $this;
    }

    /**
     * checkDates
     * Metode pārbauda, vai lietāja ievadītie datumu - Dzimšanas datums, mācību iestāžu sākuma un beigu datumi,
     * satur neatļautus simbolus.
     * 
     * Atļautie simboli - skaitļi no 0-9 un domu zīme (-).
     * 
     * Ņemot vērā, ka lauka formatēšana notiek automātiski ar HTML elementu <input type="date"> punkts nav nepieciešams.
     *
     * @return void
     */
    public function checkDates(){
        if (preg_match("/[^0-9-]/", $this->value)) {
            $this->isValid[] = "$this->field Nekorekts datums!";
        }
        return $this;
    }

    /**
     * checkEmail
     *
     * Metode pārbauda vai ievadītais e-pasts ir korekts.
     * @return void
     */
    public function checkEmail(){
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->isValid[] = "Email format ir not correct!";
        }
        return $this;
    }

    /**
     * valid
     * Metode pārbauda, vai masīvs $isValid[] satur kļūdas paziņojumus.
     * Ja metode ir patiesa, tiek atgriezts tukšs masīvs un lauki uzskatāmi var validētiem.
     * @return array isValid[]
     */
    public function valid()
    {
        return empty($this->isValid);
    }

    /**
     * getErrors
     * Metode atgriež kļūdas paziņojumus, kas radušies lauku validācijas procesā.
     * @return array isValid[]
     */
    public function getErrors()
    {
        return implode("  " , $this->isValid);
    }
}
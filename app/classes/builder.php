<?php

/**
 * Class builder @author Roberts Ivanovs
 * 
 * Klase, kas satur visas metodes .pdf faila izveidei.
 * Visi mainīgie šajā klasē tiek saņemti no kontroliera.
 */
require('tfpdf/tfpdf.php');

/**
 * PDF Dokumenta izveidei tiek izmantota bibliotēka FPDF - pieejama: http://www.fpdf.org/
 */

class Builder extends tfpdf
{

    /**
     * buildHeader
     *
     * Metode izveido .pdf dokumenta augšējo daļu (header), kas paliek nemainīga.
     * Lietotājs neietekmē šo metodi, tā paliek nemainīga visiem lietotājiem.
     * @return void
     */
    public function buildHeader()
    {
        $this->Image('../../images/logo.png', 10, -7, 45, 45);
        $this->setFont('Arial', '', 28);
        $this->cell(80);
        $this->cell(30, 10, 'CV', 0, 0, 'C');
        $this->Ln(15);
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->SetFont('DejaVu', '', 10);
        $this->cell(10, 10, 'Pamatinformācija');
        $this->Ln(8);
        $this->SetFillColor(211, 211, 211);
        $this->cell(0, 2, '', 0, 2, 'L', true);
        $this->Ln(45);
    }

    /**
     * addImage
     *
     * Metode ievieto lietotāja augšupielādēto foto attēlu .pdf dokumentā.
     * Foto tiek attēlots dokumenta pamatinformācijas daļā.
     * @param mixed $image
     *
     * @return void
     */
    public function addImage($image)
    {
        $this->Image("../../uploads/$image", 50, 37, 40, 40);
    }

    /**
     * buildBasicInfo
     *
     * Metode pamatinformācijas bloka izveidei.
     * Tiek saņemti jau pārbaudīti (validēti) lietotāja ievadītie lauki un atspoguļoti .pdf dokumentā.
     * @param  String $name
     * @param  String $surename
     * @param  mixed $bdate
     * @param  mixed $email
     * @param  Integer $phone
     *
     * @return void
     */
    public function buildBasicInfo($name, $surename, $bdate, $email, $phone)
    {
        $this->SetFont('DejaVu', '', 10);
        $this->Cell(15);
        $this->Cell(40, 6, "Vārds, uzvārds: $name $surename", 0, 2);
        $this->Cell(40, 6, "Dzimšanas datums: $bdate", 0, 2);
        $this->Cell(40, 6, "E-pasta adrese: $email", 0, 2);
        $this->Cell(40, 6, "Telefons: $phone", 0, 1);
        $this->Ln(5);
    }

    /**
     * buildSkillsHeader
     * 
     * Metode izveido .pdf dokumenta augšējo daļu (header), virs valodu zināšanām, kas paliek nemainīga.
     * Lietotājs neietekmē šo metodi, tā paliek nemainīga visiem lietotājiem.
     *
     * @return void
     */
    public function buildSkillsHeader()
    {
        $this->SetFont('DejaVu', '', 10);
        $this->cell(10, 10, 'Valodu zināšanas:');
        $this->Ln(8);
        $this->SetFillColor(211, 211, 211);
        $this->cell(0, 2, '', 0, 2, 'L', true);
        $this->Ln(5);
    }

    /**
     * buildLanguageSkillsHeader
     * 
     * Metode izveido valodu zināšanas tabulas pirmo rindu.
     * Zem šīs rindas sekos lietotāja ievadītās valodas un to prasmes.
     * $header ir masīvs, kurš satur informāciju, par to kas tiks attēlots katrā tabulas šūnā.
     * @return void
     */
    public function buildLanguageSkillsHeader()
    {
        $header = array('Valoda', 'Runat', 'Lasit', 'Rakstit');
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
    }

    /**
     * buildLanguageSkills
     *
     * Metode, kas izveido šūnas ar rāmjiem, tādējādi vizuāli veidojot tablas izskatu.
     * Lietotāja ievadītā informācija tiek saņemta pārbaudīta (validēta)
     * Tiek veidots cikls, kura katrā iterācijas reizē tiek veidotas tabulas šūnas ar informāciju no padotajiem masīviem.
     * Metodes izpildes rezultātā tiek izveidota tabula ar lietotāja ievadītajām valodām un to prasmēm.
     * 
     * Visi metodes parametri ir masīvi.
     * 
     * @param  array $valodas
     * @param  array $runat_prasme
     * @param  array $lasit_prasme
     * @param  array $rakstit_prasme
     *
     * @return void
     */
    public function buildLanguageSkills($valodas, $runat_prasme, $lasit_prasme, $rakstit_prasme)
    {
        for ($i = 0; $i < sizeof($valodas); $i++) {
            $data = [
                $i => [$valodas[$i], $runat_prasme[$i], $lasit_prasme[$i], $rakstit_prasme[$i]],
            ];
            foreach ($data as $tr) {
                foreach ($tr as $td)
                    $this->Cell(40, 7, $td, 1);
                $this->Ln();
            }
        }
    }

    /**
     * buildSchoolsHeader
     *
     * Metode, kas vizuāli izveido atstarpi starp Valodu zināšanu un Izglītības iestāžu blokiem.
     * Lietotājs neietekmē šo metodi, tā paliek nemainīga visiem lietotājiem.
     * 
     * @return void
     */
    public function buildSchoolsHeader()
    {
        $this->SetFont('DejaVu', '', 10);
        $this->cell(10, 10, 'Izglītība:');
        $this->Ln(8);
        $this->SetFillColor(211, 211, 211);
        $this->cell(0, 2, '', 0, 2, 'L', true);
        $this->Ln(5);
    }

    /**
     * buildSchools
     * 
     * Metode, lai lietotāja ievadītās izglītības iestādes, specialitāti, no - līdz termiņus attēlotu .pdf dokumentā.
     * Metode, kā parametrus saņem masīvus ar jau pārbaudītām (validētām) lietotāja ievadītajām vērtībām.
     * 
     * Tiek veidots cikls, kurā katrā no iterācijas reizēm dokumentam tiek pievienotas šūnas, kas satur lietotāja ievadīto informāciju.
     * 
     * @param  array $skolas
     * @param  array $no
     * @param  array $lidz
     * @param  array $spec
     *
     * @return void
     */
    public function buildSchools($skolas, $no, $lidz, $spec)
    {
        $this->SetFont('DejaVu', '', 10);
        $this->Cell(15);

        for ($i = 0; $i < sizeof($skolas); $i++) {

            $this->Cell(40, 6, "Skolas nosaukums: " . $skolas[$i], 0, 2);
            $this->Cell(40, 6, "Valsts: Latvija", 0, 2);
            $this->Cell(40, 6, "Gads No: " . $no[$i], 0, 2);
            $this->Cell(40, 6, "Gads līdz: " . $lidz[$i], 0, 2);
            $this->Cell(40, 6, "Specialitāte: " . $spec[$i], 0, 2);
            $this->Cell(40, 6, "", 0, 2);
        }
    }

    /**
     * buildAll
     * 
     * Metode, kas no kontroliera (controller.php) saņem visus lietotaja ievadītos mainīgos (validētus)
     * 
     * Šī funkcija no saņemtajiem parametriem padod nepieciešamos parametrus attiecīgajai metodei.
     * Katra metode tiek izpildīta secīgi, tā, lai .pdf dokuments tiktu izveidots kārtībā no augšas uz leju.
     * 
     * Pēc metodes veiksmīgas izpildes tiek izveidots pilnīgs .pdf dokuments ar visiem elementiem.
     *
     * @param  String $name
     * @param  String $surename
     * @param  mixed $bdate
     * @param  mixed $email
     * @param  mixed $phone
     * @param  mixed $image
     * @param  array $valodas
     * @param  array $runat_prasme
     * @param  array $lasit_prasme
     * @param  array $rakstit_prasme
     * @param  array $skolas
     * @param  array $no
     * @param  array $lidz
     * @param  array $spec
     *
     * @return void
     */
    public function buildAll($name, $surename, $bdate, $email, $phone, $image, $valodas, $runat_prasme, $lasit_prasme, $rakstit_prasme, $skolas, $no, $lidz, $spec)
    {
        $this->AddPage();
        $this->buildHeader();
        $this->addImage($image);
        $this->buildBasicInfo($name, $surename, $bdate, $email, $phone);
        $this->buildSkillsHeader();
        $this->buildLanguageSkillsHeader();
        $this->buildLanguageSkills($valodas, $runat_prasme, $lasit_prasme, $rakstit_prasme);
        $this->buildSchoolsHeader();
        $this->buildSchools($skolas, $no, $lidz, $spec);
        $this->Output();
    }
}
// Skaitītājs priekš valodu pievienošanas
let j = 3;


/**
 * Funkcija: addLanguage();
 * 
 * Ar katru izpildes reizi Izveido 1 ievades lauku, kurā lietotājs ievada valodu,
 * zem ievades lauka tiek izveidoti 3 <select> elementi, kas satur lasītprasmes, runātprasmes un rakstītprasmes.
 * <select> elementiem tiek pievienotas 5 izvēlēs iespējas <option>
 * <option> Satur prasmju vērtējumu - Dzimtā, Teicami, Labi, Vāji. | Default vērtība - izvēlēties.
 */
const addLanguage = () => {

    // Ar katru pievienoto valodu skaitītājs palielinās par 1.
    j += 1;

    let counter = document.getElementsByClassName("language-counter");
    let valoda = document.createElement("input");
    let runatPrasme = document.createElement("select");

    /* Cikli, lai izveidotu <option> elementus. Kopā 15 elementi */
    var k = 'x';  // <option> Elementu nosaukums
    for(let i = 1; i < 16; i++) { 
        eval("var " + k + i + "= " + "document.createElement('option');"); // "var x[1-16] = document.createElement('option'); "
    }
    for(let a = 1; a < 16; a += 5){
        eval("x"+a+".text='Izvēlieties';")
    }
    for(let B = 2; B < 17; B += 5){
        eval("x"+B+".text='Dzimtā';")
    }
    for(let C = 3; C < 18; C += 5){
        eval("x"+C+".text='Teicami';")
    }
    for(let b = 4; b < 19; b += 5){
        eval("x"+b+".text='Labi';")
    }
    for(let c = 5; c < 20; c += 5){
        eval("x"+c+".text='Vāji';")
    }

    /* Izveidoto <option> x pievienošana HTML elementam <select> */
    runatPrasme.appendChild(x1);
    runatPrasme.appendChild(x2);
    runatPrasme.appendChild(x3);
    runatPrasme.appendChild(x4);
    runatPrasme.appendChild(x5);

    let lasitPrasme = document.createElement("select");

    /* Izveidoto <option> x pievienošana HTML elementam <select> */
    lasitPrasme.appendChild(x6);
    lasitPrasme.appendChild(x7);
    lasitPrasme.appendChild(x8);
    lasitPrasme.appendChild(x9);
    lasitPrasme.appendChild(x10);

    let rakstitPrasme = document.createElement("select");

    /* Izveidoto <option> x pievienošana HTML elementam <select> */
    rakstitPrasme.appendChild(x11);
    rakstitPrasme.appendChild(x12);
    rakstitPrasme.appendChild(x13);
    rakstitPrasme.appendChild(x14);
    rakstitPrasme.appendChild(x15);

    /* HTML elements, kam tiks pievienoti izveidotie elementi */
    let div = document.getElementsByClassName("languages");

    /* Elementiem tiek peivienoti attribūti. Piem- <type="text"> <placeholder=""> */
    valoda.setAttribute("type", "text");
    valoda.setAttribute("placeholder", "Ievadiet valodu");
    valoda.setAttribute("form", "form");
    valoda.setAttribute("required", "required");
    runatPrasme.setAttribute("form", "form");
    lasitPrasme.setAttribute("form", "form");
    rakstitPrasme.setAttribute("form", "form");

    /* Katram izveidotajam elementam tiek izveidots unikāls nosaukums izmantojot skaitītāju - j
    * Katra izveidotā elementa nosaukums ir par 1 vienību lielāks nekā iepriekšējais
    * Piem.- "val-1" - "val-2" "val-3" 
    */
    valoda.name = "val-"+j;
    runatPrasme.name = "runat-"+j;
    lasitPrasme.name= "lasit-"+j;
    rakstitPrasme.name = "rakstit-"+j;

    /* HTML apslēptā ievades lauka, kas skaita cik valodas tiek peivienotas, vērtības noteikšana */
    counter[0].value = j;

    /* Izveidoto elementu pievienošana HTML dokumenta elementam */
    div[0].appendChild(valoda);
    div[0].appendChild(runatPrasme);
    div[0].appendChild(lasitPrasme);
    div[0].appendChild(rakstitPrasme);
}

/* Funkcija deleteLanguage ()

noņem pievienoto valodas lauku un <option> laukus "Rakstīšana, Lasīšana, Runāšana" attiecīgajai valodai. */

const deleteLanguage = () => {

    // HTML counter which counts how many have been added.
    let counter = document.getElementsByClassName("language-counter");

    // Delete only if there are atleast 4 attributes
    if (counter[0].value >= 4) {
    let i = counter[0].value;

    // Get elements
    let val = document.getElementsByName("val-"+i);
    let runat = document.getElementsByName("runat-"+i);

    let lasit = document.getElementsByName("lasit-"+i);
    let rakstit = document.getElementsByName("rakstit-"+i);

    if (val[0] == undefined || runat[0] == undefined || lasit[0] == undefined || rakstit[0] == undefined) {
        return document.getElementsByClassName("languages-remove__button")[0].style.display = "none";
    }

    // Remove elements
    val[0].remove();
    runat[0].remove();
    lasit[0].remove();
    rakstit[0].remove();

    // Decrease counter
    counter[0].value--;
    }
}

/* Skaitītājs, kas tiek izmantots, lai uzskaitītu izglītības iestāžu skaitu */
let i = 1;

/**
 * Funkcija - addSchool();
 * 
 * Tiek izmantota, lai HTML <div> Elementam "schools" pievienotu 2 ievades laukus:
 * 1. Skolas nosaukums | 2. Specialitāte.
 * 
 * Tiek pievienoti 2 HTML <input type="date"> elementi:
 * 1. Mācību uzsākšanas gads | 2.Mācību beigu gads.
 */
const addSchool = () => {
    // Ar katru pievienošnas reizi skaitītājs i tiek palielināts par 1.
    i += 1;

    // HTML Elementu izveide.
    let counter = document.getElementsByClassName("school-counter");
    let skola = document.createElement("input");
    let from = document.createElement("input");
    let to = document.createElement("input");
    let spec = document.createElement("input");
    let hr = document.createElement("hr");

    let div = document.getElementsByClassName("schools"); // Šim HTML elementam tiks pievienoti jaunizveidotie lauki

    /* HTML Elementiem tiek peivienoti attribūti. Piem- <type="text"> <placeholder=""> */
    skola.setAttribute("type", "text");
    skola.setAttribute("form", "form");
    skola.setAttribute("placeholder", "Ievadiet skolas nosaukumu");
    skola.setAttribute("required", "required");

    from.setAttribute("type", "date");
    from.setAttribute("form", "form");
    from.setAttribute("required", "required");

    to.setAttribute("type", "date");
    to.setAttribute("form", "form");
    to.setAttribute("required", "required");

    spec.setAttribute("type", "text");
    spec.setAttribute("form", "form");
    spec.setAttribute("placeholder", "Specilaitate");
    spec.setAttribute("required", "required");

    /* Katram izveidotajam elementam tiek izveidots unikāls nosaukums izmantojot skaitītāju - i
    * Katra izveidotā elementa nosaukums ir par 1 vienību lielāks nekā iepriekšējais
    * Piem.- "skola-1" - "skola-2" "skola-3" 
    */
    skola.name= "skola-" + i;
    from.name = "from-"+i;
    to.name = "to-"+i;
    spec.name = "spec-"+i;

    /* HTML apslēptā ievades lauka, kas skaita cik skolas tiek peivienotas, vērtības noteikšana */
    counter[0].value = i;

    /* Izveidoto elementu pievienošana HTML dokumenta elementam */
    div[0].appendChild(hr);
    div[0].appendChild(skola);
    div[0].appendChild(from);
    div[0].appendChild(to);
    div[0].appendChild(spec);
}

/* Funkcija deleteSchool ()

noņem pievienoto valodas lauku un <option> laukus "Rakstīšana, Lasīšana, Runāšana" attiecīgajai valodai. */

const deleteSchool = () => {

    // HTML counter which counts how many have been added.
    let counter = document.getElementsByClassName("school-counter");

    // Delete only if there are atleast 1 attribute
    if (counter[0].value >= 2) {
    let i = counter[0].value;

    // Get elements
    let school = document.getElementsByName("skola-"+i);
    let from = document.getElementsByName("from-"+i);

    let to = document.getElementsByName("to-"+i);
    let speciality = document.getElementsByName("spec-"+i);

    if (school[0] == undefined || from[0] == undefined || to[0] == undefined || speciality[0] == undefined) {
        return document.getElementsByClassName("schools-remove__button")[0].style.display = "none";
    }

    // Remove elements
    school[0].remove();
    from[0].remove();
    to[0].remove();
    speciality[0].remove();

    // Decrease counter
    counter[0].value--;
    }
}

/* jQuerry Validācija */
$(document).ready(function(){

    /* Pirmais solis - Pamatinformācija */
    $(".main-button__step1").click(function() {

        /* Pārbaude vai ievadītais lietotāja vārds ir vismaz 3 simbolus garš un satur tikai burtus (RegEx) */
        if ($(".main-name__input").val().length < 3 || /[^a-zA-Zā-žĀ-Ž]/.test($(".main-name__input").val())) {
            return alert("Lūdzu ievadiet derīgu vārdu!");

        /* Uzvārda pārbaude */
        } else if ($(".main-surename__input").val().length < 3 || /[^a-zA-Zā-žĀ-Ž]/.test($(".main-name__input").val())) {
            return alert("Lūdzu ievadiet derīgu uzvārdu!");

        /* Pārbaude vai ir ievadīts dzimšanas gads, .length vērtība būs 0 ja lauks nav aizpildīts pilnībā */
        } else if ($(".main-bdate__input").val().length < 1) {
            return alert("Lūdzu ievadiet derīgu dzimšanas gadu!");

        /* E-pasta pārbaude */
        } else if (!/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($(".main-email__input").val()) || $(".main-email__input").val().length < 1) {
            return alert("Lūdzu ievadiet derīgu e-pasta adresi!");

        /* Telefona nummura pārbaude */
        } else if ($(".main-phone__input").val().length < 8 || /[^0-9]\s+/.test($(".main-phone__input").val())) {
            return alert("Lūdzu ievadiet derīgu telefona nummuru!");
        }
        /* Ja validācija noritējusi veiksmīgi, parādam foto augšupielādes formu (step 2) */
        $(".main").hide();
        $(".photo").fadeIn();
    });

    /* Foto augšupielāde (step 2) */
    $(".photo-button__step2").click(function() {
        if(!$(".photo-image__input").val()) {
            return alert("Nav izvēlēts neviens attēls!");
        }
        $(".photo").hide();
        $(".languages").fadeIn();
    });
    /* Atgriezties no foto formas atpakaļ pie pamatinformācijas */
    $(".photo-button__return-to-step1").click(function() {
        $(".photo").hide();
        $(".main").fadeIn();
    });

    /* Valodu bloks (step 3) */
    $(".languages-add__button").click(function() {
        $(".languages-remove__button").css("display", "block");
    });

    /* Atgriezties no valodu formas atpakaļ pie foto */
    $(".languages-button__return-to-step2").click(function() {
        $(".languages").hide();
        $(".photo").fadeIn();
    });

    /* Turpināt no valodu formas uz pie izglītību formu (step 4) */
    $(".languages-button__step3").click(function() {
        $(".languages").hide();
        $(".schools").fadeIn();
    });

    /* Specialitāšu/izglītības bloks (step 4) */

    /* Pievienot papildu skolas */
    $(".schools-add__button").click(function() {
        $(".schools-remove__button").css("display", "block");
    });

    /* Atgriezties no skolu/specialitāšu formas atpakaļ pie valodu formas */
    $(".schools-button__return-to-step3").click(function() {
        $(".schools").hide();
        $(".languages").fadeIn();
    });

    /* Skolu lauku validācija un formas iesniegšana
    Pie veiksmīgas validācijas turpinam ar PHP validāciju */

    $(".main-button__submit").click(function() {

        let i = 1;
        for (i; i <= $(".school-counter").val(); i++) {

            /* Pārbaudam vai ir ievadīts mācību uzsākšanas gads katrai skolai */
            if ( $("[name='from-"+i+"']").val() !== undefined) {
                if( ($("[name='from-"+i+"']").val()).length < 1) {
                    event.preventDefault();
                    return alert("Lūdzu ievadiet derīgu mācību uzsākšanas gadu!");
                }
            }

            /* Pārbaudam vai ir ievadīts mācību beigu gads katrai skolai */
            if ( $("[name='to-"+i+"']").val() !== undefined) {
                if( ($("[name='to-"+i+"']").val()).length < 1) {
                    event.preventDefault();
                    return alert("Lūdzu ievadiet derīgu mācību beigu gadu!");
                }
            }
        }
    });
});

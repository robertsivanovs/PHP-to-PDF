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
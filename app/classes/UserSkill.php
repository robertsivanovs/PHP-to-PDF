<?php

declare(strict_types=1);
namespace app\classes;

/**
 * Class userSkill @author Roberts Ivanovs
 * 
 * Klase satur nepieciešamos mainīgos un metodes, lai atgrieztu nepieciešamos <select> un <options>
 * elementus index.php skatā, <div class="languages"> blokā.
 * 
 */
class UserSkill
{
    // Valodu prasmju kategorijas
    const POSSIBLE_SKILLS = ['Runāšana', 'Lasīšana', 'Rakstīšana'];

    // Katras valodu prasmes kategorijas zināšanu līmenis
    const POSSIBLE_LEVELS = ['Dzimtā', 'Teicami', 'Labi', 'Vāji'];

    /**
     * getDropdown
     * 
     * Metode, lai atgrieztu <select> un <options> elementus skatam.
     * Skatā (index.php) tiek noteiktas, kā obligātas vismaz 3 valodas - LV, RUS un ENG.
     *
     *
     * @param string $var
     * @return string
     */
    public static function getDropdown(string $var): string
    {
        if (!isset($var)) {
            return "";
        }

        $html = "<select name={$var} required>";

        // Runat-1- LV valoda | runat-2 - RUS | runat-3 ENG
        if ($var == 'runat-1' || $var == 'runat-2' || $var == 'runat-3') {
            // Atgriezīs <option>Runāšana</option> katrai valodai
            $html .= "<option>" . self::POSSIBLE_SKILLS[0] . "</option>";
        }

        if ($var == 'lasit-1' || $var == 'lasit-2' || $var == 'lasit-3') {
            // Atgriezīs <option>Lasīšana</option> katrai valodai
            $html .= "<option>" . self::POSSIBLE_SKILLS[1] . "</option>";
        }

        if ($var == 'rakstit-1' || $var == 'rakstit-2' || $var == 'rakstit-3') {
            // Atgriezīs <option>Rakstīšana</option> katrai valodai
            $html .= "<option>" . self::POSSIBLE_SKILLS[2] . "</option>";
        }

        /* Zem "Lasīšana, rakstīšana vai runāšana" pievienos prasmes  
        *  zināšanu līmeni, t.i - 'Dzimtā', 'Teicami', 'Labi', 'Vāji'
        */
        foreach (self::POSSIBLE_LEVELS as $key => $value) {
            $html .= "<option>{$value}</option>";
        }
        $html .= "</select>";
        return $html;
    }
}

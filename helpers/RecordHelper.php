<?php

namespace app\helpers;

use yii\helpers\Html;




class RecordHelper
{



    public function getStatus($status)
    {
        switch ($status) {
            case 0:

                return '<span class="innactive">Inactiv</span>';

            case 1:
                return '<span class="active">Activ</span>';
            case 3:
                return '<span class="error">Ban</span>';
            case 4:
                return '<span class="verify">În verificare</span>';

            case 5:
                return '<span class="pending">În așteptare</span>';
            case 10:
                return '<span class="active">Plătit online</span>';
            default:
                return '<span class="error">Eroare</span>';
        }
    }


    public function getVerify($status)
    {
        switch ($status) {
            case 0:

                return '<span class="innactive">Verifică</span>';

            case 1:
                return '<span class="active">Verificat</span>';
            default:
                return '<span class="error">Eroare</span>';
        }
    }


    public function getStatusReservation($status)
    {
        switch ($status) {
            case 0:

                return '<span class="error">Anulat</span>';

            case 1:
                return '<span class="active">Plată la sosire</span>';
            case 3:
                return '<span class="pending">În așteptare</span>';
            case 10:
                return '<span class="active">Plătit online</span>';
            default:
                return '<span class="error">Eroare necunoscută</span>';
        }
    }
    public function getStatusPayment($status)
    {
        switch ($status) {
            case 0:

                return '<span class="error">Nu este plătit</span>';

            case 1:
                return '<span class="active">Plată cu success</span>';
            case 3:
                return '<span class="pending">În așteptare</span>';
            case 5:
                return '<span class="error">Anulat</span>';
            default:
                return '<span class="error">Eroare necunoscută</span>';
        }
    }

    public function getGender($status)
    {
        switch ($status) {
            case 2:
                return '<span class="active">Bărbat</span>';
            case 4:
                return '<span class="active">Femeie</span>';
            default:
                return '<span class="error">Eroare necunoscută</span>';
        }
    }


    public static function getDiscount($price, $discount)
    {
        return $price - ($price * $discount) / 100;
    }


    public function dateToTime($date)
    {

        $daySeconds = 60 * 60 * 24;
        $minutieSeconds = 60;
        $hourSeconds = 60 * 60;
        $timestamp = time();
        $dateToTime = strtotime($date);
        $timeAgo = $timestamp - $dateToTime;
        $daysAgo = floor(($timeAgo / $daySeconds));
        $hoursAgo = floor(($timeAgo % $daySeconds) / $hourSeconds);
        $minutiesAgo = floor(($timeAgo % $hourSeconds) / $minutieSeconds);
        $secondsAgo = floor(($timeAgo % $minutieSeconds) / 1);


        switch (true) {
            case $timeAgo < $minutieSeconds:
                return $secondsAgo . 's ';
            case $timeAgo < $hourSeconds:
                return $hoursAgo . 'h ' . $minutiesAgo . 'm ';
            case $timeAgo < $daySeconds * 7:
                return $daysAgo . 'd ' . $hoursAgo . 'h ';
            default:
                return $daysAgo . 'd';
        }
    }


    public function listHelper($data)
    {

        $items = explode(',', $data);

        $info = '';
        foreach ($items as $item) {
            $info .= '<li class="d-flex flex-row align-items-center"><i class="bi bi-check2"></i>' . ucfirst($item) . '</li>';
        }

        return '<div class="d-flex justify-content-center">
            <div class="info-tour-view d-flex flex-column align-items-stretch  justify-content-center">'
            . $info .
            '</div>
           </div>';
    }

    public function stringExplode($options)
    {
        if (isset($options['separator'])) {
            $items = explode($options['separator'], $options['data']);
        } else {
            $items = explode(',', $options['data']);
        }

        $str = '';
        switch (true) {
            case isset($options['tag']) and isset($options['tagOptions']) and is_array($options['tagOptions']) and !is_callable($options['tagOptions']):
                // return var_dump($options['tagOptions']);

                $attr = '';
                foreach ($options['tagOptions'] as $option => $value) {
                    $attr .= $option . '=' . '"' . $value . '" ';
                }

                foreach ($items as $item) {
                    $str .=  '<' . $options['tag'] . ' ' . $attr . '>' . $item . '</' . $options['tag'] . '>';
                }
                break;
            case isset($options['tag']) and isset($options['tagOptions'])  and is_callable($options['tagOptions']):
                foreach ($items as $item) {
                    $str .=  '<' . $options['tag'] . ' ' . $options['tagOptions']($item) . '>' . $item . '</' . $options['tag'] . '>';
                }
                break;
            case isset($options['tag']):
                foreach ($items as $item) {
                    $str .=  '<' . $options['tag'] . '>' . $item . '</' . $options['tag'] . '>';
                }
                break;
            default:
                foreach ($items as $item) {
                    $str .=  $item;
                }
                break;
        }



        return $str;
    }


    public static function countryList()
    {
        $country_list = array(
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombi",
            "Comoros",
            "Congo (Brazzaville)",
            "Congo",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor (Timor Timur)",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia, The",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        );

        return array_combine($country_list, $country_list);
    }


    public function updateStatus($model, $status)
    {
        if ($model->validate() and $model->save()) {
            $model->status = htmlspecialchars(strip_tags($status));
            $model->save();
            return true;
        }
        return false;
    }
}

<?php

use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageShipmentModel;
use App\Models\Admin\ManageUserModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;

if (!function_exists('getCountriesList')) {
    function getCountriesList()
    {
        return [
            "Afghanistan",
            "Aland Islands",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
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
            "Bermuda",
            "Bhutan",
            "Bolivia, Plurinational State of",
            "Bonaire, Sint Eustatius and Saba",
            "Bosnia and Herzegovina",
            "Botswana",
            "Bouvet Island",
            "Brazil",
            "British Indian Ocean Territory",
            "Brunei Darussalam",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Christmas Island",
            "Cocos (Keeling) Islands",
            "Colombia",
            "Comoros",
            "Congo",
            "Congo, the Democratic Republic of the",
            "Cook Islands",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Curacao",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Falkland Islands (Malvinas)",
            "Faroe Islands",
            "Fiji",
            "Finland",
            "France",
            "French Guiana",
            "French Polynesia",
            "French Southern Territories",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Gibraltar",
            "Greece",
            "Greenland",
            "Grenada",
            "Guadeloupe",
            "Guam",
            "Guatemala",
            "Guernsey",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Heard Island and McDonald Islands",
            "Holy See (Vatican City State)",
            "Honduras",
            "Hong Kong",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran, Islamic Republic of",
            "Iraq",
            "Ireland",
            "Isle of Man",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jersey",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, Democratic People's Republic of",
            "South Korea",
            "Kuwait",
            "Kyrgyzstan",
            "Lao People's Democratic Republic",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macao",
            "Macedonia, the Former Yugoslav Republic of",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Martinique",
            "Mauritania",
            "Mauritius",
            "Mayotte",
            "Mexico",
            "Micronesia, Federated States of",
            "Moldova, Republic of",
            "Monaco",
            "Mongolia",
            "Montenegro",
            "Montserrat",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Caledonia",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Niue",
            "Norfolk Island",
            "Northern Mariana Islands",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Palestine, State of",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Pitcairn",
            "Poland",
            "Portugal",
            "Puerto Rico",
            "Qatar",
            "Reunion",
            "Romania",
            "Russian Federation",
            "Rwanda",
            "Saint Barthelemy",
            "Saint Helena, Ascension and Tristan da Cunha",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Martin (French part)",
            "Saint Pierre and Miquelon",
            "Saint Vincent and the Grenadines",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Sint Maarten (Dutch part)",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Georgia and the South Sandwich Islands",
            "South Sudan",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Svalbard and Jan Mayen",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syrian Arab Republic",
            "Taiwan",
            "Tajikistan",
            "Tanzania, United Republic of",
            "Thailand",
            "Timor-Leste",
            "Togo",
            "Tokelau",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Turks and Caicos Islands",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "Usa",
            "United States Minor Outlying Islands",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Venezuela, Bolivarian Republic of",
            "Viet Nam",
            "Virgin Islands, British",
            "Virgin Islands, U.S.",
            "Wallis and Futuna",
            "Western Sahara",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        ];
    }
}
if (!function_exists('getTTGCountriesList')) {
    function getTTGCountriesList()
    {
        return [
            "Afghanistan",
            "Australia",
            "Brazil",
            "Canada",
            "China",
            "Hong Kong",
            "India",
            "Japan",
            "Malaysia",
            "Singapore",
            "South Korea",
            "United Arab Emirates",
            "Usa"
        ];
    }
}
if (!function_exists('getCountriesListCodes')) {
    function getCountriesListCodes()
    {

        $countryIsoCodes = array(
            array(
                "Code" => "AF",

                "Name" => "Afghanistan"
            ),
            array(
                "Code" => "AX",

                "Name" => "Aland Islands"
            ),
            array(
                "Code" => "AL",

                "Name" => "Albania"
            ),
            array(
                "Code" => "DZ",

                "Name" => "Algeria"
            ),
            array(
                "Code" => "AS",

                "Name" => "American Samoa"
            ),
            array(
                "Code" => "AD",

                "Name" => "Andorra"
            ),
            array(
                "Code" => "AO",

                "Name" => "Angola"
            ),
            array(
                "Code" => "AI",

                "Name" => "Anguilla"
            ),
            array(
                "Code" => "AQ",

                "Name" => "Antarctica"
            ),
            array(
                "Code" => "AG",

                "Name" => "Antigua and Barbuda"
            ),
            array(
                "Code" => "AR",

                "Name" => "Argentina"
            ),
            array(
                "Code" => "AM",

                "Name" => "Armenia"
            ),
            array(
                "Code" => "AW",

                "Name" => "Aruba"
            ),
            array(
                "Code" => "AU",

                "Name" => "Australia"
            ),
            array(
                "Code" => "AT",

                "Name" => "Austria"
            ),
            array(
                "Code" => "AZ",

                "Name" => "Azerbaijan"
            ),
            array(
                "Code" => "BS",

                "Name" => "Bahamas"
            ),
            array(
                "Code" => "BH",

                "Name" => "Bahrain"
            ),
            array(
                "Code" => "BD",

                "Name" => "Bangladesh"
            ),
            array(
                "Code" => "BB",

                "Name" => "Barbados"
            ),
            array(
                "Code" => "BY",

                "Name" => "Belarus"
            ),
            array(
                "Code" => "BE",

                "Name" => "Belgium"
            ),
            array(
                "Code" => "BZ",

                "Name" => "Belize"
            ),
            array(
                "Code" => "BJ",

                "Name" => "Benin"
            ),
            array(
                "Code" => "BM",

                "Name" => "Bermuda"
            ),
            array(
                "Code" => "BT",

                "Name" => "Bhutan"
            ),
            array(
                "Code" => "BO",

                "Name" => "Bolivia, Plurinational State of"
            ),
            array(
                "Code" => "BQ",

                "Name" => "Bonaire, Sint Eustatius and Saba"
            ),
            array(
                "Code" => "BA",

                "Name" => "Bosnia and Herzegovina"
            ),
            array(
                "Code" => "BW",

                "Name" => "Botswana"
            ),
            array(
                "Code" => "BV",

                "Name" => "Bouvet Island"
            ),
            array(
                "Code" => "BR",

                "Name" => "Brazil"
            ),
            array(
                "Code" => "IO",

                "Name" => "British Indian Ocean Territory"
            ),
            array(
                "Code" => "BN",

                "Name" => "Brunei Darussalam"
            ),
            array(
                "Code" => "BG",

                "Name" => "Bulgaria"
            ),
            array(
                "Code" => "BF",

                "Name" => "Burkina Faso"
            ),
            array(
                "Code" => "BI",

                "Name" => "Burundi"
            ),
            array(
                "Code" => "KH",

                "Name" => "Cambodia"
            ),
            array(
                "Code" => "CM",

                "Name" => "Cameroon"
            ),
            array(
                "Code" => "CA",

                "Name" => "Canada"
            ),
            array(
                "Code" => "CV",

                "Name" => "Cape Verde"
            ),
            array(
                "Code" => "KY",

                "Name" => "Cayman Islands"
            ),
            array(
                "Code" => "CF",

                "Name" => "Central African Republic"
            ),
            array(
                "Code" => "TD",

                "Name" => "Chad"
            ),
            array(
                "Code" => "CL",

                "Name" => "Chile"
            ),
            array(
                "Code" => "CN",

                "Name" => "China"
            ),
            array(
                "Code" => "CX",

                "Name" => "Christmas Island"
            ),
            array(
                "Code" => "CC",

                "Name" => "Cocos (Keeling) Islands"
            ),
            array(
                "Code" => "CO",

                "Name" => "Colombia"
            ),
            array(
                "Code" => "KM",

                "Name" => "Comoros"
            ),
            array(
                "Code" => "CG",

                "Name" => "Congo"
            ),
            array(
                "Code" => "CD",

                "Name" => "Congo, the Democratic Republic of the"
            ),
            array(
                "Code" => "CK",

                "Name" => "Cook Islands"
            ),
            array(
                "Code" => "CR",

                "Name" => "Costa Rica"
            ),
            array(
                "Code" => "CI",

                "Name" => "Cote d'Ivoire"
            ),
            array(
                "Code" => "HR",

                "Name" => "Croatia"
            ),
            array(
                "Code" => "CU",

                "Name" => "Cuba"
            ),
            array(
                "Code" => "CW",

                "Name" => "Curacao"
            ),
            array(
                "Code" => "CY",

                "Name" => "Cyprus"
            ),
            array(
                "Code" => "CZ",

                "Name" => "Czech Republic"
            ),
            array(
                "Code" => "DK",

                "Name" => "Denmark"
            ),
            array(
                "Code" => "DJ",

                "Name" => "Djibouti"
            ),
            array(
                "Code" => "DM",

                "Name" => "Dominica"
            ),
            array(
                "Code" => "DO",

                "Name" => "Dominican Republic"
            ),
            array(
                "Code" => "EC",

                "Name" => "Ecuador"
            ),
            array(
                "Code" => "EG",

                "Name" => "Egypt"
            ),
            array(
                "Code" => "SV",

                "Name" => "El Salvador"
            ),
            array(
                "Code" => "GQ",

                "Name" => "Equatorial Guinea"
            ),
            array(
                "Code" => "ER",

                "Name" => "Eritrea"
            ),
            array(
                "Code" => "EE",

                "Name" => "Estonia"
            ),
            array(
                "Code" => "ET",

                "Name" => "Ethiopia"
            ),
            array(
                "Code" => "FK",

                "Name" => "Falkland Islands (Malvinas)"
            ),
            array(
                "Code" => "FO",

                "Name" => "Faroe Islands"
            ),
            array(
                "Code" => "FJ",

                "Name" => "Fiji"
            ),
            array(
                "Code" => "FI",

                "Name" => "Finland"
            ),
            array(
                "Code" => "FR",

                "Name" => "France"
            ),
            array(
                "Code" => "GF",

                "Name" => "French Guiana"
            ),
            array(
                "Code" => "PF",

                "Name" => "French Polynesia"
            ),
            array(
                "Code" => "TF",

                "Name" => "French Southern Territories"
            ),
            array(
                "Code" => "GA",

                "Name" => "Gabon"
            ),
            array(
                "Code" => "GM",

                "Name" => "Gambia"
            ),
            array(
                "Code" => "GE",

                "Name" => "Georgia"
            ),
            array(
                "Code" => "DE",

                "Name" => "Germany"
            ),
            array(
                "Code" => "GH",

                "Name" => "Ghana"
            ),
            array(
                "Code" => "GI",

                "Name" => "Gibraltar"
            ),
            array(
                "Code" => "GR",

                "Name" => "Greece"
            ),
            array(
                "Code" => "GL",

                "Name" => "Greenland"
            ),
            array(
                "Code" => "GD",

                "Name" => "Grenada"
            ),
            array(
                "Code" => "GP",

                "Name" => "Guadeloupe"
            ),
            array(
                "Code" => "GU",

                "Name" => "Guam"
            ),
            array(
                "Code" => "GT",

                "Name" => "Guatemala"
            ),
            array(
                "Code" => "GG",

                "Name" => "Guernsey"
            ),
            array(
                "Code" => "GN",

                "Name" => "Guinea"
            ),
            array(
                "Code" => "GW",

                "Name" => "Guinea-Bissau"
            ),
            array(
                "Code" => "GY",

                "Name" => "Guyana"
            ),
            array(
                "Code" => "HT",

                "Name" => "Haiti"
            ),
            array(
                "Code" => "HM",

                "Name" => "Heard Island and McDonald Islands"
            ),
            array(
                "Code" => "VA",

                "Name" => "Holy See (Vatican City State)"
            ),
            array(
                "Code" => "HN",

                "Name" => "Honduras"
            ),
            array(
                "Code" => "HK",

                "Name" => "Hong Kong"
            ),
            array(
                "Code" => "HU",

                "Name" => "Hungary"
            ),
            array(
                "Code" => "IS",

                "Name" => "Iceland"
            ),
            array(
                "Code" => "IN",

                "Name" => "India"
            ),
            array(
                "Code" => "ID",

                "Name" => "Indonesia"
            ),
            array(
                "Code" => "IR",

                "Name" => "Iran, Islamic Republic of"
            ),
            array(
                "Code" => "IQ",

                "Name" => "Iraq"
            ),
            array(
                "Code" => "IE",

                "Name" => "Ireland"
            ),
            array(
                "Code" => "IM",

                "Name" => "Isle of Man"
            ),
            array(
                "Code" => "IL",

                "Name" => "Israel"
            ),
            array(
                "Code" => "IT",

                "Name" => "Italy"
            ),
            array(
                "Code" => "JM",

                "Name" => "Jamaica"
            ),
            array(
                "Code" => "JP",

                "Name" => "Japan"
            ),
            array(
                "Code" => "JE",

                "Name" => "Jersey"
            ),
            array(
                "Code" => "JO",

                "Name" => "Jordan"
            ),
            array(
                "Code" => "KZ",

                "Name" => "Kazakhstan"
            ),
            array(
                "Code" => "KE",

                "Name" => "Kenya"
            ),
            array(
                "Code" => "KI",

                "Name" => "Kiribati"
            ),
            array(
                "Code" => "KP",

                "Name" => "Korea, Democratic People's Republic of"
            ),
            array(
                "Code" => "KR",

                "Name" => "South Korea"
            ),
            array(
                "Code" => "KW",

                "Name" => "Kuwait"
            ),
            array(
                "Code" => "KG",

                "Name" => "Kyrgyzstan"
            ),
            array(
                "Code" => "LA",

                "Name" => "Lao People's Democratic Republic"
            ),
            array(
                "Code" => "LV",

                "Name" => "Latvia"
            ),
            array(
                "Code" => "LB",

                "Name" => "Lebanon"
            ),
            array(
                "Code" => "LS",

                "Name" => "Lesotho"
            ),
            array(
                "Code" => "LR",

                "Name" => "Liberia"
            ),
            array(
                "Code" => "LY",

                "Name" => "Libya"
            ),
            array(
                "Code" => "LI",

                "Name" => "Liechtenstein"
            ),
            array(
                "Code" => "LT",

                "Name" => "Lithuania"
            ),
            array(
                "Code" => "LU",

                "Name" => "Luxembourg"
            ),
            array(
                "Code" => "MO",

                "Name" => "Macao"
            ),
            array(
                "Code" => "MK",

                "Name" => "Macedonia, the Former Yugoslav Republic of"
            ),
            array(
                "Code" => "MG",

                "Name" => "Madagascar"
            ),
            array(
                "Code" => "MW",

                "Name" => "Malawi"
            ),
            array(
                "Code" => "MY",

                "Name" => "Malaysia"
            ),
            array(
                "Code" => "MV",

                "Name" => "Maldives"
            ),
            array(
                "Code" => "ML",

                "Name" => "Mali"
            ),
            array(
                "Code" => "MT",

                "Name" => "Malta"
            ),
            array(
                "Code" => "MH",

                "Name" => "Marshall Islands"
            ),
            array(
                "Code" => "MQ",

                "Name" => "Martinique"
            ),
            array(
                "Code" => "MR",

                "Name" => "Mauritania"
            ),
            array(
                "Code" => "MU",

                "Name" => "Mauritius"
            ),
            array(
                "Code" => "YT",

                "Name" => "Mayotte"
            ),
            array(
                "Code" => "MX",

                "Name" => "Mexico"
            ),
            array(
                "Code" => "FM",

                "Name" => "Micronesia, Federated States of"
            ),
            array(
                "Code" => "MD",

                "Name" => "Moldova, Republic of"
            ),
            array(
                "Code" => "MC",

                "Name" => "Monaco"
            ),
            array(
                "Code" => "MN",

                "Name" => "Mongolia"
            ),
            array(
                "Code" => "ME",

                "Name" => "Montenegro"
            ),
            array(
                "Code" => "MS",

                "Name" => "Montserrat"
            ),
            array(
                "Code" => "MA",

                "Name" => "Morocco"
            ),
            array(
                "Code" => "MZ",

                "Name" => "Mozambique"
            ),
            array(
                "Code" => "MM",

                "Name" => "Myanmar"
            ),
            array(
                "Code" => "NA",

                "Name" => "Namibia"
            ),
            array(
                "Code" => "NR",

                "Name" => "Nauru"
            ),
            array(
                "Code" => "NP",

                "Name" => "Nepal"
            ),
            array(
                "Code" => "NL",

                "Name" => "Netherlands"
            ),
            array(
                "Code" => "NC",

                "Name" => "New Caledonia"
            ),
            array(
                "Code" => "NZ",

                "Name" => "New Zealand"
            ),
            array(
                "Code" => "NI",

                "Name" => "Nicaragua"
            ),
            array(
                "Code" => "NE",

                "Name" => "Niger"
            ),
            array(
                "Code" => "NG",

                "Name" => "Nigeria"
            ),
            array(
                "Code" => "NU",

                "Name" => "Niue"
            ),
            array(
                "Code" => "NF",

                "Name" => "Norfolk Island"
            ),
            array(
                "Code" => "MP",

                "Name" => "Northern Mariana Islands"
            ),
            array(
                "Code" => "NO",

                "Name" => "Norway"
            ),
            array(
                "Code" => "OM",

                "Name" => "Oman"
            ),
            array(
                "Code" => "PK",

                "Name" => "Pakistan"
            ),
            array(
                "Code" => "PW",

                "Name" => "Palau"
            ),
            array(
                "Code" => "PS",

                "Name" => "Palestine, State of"
            ),
            array(
                "Code" => "PA",

                "Name" => "Panama"
            ),
            array(
                "Code" => "PG",

                "Name" => "Papua New Guinea"
            ),
            array(
                "Code" => "PY",

                "Name" => "Paraguay"
            ),
            array(
                "Code" => "PE",

                "Name" => "Peru"
            ),
            array(
                "Code" => "PH",

                "Name" => "Philippines"
            ),
            array(
                "Code" => "PN",

                "Name" => "Pitcairn"
            ),
            array(
                "Code" => "PL",

                "Name" => "Poland"
            ),
            array(
                "Code" => "PT",

                "Name" => "Portugal"
            ),
            array(
                "Code" => "PR",

                "Name" => "Puerto Rico"
            ),
            array(
                "Code" => "QA",

                "Name" => "Qatar"
            ),
            array(
                "Code" => "RE",

                "Name" => "Reunion"
            ),
            array(
                "Code" => "RO",

                "Name" => "Romania"
            ),
            array(
                "Code" => "RU",

                "Name" => "Russian Federation"
            ),
            array(
                "Code" => "RW",

                "Name" => "Rwanda"
            ),
            array(
                "Code" => "BL",

                "Name" => "Saint Barthelemy"
            ),
            array(
                "Code" => "SH",

                "Name" => "Saint Helena, Ascension and Tristan da Cunha"
            ),
            array(
                "Code" => "KN",

                "Name" => "Saint Kitts and Nevis"
            ),
            array(
                "Code" => "LC",

                "Name" => "Saint Lucia"
            ),
            array(
                "Code" => "MF",

                "Name" => "Saint Martin (French part)"
            ),
            array(
                "Code" => "PM",

                "Name" => "Saint Pierre and Miquelon"
            ),
            array(
                "Code" => "VC",

                "Name" => "Saint Vincent and the Grenadines"
            ),
            array(
                "Code" => "WS",

                "Name" => "Samoa"
            ),
            array(
                "Code" => "SM",

                "Name" => "San Marino"
            ),
            array(
                "Code" => "ST",

                "Name" => "Sao Tome and Principe"
            ),
            array(
                "Code" => "SA",

                "Name" => "Saudi Arabia"
            ),
            array(
                "Code" => "SN",

                "Name" => "Senegal"
            ),
            array(
                "Code" => "RS",

                "Name" => "Serbia"
            ),
            array(
                "Code" => "SC",

                "Name" => "Seychelles"
            ),
            array(
                "Code" => "SL",

                "Name" => "Sierra Leone"
            ),
            array(
                "Code" => "SG",

                "Name" => "Singapore"
            ),
            array(
                "Code" => "SX",

                "Name" => "Sint Maarten (Dutch part)"
            ),
            array(
                "Code" => "SK",

                "Name" => "Slovakia"
            ),
            array(
                "Code" => "SI",

                "Name" => "Slovenia"
            ),
            array(
                "Code" => "SB",

                "Name" => "Solomon Islands"
            ),
            array(
                "Code" => "SO",

                "Name" => "Somalia"
            ),
            array(
                "Code" => "ZA",

                "Name" => "South Africa"
            ),
            array(
                "Code" => "GS",

                "Name" => "South Georgia and the South Sandwich Islands"
            ),
            array(
                "Code" => "SS",

                "Name" => "South Sudan"
            ),
            array(
                "Code" => "ES",

                "Name" => "Spain"
            ),
            array(
                "Code" => "LK",

                "Name" => "Sri Lanka"
            ),
            array(
                "Code" => "SD",

                "Name" => "Sudan"
            ),
            array(
                "Code" => "SR",

                "Name" => "Suriname"
            ),
            array(
                "Code" => "SJ",

                "Name" => "Svalbard and Jan Mayen"
            ),
            array(
                "Code" => "SZ",

                "Name" => "Swaziland"
            ),
            array(
                "Code" => "SE",

                "Name" => "Sweden"
            ),
            array(
                "Code" => "CH",

                "Name" => "Switzerland"
            ),
            array(
                "Code" => "SY",

                "Name" => "Syrian Arab Republic"
            ),
            array(
                "Code" => "TW",

                "Name" => "Taiwan"
            ),
            array(
                "Code" => "TJ",

                "Name" => "Tajikistan"
            ),
            array(
                "Code" => "TZ",

                "Name" => "Tanzania, United Republic of"
            ),
            array(
                "Code" => "TH",

                "Name" => "Thailand"
            ),
            array(
                "Code" => "TL",

                "Name" => "Timor-Leste"
            ),
            array(
                "Code" => "TG",

                "Name" => "Togo"
            ),
            array(
                "Code" => "TK",

                "Name" => "Tokelau"
            ),
            array(
                "Code" => "TO",

                "Name" => "Tonga"
            ),
            array(
                "Code" => "TT",

                "Name" => "Trinidad and Tobago"
            ),
            array(
                "Code" => "TN",

                "Name" => "Tunisia"
            ),
            array(
                "Code" => "TR",

                "Name" => "Turkey"
            ),
            array(
                "Code" => "TM",

                "Name" => "Turkmenistan"
            ),
            array(
                "Code" => "TC",

                "Name" => "Turks and Caicos Islands"
            ),
            array(
                "Code" => "TV",

                "Name" => "Tuvalu"
            ),
            array(
                "Code" => "UG",

                "Name" => "Uganda"
            ),
            array(
                "Code" => "UA",

                "Name" => "Ukraine"
            ),
            array(
                "Code" => "AE",

                "Name" => "United Arab Emirates"
            ),
            array(
                "Code" => "GB",

                "Name" => "United Kingdom"
            ),
            array(
                "Code" => "US",

                "Name" => "Usa"
            ),
            array(
                "Code" => "UM",

                "Name" => "United States Minor Outlying Islands"
            ),
            array(
                "Code" => "UY",

                "Name" => "Uruguay"
            ),
            array(
                "Code" => "UZ",

                "Name" => "Uzbekistan"
            ),
            array(
                "Code" => "VU",

                "Name" => "Vanuatu"
            ),
            array(
                "Code" => "VE",

                "Name" => "Venezuela, Bolivarian Republic of"
            ),
            array(
                "Code" => "VN",

                "Name" => "Viet Nam"
            ),
            array(
                "Code" => "VG",

                "Name" => "Virgin Islands, British"
            ),
            array(
                "Code" => "VI",

                "Name" => "Virgin Islands, U.S."
            ),
            array(
                "Code" => "WF",

                "Name" => "Wallis and Futuna"
            ),
            array(
                "Code" => "EH",

                "Name" => "Western Sahara"
            ),
            array(
                "Code" => "YE",

                "Name" => "Yemen"
            ),
            array(
                "Code" => "ZM",

                "Name" => "Zambia"
            ),
            array(
                "Code" => "ZW",

                "Name" => "Zimbabwe"
            )
        );
        $countriesObject = [];
        foreach ($countryIsoCodes as $key => $value) {
            $countriesObject[$value['Name']] = strtolower($value['Code']);
        }
        return $countriesObject;
    }
}
// counting for graphs
if (!function_exists('total_shipments')) {
    function total_shipments($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // shipments data
        $shipMd = new ManageShipmentModel();
        if ($country) {
            $shipment_data['total'] = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->countAllResults();
            $shipmentsLastMonth = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->where(['ttg_ship.time >=' => $last_month_first_day, 'ttg_ship.time <=' => $last_month_day])->countAllResults();
            $shipmentsCurrentMonth = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->where(['ttg_ship.time >' => $last_month_day])->countAllResults();
        } else {
            $shipment_data['total'] = $shipMd->countAllResults();
            $shipmentsLastMonth = $shipMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $shipmentsCurrentMonth = $shipMd->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($shipmentsCurrentMonth == 0) {
            $shipment_data['percentage'] = 0;
        } else {
            if ($shipmentsLastMonth == 0) {
                $shipment_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $shipmentsCurrentMonth / ($shipmentsLastMonth / 100);
                $shipment_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $shipment_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $shipment_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $shipment_data;
    }
}
if (!function_exists('total_crns')) {
    function total_crns($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // CRNS DATA
        $postMd = new PostsModel();
        if ($country) {
            $crn_data['total'] = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->countAllResults();
            $crnLastMonth = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $last_month_first_day, 'ttg_post.time <=' => $last_month_day])->countAllResults();
            $crnCurrentMonth = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >' => $last_month_day])->countAllResults();
        } else {
            $crn_data['total'] = $postMd->groupBy('crn')->countAllResults();
            $crnLastMonth = $postMd->groupBy('crn')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $crnCurrentMonth = $postMd->groupBy('crn')->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($crnCurrentMonth == 0) {
            $crn_data['percentage'] = 0;
        } else {
            if ($crnLastMonth == 0) {
                $crn_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $crnCurrentMonth / ($crnLastMonth / 100);
                $crn_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $crn_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $crn_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $crn_data;
    }
}
if (!function_exists('total_assets')) {
    function total_assets($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // ASSETS DATA
        $filesMd = new PostsModel();
        if ($country) {
            $assets_data['total'] = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                // ->groupBy('ttg_post.uid')
                ->where('ttg_login.country', $country)->countAllResults();
            $assetLastMonth = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                // ->groupBy('ttg_post.uid')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $last_month_first_day, 'ttg_post.time <=' => $last_month_day])->countAllResults();
            $assetCurrentMonth = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >' => $last_month_day])->countAllResults();
        } else {
            $assets_data['total'] = $filesMd->groupBy('uid')->countAllResults();
            $assetLastMonth = $filesMd->groupBy('uid')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $assetCurrentMonth = $filesMd->groupBy('uid')->where(['time >' => $last_month_day])->countAllResults();
        }


        if ($assetCurrentMonth == 0) {
            $assets_data['percentage'] = 0;
        } else {
            if ($assetLastMonth == 0) {
                $assets_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $assetCurrentMonth / ($assetLastMonth / 100);
                $assets_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $assets_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $assets_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $assets_data;
    }
}
if (!function_exists('total_clients')) {
    function total_clients($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // CLIENTS DATA
        $clientsMd = new AdminModel();
        if ($country) {
            $clients_data['total'] = $clientsMd->where('country', $country)->where('type', 'client')->countAllResults();
            $clientsLastMonth = $clientsMd->where('country', $country)->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $clientsCurrentMonth = $clientsMd->where('country', $country)->where(['time >' => $last_month_day])->countAllResults();
        } else {
            $clients_data['total'] = $clientsMd->where('type', 'client')->countAllResults();
            $clientsLastMonth = $clientsMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $clientsCurrentMonth = $clientsMd->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($clientsCurrentMonth == 0) {
            $clients_data['percentage'] = 0;
        } else {
            if ($clientsLastMonth == 0) {
                $clients_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $clientsCurrentMonth / ($clientsLastMonth / 100);
                $clients_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $clients_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $clients_data['percentage'] = $lastMonthPercent;
                }
            }
        }


        return $clients_data;
    }
}
if (!function_exists('packagin_quality_chart')) {
    function packagin_quality_chart($country = null)
    {
        $shipMd = new ManageShipmentModel();
        $boxConditions = $shipMd->select('box_condition')->groupBy('box_condition')->findAll();
        $conditionsData = [];
        foreach ($boxConditions as $key => $data) {
            $box_condition = $data['box_condition'];
            if ($box_condition) {
                if ($country) {
                    $conditionsData[$box_condition]['count'] = $shipMd->distinct()
                        ->select('ttg_ship.id, ttg_login.country')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->where('ttg_login.country', $country)->where('ttg_ship.box_condition', $box_condition)->countAllResults();
                } else {
                    $conditionsData[$box_condition]['count'] = $shipMd->where('box_condition', $box_condition)->countAllResults();
                }
            }
            if ($box_condition == 'Fair') {
                $conditionsData[$box_condition]['color'] = '#FFB833';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Good') {
                $conditionsData[$box_condition]['color'] = '#008000';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Poor') {
                $conditionsData[$box_condition]['color'] = '#E06061';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Rejected') {
                $conditionsData[$box_condition]['color'] = '#FF2424';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Unknown') {
                $conditionsData[$box_condition]['color'] = '#13c9f2';
                $conditionsData[$box_condition]['name'] = $box_condition;
            }
        }

        return $conditionsData;
    }
}
if (!function_exists('crn_statistics')) {
    function crn_statistics($country = null)
    {
        $postMd = new PostsModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $postMd->distinct()
                    ->select('ttg_post.*, ttg_login.id as user')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->groupBy('ttg_post.crn')
                    ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $currentDayStart, 'ttg_post.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $postMd->groupBy('crn')->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
if (!function_exists('asset_statistics')) {
    function asset_statistics($country = null)
    {
        $filesMd = new PostsModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $filesMd->distinct()
                    ->select('ttg_post.*, ttg_login.id as user')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->groupBy('ttg_post.uid')
                    ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $currentDayStart, 'ttg_post.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $filesMd->groupBy('uid')->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
if (!function_exists('shipment_statistics')) {
    function shipment_statistics($country = null)
    {
        $shipMd = new ManageShipmentModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $shipMd->distinct()
                    ->select('ttg_ship.id, ttg_login.country')
                    ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                    ->where('ttg_login.country', $country)->where(['ttg_ship.time >=' => $currentDayStart, 'ttg_ship.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $shipMd->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
if (!function_exists('globalCapabilities')) {
    function globalCapabilities()
    {
        // $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        // $last_month_day = strtotime($lastMonthLastDay);
        // $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        // $last_month_first_day = strtotime($lastMonthFirstDay);

        $countryIsoCodes = array(
            array(
                "Code" => "AF",
                "data" => 0,
                "Name" => "Afghanistan"
            ),
            array(
                "Code" => "AX",
                "data" => 0,
                "Name" => "Aland Islands"
            ),
            array(
                "Code" => "AL",
                "data" => 0,
                "Name" => "Albania"
            ),
            array(
                "Code" => "DZ",
                "data" => 0,
                "Name" => "Algeria"
            ),
            array(
                "Code" => "AS",
                "data" => 0,
                "Name" => "American Samoa"
            ),
            array(
                "Code" => "AD",
                "data" => 0,
                "Name" => "Andorra"
            ),
            array(
                "Code" => "AO",
                "data" => 0,
                "Name" => "Angola"
            ),
            array(
                "Code" => "AI",
                "data" => 0,
                "Name" => "Anguilla"
            ),
            array(
                "Code" => "AQ",
                "data" => 0,
                "Name" => "Antarctica"
            ),
            array(
                "Code" => "AG",
                "data" => 0,
                "Name" => "Antigua and Barbuda"
            ),
            array(
                "Code" => "AR",
                "data" => 0,
                "Name" => "Argentina"
            ),
            array(
                "Code" => "AM",
                "data" => 0,
                "Name" => "Armenia"
            ),
            array(
                "Code" => "AW",
                "data" => 0,
                "Name" => "Aruba"
            ),
            array(
                "Code" => "AU",
                "data" => 0,
                "Name" => "Australia"
            ),
            array(
                "Code" => "AT",
                "data" => 0,
                "Name" => "Austria"
            ),
            array(
                "Code" => "AZ",
                "data" => 0,
                "Name" => "Azerbaijan"
            ),
            array(
                "Code" => "BS",
                "data" => 0,
                "Name" => "Bahamas"
            ),
            array(
                "Code" => "BH",
                "data" => 0,
                "Name" => "Bahrain"
            ),
            array(
                "Code" => "BD",
                "data" => 0,
                "Name" => "Bangladesh"
            ),
            array(
                "Code" => "BB",
                "data" => 0,
                "Name" => "Barbados"
            ),
            array(
                "Code" => "BY",
                "data" => 0,
                "Name" => "Belarus"
            ),
            array(
                "Code" => "BE",
                "data" => 0,
                "Name" => "Belgium"
            ),
            array(
                "Code" => "BZ",
                "data" => 0,
                "Name" => "Belize"
            ),
            array(
                "Code" => "BJ",
                "data" => 0,
                "Name" => "Benin"
            ),
            array(
                "Code" => "BM",
                "data" => 0,
                "Name" => "Bermuda"
            ),
            array(
                "Code" => "BT",
                "data" => 0,
                "Name" => "Bhutan"
            ),
            array(
                "Code" => "BO",
                "data" => 0,
                "Name" => "Bolivia, Plurinational State of"
            ),
            array(
                "Code" => "BQ",
                "data" => 0,
                "Name" => "Bonaire, Sint Eustatius and Saba"
            ),
            array(
                "Code" => "BA",
                "data" => 0,
                "Name" => "Bosnia and Herzegovina"
            ),
            array(
                "Code" => "BW",
                "data" => 0,
                "Name" => "Botswana"
            ),
            array(
                "Code" => "BV",
                "data" => 0,
                "Name" => "Bouvet Island"
            ),
            array(
                "Code" => "BR",
                "data" => 0,
                "Name" => "Brazil"
            ),
            array(
                "Code" => "IO",
                "data" => 0,
                "Name" => "British Indian Ocean Territory"
            ),
            array(
                "Code" => "BN",
                "data" => 0,
                "Name" => "Brunei Darussalam"
            ),
            array(
                "Code" => "BG",
                "data" => 0,
                "Name" => "Bulgaria"
            ),
            array(
                "Code" => "BF",
                "data" => 0,
                "Name" => "Burkina Faso"
            ),
            array(
                "Code" => "BI",
                "data" => 0,
                "Name" => "Burundi"
            ),
            array(
                "Code" => "KH",
                "data" => 0,
                "Name" => "Cambodia"
            ),
            array(
                "Code" => "CM",
                "data" => 0,
                "Name" => "Cameroon"
            ),
            array(
                "Code" => "CA",
                "data" => 0,
                "Name" => "Canada"
            ),
            array(
                "Code" => "CV",
                "data" => 0,
                "Name" => "Cape Verde"
            ),
            array(
                "Code" => "KY",
                "data" => 0,
                "Name" => "Cayman Islands"
            ),
            array(
                "Code" => "CF",
                "data" => 0,
                "Name" => "Central African Republic"
            ),
            array(
                "Code" => "TD",
                "data" => 0,
                "Name" => "Chad"
            ),
            array(
                "Code" => "CL",
                "data" => 0,
                "Name" => "Chile"
            ),
            array(
                "Code" => "CN",
                "data" => 0,
                "Name" => "China"
            ),
            array(
                "Code" => "CX",
                "data" => 0,
                "Name" => "Christmas Island"
            ),
            array(
                "Code" => "CC",
                "data" => 0,
                "Name" => "Cocos (Keeling) Islands"
            ),
            array(
                "Code" => "CO",
                "data" => 0,
                "Name" => "Colombia"
            ),
            array(
                "Code" => "KM",
                "data" => 0,
                "Name" => "Comoros"
            ),
            array(
                "Code" => "CG",
                "data" => 0,
                "Name" => "Congo"
            ),
            array(
                "Code" => "CD",
                "data" => 0,
                "Name" => "Congo, the Democratic Republic of the"
            ),
            array(
                "Code" => "CK",
                "data" => 0,
                "Name" => "Cook Islands"
            ),
            array(
                "Code" => "CR",
                "data" => 0,
                "Name" => "Costa Rica"
            ),
            array(
                "Code" => "CI",
                "data" => 0,
                "Name" => "Cote d'Ivoire"
            ),
            array(
                "Code" => "HR",
                "data" => 0,
                "Name" => "Croatia"
            ),
            array(
                "Code" => "CU",
                "data" => 0,
                "Name" => "Cuba"
            ),
            array(
                "Code" => "CW",
                "data" => 0,
                "Name" => "Curacao"
            ),
            array(
                "Code" => "CY",
                "data" => 0,
                "Name" => "Cyprus"
            ),
            array(
                "Code" => "CZ",
                "data" => 0,
                "Name" => "Czech Republic"
            ),
            array(
                "Code" => "DK",
                "data" => 0,
                "Name" => "Denmark"
            ),
            array(
                "Code" => "DJ",
                "data" => 0,
                "Name" => "Djibouti"
            ),
            array(
                "Code" => "DM",
                "data" => 0,
                "Name" => "Dominica"
            ),
            array(
                "Code" => "DO",
                "data" => 0,
                "Name" => "Dominican Republic"
            ),
            array(
                "Code" => "EC",
                "data" => 0,
                "Name" => "Ecuador"
            ),
            array(
                "Code" => "EG",
                "data" => 0,
                "Name" => "Egypt"
            ),
            array(
                "Code" => "SV",
                "data" => 0,
                "Name" => "El Salvador"
            ),
            array(
                "Code" => "GQ",
                "data" => 0,
                "Name" => "Equatorial Guinea"
            ),
            array(
                "Code" => "ER",
                "data" => 0,
                "Name" => "Eritrea"
            ),
            array(
                "Code" => "EE",
                "data" => 0,
                "Name" => "Estonia"
            ),
            array(
                "Code" => "ET",
                "data" => 0,
                "Name" => "Ethiopia"
            ),
            array(
                "Code" => "FK",
                "data" => 0,
                "Name" => "Falkland Islands (Malvinas)"
            ),
            array(
                "Code" => "FO",
                "data" => 0,
                "Name" => "Faroe Islands"
            ),
            array(
                "Code" => "FJ",
                "data" => 0,
                "Name" => "Fiji"
            ),
            array(
                "Code" => "FI",
                "data" => 0,
                "Name" => "Finland"
            ),
            array(
                "Code" => "FR",
                "data" => 0,
                "Name" => "France"
            ),
            array(
                "Code" => "GF",
                "data" => 0,
                "Name" => "French Guiana"
            ),
            array(
                "Code" => "PF",
                "data" => 0,
                "Name" => "French Polynesia"
            ),
            array(
                "Code" => "TF",
                "data" => 0,
                "Name" => "French Southern Territories"
            ),
            array(
                "Code" => "GA",
                "data" => 0,
                "Name" => "Gabon"
            ),
            array(
                "Code" => "GM",
                "data" => 0,
                "Name" => "Gambia"
            ),
            array(
                "Code" => "GE",
                "data" => 0,
                "Name" => "Georgia"
            ),
            array(
                "Code" => "DE",
                "data" => 0,
                "Name" => "Germany"
            ),
            array(
                "Code" => "GH",
                "data" => 0,
                "Name" => "Ghana"
            ),
            array(
                "Code" => "GI",
                "data" => 0,
                "Name" => "Gibraltar"
            ),
            array(
                "Code" => "GR",
                "data" => 0,
                "Name" => "Greece"
            ),
            array(
                "Code" => "GL",
                "data" => 0,
                "Name" => "Greenland"
            ),
            array(
                "Code" => "GD",
                "data" => 0,
                "Name" => "Grenada"
            ),
            array(
                "Code" => "GP",
                "data" => 0,
                "Name" => "Guadeloupe"
            ),
            array(
                "Code" => "GU",
                "data" => 0,
                "Name" => "Guam"
            ),
            array(
                "Code" => "GT",
                "data" => 0,
                "Name" => "Guatemala"
            ),
            array(
                "Code" => "GG",
                "data" => 0,
                "Name" => "Guernsey"
            ),
            array(
                "Code" => "GN",
                "data" => 0,
                "Name" => "Guinea"
            ),
            array(
                "Code" => "GW",
                "data" => 0,
                "Name" => "Guinea-Bissau"
            ),
            array(
                "Code" => "GY",
                "data" => 0,
                "Name" => "Guyana"
            ),
            array(
                "Code" => "HT",
                "data" => 0,
                "Name" => "Haiti"
            ),
            array(
                "Code" => "HM",
                "data" => 0,
                "Name" => "Heard Island and McDonald Islands"
            ),
            array(
                "Code" => "VA",
                "data" => 0,
                "Name" => "Holy See (Vatican City State)"
            ),
            array(
                "Code" => "HN",
                "data" => 0,
                "Name" => "Honduras"
            ),
            array(
                "Code" => "HK",
                "data" => 0,
                "Name" => "Hong Kong"
            ),
            array(
                "Code" => "HU",
                "data" => 0,
                "Name" => "Hungary"
            ),
            array(
                "Code" => "IS",
                "data" => 0,
                "Name" => "Iceland"
            ),
            array(
                "Code" => "IN",
                "data" => 0,
                "Name" => "India"
            ),
            array(
                "Code" => "ID",
                "data" => 0,
                "Name" => "Indonesia"
            ),
            array(
                "Code" => "IR",
                "data" => 0,
                "Name" => "Iran, Islamic Republic of"
            ),
            array(
                "Code" => "IQ",
                "data" => 0,
                "Name" => "Iraq"
            ),
            array(
                "Code" => "IE",
                "data" => 0,
                "Name" => "Ireland"
            ),
            array(
                "Code" => "IM",
                "data" => 0,
                "Name" => "Isle of Man"
            ),
            array(
                "Code" => "IL",
                "data" => 0,
                "Name" => "Israel"
            ),
            array(
                "Code" => "IT",
                "data" => 0,
                "Name" => "Italy"
            ),
            array(
                "Code" => "JM",
                "data" => 0,
                "Name" => "Jamaica"
            ),
            array(
                "Code" => "JP",
                "data" => 0,
                "Name" => "Japan"
            ),
            array(
                "Code" => "JE",
                "data" => 0,
                "Name" => "Jersey"
            ),
            array(
                "Code" => "JO",
                "data" => 0,
                "Name" => "Jordan"
            ),
            array(
                "Code" => "KZ",
                "data" => 0,
                "Name" => "Kazakhstan"
            ),
            array(
                "Code" => "KE",
                "data" => 0,
                "Name" => "Kenya"
            ),
            array(
                "Code" => "KI",
                "data" => 0,
                "Name" => "Kiribati"
            ),
            array(
                "Code" => "KP",
                "data" => 0,
                "Name" => "Korea, Democratic People's Republic of"
            ),
            array(
                "Code" => "KR",
                "data" => 0,
                "Name" => "South Korea"
            ),
            array(
                "Code" => "KW",
                "data" => 0,
                "Name" => "Kuwait"
            ),
            array(
                "Code" => "KG",
                "data" => 0,
                "Name" => "Kyrgyzstan"
            ),
            array(
                "Code" => "LA",
                "data" => 0,
                "Name" => "Lao People's Democratic Republic"
            ),
            array(
                "Code" => "LV",
                "data" => 0,
                "Name" => "Latvia"
            ),
            array(
                "Code" => "LB",
                "data" => 0,
                "Name" => "Lebanon"
            ),
            array(
                "Code" => "LS",
                "data" => 0,
                "Name" => "Lesotho"
            ),
            array(
                "Code" => "LR",
                "data" => 0,
                "Name" => "Liberia"
            ),
            array(
                "Code" => "LY",
                "data" => 0,
                "Name" => "Libya"
            ),
            array(
                "Code" => "LI",
                "data" => 0,
                "Name" => "Liechtenstein"
            ),
            array(
                "Code" => "LT",
                "data" => 0,
                "Name" => "Lithuania"
            ),
            array(
                "Code" => "LU",
                "data" => 0,
                "Name" => "Luxembourg"
            ),
            array(
                "Code" => "MO",
                "data" => 0,
                "Name" => "Macao"
            ),
            array(
                "Code" => "MK",
                "data" => 0,
                "Name" => "Macedonia, the Former Yugoslav Republic of"
            ),
            array(
                "Code" => "MG",
                "data" => 0,
                "Name" => "Madagascar"
            ),
            array(
                "Code" => "MW",
                "data" => 0,
                "Name" => "Malawi"
            ),
            array(
                "Code" => "MY",
                "data" => 0,
                "Name" => "Malaysia"
            ),
            array(
                "Code" => "MV",
                "data" => 0,
                "Name" => "Maldives"
            ),
            array(
                "Code" => "ML",
                "data" => 0,
                "Name" => "Mali"
            ),
            array(
                "Code" => "MT",
                "data" => 0,
                "Name" => "Malta"
            ),
            array(
                "Code" => "MH",
                "data" => 0,
                "Name" => "Marshall Islands"
            ),
            array(
                "Code" => "MQ",
                "data" => 0,
                "Name" => "Martinique"
            ),
            array(
                "Code" => "MR",
                "data" => 0,
                "Name" => "Mauritania"
            ),
            array(
                "Code" => "MU",
                "data" => 0,
                "Name" => "Mauritius"
            ),
            array(
                "Code" => "YT",
                "data" => 0,
                "Name" => "Mayotte"
            ),
            array(
                "Code" => "MX",
                "data" => 0,
                "Name" => "Mexico"
            ),
            array(
                "Code" => "FM",
                "data" => 0,
                "Name" => "Micronesia, Federated States of"
            ),
            array(
                "Code" => "MD",
                "data" => 0,
                "Name" => "Moldova, Republic of"
            ),
            array(
                "Code" => "MC",
                "data" => 0,
                "Name" => "Monaco"
            ),
            array(
                "Code" => "MN",
                "data" => 0,
                "Name" => "Mongolia"
            ),
            array(
                "Code" => "ME",
                "data" => 0,
                "Name" => "Montenegro"
            ),
            array(
                "Code" => "MS",
                "data" => 0,
                "Name" => "Montserrat"
            ),
            array(
                "Code" => "MA",
                "data" => 0,
                "Name" => "Morocco"
            ),
            array(
                "Code" => "MZ",
                "data" => 0,
                "Name" => "Mozambique"
            ),
            array(
                "Code" => "MM",
                "data" => 0,
                "Name" => "Myanmar"
            ),
            array(
                "Code" => "NA",
                "data" => 0,
                "Name" => "Namibia"
            ),
            array(
                "Code" => "NR",
                "data" => 0,
                "Name" => "Nauru"
            ),
            array(
                "Code" => "NP",
                "data" => 0,
                "Name" => "Nepal"
            ),
            array(
                "Code" => "NL",
                "data" => 0,
                "Name" => "Netherlands"
            ),
            array(
                "Code" => "NC",
                "data" => 0,
                "Name" => "New Caledonia"
            ),
            array(
                "Code" => "NZ",
                "data" => 0,
                "Name" => "New Zealand"
            ),
            array(
                "Code" => "NI",
                "data" => 0,
                "Name" => "Nicaragua"
            ),
            array(
                "Code" => "NE",
                "data" => 0,
                "Name" => "Niger"
            ),
            array(
                "Code" => "NG",
                "data" => 0,
                "Name" => "Nigeria"
            ),
            array(
                "Code" => "NU",
                "data" => 0,
                "Name" => "Niue"
            ),
            array(
                "Code" => "NF",
                "data" => 0,
                "Name" => "Norfolk Island"
            ),
            array(
                "Code" => "MP",
                "data" => 0,
                "Name" => "Northern Mariana Islands"
            ),
            array(
                "Code" => "NO",
                "data" => 0,
                "Name" => "Norway"
            ),
            array(
                "Code" => "OM",
                "data" => 0,
                "Name" => "Oman"
            ),
            array(
                "Code" => "PK",
                "data" => 0,
                "Name" => "Pakistan"
            ),
            array(
                "Code" => "PW",
                "data" => 0,
                "Name" => "Palau"
            ),
            array(
                "Code" => "PS",
                "data" => 0,
                "Name" => "Palestine, State of"
            ),
            array(
                "Code" => "PA",
                "data" => 0,
                "Name" => "Panama"
            ),
            array(
                "Code" => "PG",
                "data" => 0,
                "Name" => "Papua New Guinea"
            ),
            array(
                "Code" => "PY",
                "data" => 0,
                "Name" => "Paraguay"
            ),
            array(
                "Code" => "PE",
                "data" => 0,
                "Name" => "Peru"
            ),
            array(
                "Code" => "PH",
                "data" => 0,
                "Name" => "Philippines"
            ),
            array(
                "Code" => "PN",
                "data" => 0,
                "Name" => "Pitcairn"
            ),
            array(
                "Code" => "PL",
                "data" => 0,
                "Name" => "Poland"
            ),
            array(
                "Code" => "PT",
                "data" => 0,
                "Name" => "Portugal"
            ),
            array(
                "Code" => "PR",
                "data" => 0,
                "Name" => "Puerto Rico"
            ),
            array(
                "Code" => "QA",
                "data" => 0,
                "Name" => "Qatar"
            ),
            array(
                "Code" => "RE",
                "data" => 0,
                "Name" => "Reunion"
            ),
            array(
                "Code" => "RO",
                "data" => 0,
                "Name" => "Romania"
            ),
            array(
                "Code" => "RU",
                "data" => 0,
                "Name" => "Russian Federation"
            ),
            array(
                "Code" => "RW",
                "data" => 0,
                "Name" => "Rwanda"
            ),
            array(
                "Code" => "BL",
                "data" => 0,
                "Name" => "Saint Barthelemy"
            ),
            array(
                "Code" => "SH",
                "data" => 0,
                "Name" => "Saint Helena, Ascension and Tristan da Cunha"
            ),
            array(
                "Code" => "KN",
                "data" => 0,
                "Name" => "Saint Kitts and Nevis"
            ),
            array(
                "Code" => "LC",
                "data" => 0,
                "Name" => "Saint Lucia"
            ),
            array(
                "Code" => "MF",
                "data" => 0,
                "Name" => "Saint Martin (French part)"
            ),
            array(
                "Code" => "PM",
                "data" => 0,
                "Name" => "Saint Pierre and Miquelon"
            ),
            array(
                "Code" => "VC",
                "data" => 0,
                "Name" => "Saint Vincent and the Grenadines"
            ),
            array(
                "Code" => "WS",
                "data" => 0,
                "Name" => "Samoa"
            ),
            array(
                "Code" => "SM",
                "data" => 0,
                "Name" => "San Marino"
            ),
            array(
                "Code" => "ST",
                "data" => 0,
                "Name" => "Sao Tome and Principe"
            ),
            array(
                "Code" => "SA",
                "data" => 0,
                "Name" => "Saudi Arabia"
            ),
            array(
                "Code" => "SN",
                "data" => 0,
                "Name" => "Senegal"
            ),
            array(
                "Code" => "RS",
                "data" => 0,
                "Name" => "Serbia"
            ),
            array(
                "Code" => "SC",
                "data" => 0,
                "Name" => "Seychelles"
            ),
            array(
                "Code" => "SL",
                "data" => 0,
                "Name" => "Sierra Leone"
            ),
            array(
                "Code" => "SG",
                "data" => 0,
                "Name" => "Singapore"
            ),
            array(
                "Code" => "SX",
                "data" => 0,
                "Name" => "Sint Maarten (Dutch part)"
            ),
            array(
                "Code" => "SK",
                "data" => 0,
                "Name" => "Slovakia"
            ),
            array(
                "Code" => "SI",
                "data" => 0,
                "Name" => "Slovenia"
            ),
            array(
                "Code" => "SB",
                "data" => 0,
                "Name" => "Solomon Islands"
            ),
            array(
                "Code" => "SO",
                "data" => 0,
                "Name" => "Somalia"
            ),
            array(
                "Code" => "ZA",
                "data" => 0,
                "Name" => "South Africa"
            ),
            array(
                "Code" => "GS",
                "data" => 0,
                "Name" => "South Georgia and the South Sandwich Islands"
            ),
            array(
                "Code" => "SS",
                "data" => 0,
                "Name" => "South Sudan"
            ),
            array(
                "Code" => "ES",
                "data" => 0,
                "Name" => "Spain"
            ),
            array(
                "Code" => "LK",
                "data" => 0,
                "Name" => "Sri Lanka"
            ),
            array(
                "Code" => "SD",
                "data" => 0,
                "Name" => "Sudan"
            ),
            array(
                "Code" => "SR",
                "data" => 0,
                "Name" => "Suriname"
            ),
            array(
                "Code" => "SJ",
                "data" => 0,
                "Name" => "Svalbard and Jan Mayen"
            ),
            array(
                "Code" => "SZ",
                "data" => 0,
                "Name" => "Swaziland"
            ),
            array(
                "Code" => "SE",
                "data" => 0,
                "Name" => "Sweden"
            ),
            array(
                "Code" => "CH",
                "data" => 0,
                "Name" => "Switzerland"
            ),
            array(
                "Code" => "SY",
                "data" => 0,
                "Name" => "Syrian Arab Republic"
            ),
            array(
                "Code" => "TW",
                "data" => 0,
                "Name" => "Taiwan"
            ),
            array(
                "Code" => "TJ",
                "data" => 0,
                "Name" => "Tajikistan"
            ),
            array(
                "Code" => "TZ",
                "data" => 0,
                "Name" => "Tanzania, United Republic of"
            ),
            array(
                "Code" => "TH",
                "data" => 0,
                "Name" => "Thailand"
            ),
            array(
                "Code" => "TL",
                "data" => 0,
                "Name" => "Timor-Leste"
            ),
            array(
                "Code" => "TG",
                "data" => 0,
                "Name" => "Togo"
            ),
            array(
                "Code" => "TK",
                "data" => 0,
                "Name" => "Tokelau"
            ),
            array(
                "Code" => "TO",
                "data" => 0,
                "Name" => "Tonga"
            ),
            array(
                "Code" => "TT",
                "data" => 0,
                "Name" => "Trinidad and Tobago"
            ),
            array(
                "Code" => "TN",
                "data" => 0,
                "Name" => "Tunisia"
            ),
            array(
                "Code" => "TR",
                "data" => 0,
                "Name" => "Turkey"
            ),
            array(
                "Code" => "TM",
                "data" => 0,
                "Name" => "Turkmenistan"
            ),
            array(
                "Code" => "TC",
                "data" => 0,
                "Name" => "Turks and Caicos Islands"
            ),
            array(
                "Code" => "TV",
                "data" => 0,
                "Name" => "Tuvalu"
            ),
            array(
                "Code" => "UG",
                "data" => 0,
                "Name" => "Uganda"
            ),
            array(
                "Code" => "UA",
                "data" => 0,
                "Name" => "Ukraine"
            ),
            array(
                "Code" => "AE",
                "data" => 0,
                "Name" => "United Arab Emirates"
            ),
            array(
                "Code" => "GB",
                "data" => 0,
                "Name" => "United Kingdom"
            ),
            array(
                "Code" => "US",
                "data" => 0,
                "Name" => "Usa"
            ),
            array(
                "Code" => "UM",
                "data" => 0,
                "Name" => "United States Minor Outlying Islands"
            ),
            array(
                "Code" => "UY",
                "data" => 0,
                "Name" => "Uruguay"
            ),
            array(
                "Code" => "UZ",
                "data" => 0,
                "Name" => "Uzbekistan"
            ),
            array(
                "Code" => "VU",
                "data" => 0,
                "Name" => "Vanuatu"
            ),
            array(
                "Code" => "VE",
                "data" => 0,
                "Name" => "Venezuela, Bolivarian Republic of"
            ),
            array(
                "Code" => "VN",
                "data" => 0,
                "Name" => "Viet Nam"
            ),
            array(
                "Code" => "VG",
                "data" => 0,
                "Name" => "Virgin Islands, British"
            ),
            array(
                "Code" => "VI",
                "data" => 0,
                "Name" => "Virgin Islands, U.S."
            ),
            array(
                "Code" => "WF",
                "data" => 0,
                "Name" => "Wallis and Futuna"
            ),
            array(
                "Code" => "EH",
                "data" => 0,
                "Name" => "Western Sahara"
            ),
            array(
                "Code" => "YE",
                "data" => 0,
                "Name" => "Yemen"
            ),
            array(
                "Code" => "ZM",
                "data" => 0,
                "Name" => "Zambia"
            ),
            array(
                "Code" => "ZW",
                "data" => 0,
                "Name" => "Zimbabwe"
            )
        );

        // ASSETS DATA
        $userMd = new AdminModel();
        $postMd = new PostsModel();
        $userCountries = $userMd->select('id, country')->where('country !=', null)->findAll();

        $countries = [];

        foreach ($userCountries as $key => $country) {
            $userPostsData = $postMd->where('userid', $country['id'])->countAllResults();
            $thisCountry = ucfirst($country['country']);

            $arrayKey = array_search($thisCountry, array_column($countryIsoCodes, 'Name'));
            $countryIsoCodes[$arrayKey]['data'] += intval($userPostsData);
            // if (isset($countries[$thisCountry])) {
            //     $countries[$thisCountry] += intval($userPostsData);
            // } else {
            //     $countries[$thisCountry] = intval($userPostsData);
            // }
        }

        foreach ($countryIsoCodes as $key => $countryData) {
            $countries[strtolower($countryData['Code'])] = $countryData['data'] . "";
        }

        // $assets = $postMd->

        // $data['userCountries'] = $userCountries;
        $data['data'] = $countries;

        // $data['countries'] = $postMd->distinct()
        //     ->select('ttg_post.userid, ttg_login.country, ttg_login.id as user')
        //     ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
        //     ->groupBy('ttg_login.country')->findAll();


        // $assetLastMonth = $postMd->groupBy('uid')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
        // $assetCurrentMonth = $postMd->groupBy('uid')->where(['time >' => $last_month_day])->countAllResults();

        // if ($assetCurrentMonth == 0) {
        //     $assets_data['percentage'] = 0;
        // } else {
        //     if ($assetLastMonth == 0) {
        //         $assets_data['percentage'] = 100;
        //     } else {
        //         $lastMonthPercent = $assetCurrentMonth / ($assetLastMonth / 100);
        //         $assets_data['percentage'] = $lastMonthPercent;
        //         if ($lastMonthPercent > 100) {
        //             $assets_data['percentage'] = $lastMonthPercent - 100;
        //         } else {
        //             $assets_data['percentage'] = $lastMonthPercent;
        //         }
        //     }
        // }

        return $data;
    }
}

// other functions
if (!function_exists('logout')) {
    function logout()
    {
        return redirect()->route('logout');
    }
}
if (!function_exists('test_input')) {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('', '', $data);
        return $data;
    }
}

if (!function_exists('add_colon')) {
    function add_colon($data)
    {
        $data = str_replace("'", '', $data);
        $data = str_replace("pdfdownload", '', $data);
        $data = "'" . $data . "'";
        return $data;
    }
}

if (!function_exists('attachment_size')) {
    function attachment_size($data)
    {
        $size = 0;
        foreach ($data as $fr) {

            $ed =  unified(json_decode($fr['files'], true));
            foreach ($ed as $rf) {
                $size = filesize($rf['file']) + $size;
            }
        }
        return $size;
    }
}

if (!function_exists('unified')) {
    function unified($data)
    {
        foreach ($data as $firstdata) {
            foreach ($firstdata as $key => $seconddata) {
                $key = substr($key, 0, 4);
                $newseconddata[$key] = $seconddata;
            }
            $newfirstdata[] = $newseconddata;
        }

        return $newfirstdata;
    }
}
if (!function_exists('remove_empty')) {
    function remove_empty($data)
    {
        if ($data != "") {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('checkUserTypes')) {
    function checkUserTypes($type)
    {
        if (in_array(session()->get('user.type'), $type)) {
            return true;
        }
        logout();
    }
}
if (!function_exists('passwordHash')) {
    function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
if (!function_exists('create_dates')) {
    function create_dates()
    {
        // $db = new ObjectionsModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['datetimes'];
        //     // $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done objection <br>';
        // $db = new AdminModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done admin model <br>';
        // $db = new FilesModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done <br>';
        // $db = new CrnModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done crn <br>';
        // $db = new ActivityLogModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done activity <br>';
        // $db = new EmployeModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['joiningDate'] . ' 00:00:00';
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done employe <br>';
        $db = new ManageUserModel();
        $postdata = $db->findAll();

        foreach ($postdata as $key => $shipment) {
            $createdAt = date('Y-m-d H:s:i', $shipment['created_date']);
            $data = [
                'adduserID' => $shipment['adduserID'],
                'created_at' => $createdAt
            ];
            $db->save($data);
        }

        echo 'done user <br>';
        return;
    }
}

// private function

if (!function_exists('generatePdf')) {
    function generatePdf($data, $type = 'single')
    {
        $pdfTitle = '';
        if ($type == 'multiple') {
            foreach ($data as $key => $value) {
                $pdfTitle = $value['uid'] . ', ';
            }
        } else {
            $pdfTitle = $data['uid'];
        }
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $pdfTitle . '</title>
            </head>
            <body style="margin:auto;">';

        if ($type == 'multiple') {
            foreach ($data as $key => $value) {
                $images = json_decode($value['files']);
                $html .= '<div style="margin-top:20px;page-break-after: always;">
                                <div style="background: #18416c;padding: 7px 0px 8px 7px;text-align: center;color: white;font-size:large;font-weight:700;">
                                    PHOTOS FOR : ' . $value['uid'] . '
                                </div>';
                foreach ($images as $key => $image) {
                    $file = 'file' . ($key + 1);
                    $desc = 'desc' . ($key + 1);
                    if (file_exists($image->$file)) {
                        $thisImage = base64_encode_html_image($image->$file, '1x1');
                        $html .= '<div style="border: 1px solid blue;margin-top: 20px;height: auto;">
                                    <div style="margin-top: 20px;text-align: left;border: 1px solid blue;margin-right: 150px;margin-left: 150px;height: auto;">
                                    <div style="text-align: center;height: 300px;">
                                        ' . $thisImage . '
                                    </div>
                                    <div style="min-height: 40px;">
                                    ' . $image->$desc . '
                                    </div>
                                </div></div>';
                    }
                }

                $html .= '</div>';
            }
        } else {
            $images = json_decode($data['files']);
            $html .= '<div style="page-break-after: always;">
                            <div style="background: #18416c;padding: 7px 0px 8px 7px;text-align: center;color: white;font-size:large;font-weight:700;">
                                PHOTOS FOR : ' . $data['uid'] . '
                            </div>';
            foreach ($images as $key => $image) {
                $file = 'file' . ($key + 1);
                $desc = 'desc' . ($key + 1);
                if (file_exists($image->$file)) {
                    $thisImage = base64_encode_html_image($image->$file, '1x1');
                    $html .= '<div style="border: 1px solid blue;margin-top: 20px;height: auto;">
                                <div style="margin-top: 20px;text-align: left;border: 1px solid blue;margin-right: 150px;margin-left: 150px;height: auto;">
                                <div style="text-align: center;height: 300px;">
                                    ' . $thisImage . '
                                </div>
                                <div style="min-height: 40px;">
                                ' . $image->$desc . '
                                </div>
                            </div></div>';
                }
            }

            $html .= '</div>';
        }

        $html .= '</body></html>';

        // instantiate and use the dompdf class
        $encodedHtml = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        // $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);

        $dompdf->setOptions($options);

        $dompdf->loadHtml($html, 'UTF-8');

        $date = date('d-M-Y', time());
        $file_name = 'TTG_PHOTOSTORAGE_' . $date . '.pdf';

        $dompdf->loadHtml($encodedHtml);
        $dompdf->render();
        ob_end_clean();
        return $dompdf->stream($file_name, array("Attachment" => false));

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        // $dompdf->render();


        // $html = mb_convert_encoding($output1, 'HTML-ENTITIES', 'UTF-8');
        // $pdf = new Pdf();
        // $options = $pdf->getOptions();

        // $pdf->setOptions($options);

        // $file_name = 'Halal-Certificate-' . $row["order_no"] . '.pdf';
        // $pdf->loadHtml($html);
        // $pdf->render();
        // ob_end_clean();
        // $pdf->stream($file_name, array("Attachment" => false));
        // // die();




        // Output the generated PDF to Browser
        // return $dompdf->stream('TTG_PHOTOSTORAGE_' . $date . '.pdf', array("Attachment" => false));
    }
}

if (!function_exists('base64_encode_html_image')) {
    function base64_encode_html_image($img_file, $alt = null, $cache = false, $ext = null)
    {
        if (!is_file($img_file)) {
            return false;
        }

        $b64_file = "{$img_file}.b64";
        if ($cache && is_file($b64_file)) {
            $b64 = file_get_contents($b64_file);
        } else {
            $bin = file_get_contents($img_file);
            $b64 = base64_encode($bin);

            if ($cache) {
                file_put_contents($b64_file, $b64);
            }
        }

        if (!$ext) {
            $ext = pathinfo($img_file, PATHINFO_EXTENSION);
        }

        return "<img alt='{$alt}' src='data:image/{$ext};base64,{$b64}' style='height:100%;'/>";
    }
}

if (!function_exists('user_login')) {
    function user_login($userEmail, $userPassword)
    {
        $response = ['success' => false, 'message' => '', 'user_data' => []];
        $userDb = new AdminModel();
        $getUser = $userDb->where('email', $userEmail)->first();

        if (!$getUser['status'] || $getUser['status'] == '0') {
            $response['message'] = 'You are not activated, please contact adminstration.';
        } else {
            if (password_verify($userPassword, $getUser['pass']) && $getUser['status']) {
                // return print_r($getUser);
                unset($getUser['pass']);
                unset($getUser['token']);
                // return print_r($getUser);

                $sessionData['userLoggedIn'] = true;
                $sessionData['loginType'] = $getUser['type'];
                $sessionData['user'] = $getUser;
                session()->set($sessionData);
                $response['success'] = true;
                $response['user_data'] = $getUser;
                $response['message'] = 'Login successfully.';
            } else {
                // return print_r('not match or not activated');
                $response['message'] = 'Password or email not matched. Or User not activated yet.';
            }
        }

        return $response;
    }
}

// if (!function_exists('verifyPassword')) {
//     function verifyPassword()
//     {
//     }
// }

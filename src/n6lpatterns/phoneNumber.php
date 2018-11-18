<?php
/**
 * @author    Chris Yates
 * @copyright Copyright &copy; 2017 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   User.PhoneNumber
 */

namespace BeastBytes\User\PhoneNumber\validators;

/**
 * National patterns to use when validating phone numbers.
 * National patterns are indexed by
 * {@link http://en.wikipedia.org/wiki/ISO_3166-1#Current_codes ISO 3166-1 alpha-2 country code}
 * and may be a string or array.
 * If a string the pattern is the regex to match, if an array the first element
 * is the regex to match and the second is the replacement allowing numbers to be stored in a standard format.
 */
return [
    'AD' => [], // Andorra
    'AE' => [], // United Arab Emirates
    'AF' => [], // Afghanistan
    'AG' => [], // Antigua and Barbuda
    'AI' => [], // Anguilla
    'AL' => [], // Albania
    'AM' => [], // Armenia
    'AO' => [], // Angola
    'AQ' => [], // Antarctica
    'AR' => [], // Argentina
    'AS' => [], // American Samoa
    'AT' => [], // Austria
    'AU' => [], // Australia
    'AW' => [], // Aruba
    'AX' => [], // Åland Islands
    'AZ' => [], // Azerbaijan
    'BA' => [], // Bosnia and Herzegovina
    'BB' => [], // Barbados
    'BD' => [], // Bangladesh
    'BE' => [], // Belgium
    'BF' => [], // Burkina Faso
    'BG' => [], // Bulgaria
    'BH' => [], // Bahrain
    'BI' => [], // Burundi
    'BJ' => [], // Benin
    'BL' => [], // Saint Barthélemy
    'BM' => [], // Bermuda
    'BN' => [], // Brunei
    'BO' => [], // Bolivia
    'BQ' => [], // Bonaire, Sint Eustatius and Saba
    'BR' => [], // Brazil
    'BS' => [], // The Bahamas
    'BT' => [], // Bhutan
    'BV' => [], // Bouvet Island
    'BW' => [], // Botswana
    'BY' => [], // Belarus
    'BZ' => [], // Belize
    'CA' => [
        '/\(?\b([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\b/',
        '($1) $2-$3'
    ], // Canada
    'CC' => [], // Cocos (Keeling) Islands
    'CD' => [], // Democratic Republic of the Congo
    'CF' => [], // Central African Republic
    'CG' => [], // Republic of the Congo
    'CH' => [], // Switzerland
    'CI' => [], // Ivory Coast / Côte d'Ivoire
    'CK' => [], // Cook Islands
    'CL' => [], // Chile
    'CM' => [], // Cameroon
    'CN' => [], // China
    'CO' => [], // Colombia
    'CR' => [], // Costa Rica
    'CU' => [], // Cuba
    'CV' => [], // Cape Verde
    'CW' => [], // Curaçao
    'CX' => [], // Christmas Island
    'CY' => [], // Cyprus
    'CZ' => [], // Czech Republic
    'DE' => [], // Germany
    'DJ' => [], // Djibouti
    'DK' => [], // Denmark
    'DM' => [], // Dominica
    'DO' => [], // Dominican Republic
    'DZ' => [], // Algeria
    'EC' => [], // Ecuador
    'EE' => [], // Estonia
    'EG' => [], // Egypt
    'EH' => [], // Western Sahara
    'ER' => [], // Eritrea
    'ES' => [], // Spain
    'ET' => [], // Ethiopia
    'FI' => [], // Finland
    'FJ' => [], // Fiji
    'FK' => [], // Falkland Islands
    'FM' => [], // Micronesia
    'FO' => [], // Faroe Islands
    'FR' => [], // France
    'GA' => [], // Gabon
    'GB' => [
        '/^((\()?)(0\d{2,4})(?(2)\))([-. ]?((\d){3,4}))([-. ]?((\d){3,4}))(?:[-. ]?(x|#).+)?$/',
        '$3 $5$8 $10'
    ], // United Kingdom
    'GD' => [], // Grenada
    'GE' => [], // Georgia
    'GF' => [], // French Guiana
    'GG' => [], // Guernsey
    'GH' => [], // Ghana
    'GI' => [], // Gibraltar
    'GL' => [], // Greenland
    'GM' => [], // Gambia
    'GN' => [], // Guinea
    'GP' => [], // Guadeloupe
    'GQ' => [], // Equatorial Guinea
    'GR' => [], // Greece
    'GS' => [], // South Georgia and the South Sandwich Islands
    'GT' => [], // Guatemala
    'GU' => [], // Guam
    'GW' => [], // Guinea-Bissau
    'GY' => [], // Guyana
    'HK' => [], // Hong Kong
    'HM' => [], // Heard Island and McDonald Islands
    'HN' => [], // Honduras
    'HR' => [], // Croatia
    'HT' => [], // Haiti
    'HU' => [], // Hungary
    'ID' => [], // Indonesia
    'IE' => [], // Ireland
    'IL' => [], // Israel
    'IM' => [], // Isle of Man
    'IN' => [], // India
    'IO' => [], // British Indian Ocean Territory
    'IQ' => [], // Iraq
    'IR' => [], // Iran
    'IS' => [], // Iceland
    'IT' => [], // Italy
    'JE' => [], // Jersey
    'JM' => [], // Jamaica
    'JO' => [], // Jordan
    'JP' => [], // Japan
    'KE' => [], // Kenya
    'KG' => [], // Kyrgyzstan
    'KH' => [], // Cambodia
    'KI' => [], // Kiribati
    'KM' => [], // Comoros
    'KN' => [], // Saint Kitts and Nevis
    'KP' => [], // North Korea
    'KR' => [], // South Korea
    'KW' => [], // Kuwait
    'KY' => [], // Cayman Islands
    'KZ' => [], // Kazakhstan
    'LA' => [], // Laos
    'LB' => [], // Lebanon
    'LC' => [], // Saint Lucia
    'LI' => [], // Liechtenstein
    'LK' => [], // Sri Lanka
    'LR' => [], // Liberia
    'LS' => [], // Lesotho
    'LT' => [], // Lithuania
    'LU' => [], // Luxembourg
    'LV' => [], // Latvia
    'LY' => [], // Libya
    'MA' => [], // Morocco
    'MC' => [], // Monaco
    'MD' => [], // Moldova
    'ME' => [], // Montenegro
    'MF' => [], // Saint Martin (French part)
    'MG' => [], // Madagascar
    'MH' => [], // Marshall Islands
    'MK' => [], // Macedonia
    'ML' => [], // Mali
    'MM' => [], // Myanmar
    'MN' => [], // Mongolia
    'MO' => [], // Macau
    'MP' => [], // Northern Mariana Islands
    'MQ' => [], // Martinique
    'MR' => [], // Mauritania
    'MS' => [], // Montserrat
    'MT' => [], // Malta
    'MU' => [], // Mauritius
    'MV' => [], // Maldives
    'MW' => [], // Malawi
    'MX' => [], // Mexico
    'MY' => [], // Malaysia
    'MZ' => [], // Mozambique
    'NA' => [], // Namibia
    'NC' => [], // New Caledonia
    'NE' => [], // Niger
    'NF' => [], // Norfolk Island
    'NG' => [], // Nigeria
    'NI' => [], // Nicaragua
    'NL' => [], // Netherlands
    'NO' => [], // Norway
    'NP' => [], // Nepal
    'NR' => [], // Nauru
    'NU' => [], // Niue
    'NZ' => [], // New Zealand
    'OM' => [], // Oman
    'PA' => [], // Panama
    'PE' => [], // Peru
    'PF' => [], // French Polynesia
    'PG' => [], // Papua New Guinea
    'PH' => [], // Philippines
    'PK' => [], // Pakistan
    'PL' => [], // Poland
    'PM' => [], // Saint Pierre and Miquelon
    'PN' => [], // Pitcairn Islands
    'PR' => [], // Puerto Rico
    'PS' => [], // State of Palestine
    'PT' => [], // Portugal
    'PW' => [], // Palau
    'PY' => [], // Paraguay
    'QA' => [], // Qatar
    'RE' => [], // Réunion
    'RO' => [], // Romania
    'RS' => [], // Serbia
    'RU' => [], // Russia
    'RW' => [], // Rwanda
    'SA' => [], // Saudi Arabia
    'SB' => [], // Solomon Islands
    'SC' => [], // Seychelles
    'SD' => [], // Sudan
    'SE' => [], // Sweden
    'SG' => [], // Singapore
    'SH' => [], // Saint Helena, Ascension and Tristan da Cunha
    'SI' => [], // Slovenia
    'SJ' => [], // Svalbard and Jan Mayen
    'SK' => [], // Slovakia
    'SL' => [], // Sierra Leone
    'SM' => [], // San Marino
    'SN' => [], // Senegal
    'SO' => [], // Somalia
    'SR' => [], // Suriname
    'SS' => [], // South Sudan
    'ST' => [], // São Tomé and Príncipe
    'SV' => [], // El Salvador
    'SX' => [], // Sint Maarten
    'SY' => [], // Syria
    'SZ' => [], // Eswatini
    'TC' => [], // Turks and Caicos Islands
    'TD' => [], // Chad
    'TF' => [], // French Southern Territories
    'TG' => [], // Togo
    'TH' => [], // Thailand
    'TJ' => [], // Tajikistan
    'TK' => [], // Tokelau
    'TL' => [], // East Timor / Timor-Leste
    'TM' => [], // Turkmenistan
    'TN' => [], // Tunisia
    'TO' => [], // Tonga
    'TR' => [], // Turkey
    'TT' => [], // Trinidad and Tobago
    'TV' => [], // Tuvalu
    'TW' => [], // Taiwan
    'TZ' => [], // Tanzania
    'UA' => [], // Ukraine
    'UG' => [], // Uganda
    'UM' => [
        '/\(?\b([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\b/',
        '($1) $2-$3'
    ], // United States Minor Outlying Islands
    'US' => [
        '/\(?\b([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\b/',
        '($1) $2-$3'
    ], // United States of America
    'UY' => [], // Uruguay
    'UZ' => [], // Uzbekistan
    'VA' => [], // Vatican City / Holy See
    'VC' => [], // Saint Vincent and the Grenadines
    'VE' => [], // Venezuela
    'VG' => [], // British Virgin Islands
    'VI' => [], // United States Virgin Islands
    'VN' => [], // Vietnam
    'VU' => [], // Vanuatu
    'WF' => [], // Wallis and Futuna
    'WS' => [], // Samoa
    'YE' => [], // Yemen
    'YT' => [], // Mayotte
    'ZA' => [], // South Africa
    'ZM' => [], // Zambia
    'ZW' => [], // Zimbabwe
];

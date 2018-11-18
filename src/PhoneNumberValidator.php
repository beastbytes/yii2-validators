<?php
/**
 * PhoneNumberValidator Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2018 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 */

namespace BeastBytes\Validators;

use Yii;
use yii\base\InvalidConfigException;

/**
 * PhoneNumberValidator class.
 * Validates phone numbers.
 * Validation can be against {@link http://www.faqs.org/rfcs/rfc3733.html RFC 3733 - Extensible Provisioning Protocol (EPP) Contact Mapping} format (see section 2.5), {@link http://www.itu.int/rec/T-REC-E.123 ITU-T Recommendation E.123 (“Notation for national and i11l telephone numbers, e-mail addresses and Web addresses”)} format, or a custom format defined in {@link $i11lPattern}.
 * International numbers may also be converted to EPP format if required.
 * Validation can also be against one or many national number formats; the first match makes a number valid.
 * National numbers may be converted to a standard format if required; this is specified by country.
 * Validation for international and national numbers are independent, so you can allow only international numbers,
 * only national numbers, or both.
 */
class PhoneNumberValidator extends I11lValidator
{
    /**
     * @var string|string[] a country or list of countries whose national format to match against in $n6lpatterns.
     * If empty, phone numbers must match the specified international format.
     * @see $i11l
     * @see $n6lpatterns
     */
    public $countries;
    /**
     * @var string Regex pattern used to match phone numbers in EPP format
     */
    public $eppPattern = '/^\+[0-9]{1,3}\.[0-9]{4,14}(?:x.+)?$/';
    /**
     * @var mixed If boolean false, international format numbers are not permitted
     * If the case insensitive string "EPP", international numbers must be in EPP format.
     * If the case insensitive string "ITU", international numbers must be in the ITU-T Recommendation E.123 format
     * (i.e. groups of numbers). The separator may be a space, dot, or dash. The minimum grouping is
     * <country code><separator><national significant number>.
     * Further grouping of the national significant number is supported, e.g. +44 1234 567 890
     * If boolean TRUE, international numbers may be in EPP or ITU-T Recommendation E.123 format.
     * @see $countries
     */
    public $i11l = true;
    /**
     * @var string Regex pattern used to match phone numbers in ITU format
     */
    public $ituPattern = '/^\+[0-9]{1,3}[-. ]([0-9]{2,6}([-. ])?){1,4}(?:(x|#).+)?$/';
    /**
     * @var string A custom regex used to match international phone numbers if not using EPP or ITU formats.
     * The extension part (if used) must start with a letter or #
     */
    public $i11lPattern;
    /**
     * @var integer Maximum length of international phone numbers
     */
    public $maxI11l = 15;
    /**
     * @var mixed An array of national specific regexes indexed by country, or a string that is the path alias of a PHP
     * script file that returns such an array.
     * If null the n6lPatterns file in the current directory is used; this is indexed by
     * {@link http://en.wikipedia.org/wiki/ISO_3166-1#Current_codes ISO 3166-1 alpha-2 country codes}
     * A country pattern can be a string or an array. A string specifies the pattern to match. If an array,
     * the first element is the pattern to match, the second is the replacement pattern.
     * @see $countries
     */
    public $n6lPatterns;
    /**
     * @var string Regex pattern used to remove the extension from phone numbers
     */
    public $removeExtPattern = '/^(.+?)([a-zA-Z#].+)?$/';
    /**
     * @var boolean Whether to convert international numbers to EPP format
     */
    public $toEpp = false;
    /**
     * @var string Regex pattern used in converting phone numbers to EPP format
     */
    public $toEppPattern = '/^(\+\d{1,3})\D+((\d+[\s\.-]*)+)([\D]+(\d+))?/';

    /**
     * @inheritdoc
     * @throws InvalidConfigException If international format or countries are not specified
     * @throws InvalidConfigException If national regex patterns not valid
     * @throws InvalidConfigException If a country is not specified in national regex patterns
     */
    public function init()
    {
        if (empty($this->i11l) && empty($this->countries)) {
            throw new InvalidConfigException( 'An international format and/or countries must be specified');
        }

        parent::init();
    }

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param \yii\base\Model $model the object being validated
     * @param string $attribute the attribute being validated
     * @throws InvalidConfigException If national regex patterns not valid
     */
    public function validateAttribute($model, $attribute)
    {
        if ($this->skipOnEmpty && $this->isEmpty($model->$attribute)) {
            return;
        }

        $match = ($this->i11l !== false
            ? $this->isI11l($model, $attribute)
            : false
        );

        if (!$match) {
            $match = (!empty($this->countries)
                ? $this->isN6l($model, $attribute)
                : false
            );
        }

        if (!$match) {
            $message = ($this->message !== null
                ? $this->message
                : Yii::t('phonenumbervalidator', '"{attribute}" is not a valid phone number.', compact('attribute')));
            $this->addError($model, $attribute, $message);
        }
    }

    /**
     * Indicates whether the attribute value is an internationally formatted phone number
     * @param \yii\base\Model $model the object being validated
     * @param string $attribute the attribute being validated
     * @return boolean TRUE if the attribute value is an internationally formatted phone number, FALSE if not
     */
    protected function isI11l($model, $attribute)
    {
        $value = $model->$attribute;

        if ($this->i11l === true) {
            $pattern = substr($this->eppPattern, 0, -1) . '|' . substr($this->ituPattern, 1);
        } elseif (is_string($this->i11l)) {
            switch (strtolower($this->i11l)) {
                case 'epp':
                    $pattern = $this->eppPattern;
                    break;
                case 'itu':
                    $pattern = $this->ituPattern;
                    break;
            }
        } else {
            $pattern = $this->i11lPattern;
        }

        if (!preg_match($pattern, $value)) {
            return false;
        }

        /*
         * Make sure the number is not too long. ITU-T Recommendation E.164 specifies that the maximum length for the
         * country code and national significant number is 15 digits (excludes any extension)
         */

        // remove any extension part
        $number = preg_replace($this->removeExtPattern, '$1', $value);
        // removes non-digit characters
        $number = preg_replace('/\d/', '$1', $number);

        // check the resulting number is not over the maximum length
        if (strlen($number) > $this->maxI11l) {
            return false;
        }

        if ($this->toEpp && strtolower($this->i11l) !== 'epp') {
            $matches = [];
            preg_match($this->toEppPattern, $value, $matches);

            // $matches[1] => country code
            // $matches[2] => national significant number potentially containing non-digits (e.g. white space)
            // $matches[5] => extension - if given
            $model->$attribute = $matches[1] . '.' . preg_replace('/(\D)/', '', $matches[2]) .
            (isset($matches[5]) ? 'x' . $matches[5] : '');
        }

        return true;
    }

    /**
     * Indicates if the attribute value is a phone number in a national format that matches one of the specified
     * countries.
     * If the attribute matches a national pattern specified as an array, it is updated according to the replacement
     * given in the definition
     * @param \yii\base\Model $model the object being validated
     * @param string $attribute the attribute being validated
     * @return boolean TRUE if the attribute value is a phone number in a national format that matches one of the
     * specified countries, FALSE if not
     */
    protected function isN6l($model, $attribute)
    {
        $value = $model->$attribute;

        foreach ($this->countries as $country) {
            if (is_string($this->n6lPatterns[$country]) && preg_match($this->n6lPatterns[$country], $value)) {
                return true;
            }

            if (is_array($this->n6lPatterns[$country]) && preg_match($this->n6lPatterns[$country][0], $value)) {
                $model->$attribute = trim(
                    preg_replace($this->n6lPatterns[$country][0], $this->n6lPatterns[$country][1], $value)
                );
                return true;
            }
        }
        return false;
    }
}

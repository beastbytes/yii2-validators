<?php
/**
 * I18lValidator Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2018 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 */

namespace BeastBytes\Validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

/**
 * I18lValidator class.
 * Base class for validators that validate international values that vary by nationality, e.g. phone numbers,
 * postal codes, etc.
 */
class I11lValidator extends Validator
{
    /**
     * @var string|string[] a country or list of countries whose national format to match against in $n6lpatterns.
     * @see $n6lpatterns
     */
    public $countries;
    /**
     * @var mixed An array of national specific regexes indexed by country or a string that is the path alias of a PHP
     * script file that returns such an array.
     * If null the associated file in the n6lPatterns directory is used; this is indexed by
     * {@link http://en.wikipedia.org/wiki/ISO_3166-1#Current_codes ISO 3166-1 alpha-2 country codes}. The associated
     * file is named according to the validator class, e.g. if the validator class is PhoneNumberValidator the
     * associated file is phoneNumber.php
     * @see $countries
     */
    public $n6lPatterns;

    /**
     * @inheritdoc
     * @throws InvalidConfigException If national regex patterns not valid
     * @throws InvalidConfigException If a country is not specified in national regex patterns
     */
    public function init()
    {
        if (is_string($this->countries)) {
            $this->countries = (array) $this->countries;
        }

        if (is_array($this->countries) && sizeof($this->countries) > 0) {
            if ($this->n6lPatterns === null) {

                $this->n6lPatterns = require(__DIR__ . DIRECTORY_SEPARATOR . 'n6lpatterns' . DIRECTORY_SEPARATOR . lcfirst(substr(get_class($this), 22, -9)) . '.php');
            } elseif (is_string($this->n6lPatterns)) {
                $this->n6lPatterns = require(Yii::getAlias($this->n6lPatterns) . '.php');
            } elseif (!is_array($this->n6lPatterns)) {
                throw new InvalidConfigException('Invalid national patterns definition');
            }

            foreach ($this->countries as $country) {
                if (!array_key_exists($country, $this->n6lPatterns)) {
                    throw new InvalidConfigException("Country \"$country\" not specified in \"n6lPatterns\"");
                }
            }
        }

        parent::init();
    }
}

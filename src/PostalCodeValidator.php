<?php
/**
 * PostalCodeValidator Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2018 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 */

namespace BeastBytes\Validators;

use Yii;

/**
 * PostalCodeValidator class.
 */
class PostalCodeValidator extends I11lValidator
{
    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param \yii\base\Model $model the object being validated
     * @param string $attribute the attribute being validated
     */
    public function validateAttribute($model, $attribute)
    {
        if ($this->skipOnEmpty && $this->isEmpty($model->$attribute)) {
            return;
        }

        $value = $model->$attribute;
        foreach ($this->countries as $country) {
            if (preg_match($this->n6lPatterns[trim($country)], $value)) {
                return;
            }
        }

        $message = ($this->message !== null
            ? $this->message
            : Yii::t('postalcodevalidator', '{attribute} is not a valid postal code.')
        );
        $this->addError($model, $attribute, $message);
    }
}

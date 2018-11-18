<?php

namespace BeastBytes\Validators\Tests\unit;

use yii\base\InvalidConfigException;
use BeastBytes\Validators\PhoneNumberValidator;

class PhoneNumberTest extends \Codeception\Test\Unit
{
    const ATTRIBUTE = 'attribute';
    const COUNTRIES_ATTRIBUTE = 'countries';
    const BAD_COUNTRIES = ['GBR']; // ISO 3166-1 alpha-3 country codes
    const GOOD_COUNTRIES = ['GB']; // ISO 3166-1 alpha-2 country codes
    const BAD_PHONE_NUMBER = '777777777777777777777777777777';
    const GOOD_PHONE_NUMBER = '01234 567890';

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testBadCountries()
    {
        $this->expectException(InvalidConfigException::class);
        $validator = new PhoneNumberValidator([
            self::COUNTRIES_ATTRIBUTE => self::BAD_COUNTRIES
        ]);
    }

    public function testBadPhoneNumber()
    {
        $validator = new PhoneNumberValidator([
            self::COUNTRIES_ATTRIBUTE => self::GOOD_COUNTRIES
        ]);
        $model = new Model([self::ATTRIBUTE => self::BAD_PHONE_NUMBER]);
        $validator->validateAttribute($model,self::ATTRIBUTE);
        $this->assertNotEmpty($model->errors);
    }

    public function testGoodPhoneNumber()
    {
        $validator = new PhoneNumberValidator([
            self::COUNTRIES_ATTRIBUTE => self::GOOD_COUNTRIES
        ]);
        $model = new Model([self::ATTRIBUTE => self::GOOD_PHONE_NUMBER]);
        $validator->validateAttribute($model,self::ATTRIBUTE);
        $this->assertEmpty($model->errors);
    }
}

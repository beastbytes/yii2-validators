<?php

namespace BeastBytes\Validators\Tests\unit;

use yii\base\InvalidConfigException;
use BeastBytes\Validators\PostalCodeValidator;

class PostalCodeTest extends \Codeception\Test\Unit
{
    const ATTRIBUTE = 'attribute';
    const COUNTRIES_ATTRIBUTE = 'countries';
    const BAD_COUNTRIES = ['GBR']; // ISO 3166-1 alpha-3 country codes
    const GOOD_COUNTRIES = ['GB']; // ISO 3166-1 alpha-2 country codes
    const BAD_POSTALCODE = 'NNNN 7JN';
    const GOOD_POSTALCODE = 'NN12 7JN';

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
        $validator = new PostalCodeValidator([
            self::COUNTRIES_ATTRIBUTE => self::BAD_COUNTRIES
        ]);
    }

    public function testBadPostalCode()
    {
        echo getcwd();
        $validator = new PostalCodeValidator([
            self::COUNTRIES_ATTRIBUTE => self::GOOD_COUNTRIES
        ]);
        $model = new Model([self::ATTRIBUTE => self::BAD_POSTALCODE]);
        $validator->validateAttribute($model,self::ATTRIBUTE);
        $this->assertNotEmpty($model->errors);
    }

    public function testGoodPostalCode()
    {
        $validator = new PostalCodeValidator([
            self::COUNTRIES_ATTRIBUTE => self::GOOD_COUNTRIES
        ]);
        $model = new Model([self::ATTRIBUTE => self::GOOD_POSTALCODE]);
        $validator->validateAttribute($model,self::ATTRIBUTE);
        $this->assertEmpty($model->errors);
    }
}

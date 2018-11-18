<?php
return [
    'id'         => 'bb-vt',
    'name'       => 'validator-test',
    'basePath'   => YII_BASE_PATH,
    'vendorPath' => VENDOR_PATH,
    'components' => [
        'i18n'       => [
            'translations' => [
                'phonenumbervalidator' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@vendor/beastbytes/validators/messages',
                    'sourceLanguage' => 'en-GB'
                ],
                'postalcodevalidator' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@vendor/beastbytes/validators/messages',
                    'sourceLanguage' => 'en-GB'
                ]
            ]
        ]
    ]
];
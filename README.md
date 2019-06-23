# Yii2 Pwned validator

A Yii2 password validator against the [Pwned passwords database][pwned-db].


> Pwned Passwords are more than half a billion real world passwords previously 
> exposed in data breaches. This exposure makes them unsuitable for ongoing use 
> as they're at much greater risk of being used to take over other accounts.

## Requirements

- Yii framework 2
- PHP `mbstring` (multibyte string) extension (required)


## Installation

The preferred way to install this extension is through [Composer](https://getcomposer.org).

To install, either run

```
$ composer require nstcactus/yii2-pwned-validator
```

or add

```
"nstcactus/yii2-pwned-validator": "*"
```

to the `require` section of your `composer.json` file.


## Usage

Model class example:

```php
<?php

namespace app\models;

use nstCactus\yii2\validators\PwnedValidator;
use Yii;
use yii\base\Model;

class YourCustomModel extends Model
{
    public function rules()
    {
        return [
            ['newPassword', PwnedValidator::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'New password'),
        ];
    }
}
```

This validator will fail to validate passwords that have been exposed in 
known security breaches.


## Like it?

Send some love to [Troy Hunt](https://www.troyhunt.com/), the author of [Have I been pwned?][hibp].

[hibp]:     https://haveibeenpwned.com
[pwned-db]: https://haveibeenpwned.com/Passwords

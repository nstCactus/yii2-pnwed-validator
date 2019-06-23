<?php
/**
 * @author nstCactus<nstCactus@gmail.com>
 * @date   2019-06-23 22:35
 */

namespace nstCactus\yii2\validators;

use yii\validators\Validator;

class PwnedValidator extends Validator
{
    public $message = 'This password has been exposed in know security breaches. Please choose another one.';

    protected function validateValue($value)
    {
        if ($this->hasBeenPwned($value)) {
            return [$this->message, [ 'value' => $value ]];
        }

        return null;
    }

    protected function hasBeenPwned($password)
    {
        $hash = $hash = sha1($password);
        $prefix = mb_substr($hash, 0, 5);
        $suffix = mb_substr($hash, 5);

        $response = file_get_contents("https://api.pwnedpasswords.com/range/{$prefix}");
        $pwnedPasswordEntries = explode("\r\n", trim($response));
        foreach ($pwnedPasswordEntries as $pwnedPasswordEntry) {
            if (mb_stripos($pwnedPasswordEntry, $suffix) === 0) {
                return true;
            }
        }

        return false;
    }
}

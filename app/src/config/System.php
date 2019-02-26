<?php
namespace App\Config;

use App\Business\PhoneValidator;
use App\Business\PhoneValidations\CameroonPhoneValidationRule;
use App\Business\PhoneValidations\EthiopiaPhoneValidationRule;
use App\Business\PhoneValidations\MoroccoPhoneValidationRule;
use App\Business\PhoneValidations\MozambiquePhoneValidationRule;
use App\Business\PhoneValidations\UgandaPhoneValidationRule;

class System {
	public function boot()	{
		PhoneValidator::registerRule(new CameroonPhoneValidationRule);
		PhoneValidator::registerRule(new EthiopiaPhoneValidationRule);
		PhoneValidator::registerRule(new MoroccoPhoneValidationRule);
		PhoneValidator::registerRule(new MozambiquePhoneValidationRule);
		PhoneValidator::registerRule(new UgandaPhoneValidationRule);
	}
}
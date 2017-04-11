<?php

namespace Battleships\Validator;

use Battleships\Model\State;

class StateInputValidator implements ValidatorInterface {

	const INVALID_INPUT_GIVEN = "The given input is not a valid option.";

	private $errorMsg;

	public function isValid($input) {
		if (!is_string($input)) {
			$this->errorMsg = self::INVALID_INPUT_GIVEN;
			return false;
		}

		if (strlen($input) !== 2) {
			$this->errorMsg = self::INVALID_INPUT_GIVEN;
			return false;
		}

		if (!ctype_upper(substr($input, 0, 1))) {
			$this->errorMsg = self::INVALID_INPUT_GIVEN;
			return false;
		}

		if (!ctype_digit(substr($input, 1, 2))) {
			$this->errorMsg = self::INVALID_INPUT_GIVEN;
			return false;
		}

		return true;
	}

	/**
	 * @return string|null
	 */
	public function getErrorMessage() {
		return $this->errorMsg;
	}
}
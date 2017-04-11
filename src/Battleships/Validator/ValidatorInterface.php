<?php

namespace Battleships\Validator;


use Battleships\Model\State;

interface ValidatorInterface {

	/**
	 * Returns true if and only if $value meets the validation requirements.
	 *
	 * If $value fails validation, then this method returns false, and
	 * getErrorMessage() will return an array of messages that explain why the
	 * validation failed.
	 *
	 * @param  mixed $value
	 * @return bool
	 */
	public function isValid($value);

	/**
	 * @return string
	 */
	public function getErrorMessage();
}
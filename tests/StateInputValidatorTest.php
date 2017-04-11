<?php


use Battleships\Validator\StateInputValidator;
use PHPUnit\Framework\TestCase;

class StateInputValidatorTest extends TestCase {

	public function setUp()
	{
		$this->validator = new StateInputValidator();
	}

	public function testValidatorWillReturnFalseWithLettersOnly() {
		$this->assertEquals(false, $this->validator->isValid("AA"));
	}

	public function testValidatorWillReturnFalseWithLongerInput() {
		$this->assertEquals(false, $this->validator->isValid("A44"));
	}

	public function testValidatorWillReturnFalseWithLowercaseInput() {
		$this->assertEquals(false, $this->validator->isValid("c3"));
	}

	public function testValidatorWillReturnTrueWithExpectedInput() {
		$this->assertEquals(true, $this->validator->isValid("D4"));
	}
}
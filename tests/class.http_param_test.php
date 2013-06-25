<?php
include '../php-lib/class.http_param.php';

class HttpParamTest extends PHPUnit_Framework_TestCase {

	public function testReadGetParameter() {
		$this->cleanup();
		$_GET['foo'] = 'barGet';
		$actual = HttpParam::asString('foo');
		$this->assertTrue('barGet' == $actual);
	}

	public function testReadPostParameter() {
		$this->cleanup();
		$_POST['foo'] = 'bar';
		$actual = HttpParam::asString('foo');
		$this->assertTrue('bar' == $actual);
	}

	public function testReadGetInvalidIntParameter() {
		$this->cleanup();
		$_GET['num'] = 'DROP DATABASE';
		$actual = HttpParam::asInt('num');
		$this->assertTrue(NULL == $actual);
	}

	public function testReadGetIntParameter() {
		$this->cleanup();
		$_GET['num'] = 4;
		$actual = HttpParam::asInt('num');
		$this->assertTrue(4 == $actual);
	}

	public function testReadGetParameterBeforePost() {
		$this->cleanup();
		$_GET['foo'] = 'barGet';
		$_POST['foo'] = 'barPost';
		$actual = HttpParam::asString('foo');
		$this->assertTrue('barGet' == $actual);
	}
	
	private function cleanup() {
		$val = 1;
		while($val) { $val = array_pop($_GET); };
		$val = 1;
		while($val) { $val = array_pop($_POST); };
	}

}
?>

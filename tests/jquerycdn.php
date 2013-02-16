<?php
/**
 * Package Jquerycdn tests
 *
 * @group JquerycdnPackage
 */
class Test_Jquerycdn extends TestCase
{
	protected $check;
	protected $fallback;
	protected $orignal_ver;
    public function setup()
    {
		$this->original_ver = \Config::get('jquerycdn.version');
		\Config::set('jquerycdn.version','1.7.2');
		$this->check = new ReflectionMethod('Jquerycdn', 'validate_version');
		$this->check->setAccessible(true);
		$this->script = new ReflectionMethod('Jquerycdn', 'addscript');
		$this->script->setAccessible(true);
    }
    
    public function success()
	{
		return array(
			array('1.7'),
			array('1.7.2'),
			array('2'),
			array('2.0'),
		);
	}
    /**
     * @dataProvider success
     */
    public function test_check_version_success($data)
    {
		$output = $this->check->invoke(new Jquerycdn(), $data);
        $this->asserttrue($output);
    }

    public function failure()
	{
		return array(
			array('1..7'),
			array("1.7\n"),
			array('2. 0 '),
		);
	}
    /**
     * @dataProvider failure
     */
    public function test_check_version_fail($data)
    {
		$output = $this->check->invoke(new Jquerycdn(), $data);
        $this->assertfalse($output);
    }

    public function testGetCdngoogle()
    {
		$expected = '	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
';
		$output = Jquerycdn::getcdn('google');
        $this->assertEquals($expected, $output);
    }
    public function testAddscript()
    {
		$expected = "<script>window.jQuery || document.write('http://127.0.0.1/js/jquery-1.7.2.min.js')</script>";
		$output = $this->script->invoke(new Jquerycdn(), 'http://127.0.0.1/js/jquery-1.7.2.min.js');
        $this->assertEquals($expected, $output);
    }

	public function teardown()
	{
		\Config::set('jquerycdn.version',$this->original_ver);
	}
}

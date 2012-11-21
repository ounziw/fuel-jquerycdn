<?php
/**
 * Package Jquerycdn tests
 *
 * @group Package
 */
class Test_Jquerycdn extends TestCase
{
	protected $check;
	protected $fallback;
	// todo
    public function setup()
    {
		\Config::set('jquerycdn.version','1.7.2');
		$this->check = new ReflectionMethod('Jquerycdn', 'validate_version');
		$this->check->setAccessible(true);
		$this->script = new ReflectionMethod('Jquerycdn', 'addscript');
		$this->script->setAccessible(true);
    }
    
    public function test_check_version_success()
    {
		$output = $this->check->invoke(new Jquerycdn(), '1.7.2');
        $this->asserttrue($output);
    }

    public function test_check_version_fail()
    {
		$output = $this->check->invoke(new Jquerycdn(), '0.7.2');
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

}

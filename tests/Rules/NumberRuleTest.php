<?php

final class NumberRuleTest extends PHPUnit_Framework_TestCase
{
    public function testCannotUseString()
    {
        $params = array(
            'age' => '111abcd'
        );
        $rules = array(
            'age' => array(
                'type' => 'number'
            )
        );

        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }

    public function testCanUseInteger()
    {
        $params = array('age' => 55);
        $rules = array(
            'age' => array(
                'type' => 'number'
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);
    }

    public function testCanUseFloat()
    {
        $params = array('age' => 12.04);
        $rules = array(
            'age' => array(
                'type' => 'number'
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);
    }

    /**
     * 测试可以使用负数
     * @throws \Crazymus\PvalidateException
     */
    public function testCanUseNagtiveNumber()
    {
        $params = array('age' => -10);
        $rules = array(
            'age' => array(
                'type' => 'number'
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);

        $params = array('age' => -10.2);
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);
    }

    public function testOperator()
    {
        $params = array( 'age' => 10);
        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => 10,
            )
        );

        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);

        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array('>', 9),
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);


        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array('>=', 10),
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);


        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array('<', 11),
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);

        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array('<=', 10),
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);

        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array(
                    array('>', 9),
                    array('<', 11)
                ),
            )
        );
        $vParams = \Crazymus\Pvalidate::validate($params, $rules);
        $this->assertEquals($vParams['age'], $params['age']);
    }

    public function testOperatorNotPass()
    {
        $params = array( 'age' => 10);
        $rules = array(
            'age' => array(
                'type' => 'number',
                'value' => array('>', 11),
            )
        );

        $this->setExpectedException('\Crazymus\PvalidateException');
        \Crazymus\Pvalidate::validate($params, $rules);
    }
}
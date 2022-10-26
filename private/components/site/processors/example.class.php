<?php
/**
 * ExampleProcessor
 *
 * @package site
 * @subpackage processor
 */

class ExampleProcessor extends modProcessor
{
    public function process()
    {

        $this->modx->log(1, 'test');

        // Example:
        //
        // $response_array = array();
        //
        // $response_array['status'] = 'success';
        //
        // return json_encode($response_array);


        return;
    }
}

return 'ExampleProcessor';

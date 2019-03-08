<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 3/7/19
 * Time: 8:47 AM
 */

namespace App\Tools\Api;

use Illuminate\Http\Response;

class ApiOutputMaker
{

    private $_output = [];

    public function __construct()
    {
        $this->setStatus(Response::HTTP_OK);
        $this->setDescription(null);
    }

    /**
     * @param array $output
     */
    public function setOutput($output, $key = 'result')
    {
        $this->_output[$key] = $output;
        return $this;
    }

    public function getOutput()
    {
        return response()->json($this->_output, $this->_output['status']);
    }

    public function output()
    {
        return $this->getOutput();
    }

    public function setStatus($status)
    {
        $this->setOutput($status, 'status');
        return $this;
    }

    public function setDescription($description)
    {
        $this->setOutput($description, 'description');
        return $this;
    }

    public function setResult($result)
    {
        $this->setOutput($result, 'result');
        return $this;
    }
}

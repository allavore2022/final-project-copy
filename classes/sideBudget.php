<?php

class sideBudget {

    private $_amountToSetAside;
    private $_timeFrame;

    /**
     * sideBudget constructor.
     * @param $_amountToSetAside
     * @param $_timeFrame
     */
    public function __construct($_amountToSetAside, $_timeFrame)
    {
        $this->_amountToSetAside = $_amountToSetAside;
        $this->_timeFrame = $_timeFrame;
    }

    /**
     * @return mixed
     */
    public function getAmountToSetAside()
    {
        return $this->_amountToSetAside;
    }

    /**
     * @param mixed $amountToSetAside
     */
    public function setAmountToSetAside($amountToSetAside)
    {
        $this->_amountToSetAside = $amountToSetAside;
    }

    /**
     * @return mixed
     */
    public function getTimeFrame()
    {
        return $this->_timeFrame;
    }

    /**
     * @param mixed $timeFrame
     */
    public function setTimeFrame($timeFrame)
    {
        $this->_timeFrame = $timeFrame;
    }

}
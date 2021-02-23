<?php

class budget {

    private $_alottedAmount;
    private $_timeFrame;

    /**
     * budget constructor.
     * @param $_alottedAmount
     * @param $_timeFrame
     */
    public function __construct($_alottedAmount, $_timeFrame)
    {
        $this->_alottedAmount = $_alottedAmount;
        $this->_timeFrame = $_timeFrame;
    }

    /**
     * @return mixed
     */
    public function getAlottedAmount()
    {
        return $this->_alottedAmount;
    }

    /**
     * @param mixed $alottedAmount
     */
    public function setAlottedAmount($alottedAmount)
    {
        $this->_alottedAmount = $alottedAmount;
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
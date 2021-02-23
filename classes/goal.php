<?php

class goal {

    private $_startDate;
    private $_endDate;
    private $_preferredEndDate;

    /**
     * goal constructor.
     * @param $_startDate
     * @param $_endDate
     * @param $_preferredEndDate
     */
    public function __construct($_startDate, $_endDate, $_preferredEndDate)
    {
        $this->_startDate = $_startDate;
        $this->_endDate = $_endDate;
        $this->_preferredEndDate = $_preferredEndDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->_endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->_endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getPreferredEndDate()
    {
        return $this->_preferredEndDate;
    }

    /**
     * @param mixed $preferredEndDate
     */
    public function setPreferredEndDate($preferredEndDate)
    {
        $this->_preferredEndDate = $preferredEndDate;
    }


}
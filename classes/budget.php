<?php

class Budget
{

    private $_baseFunds;
    private $_description;
    private $_startDate;
    private $_endDate;
    private $_priority;


    /**
     * @return mixed
     */
    public function getBaseFunds()
    {
        return $this->_baseFunds;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->_endDate;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * @param mixed $baseFunds
     */
    public function setBaseFunds($baseFunds): void
    {
        $this->_baseFunds = $baseFunds;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->_description = $description;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->_startDate = $startDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->_endDate = $endDate;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority): void
    {
        $this->_priority = $priority;
    }
}
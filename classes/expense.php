<?php

class Expense {

    private $_price;
    private $_description;
    private $_priority;

    /**
     * expenses constructor.
     * @param $_price
     * @param $_description
     * @param $_priority
     */
    public function __construct($_price, $_description, $_priority)
    {
        $this->_price = $_price;
        $this->_description = $_description;
        $this->_priority = $_priority;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->_priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }


}
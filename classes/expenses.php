<?php

class expenses {

    private $_price;
    private $_description;

    /**
     * expenses constructor.
     * @param $_price
     * @param $_description
     */
    public function __construct($_price, $_description)
    {
        $this->_price = $_price;
        $this->_description = $_description;
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
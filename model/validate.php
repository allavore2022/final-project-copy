<?php

class Validate
{
    private $_dataLayer;

    /**
     * Validate constructor.
     * @param $_dataLayer
     */
    public function __construct()
    {
        $this->_dataLayer = new DataLayer();
    }

    /**
     * @param $baseFunds
     * @return bool
     */
    public function baseFundsValidation($baseFunds) {
        return !empty($baseFunds);
    }

    /**
     * @param $startDate
     * @return bool
     */
    public function dateValidDateStart($startDate) {
        return strlen($startDate) == 8 && !empty($startDate);
    }

    /**
     * @param $endDate
     * @return bool
     */
    public function dateValidDateEnd($endDate) {
        return strlen($endDate) == 8 && !empty($endDate);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return bool
     */
    public function validDates($startDate, $endDate) {
        return $startDate > $endDate;
    }

    /**
     * @param $priority
     * @return bool
     */
    public function validPriority($priority) {
        return isset($priority);
    }

    /**
     * @param $checkSpoof
     * @return bool
     */
    function validPriorities($checkSpoof) {
        $validPriorities = $this->_dataLayer->getPriorities();

        if (in_array($checkSpoof, $validPriorities)) {
            return false;
        }
        return true;
    }
}
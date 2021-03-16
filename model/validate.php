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
        $this->_dataLayer = new DataLayer($dbh);
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

    //-------Registration Page Validation
    function validUsername($username)
    {
        return !empty($username) && strlen($username) > 3;
    }

    /**
     * validAEmail checks to see that an email address is valid
     * REQUIRED
     * #param String $email
     * @return boolean
     */
    function validEmail($email)
    {
        return !empty($email) && preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email);
    }

    function validPassword($password)
    {
        return !empty($password) && strlen($password) > 5;
    }

    function passwordConfirmation($password, $confirm)
    {
        return $password === $confirm;
    }

    /**
     * validName checks to see that  string is all
     * alphabetic
     * REQUIRED
     * #param String $name
     * @return boolean
     */
    function validFname($fname)
    {
        return !empty($fname) && ctype_alpha($fname);
    }

    function validLname($lname)
    {
        return !empty($lname) && ctype_alpha($lname);
    }



    function validStartingfunds($startingFunds)
    {
        return !empty($startingFunds) && $startingFunds > 0;
    }

    function validSituation($selectedSituation)
    {
        //get valid situations from data layer
        $validSituation = $this->_dataLayer->getSituation();

        //If the selected condiment is not in the valid list, return false
        if (!in_array($selectedSituation, $validSituation)) {
            return false;
        }

        //If we haven't false by now, we're good!
        return true;
    }
}
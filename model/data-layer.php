<?php

/* model/data-layer.php
 * returns data for my app
 *
 */

class DataLayer
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    function insertBudget($budget)
    {

        $sql = "INSERT INTO budget(baseFunds, description, startDate, endDate, priority)
                   VALUES (:baseFunds, :description, :startDate, :endDate, :priority)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(":baseFunds", $budget->getBaseFunds(), PDO::PARAM_INT);
        $statement->bindParam(":description", $budget->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(":startDate", $budget->getStartDate(), PDO::PARAM_STR);
        $statement->bindParam(":endDate", $budget->getEndDate(), PDO::PARAM_STR);
        $statement->bindParam(":priority", $budget->getPriority(), PDO::PARAM_STR);

        //execute
        $statement->execute();
    }

    function insertAccount($account)
    {
        $sql = "INSERT INTO account(userName, email, notification, fname, lname, gender, age, startingFunds, situation)
                   VALUES (:userName, :email, :notification, :fname, :lname, :gender, :age, :startingFunds, :situation)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(":userName", $account->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":email", $account->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(":notification", $account->getNotifications(), PDO::PARAM_BOOL);
        $statement->bindParam(":fname", $account->getFname(), PDO::PARAM_STR);
        $statement->bindParam(":lname", $account->getLname(), PDO::PARAM_STR);
        $statement->bindParam(":gender", $account->getGender(), PDO::PARAM_STR);
        $statement->bindParam(":age", $account->getAge(), PDO::PARAM_INT);
        $statement->bindParam(":startingFunds", $account->getStartingFunds(), PDO::PARAM_INT);
        $statement->bindParam(":situation", $account->getSituation(), PDO::PARAM_STR);

        //execute
        $statement->execute();
    }

    function getPriorities()
    {
        return array("high", "medium", "low");
    }

    function getSituation()
    {
        return array("Choose your situation", "education", "bills", "leisure", "other");
    }

    /** getGender() returns an array of gender options
     *  @return array
     */
    function getGender()
    {
        return array("male", "female");
    }

    function getNotification()
    {
        return array("yes", "no");
    }
}
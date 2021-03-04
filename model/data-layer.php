<?php

/* model/data-layer.php
 * returns data for my app
 *
 */

class DataLayer
{

    function getPriorities()
    {
        return array("high", "medium", "low");
    }

    function getSituation()
    {
        return array("education", "bills", "leisure", "other");
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


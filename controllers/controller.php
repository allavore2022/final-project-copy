<?php

class Controller
{
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Display a home view
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function login()
    {
        //Display a login view
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function register()
    {
        //Display a register view
        $view = new Template();
        echo $view->render('views/register.html');

    }

    function budget()
    {
        global $validator;
        global $budget;
        global $dataLayer;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $baseFunds = $_POST['baseFunds'];
            $description = $_POST['description'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $priority = $_POST['priority'];

            // baseFunds validation
            if (!$validator->baseFundsValidation($baseFunds)) {
                $this->_f3->set('errors["baseFunds"]', "Please provide a base fund");
            }

            //startDate validation
            if (!$validator->dateValidDateStart($startDate)) {
                $this->_f3->set('errors["startDate"]', "Please provide an start date");
            }

            //endDate validation
            if (!$validator->dateValidDateEnd($endDate)) {
                $this->_f3->set('errors["endDate"]', "Please provide an end date");
            }

            //startDate < endDate validation
            if ($validator->validDates($startDate, $endDate)) {
                $this->_f3->set('errors["endDate"]', "End date can't be before start date.");
            }

            //priority validation | spoof prevention
            if(isset($priority)) {
                if ($validator->validPriorities($priority)) {
                    $this->_f3->set('errors["prioritySpoof"]', "Spoof attempt, prevented.");
                }
            }

            //priority validation | empty
            if (!$validator->validPriority($priority)) {
                $this->_f3->set('errors["priorityEmpty"]', "Please choose priority level.");
            }

            //if no errors set in f3 hive, store variables in sessions and set in $budget class
            if (empty($this->_f3->get('errors'))) {

                //save data to object
                $budget->setBaseFunds($baseFunds);
                $budget->setStartDate($startDate);
                $budget->setEndDate($endDate);
                $budget->setPriority($priority);

                //save data to session
                $_SESSION['baseFunds'] = $baseFunds;
                $_SESSION['startDate'] = $startDate;
                $_SESSION['endDate'] = $endDate;
                $_SESSION['priority'] = $priority;

                echo "success";
                //$this->_f3->reroute('/summary');
            }

            //optional sticky data
            $budget->setDescription($description);

            //set priority choice in hive to check in html
            $this->_f3->set('priorityChoice', $priority);
        }

        //Sticky data
        $this->_f3->set('baseFunds', isset($baseFunds) ? $baseFunds : "");
        $this->_f3->set('description', isset($description) ? $description : "");
        $this->_f3->set('startDate', isset($startDate) ? $startDate : "");
        $this->_f3->set('endDate', isset($endDate) ? $endDate : "");
        $this->_f3->set('priority', isset($priority) ? $priority : "");
        $this->_f3->set('priorities', $dataLayer->getPriorities());

        //Display a view
        $view = new Template();
        echo $view->render('views/budget.html');
    }

    function budgetSummary()
    {
        //Display a view
        $_SESSION["budgetSummary"] = $_POST;
        $view = new Template();
        echo $view->render('views/budget-summary.html');
    }
}
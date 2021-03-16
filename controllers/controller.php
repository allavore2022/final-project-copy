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

        global $validator;
        global $dataLayer;

        $userNotification = "off";

        //get array
        $this->_f3->set('situations', $dataLayer->getSituation());
        $this->_f3->set('genders', $dataLayer->getGender());
        $this->_f3->set('notifications', $dataLayer->getNotification());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $userNotification = $_POST['notification'];
            $userFname = $_POST['fname'];
            $userLname = $_POST['lname'];
            $userGender = $_POST['gender'];
            $userAge = $_POST['age'];
            $userStartingfunds = $_POST['startingFunds'];
            $userSituation = $_POST['situation'];


            //validate username
            if(!$validator->validUsername($username)){
                $this->_f3->set('errors["username"]', "Please enter a username that is longer than 3 characters");
            }

            //validate email
            if(!$validator->validEmail($userEmail)){
                $this->_f3->set('errors["email"]', "Email must contain an @.");
            }

            //validate password
            if(!$validator->validPassword($userPassword)){
                $this->_f3->set('errors["password"]', "Password cannot be empty and has to be longer than 5 characters.");
            }

            //validate confirm password
            if(!$validator->passwordConfirmation($userPassword, $confirmPassword)){
                $this->_f3->set('errors["confirmPassword"]', "Passwords don't match.");
            }

            //spoof protection notification
            if (isset($userNotification)) {
                if ($userNotification != "on") {
                    $this->_f3->set('errors["notification"]', "Spoof prevented");
                }
            }

            //validate first name
            if(!$validator->validFname($userFname)) {
                $this->_f3->set('errors["fname"]', "Please enter a first name that only contains characters");
            }

            //validate last name
            if(!$validator->validLname($userLname)){
                $this->_f3->set('errors["lname"]', "Please enter a last name that only contains characters");
            }

            //validate starting funds
            if(!$validator->validStartingfunds($userStartingfunds)){
                $this->_f3->set('errors["startingFunds"]', "Starting funds cannot be empty and has to be more than 0.");
            }

            //validate situation | user must make choice
            if($userSituation == "Choose your situation"){
                $this->_f3->set('errors["situation"]', "Please pick a situation.");
            }

            //validate situation | spoof protection
            if(!$validator->validSituation($userSituation)){
                $this->_f3->set('errors["situation"]', "Spoof prevented.");
            }

            //validate gender | spoof protection
            if(isset($userGender)) {
                if($userGender != "male") {
                    if($userGender != "female"){
                        $this->_f3->set('errors["gender"]', "Spoof prevented.");
                    }
                }

                if($userGender != "female") {
                    if($userGender != "male"){
                        $this->_f3->set('errors["gender"]', "Spoof prevented.");
                    }
                }
            }

            //validate gender | spoof protection
            if(!isset($userGender)) {
                $this->_f3->set('errors["gender"]', "Please choose gender.");
            }

            //validate age
            if($userAge == ""){
                $this->_f3->set('errors["age"]', "Please enter age.");
            }

            //validate age
            if($userAge < 13){
                $this->_f3->set('errors["age"]', "You must at least 13 years of age.");
            }


            //if there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))){



                //instantiate budget with parameters
                $account = new Account($username, $userEmail, $userPassword, $userNotification, $userFname, $userLname, $userGender, $userAge, $userStartingfunds, $userSituation);

                print_r($account);

                $_SESSION['account'] = $account;
                $dataLayer->insertAccount($_SESSION['account']);

                echo "success";
            }
        }

        //make form sticky
        $this->_f3->set('username', isset($username) ? $username : "");
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('userPassword', isset($userPassword) ? $userPassword : "");
        $this->_f3->set('confirmPassword', isset($confirmPassword) ? $confirmPassword : "");
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('userNotification', isset($userNotification) ? $userNotification : "");
        $this->_f3->set('userFname', isset($userFname) ? $userFname : "");
        $this->_f3->set('userLname', isset($userLname) ? $userLname : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userStartingfunds', isset($userStartingfunds) ? $userStartingfunds : "");
        $this->_f3->set('userSituation', isset($userSituation) ? $userSituation : "");

        //Display a register view
        $view = new Template();
        echo $view->render('views/register.html');
    }

    function budget()
    {
        global $validator;
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


            echo $startDate;
            echo $endDate;

            //if no errors set in f3 hive, store variables in sessions and set in $budget class
            if (empty($this->_f3->get('errors'))) {

                $startDate =
                    substr((string)$startDate, 0, 4) . "-" .
                    substr((string)$startDate, 4, 2) . "-" .
                    substr((string)$startDate, 6, 2);

                $endDate =
                    substr((string)$endDate, 0, 4) . "-" .
                    substr((string)$endDate, 4, 2) . "-" .
                    substr((string)$endDate, 6, 2);

                //instantiate budget with parameters
                $budget = new Budget($baseFunds, $description, $startDate, $endDate, $priority);

                //save data to session
                $_SESSION['budget'] = $budget;
                $dataLayer->insertBudget($_SESSION['budget']);

                echo "success";
            }

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

        //clear session
        session_destroy();
    }
}
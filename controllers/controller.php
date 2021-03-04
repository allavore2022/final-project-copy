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

        //get array
        $this->_f3->set('situations', $dataLayer->getSituation());
        $this->_f3->set('genders', $dataLayer->getGender());
        $this->_f3->set('notifications', $dataLayer->getNotification());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            $userNotification = $_POST['notification'];
            $userFname = $_POST['fname'];
            $userLname = $_POST['lname'];
            $userGender = $_POST['gender'];
            $userAge = $_POST['age'];
            $userStartingfunds = $_POST['startingFunds'];
            $userSituation = $_POST['situation'];


            //instantiate a new person
            $person = new Person($username, $userEmail, $userPassword, $userNotification, $userFname, $userLname, $userGender, $userAge, $userStartingfunds, $userSituation);

            //validate username
            if($validator->validUsername($username)){
                //$_SESSION['fname'] = $userFname;
                $person->setUserName($username);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["username"]', "Please enter a username that is longer than 3 characters");
            }

            //validate email
            if($validator->validEmail($userEmail)){
//                $_SESSION['email'] = $userEmail;
                $person->setEmail($userEmail);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["email"]', "Email must contain an @.");
            }

            //validate password
            if($validator->validPassword($userPassword)){
//                $_SESSION['email'] = $userEmail;
                $person->setPassword($userPassword);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["password"]', "Password cannot be empty and has to be longer than 5 characters.");
            }

            //validate notification
            if(isset($userGender)){
                $person->setGender($userGender);
            }

            //validate first name
            if($validator->validFname($userFname)){
                //$_SESSION['fname'] = $userFname;
                $person->setFname($userFname);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["fname"]', "Please enter a first name that only contains characters");
            }

            //validate last name
            if($validator->validLname($userLname)){
                //$_SESSION['lname'] = $userLname;
                $person->setLname($userLname);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["lname"]', "Please enter a last name that only contains characters");
            }

            //validate gender
            if(isset($userGender)){
                //$_SESSION['gender'] = $userGender;
                $person->setGender($userGender);
            }

            //validate age
            if(isset($userAge)){
                //$_SESSION['gender'] = $userGender;
                $person->setAge($userAge);
            }

            //validate starting funds
            if($validator->validStartingfunds($userStartingfunds)){
                //$_SESSION['pnumber'] = $userPhone;
                $person->setStartingFunds($userStartingfunds);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["startingFunds"]', "Starting funds cannot be empty and has to be more than 0.");
            }

            //validate situation
            if($validator->validSituation($userSituation)){
                //$_SESSION['pnumber'] = $userPhone;
                $person->setSituation($userSituation);
            }
            //if data is not valid -> set an error in f3 hive
            else {
                $this->_f3->set('errors["situation"]', "Please pick a valid situation.");
            }

            //validate gender
            if(isset($userGender)){
                //$_SESSION['gender'] = $userGender;
                $person->setGender($userGender);
            }

            //if there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))){
                $_SESSION['person'] = $person;
                echo "success";
                //$this->_f3->reroute('/profile');
            }

        }

        //make form sticky
        $this->_f3->set('username', isset($username) ? $username : "");
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('userPassword', isset($userPassword) ? $userPassword : "");
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('userNotification', isset($userNotification) ? $userNotification : "");
        $this->_f3->set('userFname', isset($userFname) ? $userFname : "");
        $this->_f3->set('userLname', isset($userLname) ? $userLname : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userStartingfunds', isset($userStartingfunds) ? $userStartingfunds : "");
        //not sure how to make situation sticky????
        $this->_f3->set('userSituation', isset($userSituation) ? $userSituation : "");





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

        //clear session
        session_destroy();
    }
}
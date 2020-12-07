<?php
include_once 'account.php';
session_start();
    class User implements Account{
        // User Details
        private $userID;
        private $firstName;
        private $middleName;
        private $lastName;
        private $emailAddress;
        private $cityOfResidence;
        private $profilePicture;
        private $passKey;
        private $dateCreated;
        // Password Verification
        private $PasswordVerify;
        private $userSession_id;
        // Password Change
        private $newPassword;

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
            return $this;
        }

        public function getMiddleName()
        {
            return $this->middleName;
        }

        public function setMiddleName($middleName)
        {
            $this->middleName = $middleName;
            return $this;
        }
 
        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
            return $this;
        }

        public function getEmailAddress()
        {
            return $this->emailAddress;
        }

        public function setEmailAddress($emailAddress)
        {
            $this->emailAddress = $emailAddress;
            return $this;
        }

        public function getCityOfResidence()
        {
            return $this->cityOfResidence;
        }

        public function setCityOfResidence($cityOfResidence)
        {
            $this->cityOfResidence = $cityOfResidence;
            return $this;
        }

        public function getProfilePicture()
        {
            return $this->profilePicture;
        }

        public function setProfilePicture($profilePicture)
        {
            $this->profilePicture = $profilePicture;
            return $this;
        }

        public function getPassKey()
        {
            return $this->passKey;
        }

        public function setPassKey($passKey)
        {
            $this->passKey = $passKey;
            return $this;
        }

        public function getDateCreated()
        {
            return $this->dateCreated;
        }

        public function setDateCreated($dateCreated)
        {
            $this->dateCreated = $dateCreated;
            return $this;
        }

        public function getUserID()
        {
            return $this->userID;
        }

        public function setUserID($userID)
        {
            $this->userID = $userID;
            return $this;
        }
        
        public function getPasswordVerify()
        {
            return $this->PasswordVerify;
        }

        public function setPasswordVerify($PasswordVerify)
        {
            $this->PasswordVerify = $PasswordVerify;
            return $this;
        }
        
        public function getSession_id()
        {
            return $this->userSession_id;
        }

        public function setSession_id($userSession_id)
        {
            $this->userSession_id = $userSession_id;
            return $this;
        }

        public function getNewPassword()
        {
            return $this->newPassword;
        }

        public function setNewPassword($newPassword)
        {
            $this->newPassword = $newPassword;
            $this;
        }

        public function register($pdo){
            try {
                $stm = $pdo->prepare("INSERT INTO user_details(FirstName, MiddleName, LastName, Email_Address, City_Of_Residence, Profile_Picture, UserPassword, DateCreated) VALUES(?,?,?,?,?,?,?,?)");
                $stm->execute([$this->firstName, $this->middleName, $this->lastName, $this->emailAddress, $this->cityOfResidence, $this->profilePicture, $this->passKey, $this->dateCreated]);
                $stm = null;
                header("Location: index.php");
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        public function login($pdo){
            try{
                $record = $pdo->prepare("SELECT UserPassword FROM user_details WHERE Email_Address = ?");
                $record->execute([$this->emailAddress]);
                $gotten = $record->fetch();
                $this->PasswordVerify = $gotten['UserPassword'];

                if(password_verify($this->passKey, $this->PasswordVerify)){
                    // echo "true";
                
                    $stmt = $pdo->prepare("SELECT * FROM user_details WHERE Email_Address = ? AND UserPassword = ?");
                    $stmt->execute([$this->emailAddress, $this->PasswordVerify]);
                    $found = $stmt->fetch();

                    $this->userID = $found['iduser'];
                    $this->firstName = $found['FirstName'];
                    $this->middleName = $found['MiddleName'];
                    $this->lastName = $found['LastName']; 
                    $this->cityOfResidence = $found['City_Of_Residence'];
                    $this->profilePicture = $found['Profile_Picture'];
                    
                    $_SESSION['firstname'] = $this->firstName;
                    $this->userSession_id = session_id();
                    $stmp  = $pdo->prepare("INSERT INTO login_session(iduser, Firstname, emailAddress, Usersession_id)VALUES(?,?,?,?)");
                    $stmp->execute([$this->userID, $this->firstName, $this->emailAddress, $this->userSession_id]);
                    $stmp = null;
                    
                }else{
                    // echo "false";
                    // header("Location: index.php?login=credentials");
                }
       
            }catch(PDOException $e){
                return $e->getMessage();
            }


        }

        public function changePassword($pdo){
            try {
                $record = $pdo->prepare("SELECT UserPassword FROM user_details WHERE iduser = ?");
                $record->execute([$this->userID]);
                $gotten = $record->fetch();
                $this->PasswordVerify = $gotten['UserPassword'];

                if(password_verify($this->passKey, $this->PasswordVerify)){
                $stm = $pdo->prepare("UPDATE user_details SET UserPassword = ? WHERE iduser = ?");
                $stm->execute([$this->newPassword, $this->userID]);
                $stm= null;

                }else{
                    header("Location: passwordchange.php?oldpassword=false");
                }
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        public function logout($pdo){
            session_destroy();
        }

    }

?>
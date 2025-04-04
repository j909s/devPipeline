<?php

    class Order
    {
        private $OrderID;
        
        private $userID; 

        private $totalPrice;

        private $totalItems;


        private $payType;

        private $cardNum;

        private $postcode;

        private $date;

        private $orderVal;

        public function __construct($OrderID,$userID, $totalPrice,$totalItems, $payType, $cardNum,$postcode, $date,$orderVal)
        {
            $this->OrderID = $OrderID;
            $this->userID = $userID;
            $this->totalPrice = $totalPrice;
            $this->totalItems = $totalItems;
            $this->payType = $payType;
            $this->cardNum = $cardNum;
            $this->postcode = $postcode;
            $this->date = $date;
            $this->orderVal = $orderVal;
        }
        public function OrderID()
        {
            return $this->OrderID;
        }
        public function userID()
        {
            return $this->userID;
        }
        public function totalPrice()
        {
            return $this->totalPrice;
        }
        public function totalItems()
        {
            return $this->totalItems;
        }
        
        public function payType()
        {
            return $this->payType;
        }

        public function cardNum()
        {
            return $this->cardNum;
        }
        public function postcode()
        {
            return $this->postcode;
        }
        public function date()
        {
            return $this->date;
        }
        public function orderVal()
        {
            return $this->orderVal;
        }

        
    }

    class User
    {
        private $userID;

        private $email;

        private $username;

        private $password;

        public function __construct($userID,$email, $username, $password )
        {

            $this->userID = $userID;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;


        }
        public function userID()
        {
            return $this->userID;
        }
        public function email()
        {
            return $this->email;
        }

        public function username()
        {
            return $this->username;
        }
        public function password()
        {
            return $this->password;
        }
    }
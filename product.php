<?php

    class Product
    {
        private $productID;
        
        private $name; 

        private $image;

        private $price;
        private $description;

        public function __construct($productID, $name, $image, $price,$description)
        {
            $this->productID = $productID;
            $this->name = $name;
            $this->image = $image;
            $this->price = $price;
            $this->description = $description;
        }
        public function productID()
        {
            return $this->productID;
        }
        public function name()
        {
            return $this->name;
        }
        public function image()
        {
            return $this->image;
        }
        
        public function price()
        {
            return $this->price;
        }
        public function description()
        {
            return $this->description;
        }


        
    }
    
      
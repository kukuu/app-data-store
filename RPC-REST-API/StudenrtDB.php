<?php 
//Author: Alexander Adu-Sarkodie
// Application Type : Web Service: 

//create a class StudentDB with properties and method
	/**
	* 
	*/
	class StudentDB{
			# code...
		//create properties
		public $first_name = "";
		public $last_name = "";
		public $email = "";
		public $street = "";
		public $city = "";
		public $state = "";
		public $zip;
		public $phone = "";
		public $birth_date = "";
		public $sex = "";
		public $date_entered = "";
		public $lunch_cost = "";
		public $student_id = "";

		//create a constructor that will build all the objects properties.
		function __construct($first_name, $last_name, $email, $street, $state, $zip, $phone,
			$birth_date, $sex, $date_entered, $lunch_cost, $student_id){	
			// initialise all the objects created (object instantiation)
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->email = $email;
			$this->street = $street;
			$this->city = $city;
			$this->state = $state;
			$this->phone = $phone;
			$this->birth_date = $birth_date;
			$this->sex = $sex;
			$this->date_entered = $date_entered;
			$this->lunch_cost = $lunch_cost;
			$this->student_id = $student_id;
			
		}
	}

?>
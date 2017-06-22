<?php
//Author: Alexander Adu-Sarkodie
// Application Type : Web Service:  
// Use content-type headers to indicate who is receiving the application
	//header('content-type: application/json');
	//Comented the above statement as I am printing all to screen

	//Now we grab the StudentDB class 
	require_once('StudentDB');

	/**
	*  Decode the string and convert into a php array
	*/

	
	$json_data = json_decode('{"first_name": "Dale"}');

	/**
	* print to screen: check localhost://json_code.php
	*/
	
	var_dump($json_data);

	
	/**
	* Extend applications features by creating an Address class
	*/
	class Address{

		public $street = "";
		public $city = "";
		public $state = "";;
		
		function __construct($street, $city, $state){
			# code...
			$this->street = $street;
			$this->city = $city;
			$this->state = $state;

		}
	}

	/**
	* Extend applications features by creating a Student class to be modelled inside the address
	*/
	
	class  Student{
		public $first_name = "";
		public $last_name = "";
		public $age = "";
		public $enrolled = false;
		public $married = null;
		//since addresses can consists of multiple lines we model it
		//around a single object property -  Interface segreagation
		//create an instance of the address class above (line 75)
		public $address = "";
		//same as above. can have different types of phones 
		//create an array data for it in the constructor (line 77)
		public $phone;
		
		//create a constructor that will build all the objects properties
		function __construct($first_name, $last_name, $age,
			$enrolled, $married, $street, $city, $state, $ph_home, $ph_mobile){
			# code...

			//instantiate. Use interface segregation and sngle responsibility 
			//to write less code (Address and phone)
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->age = $age;
			$this->enrolled = $enrolled;
			$this->married = $married;
			//we instantiate the address property from the Address class above
			//write less lines of code
			$this->address = new Address($street, $city, $state);
			//encapsulat $phone into an array
			$this->phone = array('home' => $ph_home,
			'mobile'=>$ph_mobile );

		}
	}

	//Create student objects
	$luca_trinca = new Student("Luca", "Trinca", 30, true, null, 
		"123 Main St", "Seattle", "LN", "0207 541 234", "0786754332");

	echo "<br /><br />";

	//Now we can take this raw data and encode into  json data
	//pass the instantiated object as argumnet to json_encode method
	$lucatrinca_data = json_encode($luca_trinca)

	//Next step we can use real data from the database
	require_once("mysqli_connect.php");

	//we check if we have connection to the database
	//if we do not  then we expect the error handler to function
	if(mysqli_connect_error()){
		printf("Connect failed: %s\n",mysqli_connect_error());
		exit();
	}

	//otherwise we have a connection to the database. so we can send query
	//Querying for just the first 2 students
	$query = "select * from students where student_id IN (1,2)";

	//create an array to hold our data from the database
	$student_array = array();

	//we fetch result if there are from database
	if($result = $dbc->query($query)){
		//while we get results we will keep asking for 'more' from the database: 
		while($obj = $result->fetch_objec()) {
			# code...
			//Set up output template
			//print the headers (13 strings in our case)
			//and match them with the appropriate data
			printf("%s %s %s %s %s %s %s %s %s %s %s %s %s <br />",
				$obj->first_name, $obj->last_name, $obj->first_name, $obj->email, $obj->street, $obj->city, $obj->state, $obj->zip, $obj->phone, $obj->birth_date, $obj->sex, $obj->date_entered, $obj->lunch_cost, $obj->student_id);

			//we create a student object (instantiate student class)  which we convert into jason
			$temp_student = new StudentDB($obj->first_name, $obj->last_name, $obj->first_name, $obj->email, $obj->street, $obj->city, $obj->state, $obj->zip, $obj->phone, $obj->birth_date, $obj->sex, $obj->date_entered, $obj->lunch_cost, $obj->student_id);

			//store in an array
			$student_array[] = $temp_student;

		}

		//Now we unscrumble and output just the first 2 records from the student database
		
		echo "<br /><br />";

		//we use students as key
		echo '{"students": [';

		//first record
		$luca_data = json_encode($student_array[0]);
		echo $luca_data ;

		echo ',<br />';

		//second record
		$luca_data = json_encode($student_array[1]);
		echo $luca_data ;

		echo ']}';

		//close results from the loop
		$result->close();

		//close database
		$dbc->close();

	}
?>
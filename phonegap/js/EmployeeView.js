
//Author: Alexander Adu-Sarkodie

var EmployeeView = function() {

	//initialize the div element holding the data
	 this.initialize = function() {
	        
	        //Attach result to the div element
	        this.el = $('<div/>');

	        //register an event listener for the click event of the Add Location list item
	        this.el.on('click', '.add-location-btn', this.addLocation);

	        //we  register an event listener for the click event of the Add to Contacts list item:
	        this.el.on('click', '.add-contact-btn', this.addToContacts);
	  };
	 
	   this.initialize();

	   //render associated template
	   this.render = function() {
		    this.el.html(EmployeeView.template(employee));
		    return this;
		};

		// we add the ability to tag an employee with his/her location information. 
		// In this sample application, we display the raw information (longitude/latitude) in
		//  the employee view. In a real-life application, 
		// we would typically save the location in the database as part of the employee information and show it on a map.

		this.addLocation = function(event) {
		    event.preventDefault();
		    console.log('addLocation');
		    navigator.geolocation.getCurrentPosition(
		        function(position) {
		            $('.location', this.el).html(position.coords.latitude + ',' + position.coords.longitude);
		        },
		        function() {
		            alert('Error getting location');
		        });
		    return false;
		};


		//we define the addToContacts event handler as follows:

		this.addToContacts = function(event) {
		    event.preventDefault();
		    console.log('addToContacts');
		    if (!navigator.contacts) {
		        app.showAlert("Contacts API not supported", "Error");
		        return;
		    }
		    var contact = navigator.contacts.create();
		    contact.name = {givenName: employee.firstName, familyName: employee.lastName};
		    var phoneNumbers = [];
		    phoneNumbers[0] = new ContactField('work', employee.officePhone, false);
		    phoneNumbers[1] = new ContactField('mobile', employee.cellPhone, true); // preferred number
		    contact.phoneNumbers = phoneNumbers;
		    contact.save();
		    return false;
		};

}
 
EmployeeView.template = Handlebars.compile($("#employee-tpl").html());
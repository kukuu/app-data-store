// It’s time to provide our application with some structure.
//  If we keep adding all the core functions of the application to the app object, 
//  it will very quickly grow out of control. In this section we create a HomeView 
//  object that encapsulates the logic to create and render the Home view.


var HomeView = function(store) {

 // Define an initialize() function inside the HomeView class. Define a div wrapper for the view. 
 // The div wrapper is used to attach the view-related events. 
 // Invoke the initialize() function inside the HomeView constructor function.

 	this.initialize = function() {
        // Define a div wrapper for the view. The div wrapper is used to attach events.
        this.el = $('<div/>');
        //search instance
        this.el.on('keyup', '.search-key', this.findByName);
    };
 
    this.initialize();



// Move the renderHomeView() function from the app object to the HomeView class. 
// To keep the view reusable, attach the html to the div wrapper (this.el) 
// instead of the document body. 
// Because the function is now encapsulated in the HomeView class, you can 
// also rename it from renderHomeView() to just render().

    this.render = function() {
	    this.el.html(HomeView.template());
	    return this;
	};


// Move the findByName() function from the app object to the HomeView class.
	this.findByName = function() {
	    store.findByName($('.search-key').val(), function(employees) {
	        $('.employee-list').html(HomeView.liTemplate(employees));
	    });
	};
 
}
 
 //Add the two templates as static members of HomeView.

HomeView.template = Handlebars.compile($("#home-tpl").html());
HomeView.liTemplate = Handlebars.compile($("#employee-li-tpl").html());
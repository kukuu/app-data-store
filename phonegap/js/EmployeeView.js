var EmployeeView = function() {

	//initialize the div element holding the data
	 this.initialize = function() {
	        this.el = $('<div/>');
	  };
	 
	   this.initialize();

	   //render associated template
	   this.render = function() {
		    this.el.html(EmployeeView.template(employee));
		    return this;
		};
}
 
EmployeeView.template = Handlebars.compile($("#employee-tpl").html());
//Author: Alexander Adu-Sarkodie
// Purpose: SPA Mobile App Directory
//Framework: Phonegap
//Version: V1.1

var app = {


    initialize: function() {

        var self = this;

        //Routing
        this.detailsURL = /^#employees\/(\d{1,})/;

        //registers event
        this.registerEvents();

        //calls the route function
        this.store = new MemoryStore(function() {
            self.route();
        });
    },

    // initialize: function() {
        
    //     //Routing
    //     this.detailsURL = /^#employees\/(\d{1,})/;

    //     var self = this;
    //     this.store = new MemoryStore(function() {
    //         $('body').html(new HomeView(self.store).render().el);
    //     });
    // },

    showAlert: function (message, title) {
        if (navigator.notification) {
            navigator.notification.alert(message, null, title, 'OK');
        } else {
            alert(title ? (title + ": " + message) : message);
        }
    },

    //Touch events and routing 

    registerEvents: function() {

        //listen to URL changes from initializations
        $(window).on('hashchange', $.proxy(this.route, this));


        var self = this;
        // Check of browser supports touch events...
        if (document.documentElement.hasOwnProperty('ontouchstart')) {
            // ... if yes: register touch event listener to change the "selected" state of the item
            $('body').on('touchstart', 'a', function(event) {
                $(event.target).addClass('tappable-active');
            });
            $('body').on('touchend', 'a', function(event) {
                $(event.target).removeClass('tappable-active');
            });
        } else {
            // ... if not: register mouse events instead
            $('body').on('mousedown', 'a', function(event) {
                $(event.target).addClass('tappable-active');
            });
            $('body').on('mouseup', 'a', function(event) {
                $(event.target).removeClass('tappable-active');
            });
        }
    },


    /* CSS page transitions  */

    slidePage: function(page) {
 
        var currentPageDest,
            self = this;
     
        // If there is no current page (app just started) -> No transition: Position new page in the view port
        if (!this.currentPage) {
            $(page.el).attr('class', 'page stage-center');
            $('body').append(page.el);
            this.currentPage = page;
            return;
        }
     
        // Cleaning up: remove old pages that were moved out of the viewport
        $('.stage-right, .stage-left').not('.homePage').remove();
     
        if (page === app.homePage) {
            // Always apply a Back transition (slide from left) when we go back to the search page
            $(page.el).attr('class', 'page stage-left');
            currentPageDest = "stage-right";
        } else {
            // Forward transition (slide from right)
            $(page.el).attr('class', 'page stage-right');
            currentPageDest = "stage-left";
        }
     
        $('body').append(page.el);
     
        // Wait until the new page has been added to the DOM...
        setTimeout(function() {
            // Slide out the current page: If new page slides from the right -> slide current page to the left, and vice versa
            $(self.currentPage.el).attr('class', 'page transition ' + currentPageDest);
            // Slide in the new page
            $(page.el).attr('class', 'page stage-center transition');
            self.currentPage = page;
        });
     
    },


    // If there is no hash tag in the URL: display the HomeView
    // If there is a has tag matching the pattern for an employee details 
    // URL: display an EmployeeView for the specified employee.

    route: function() {
        var hash = window.location.hash;
        if (!hash) {
            $('body').html(new HomeView(this.store).render().el);
            return;
        }
        var match = hash.match(app.detailsURL);
        if (match) {
            this.store.findById(Number(match[1]), function(employee) {
                $('body').html(new EmployeeView(employee).render().el);
            });
        }
    }
   

};

app.initialize();




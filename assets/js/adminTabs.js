    // page is ready to go via HTML, jquery only comes into play when user interacts. 
    $(".nav-tabs li").click(function () {
        // only executes if tab/page not active
        if (!$(this).hasClass('active-tab')) {
            $(".nav-tabs li").removeClass("active-tab");
            $(this).addClass('active-tab');
            var page = "#" + $(this).attr("data-link");
            $(".content").removeClass('active');
            $(page).addClass('active');
        }
    });
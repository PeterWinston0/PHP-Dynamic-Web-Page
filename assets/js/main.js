
//SLIDESHOW
const imgs = document.querySelectorAll(".container img");
const dots = document.querySelectorAll(".dot i");
const leftArrow = document.querySelector(".arrow-left");
const rightArrow = document.querySelector(".arrow-right");

let currentIndex = 0;
let time = 5000; // default time for auto slideshow

const defClass = (startPos, index) => {
    for (let i = startPos; i < imgs.length; i++) {
        imgs[i].style.display = "none";
        dots[i].classList.remove("fa-dot-circle");
        dots[i].classList.add("fa-circle");
    }
    imgs[index].style.display = "block";
    dots[index].classList.add("fa-dot-circle");
};

defClass(1, 0);

leftArrow.addEventListener("click", function () {
    currentIndex <= 0 ? currentIndex = imgs.length - 1 : currentIndex--;
    defClass(0, currentIndex);
});

rightArrow.addEventListener("click", function () {
    currentIndex >= imgs.length - 1 ? currentIndex = 0 : currentIndex++;
    defClass(0, currentIndex);
});

const startAutoSlide = () => {
    setInterval(() => {
        currentIndex >= imgs.length - 1 ? currentIndex = 0 : currentIndex++;
        defClass(0, currentIndex);
    }, time);
};

startAutoSlide(); // Start the slideshow



//PRODUCT CAROUSEL
//1
$(document).ready(function () {
    $(".car1").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        appendArrows: $(".car1"),
        dots: false,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        ],
    });
});

//2
$(document).ready(function () {
    $(".car2").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        appendArrows: $(".car2"),
        dots: false,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        ],
    });
});
//RESPOMSIVE
$(document).ready(function () {
    $(".row-eq").each(function () {
        equalColHeights($(this));
    });
    window.onresize = function () {
        $(".row-eq").each(function () {
            equalColHeights($(this));
        });
    };

    const accordion = document.getElementsByClassName("container");

    for (i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener("click", function () {
            this.classList.toggle("active");
        });
    }

    function equalColHeights(ele) {
        var highestCol = 0;
        $(ele)
            .children(".col")
            .each(function () {
                $(this).css("height", "auto");
                if (highestCol < $(this).height()) {
                    highestCol = $(this).height();
                }
                $(ele).children(".col").height(highestCol);
            });
    }
});

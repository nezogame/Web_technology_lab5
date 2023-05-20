var images = [ 
      ["source/raspberry.jpg",
      "source/blueberry.jpg",
      "source/strawberry.jpg"],
      ["source/conifer.jpg",
      "source/fern.jpg",
      "source/needle.jpg"],
      ["source/hyacinth.jpg",
      "source/bulbs.jpg",
      "source/tulips.jpg"
    ],
    ["https://ua.s.bekhost.com/uploads/catalog_products/tmp_330/pion-red_1.jpg?1682523906",
      "https://ua.s.bekhost.com/uploads/catalog_products/tmp_330/floks-pink_1.jpg?1682523906",
      "https://ua.s.bekhost.com/uploads/catalog_products/tmp_330/begoniya-dabl-oranj_1.jpg?1682523906"
    ],
    ["https://ua.s.bekhost.com/uploads/catalog_products/tmp_500/goroh-saharnyy-shestinedelnyy_1.jpg?1683216000",
    "https://ua.s.bekhost.com/uploads/catalog_products/tmp_330/morkov-zimnyaya-vkusnaya_1.jpg?1676361669",
    "https://ua.s.bekhost.com/uploads/catalog_products/tmp_330/tomat-dlya-soleniya-bingo-f1-semena_1.jpg?1675590389"
    ]
];

var links = [
  "lab4/fruity.php",
  "lab4/сonifers.php",
  "lab4/blubs.php",
  "lab4/annual.php",
  "lab4/perennial.php"
]


var imgesName = [
  "Ягідні",
  "Хвойні",
  "Цибулинні",
  "Багаторічні",
  "Однорічні"
]

const prevButton = document.querySelector(".click_prev");
const nextButton = document.querySelector(".click_next");

var slideshowImage =  document.querySelector(".slideshow_image");
var catName = document.querySelector(".category_name");
var catRef = document.querySelector(".category_acquire");
var currentImage = 0;

function showImage() {
  catName.textContent = imgesName[currentImage];
  catRef.pathname = links[currentImage];
  var imageElements = slideshowImage.querySelectorAll("img");
  images[currentImage].forEach((imageUrl, index) => {
    imageElements[index].src = imageUrl;
  });
}


function prevImage() {
    currentImage--;
    if (currentImage < 0) {
      currentImage = images.length - 1;
    }
    return showImage();
}

function nextImage() {
    currentImage++;
    if (currentImage >= images.length) {
      currentImage = 0;
    }
    return showImage();
}

// Initialize the slideshow with the first set of images
showImage();

// Add event listeners to the buttons
prevButton.addEventListener("click", prevImage);
nextButton.addEventListener("click", nextImage);

// Start the slideshow timer
setInterval(nextImage, 5000);





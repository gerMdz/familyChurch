/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min";

// start the Stimulus application
// import './bootstrap';

require('bootstrap/dist/js/bootstrap.bundle.min');
// import bootstrap from "bootstrap";

const myCarouselElement = document.querySelector('#carouselMiAlameda')
const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 10000,
    wrap: true,
})


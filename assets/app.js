/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import 'bootstrap-icons/font/bootstrap-icons.css'; 

//add an eventlistener to a wearlist

document.querySelector("#wearlist").addEventListener('click', addWearlist);

function addWearlist(event) {

    event.preventDefault();

    // Get the link object you click in the DOM

    let wearlistLink = event.currentTarget;

    let link = wearlistLink.href;

    // Send an HTTP request with fetch to the URI defined in the href

    fetch(link)

    // Extract the JSON from the response

        .then(res => res.json())

    // Then update the icon

        .then(function(res) {

            let wearlistIcon = wearlistLink.firstElementChild;

            if (res.isInWearlist) {

                wearlistIcon.classList.remove('bi-heart'); // Remove the .bi-heart (empty heart) from classes in <i> element

                wearlistIcon.classList.add('bi-heart-fill'); // Add the .bi-heart-fill (full heart) from classes in <i> element

            } else {

                wearlistIcon.classList.remove('bi-heart-fill'); // Remove the .bi-heart-fill (full heart) from classes in <i> element

                wearlistIcon.classList.add('bi-heart'); // Add the .bi-heart (empty heart) from classes in <i> element

            }

        });
}
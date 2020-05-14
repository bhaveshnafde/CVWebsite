'use strict';

grecaptcha.ready(function() {
    grecaptcha.execute('_reCAPTCHA_site_key_', {action: 'homepage'}).then(function(token) {
       ...
    });
});


const form = document.querySelector('.form-inline');

//grab an input
const inputEmail = form.querySelector('#email');
const name = form.querySelector('#name');
const subject = form.querySelector('#subject');
const message = form.querySelector('#message');

//config your firebase push
const config = {
  apiKey: "AIzaSyBXe8Rk7JE5OHm0OM2SJIfh1rQSujAwZz0",
  authDomain: "bhaveshnaphade-55657.firebaseapp.com",
  databaseURL: "https://bhaveshnaphade-55657.firebaseio.com",
  projectId: "bhaveshnaphade-55657",
  storageBucket: "bhaveshnaphade-55657.appspot.com",
  messagingSenderId: "661483411018",
  appId: "1:661483411018:web:6e0faf384b6fc9f61538b3",
  measurementId: "G-EG0PSZDXJR"
};


//create a functions to push
    function firebasePush(input, name, subject, message) {


        //prevents from braking
        if (!firebase.apps.length) {
            firebase.initializeApp(config);
        }
        //push itself
        var mailsRef = firebase.database().ref('emails').push().set(
            {
                mail: input.value

            }
        );
        var namesRef = firebase.database().ref('names').push().set(
            {
              name: name.value

            }
        );
        var subjectsRef = firebase.database().ref('subjects').push().set(
            {
              subject: subject.value

            }
        );
        var messagesRef = firebase.database().ref('messages').push().set(
            {
              message: message.value

            }
        );

    }

//push on form submit
    if (form) {
        form.addEventListener('submit', function (evt) {
            evt.preventDefault();
            firebasePush(inputEmail, name, subject, message);

            //shows alert if everything went well.
            return alert('Thanks ${name} for getting in touch. I will get back to you soon.');
        })
    }

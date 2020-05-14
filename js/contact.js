var config = {
  apiKey: "AIzaSyCIjqazYQKoLCVMUncpQ7s6Oz3LegehPm8",
  authDomain: "bhaveshnaphade-2150c.firebaseapp.com",
  databaseURL: "https://bhaveshnaphade-2150c.firebaseio.com",
  projectId: "bhaveshnaphade-2150c",
  storageBucket: "bhaveshnaphade-2150c.appspot.com",
  messagingSenderId: "58971767966",
  appId: "1:58971767966:web:67da672070b2b3c0f2278f",
  measurementId: "G-S0LLKCRBNT"
};
firebase.initializeApp(config);
firebase.analytics();

// Reference messages collection
var messagesRef = firebase.database().ref('messages');

// Listen for form submit
document.getElementById('contactForm').addEventListener('submit', submitForm);

// Submit form
function submitForm(e){
  e.preventDefault();

  // Get values
  var name = getInputVal('name');
  var email = getInputVal('email');
  var subject = getInputVal('subject');
  var message = getInputVal('message');

  // Save message
  saveMessage(name, email, subject, message);

  // Show alert
  document.querySelector('.alert').style.display = 'block';

  // Hide alert after 3 seconds
  setTimeout(function(){
    document.querySelector('.alert').style.display = 'none';
  },3000);

  // Clear form
  document.getElementById('contactForm').reset();
}

// Function to get get form values
function getInputVal(id){
  return document.getElementById(id).value;
}

// Save message to firebase
function saveMessage(name,  email, subject, message){
  var newMessageRef = messagesRef.push();
  newMessageRef.set({
    name: name,
    email:email,
    subject:subject,
    message:message
  });
}

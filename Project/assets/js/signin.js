
var firstNameRegEx = /^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/;
var lastNameRegEx = /^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/;
var birthdayRegEx = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
var phonenumberRegEx = /^[0-9]{6,}/;
var emailRegEx = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
var passwordRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


var firstName = document.getElementById('firstname');
firstName.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongFirstName');
    if (firstName.value.match(firstNameRegEx) && firstName.value.length >= 2) 
    {
        firstName.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        firstName.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Vorname muss mindestens 2 Buchstaben und<br>keine Zahlen enthalten";
        
        return;
    }
});

var lastName = document.getElementById('lastname');
lastName.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongLastName');
    if (lastName.value.match(lastNameRegEx) && lastName.value.length >= 2) 
    {
        lastName.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        lastName.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Nachname muss mindestens 2 Buchstaben und<br> keine Zahlen enthalten";
        return;
    }
});


var birthday = document.getElementById('birthday');
birthday.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongBirthday');
    if (birthday.value.match(birthdayRegEx)) 
    {
        birthday.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        birthday.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Datum muss im Format tt.mm.jjjj und<br> ein valides Geburtsdatum sein";
        
        return;
    }
});

var phonenumber = document.getElementById('phonenumber');
phonenumber.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongPhoneNumber');
    if (phonenumber.value.match(phonenumberRegEx)) 
    {
        phonenumber.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        phonenumber.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Telefonnummer muss mindestens 6 Stellen haben und<br> darf nur Zahlen enthalten";
        
        return;
    }
});

var email = document.getElementById('email');
email.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongEMail');
    if (email.value.match(emailRegEx)) 
    {
        email.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        email.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Email ist keine valide Email";
        
        return;
    }
});

var password = document.getElementById('password');
password.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongPassword');
    if (password.value.match(passwordRegEx)) 
    {
        password.style.border = "1px solid green";
        errorOutput.style.display = "none";
        return;
    }
    else
    {
        password.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Passwort muss mindestens 8 Stellen haben und<br> muss mindestens 1 Großbuchstabe, 1 Kleinbuchstabe und 1 Zahl enthalten ";
        
        return;
    }
});


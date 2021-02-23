


document.addEventListener('DOMContentLoaded', function () {

    var firstNameRegEx = /^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/;
    var lastNameRegEx = /^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/;
    var birthdayRegEx = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
    var phonenumberRegEx = /^[0-9]{6,}/;
    var emailRegEx = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    var passwordRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    // get Page input
    var firstName = document.getElementById('firstname');
    var lastName = document.getElementById('lastname');
    var birthday = document.getElementById('birthday');
    var phonenumber = document.getElementById('phonenumber');
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    // handle Submit button
    var submit = document.getElementById('signin');
    function activateSumbit() 
    {
    if(firstName.value.length == 0 || lastName.value.length == 0 || birthday.value.length == 0 || phonenumber.value.length == 0 || email.value.length == 0 || password.value.length == 0)
    {
        submit.disabled = true;
    }
    }
    activateSumbit();

    // handle validation
    firstName.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongFirstName');
    if (firstName.value.match(firstNameRegEx) && firstName.value.length >= 2) 
    {
        firstName.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        firstName.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Vorname muss mindestens 2 Buchstaben und<br>keine Zahlen enthalten";
        submit.disabled = true;
        return;
    }
    });

    lastName.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongLastName');
    if (lastName.value.match(lastNameRegEx) && lastName.value.length >= 2) 
    {
        lastName.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        lastName.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Nachname muss mindestens 2 Buchstaben und<br> keine Zahlen enthalten";
        submit.disabled = true;
        return;
    }
    });


    birthday.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongBirthday');
    if (birthday.value.match(birthdayRegEx)) 
    {
        birthday.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        birthday.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Datum muss im Format tt.mm.jjjj und<br> ein valides Geburtsdatum sein";
        submit.disabled = true;
        return;
    }
    });

    phonenumber.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongPhoneNumber');
    if (phonenumber.value.match(phonenumberRegEx)) 
    {
        phonenumber.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        phonenumber.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Telefonnummer muss mindestens 6 Stellen haben und<br> darf nur Zahlen enthalten";
        submit.disabled = true;
        return;
    }
    });

    email.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongEMail');
    if (email.value.match(emailRegEx)) 
    {
        email.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        email.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Email ist keine valide Email";
        submit.disabled = true;
        return;
    }
    });

    password.addEventListener('focusout', function() {
    errorOutput = document.getElementById('wrongPassword');
    if (password.value.match(passwordRegEx)) 
    {
        password.style.border = "1px solid green";
        errorOutput.style.display = "none";
        submit.disabled = false;
        activateSumbit() 
        return;
    }
    else
    {
        password.style.border = "1px solid red";
        errorOutput.style.display = "block";
        errorOutput.style.color = "red";
        errorOutput.innerHTML = "Passwort muss mindestens 8 Stellen haben und<br> muss mindestens 1 Großbuchstabe, 1 Kleinbuchstabe und 1 Zahl enthalten ";
        submit.disabled = true;
        return;
    }
    });
});

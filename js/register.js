window.onload = function () {
    const form = document.querySelector('form');
    const message = document.getElementById('message');
    const smallMessage = document.getElementById('smallMessage');
    const emailMessage = 'Type your email';
    const passwordMessage = 'Choose your password';
    const cpasswordMessage = 'Confirm your password';
    const fnameMessage = 'Type your First Name';
    const lnameMessage = 'Type your Last Name';
    const phoneMessage = 'Type your Mobile Number';
    const fname = document.getElementById('fname');
    const lname = document.getElementById('lname');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const cpassword = document.getElementById('cpassword');
    const phone = document.getElementById('phone');
    const submitBtn = document.getElementById('submit');

    function firstMessage() {
        message.innerHTML = fnameMessage;
        smallMessage.innerHTML = "";
        document.body.style.background = '#88C9E8';
    }

    function secondMessage() {
        message.innerHTML = lnameMessage;

        document.body.style.background = '#D5F3A6';
    }

    function thirdMessage() {
        message.innerHTML = emailMessage;
        smallMessage.innerHTML = "";
        document.body.style.background = '#88C9E8';
    }

    function fourthMessage() {
        message.innerHTML = passwordMessage;

        document.body.style.background = '#D5F3A6';
    }

    function fifthMessage() {
        message.innerHTML = cpasswordMessage;
        smallMessage.innerHTML = "";
        document.body.style.background = '#88C9E8';
    }

    function sixthMessage() {
        message.innerHTML = phoneMessage;

        document.body.style.background = '#D5F3A6';
    }

    function length() {
        if (password.value.length <= 3) {
            smallMessage.innerHTML = "Make it strong";

        } else if (password.value.length > 3 && password.value.length < 10) {
            smallMessage.innerHTML = "Strong as a bull!";

        } else if (password.value.length >= 10) {
            smallMessage.innerHTML = "It's unbreakable!!!";

        } else {
            smallMessage.innerHTML = "";
        }
    }

    function match() {
        if (cpassword.value == password.value) {
            smallMessage.innerHTML = "Passwords Match";
        } else {
            smallMessage.innerHTML = "";
        }
    }

    function formValidation() {
        //step 1 first name
        //display Type your First Name when user clicks on input and types, 
        //hide after user clicks on something else
        fname.addEventListener("input", firstMessage);
        //step 2 last name
        //display Type your Last Name when user clicks on input and types, 
        //hide after user clicks on something else
        lname.addEventListener("input", secondMessage);
        //step 3 email
        //display Type your email when user clicks on input and types, 
        //hide after user clicks on something else
        email.addEventListener("input", thirdMessage);
        //step 4 password 
        //display Choose your password as user clicks on input
        //change small message as user enters longer password 
        password.addEventListener('input', fourthMessage);
        password.addEventListener('keyup', length);
        //step 5 confirm password 
        //display Confirm your password as user clicks on input
        //change small message as passwords match
        cpassword.addEventListener('input', fifthMessage);
        cpassword.addEventListener('keyup', match);
        //step 6 mobile number
        //display Type your Mobile Number when user clicks on input and types, 
        //hide after user clicks on something else
        phone.addEventListener("input", sixthMessage);

        //step 7 when all inputs are filled out 
        //display message You're a click away, small message that is what you're here for
        submitBtn.addEventListener('mouseover', function (event) {
            message.innerHTML = "You're a click away";
            smallMessage.innerHTML = "Do it. That's what you are here for.";
            document.body.style.background = '#FCEFA6';
        });

        //step 4 button click
        //display Congratulations, there is a confirmation link in your email
        submitBtn.addEventListener('click', function (event) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    form.innerHTML = this.responseText;
                    document.body.style.background = '#D7F5DE';
                }
            };
            xhttp.open("POST", "RegisterNewUser.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("fname="+fname.value+"&lname="+lname.value+"&email="+email.value+"&password="+password.value+"&cpassword="+cpassword.value+"&phone="+phone.value);
        });


    }

    formValidation();
}
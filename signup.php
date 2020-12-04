<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>App Interface</title>
        <link rel="stylesheet" href="signup.css" type="text/css">
        <script>
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                checkup();
            });
            function checkup() {
                const password = document.getElementById('Passkey').value;
                const confirmpassword = document.getElementById('Confirmp').value;

                if(password.length < 6){
                    document.getElementById("small1").innerHTML = "Password must be more than 6 characters."
                    return false;
                }else{
                    document.getElementById("small1").innerHTML = ""
                }
                if(password != confirmpassword){
                    document.getElementById("small").innerHTML = "Password does not match."
                    return false;
                }else{
                    document.getElementById("small").innerHTML = ""
                }
            }
        </script>
    </head>
    <body>
        <img src="Colour.png" class="background-image">
        <form action="fetch.php" method="POST" onsubmit="return checkup()" enctype="multipart/form-data" > 
            <h1>Create An Account</h1>
            <div class="form">
                <div>
                    <input type="text" name="FirstName" id="FirstName" placeholder="First Name" required>
                    <br>
                </div>
                <div>
                    <input type="text" name="MiddleName" id="MiddleName" placeholder="Middle Name" required>
                    <br>
                </div>
                <div>
                    <input type="text" name="LastName" id="LastName" placeholder="Last Name" required>
                    <br>
                </div>
                <div>
                    <input type="text" name="Email" id="Email" placeholder="Email" required>
                    <br>
                </div>
                <div>
                    <input type="text" name="City" id="City" placeholder="City of Residence" required>
                    <br>
                </div>
                <div>
                    <input type="file" name="ProfilePic" id="ProfilePic" placeholder="Upload Image" required>
                    <br>
                </div>
                <div>
                    <input type="password" name="Passkey" id="Passkey" placeholder="Password" required>
                    <br>
                    <small id="small1"></small>
                </div>
                <div>
                    <input type="password" name="ConfirmP" id="ConfirmP" placeholder="Confirm Password" required>
                    <br>
                    <small id="small"></small>
                </div>
                <div>
                    <button type="submit" name="signup" class="button" >Create an Account</button>
                    <br>
                </div>
                <a href="index.php"><p>Already have an Account?</p></a>
            </div>
        </form>
    </body>

</html>
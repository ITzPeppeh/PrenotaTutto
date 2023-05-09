/* login.php */
function showPWD() {
    var x = document.getElementById("passbox");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

/* register.php */
function showPWD2() {
    var x = document.getElementById("passwd1");
    var y = document.getElementById("passwd2");
    if (x.type === "password") {
    x.type = "text";
    y.type = "text";
    } else {
    x.type = "password";
    y.type = "password";
    }
}

function checkpwd2() {
    var password1 = document.getElementById('passwd1').value;
    var password2 = document.getElementById('passwd2').value;

    if (password1 == password2) {
        if(password1.length >= 8) {
            if (password1.match("[A-Z]")) {
                if (password1.match("[0-9]")) {
                    document.getElementById("myreg").submit();
                } else {
                    alert("Password deve includere almeno un numero.");
                }
            } else {
                alert("Password deve contenere almeno un carattere maiuscolo.");
            }
        } else {
            alert("Password deve essere lungha almeno 8 caratteri.");
        }
    } else {
        alert("Password non coincidono.");
    }
}

/* profile.php */
function checkpwd() {

    var password1 = document.getElementById('passwd1').value;
    var password2 = document.getElementById('passwd2').value;
    var oldpassword = document.getElementById('passwd3').value;

    if (password1) {
        if (password1 == password2) {
            if(password1.length >= 8) {
                if (password1.match("[A-Z]")) {
                    if (password1.match("[0-9]")) {
                        document.cookie = "pwd=" + password1;
                        document.getElementById("myreg").submit();
                    } else {
                        alert("Password must include at least one number");
                    }
                } else {
                    alert("Password must include at least one upper case letter");
                }
            } else {
                alert("Password must be at least 8 characters in length");
            }
        } else {
            alert("Password non coincidono");
        }
    } else {
        document.cookie = "pwd=" + oldpassword;
        document.getElementById("myreg").submit();
    }

    
}
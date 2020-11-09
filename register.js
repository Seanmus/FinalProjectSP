function validate(e)
{
    hideErrors();
	//Determine if the form has errors
	if(formHasErrors()){
		// 	Prevents the form from submitting
		e.preventDefault();
		// 	Returning false prevents the form from submitting
		return false;
	}
	return true;
}

function formHasErrors()
{
    let errorFlag = false;

    let password1 = document.getElementById("password").value;
    let password2 = document.getElementById("passwordReEnter").value;

    if(password1 != password2){
        let passwordError = document.getElementById("passwordError");
        passwordError.style.display = "block";
        errorFlag = true;
    }
    return errorFlag;

}

function hideErrors()
{
    let passwordError = document.getElementById("passwordError");
    passwordError.style.display = "none";
}
function load()
{
    hideErrors();
    document.getElementById("loginform").addEventListener("submit", validate);
    
}

document.addEventListener("DOMContentLoaded", load);
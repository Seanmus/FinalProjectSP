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

    let name = document.getElementById("name").value;
    let platform = document.getElementById("platform").value;

    if(name == ""){
        errorFlag = true;
        let nameError = document.getElementById("nameError");
        nameError.style.display = "block";
    }
    if(platform == ""){
        errorFlag = true;
        let platformError = document.getElementById("platformError");
        platformError.style.display = "block";
    }
    return errorFlag;

}

function hideErrors()
{
    let nameError = document.getElementById("nameError");
    nameError.style.display = "none";
    let platformError = document.getElementById("platformError");
    platformError.style.display = "none";
}
function load()
{
    hideErrors();
    document.getElementById("game").addEventListener("submit", validate);
    
}

document.addEventListener("DOMContentLoaded", load);
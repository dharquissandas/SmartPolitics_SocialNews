var emailentry = document.getElementById("email");
var passwordentry = document.getElementById("password");
var registerbody = document.getElementById("registerbody");
var nameentry = document.getElementById("username");

var submitbutton = document.getElementById("registerbtn").addEventListener("click", verify);
var closebutton = document.getElementById("closebtn").addEventListener("click", close);


function verify(e){
    var message = document.createElement("p");
    var message2 = document.createElement("p");
    var text = document.createTextNode("Name Must Have 3 Letters Or More");
    var text2 = document.createTextNode("Password Must Have 6 Characters Or More");
    if(passwordentry.value.length < 6 || nameentry.value.length < 3){
        e.preventDefault();
        var messagecheck = document.getElementById("passerror");
        if (typeof(messagecheck) != 'undefined' && messagecheck != null){}
        else{
            message.appendChild(text);
            message2.appendChild(text2)
            registerbody.appendChild(message);
            registerbody.appendChild(message2);
            message.setAttribute("id","passerror");
            message2.setAttribute("id","passerror");
            message.style.color = "white";
            message2.style.color = "white";
        }
    }
}
var myaccount = document.getElementById("account");
if (typeof(myaccount) != 'undefined' && myaccount != null){
    myaccount.addEventListener("click", accounts);
}

var home = document.getElementById("home");
if (typeof(home) != 'undefined' && home != null){
    home.addEventListener("click", index);
}

function accounts(){
    window.location.href="accountallposts.php";
}

function index(){
    window.location.href="index.php";
}







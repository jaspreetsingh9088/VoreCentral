let popUp = document.getElementById("cookiePopup");
let agePopUp = document.getElementById("agePopup");
//When user clicks the accept button
document.getElementById("acceptCookie").addEventListener("click", () => {
  //Create date object
  //let d = new Date();
  //Increment the current time by 1 minute (cookie will expire after 1 minute)
 // d.setMinutes(2 + d.getMinutes());
  //Create Cookie withname = myCookieName, value = thisIsMyCookie and expiry time=1 minute
  //document.cookie = "VoreCookieConsent=VoreCentral.com; expires = " + d + ";";
  setCookie('VoreCookieConsent', "VoreCentral.com");

  //Hide the popup
  popUp.classList.add("hide");
  popUp.classList.remove("show");


    //Show the age popup
    agePopUp.classList.add("show");
    agePopUp.classList.remove("hide");

});

//When user clicks the Are you above 18? yes button
document.getElementById("above18yes").addEventListener("click", () => {
    setCookie('VoreAgeCookieConsent', "VoreCentral.com");

    //Hide the popup
    agePopUp.classList.add("hide");
    agePopUp.classList.remove("show");
});

//When user clicks the Are you above 18? no button
document.getElementById("above18no").addEventListener("click", () => {
    alert("You are not allowed to access the website.");
});

//Check if cookie is already present
const checkCookie = () => {
  //Read the cookie and split on "="
  //let input = document.cookie.split("=");console.log(input);
  //const coc = document.cookie.split("  VoreCookie=");console.log(coc);
  //Check for our cookie
 // if (input[0] == "VoreCookie") {

 if(getCookie ('VoreCookieConsent')){

    //Hide the popup
    popUp.classList.add("hide");
    popUp.classList.remove("show");

    //Check if age cookie is already present
    if (getCookie('VoreAgeCookieConsent')) {
        //Hide the age popup
        agePopUp.classList.add("hide");
        agePopUp.classList.remove("show");
    } else {
        //Show the age popup
        agePopUp.classList.add("show");
        agePopUp.classList.remove("hide");
    }

  } else {

    //Show the popup
    popUp.classList.add("show");
    popUp.classList.remove("hide");
  }
};
//Check if cookie exists when page loads
window.onload = () => {
  setTimeout(() => {
    checkCookie();
  }, 2000);
};



const getCookie = function(name) {
    const value = " " + document.cookie;
    // console.log("value", `==${value}==`);
    const parts = value.split(" " + name + "=");
    return parts.length < 2 ? undefined : parts.pop().split(";").shift();
  };

const setCookie = function (name, value, expiryDays, domain, path, secure) {
    const exdate = new Date();
    exdate.setHours(
      exdate.getHours() +
        (typeof expiryDays !== "number" ? 365 : expiryDays) * 24
    );
    document.cookie =
      name +
      "=" +
      value +
      ";expires=" +
      exdate.toUTCString() +
      ";path=" +
      (path || "/") +
      (domain ? ";domain=" + domain : "") +
      (secure ? ";secure" : "");
  };

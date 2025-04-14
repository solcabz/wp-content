  // Function to set a cookie
  function setCookie(name, value,  days = 1) {
    let expires = "";
    if (days) {
      const date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
  }

  // Function to get a cookie
  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
      let c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

  // Function to hide cookie notice after acceptance
  function acceptCookies() {
    setCookie("cookieAccepted", "true", 30);
    document.getElementById("cookie-notice").style.display = "none";

    // ✅ Load Meta Pixel after user accepts
    loadMetaPixel();
  }

  // Check if cookie is set
  document.addEventListener("DOMContentLoaded", function() {
    if (!getCookie("cookieAccepted")) {
      document.getElementById("cookie-notice").style.display = "block";
    } else {
      // ✅ Load Meta Pixel automatically if cookie already set
      loadMetaPixel();
    }
  });
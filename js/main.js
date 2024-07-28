document.addEventListener('DOMContentLoaded', function() {
    // Check if the banner should be displayed based on user's choice in cookies
    if (!getCookie('bannerClosed')) {
        jQuery('body').addClass('banner-show');
    }

    else {
        jQuery('body').addClass('banner-hide');
        document.getElementById('custom-banner').style.display = 'none';
    }
    console.log(bannerCookieStoreTime);

    // Close button click event handler
    jQuery('#close-banner').on('click', function() {
        // Hide the banner
        jQuery('#custom-banner').hide();
        jQuery('body').removeClass('banner-show');
        jQuery('body').addClass('banner-hide');
        // Set cookie to remember user's choice
        setCookie('bannerClosed', 'true', bannerCookieStoreTime); 
    });
});

// Function to set a cookie
function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

// Function to get the value of a cookie
function getCookie(name) {
    var nameEQ = name + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}

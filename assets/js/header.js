

// LOCALE START //
let selectLocale = document.getElementById('select-locale');
let contentLocale = document.getElementById('content-locale');

selectLocale.addEventListener('click', function () {
    if (contentLocale.classList.contains('hidden')) {
        contentLocale.classList.remove('hidden');
    } else {
        contentLocale.classList.add('hidden');
    }
})


// LOCALE END //
function changeLanguage() {
    var languageSelect = document.getElementById('languageSelect');
    var selectedLanguage = languageSelect.value;

    // Store the selected language in local storage
    localStorage.setItem('selectedLanguage', selectedLanguage);

    switchLanguage(selectedLanguage);
}
        function switchLanguage(selectedLanguage) {
    switch (selectedLanguage) {
        case 'en':
            document.getElementById('59').innerText = 'Select Date:';
            // document.getElementById('60').innerText = 'Session: ';
            document.getElementById('61').innerText = 'Morning';
            document.getElementById('62').innerText = 'Evening';
            document.getElementById('63').innerText = 'Milk Collected Customer';
            document.getElementById('64').innerText = 'No';
            document.getElementById('65').innerText = 'CUSTOMER ID';
            document.getElementById('66').innerText = 'CUSTOMER NAME';
            document.getElementById('67').innerText = 'MILK TYPE';
            document.getElementById('68').innerText = 'Remaining Customer';
            document.getElementById('69').innerText = 'No';
            document.getElementById('70').innerText = 'CUSTOMER ID';
            document.getElementById('71').innerText = 'CUSTOMER NAME';
            document.getElementById('72').innerText = 'MILK TYPE';
            
            break;
        case 'mr':
            document.getElementById('59').innerText = 'तारीख निवडा';
            //document.getElementById('60').innerText = 'सत्र';
            document.getElementById('61').innerText = 'सकाळ';
            document.getElementById('62').innerText = 'संध्याकाळ';
            document.getElementById('63').innerHTML = 'दूध संकलित ग्राहक';
            document.getElementById('64').innerText = 'क्रमांक';
            document.getElementById('65').innerText = 'ग्राहक क्र';
            document.getElementById('66').innerText = 'ग्राहकाचे नाव';
            document.getElementById('67').innerText = 'दुधाचा प्रकार';
            document.getElementById('68').innerText = 'उरलेले ग्राहक';
            document.getElementById('69').innerText = 'क्रमांक';
            document.getElementById('70').innerText = 'ग्राहक क्र';
            document.getElementById('71').innerText = 'ग्राहकाचे नाव';
            document.getElementById('72').innerText = 'दुधाचा प्रकार';
            break;
        case 'kn':
            document.getElementById('59').innerText = 'ದಿನಾಂಕವನ್ನು ಆಯ್ಕೆಮಾಡಿ';
            //document.getElementById('60').innerText = 'ಅಧಿವೇಶನ';
            document.getElementById('61').innerText = 'ಬೆಳಿಗ್ಗೆ';
            document.getElementById('62').innerText = 'ಸಂಜೆ';
            document.getElementById('63').innerText = 'ಹಾಲು ಸಂಗ್ರಹಿಸುವ ಗ್ರಾಹಕರು';
            document.getElementById('64').innerText = 'ಸಂ';
            document.getElementById('65').innerText = 'ಗ್ರಾಹಕ ID';
            document.getElementById('66').innerText = 'ಗ್ರಾಹಕ ಹೆಸರು';
            document.getElementById('67').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('68').innerText = 'ಉಳಿದ ಗ್ರಾಹಕರು';
            document.getElementById('69').innerText = 'ಸಂ';
            document.getElementById('70').innerText = 'ಗ್ರಾಹಕ ID';
            document.getElementById('71').innerText = 'ಗ್ರಾಹಕ ಹೆಸರು';
            document.getElementById('72').innerText = 'ಹಾಲಿನ ವಿಧ';
            break;
        default:
            break;
    }
}
// On page load, check if a language preference is stored in local storage
document.addEventListener('DOMContentLoaded', function () {
    var storedLanguage = localStorage.getItem('selectedLanguage');
    if (storedLanguage) {
        // If a language preference is found, switch to that language
        switchLanguage(storedLanguage);
        // Update the language select dropdown to reflect the stored preference
        document.getElementById('languageSelect').value = storedLanguage;
    }
});  
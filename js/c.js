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
            document.getElementById('31').innerText = 'DAILY MILK COLLECTION';
            document.getElementById('32').innerText = 'CUSTOMER ID';
            document.getElementById('33').innerText = 'NAME';
            document.getElementById('34').innerText = 'MILK TYPE';
            document.getElementById('35').innerText = 'QTY (LTR)';
            document.getElementById('36').innerText = 'FAT';
            document.getElementById('37').innerText = 'SNF';
            document.getElementById('38').innerText = 'RATE';
            document.getElementById('39').innerText = 'TOTAL';
            document.getElementById('40').innerText = 'LIVE';
            document.getElementById('41').innerText = 'Division';
            document.getElementById('42').innerText = 'Date';
            document.getElementById('43').innerText = 'Session';
            document.getElementById('44').innerText = 'TOTAL';
            document.getElementById('45').innerText = 'Buffalo';
            document.getElementById('46').innerText = 'Litre';
            document.getElementById('47').innerText = 'Rate';
            document.getElementById('48').innerText = 'Cow';
            document.getElementById('49').innerText = 'Litre';
            document.getElementById('50').innerText = 'Rate';
            document.getElementById('51').innerText = 'DAILY-MILK-COLLECTION-DETAILS';
            document.getElementById('52').innerText = 'CUSTOMER ID';
            document.getElementById('53').innerText = 'MILK TYPE';
            document.getElementById('54').innerText = 'QTY/LTR';
            document.getElementById('55').innerText = 'FAT';
            document.getElementById('56').innerText = 'SNF';
            document.getElementById('57').innerText = 'RATE	';
            document.getElementById('58').innerText = 'TOTAL';
            
            break;
        case 'mr':
            document.getElementById('31').innerText = 'दररोज दूध संकलन';
            document.getElementById('32').innerText = 'ग्राहक क्र';
            document.getElementById('33').innerText = 'नाव';
            document.getElementById('34').innerText = 'दुधाचा प्रकार';
            document.getElementById('35').innerText = 'लिटर';
            document.getElementById('36').innerText = 'फॅट ';
            document.getElementById('37').innerText = 'एस एन एफ';
            document.getElementById('38').innerText = 'दर';
            document.getElementById('39').innerText = 'एकूण संकलन';
            document.getElementById('40').innerText = 'चालू कलेक्शन ';
            document.getElementById('41').innerText = 'शाखा ';
            document.getElementById('42').innerText = 'तारीख';
            document.getElementById('43').innerText = 'सत्र';
            document.getElementById('44').innerText = 'एकूण';
            document.getElementById('45').innerText = 'म्हैस';
            document.getElementById('46').innerText = 'लिटर';
            document.getElementById('47').innerText = 'दर';
            document.getElementById('48').innerText = 'गाय';
            document.getElementById('49').innerText = 'लिटर';
            document.getElementById('50').innerText = 'दर';
            document.getElementById('51').innerText = 'दैनिक दूध संकलन तपशील';
            document.getElementById('52').innerText = 'ग्राहक क्र';
            document.getElementById('53').innerText = 'दुधाचा प्रकार';
            document.getElementById('54').innerText = 'लिटर';
            document.getElementById('55').innerText = 'फॅट ';
            document.getElementById('56').innerText = 'एस एन एफ';
            document.getElementById('57').innerText = 'दर';
            document.getElementById('58').innerText = 'एकूण';
            break;
        case 'kn':
            document.getElementById('31').innerText = 'ದೈನಂದಿನ ಹಾಲು ಸಂಗ್ರಹಣೆ';
            document.getElementById('32').innerText = 'ಗ್ರಾಹಕ ID';
            document.getElementById('33').innerText = 'ಹೆಸರು';
            document.getElementById('34').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('35').innerText = 'ಲೀಟರ್';
            document.getElementById('36').innerText = 'ಕೊಬ್ಬು';
            document.getElementById('37').innerText = 'ಎಸ್ ಎನ್ ಎಫ್';
            document.getElementById('38').innerText = 'ದರಗಳು';
            document.getElementById('39').innerText = 'ಒಟ್ಟು';
            document.getElementById('40').innerText = 'ಪ್ರಸ್ತುತ ಸಂಗ್ರಹಣೆ';
            document.getElementById('41').innerText = 'ಶಾಖೆ';
            document.getElementById('42').innerText = 'ದಿನಾಂಕ';
            document.getElementById('43').innerText = 'ಅಧಿವೇಶನ';
            document.getElementById('44').innerText = 'ಒಟ್ಟು';
            document.getElementById('45').innerText = 'ಎಮ್ಮೆ';
            document.getElementById('46').innerText = 'ಲೀಟರ್';
            document.getElementById('47').innerText = 'ದರಗಳು';
            document.getElementById('48').innerText = 'ಹಸು';
            document.getElementById('49').innerText = 'ಲೀಟರ್';
            document.getElementById('50').innerText = 'ದರಗಳು';
            document.getElementById('51').innerText = 'ದೈನಂದಿನ ಹಾಲು ಸಂಗ್ರಹಣೆ ವಿವರಗಳು';
            document.getElementById('52').innerText = 'ಗ್ರಾಹಕ ID';
            document.getElementById('53').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('54').innerText = 'ಲೀಟರ್';
            document.getElementById('55').innerText = 'ಕೊಬ್ಬು';
            document.getElementById('56').innerText = 'ಎಸ್ ಎನ್ ಎಫ್';
            document.getElementById('57').innerText = 'ದರಗಳು';
            document.getElementById('58').innerText = 'ಒಟ್ಟು';
            // Add more cases for other elements if needed
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
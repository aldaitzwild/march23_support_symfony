const verifyBtn = document.getElementById('verifyTelBtn');
const phoneNumber = document.getElementById('phoneNumber');
const resultVerify = document.getElementById('resultVerify');

verifyBtn.addEventListener('click', function () {
    
    fetch('https://api.veriphone.io/v2/verify?phone=' + phoneNumber.innerHTML + '&key=YOUR_API_KEY')
    .then(response => response.json())
    .then(json => {
        console.log(json.phone_valid);
        console.log(json.country);

        resultVerify.innerHTML = "Pays du tel : " + json.country 
                                + ", Validé : " + json.phone_valid;
    })
    
});
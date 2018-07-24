// config
// var baseUrl = 'http://localhost:3000'
var baseUrl = 'https://api.getcryptostorm.com'

var transaction = {}
var paymentTimer = null
var currentPage = window.location.href.toLowerCase()


// Mobile menu
var mobileToggle = document.getElementById('mobile-toggle')

mobileToggle.addEventListener("click", function() {
    document.body.classList.toggle('open')
})

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}


// Payment form
var checkDiscountCode = debounce((transactionId, discountCode) => {
    discountCode = discountCode.replace(' ', '')
    if (discountCode && discountCode.length > 0) {
        axios.get(baseUrl+'/payment/discount/'+transactionId+'/'+discountCode)
        .then((res) => {
            if (res.data.isValid) {
                document.querySelector('.discount-error').style.display = 'none'
                updatePaymentFrame(transactionId, res.data.amount)
            } else {
                document.querySelector('.discount-error').style.display = 'block'
            }
        })
        .catch((err) => {
            console.log(err)
        })
    }
}, 1000)

var updateEmail = (transactionId, email) => {
    axios.post(baseUrl+'/payment/email/'+transactionId, { email: email })
    .then((res) => {
    })
    .catch((err) => {
        console.log(err)
    })
    console.log('update', email)
}

var updatePaymentFrame = function(transactionId, amount) {
    var paymentContainer = document.getElementById('payment-address-container')
    /*var opts = {
        "id": transactionId,
        "apikey": "8vwkqvzpsi",
        "curr": "BTC",
        "email": document.querySelector('#BuyModal input[name=email]').value,
        "amount": amount
    }
    klukt.render('#payment-address-container', opts, function (payment) {
        console.log('Payment received!!', payment)
    })*/
    var userEmail = document.querySelector('#BuyForm-1 input[name=email]').value;
    paymentContainer.innerHTML = '<iframe src="https://klukt.com/widget.html?apikey=q49rbwjukg&id='+transactionId+'&amount='+amount+'&curr=BTC&email='+userEmail+'" scrolling="" frameborder="0" style="border:none;border-radius:5px;" width=240 height=300/>'
}

var checkForPayment = function(transactionId) {
    axios.get(baseUrl + '/payment/'+transactionId)
    .then((res) => {
        if (res.data.status == 'failed') {
            clearInterval(paymentTimer)
            document.getElementById('BuyForm-2').style.display = 'none'
            document.getElementById('PaymentFail').style.display = 'block'
        }
        else if (res.data.status == 'completed') {
            clearInterval(paymentTimer)
            document.getElementById('activation-code').innerHTML = res.data.license
            document.getElementById('BuyForm-2').style.display = 'none'
            document.getElementById('PaymentSuccess').style.display = 'block'
        }
    })
    .catch((err) => {
        console.log(err)
    })
}

var initPayment = function(modalId) {
    if (modalId)
        showModal(modalId)
    axios.post(baseUrl + '/payment')
    .then((res) => {
        transaction = res.data

        let urlStart = currentPage.indexOf('discountcode=')
        if (urlStart >= 0) saveDiscountCode(currentPage.substr(urlStart + 13, 6))
        else getDiscountCode()

        updatePaymentFrame(res.data._id, res.data.amount)

        // var emailInput = document.querySelector('#BuyForm-1 input[name=email]')
        // updateEmail(res.data._id, emailInput.value)

        var discountInput = document.querySelector('#BuyForm-1 input[name=discount]')
        if (discountInput) checkDiscountCode(res.data._id, discountInput.value)
        
        paymentTimer = setInterval(() => checkForPayment(res.data._id), 2000)
    })
    .catch((err) => {
        console.log(err)
    })
}

var discountInput = document.querySelector('#BuyForm-1 input[name=discount]')
if (discountInput)
    discountInput.addEventListener("keyup", function(e) {
        checkDiscountCode(transaction._id, e.target.value)
    })

var emailInput = document.querySelector('#BuyForm-1 input[name=email]')
if (emailInput)
    emailInput.addEventListener("blur", function(e) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if (!re.test(e.target.value)) {
            document.querySelector('.email-error').style.display = 'block'
        } else {
            document.querySelector('.email-error').style.display = 'none'
            updateEmail(transaction._id, e.target.value)
        }
    })


// Modals
var showModal = function(modalId) {
    modalId.style.visibility = 'visible'
    modalId.style.opacity = 1
    document.getElementsByTagName("body")[0].style.overflow = "hidden"
}
var hideModal = function(modalId) {
    modalId.style.opacity = 0
    modalId.style.visibility = 'hidden'
    document.getElementsByTagName("body")[0].style.overflow = "visible"
}


let continueBtn = document.getElementById('continuePayment')
if (continueBtn) {
    continueBtn.addEventListener('click', function(e) {
        // No email
        if (document.querySelector('#BuyForm-1 input[name=email]').value == '') {
            document.querySelector('.email-error').style.display = 'block'
        } 
        // No T&C
        else if (!document.querySelector('#BuyForm-1 input[name=terms]').checked) {
            document.querySelector('.terms-error').style.display = 'block'
        } 
        // Good to go
        else {
            document.getElementById('BuyForm-1').style.display = 'none'
            document.getElementById('BuyForm-2').style.display = 'block'
        }
    })
}


// Handle discount code in query string
var saveDiscountCode = function(code) {
    console.log(code)
    axios.get(baseUrl+'/payment/discount/'+transaction._id+'/'+code)
    .then((res) => {
        if (res.data.isValid) {
            console.log('valid discount code')
            saveDiscountCodeCookie(code)
            document.querySelector('input[name=discount]').value = code

            // if (currentPage.indexOf('buy.html') >= 0) initPayment(null)
            updatePaymentFrame(transaction._id, res.data.amount)
        } else {
            console.log('invalid discount code')
        }
    })
    .catch((err) => {
        console.log(err)
    })
}

var saveDiscountCodeCookie = function(code) {
    document.cookie = 'discountcode='+code  // save to cookie
}

var getDiscountCode = function() {
    let cookieStart = document.cookie.indexOf('discountcode=')
    if (cookieStart >= 0) saveDiscountCode(document.cookie.substr(cookieStart + 13, 6))
}


if (currentPage.indexOf('buy') >= 0) initPayment(null)

let urlStart = currentPage.indexOf('discountcode=')
if (urlStart >= 0) saveDiscountCodeCookie(currentPage.substr(urlStart + 13, 6))



/* FAQ Accordion */
let faqItems = document.querySelectorAll('.FAQ-list li')
faqItems.forEach(function(e) {
    e.addEventListener('click', function(e) {
        if (e.target.closest('li').className == "active")
            e.target.closest('li').className = ""
        else
            e.target.closest('li').className = "active"
    })
})



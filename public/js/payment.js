const totalPrice = document.querySelector('.total-price')
const proceedBtn = document.querySelector('.proceed-btn')
if(proceedBtn) {
    if (parseFloat(totalPrice.innerHTML) == 0) {
        proceedBtn.disabled = true
    }
}

const paymentMethods = [
    {
        id: 1,
        name : "Cash-payment"
    },
    {
        id: 2,
        name : "Momo"
    },
    {
        id: 3,
        name : "VNPAY"
    }
]

const paymentOption = document.querySelector('.payment-option') ?? null 
if(paymentOption) {
    paymentMethods.forEach(item => {
        paymentOption.innerHTML += `
            <li class="payment-item ${item.name.toLowerCase()}-method">
                <a class="payment-link">
                    <img src="${assetUrl}/${item.name.toLowerCase()}.jpg" alt="payment">
                    <span>${item.name}</span>
                </a>
            </li>
        `
    })

    const priceInput = document.querySelectorAll('input[name="total-price"]')
    priceInput.forEach(item => {
        item.value = parseFloat(document.querySelector('.total-price').innerHTML.replace(',', ''))
    })
}


const cashItem = document.querySelector('.cash-payment-method')
const proceedForm = document.querySelector('.proceed-form')

const momoItem = document.querySelector('.momo-method')
const momoForm = document.querySelector('.momo-form')

const vnpayItem = document.querySelector('.vnpay-method')
const vnpayForm = document.querySelector('.vnpay-form')

if(cashItem) {
    cashItem.addEventListener('click', e => {
        vnpayItem.classList.remove('active')
        vnpayForm.classList.remove('open')

        momoItem.classList.remove('active')
        momoForm.classList.remove('open')

        cashItem.classList.toggle('active')
        if(cashItem.classList.contains('active')) {
            proceedForm.classList.add('open')
        }
        else {
            proceedForm.classList.remove('open')
        }
    })
}

if(momoItem) {
    momoItem.addEventListener('click', e => {
        cashItem.classList.remove('active')
        proceedForm.classList.remove('open')
        vnpayItem.classList.remove('active')
        vnpayForm.classList.remove('open')

        momoItem.classList.toggle('active')
        if(momoItem.classList.contains('active')) {
            momoForm.classList.add('open')
        }
        else {
            momoForm.classList.remove('open')
        }
    })
}


if(vnpayItem) {
    vnpayItem.addEventListener('click', e => {
        cashItem.classList.remove('active')
        proceedForm.classList.remove('open')
        momoItem.classList.remove('active')
        vnpayItem.classList.toggle('active')

        if(vnpayItem.classList.contains('active')) {
            vnpayForm.classList.add('open')
        }
        else {
            vnpayForm.classList.remove('open')
        }
    })
}




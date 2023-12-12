const totalPrice = document.querySelector('.total-price')
const proceedBtn = document.querySelector('.proceed-btn')
if (!parseFloat(totalPrice)) {
    proceedBtn.disabled = true
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
                <a href="#">
                    <img src="${assetUrl}/${item.name.toLowerCase()}.jpg" alt="payment">
                    <span>${item.name}</span>
                </a>
            </li>
        `
    })
}


const paymentItems = document.querySelectorAll('.payment-item') ?? null
const paymentItemsLink = document.querySelectorAll('.payment-item a') ?? null

if(paymentItemsLink) {
    paymentItemsLink.forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault()
            paymentItems.forEach(item => {
                item.classList.remove('active')
            })
            const paymentItem =  e.target.closest('li')
            paymentItem.classList.add('active')
            if (paymentItem.className.includes('cash-payment')) {
                console.log('thanh toán thường')
            }
            else if(paymentItem.className.includes('momo')) {
                console.log('thanh toán momo')
            }
            else {
                console.log('thanh toán vnpay')
            }
        })
    })
}











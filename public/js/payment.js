let paymentMethods = JSON.parse(localStorage.getItem('paymentMethods')) ?? null
if(!paymentMethods) {
    localStorage.setItem('paymentMethods', JSON.stringify([
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
    ]))
    paymentMethods = JSON.parse(localStorage.getItem('paymentMethods'))
}
const paymentOption = document.querySelector('.payment-option') 
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

const paymentItems = document.querySelectorAll('.payment-item')
const paymentItemsLink = document.querySelectorAll('.payment-item a')

paymentItemsLink.forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault()
        paymentItems.forEach(item => {
            item.classList.remove('active')
        })
        e.target.closest('li').classList.add('active')
    })
})





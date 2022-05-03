

let = accountBox = document.querySelector('.header .header-2 .account-box');

document.querySelector('#user-btn').onclick = () =>{
    accountBox.classList.toggle('active');
    navbar.classList.remove('active');
 }
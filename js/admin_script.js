let userBtn = document.querySelector('#user-btn');

let accountBox = document.querySelector('.header .account-box');

userBtn.onclick = () =>{
    accountBox.classList.toggle('active');
}

document.querySelector('#close-update').onclick = () =>{
    document.querySelector('.edit-container').style.display="none";
}
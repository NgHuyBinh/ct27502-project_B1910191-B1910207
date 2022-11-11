const sign_in_btn = document.querySelector('#sign-in-button');
const sign_up_btn = document.querySelector('#sign-up-button');
const container = document.querySelector('.container');
const signin = document.querySelector('.signin-signup');
const signup = document.querySelector('.signup-signup');

sign_up_btn.addEventListener('click', () =>{
    container.classList.add('sign-up-mode');

    setTimeout( () => {
        signin.style.zIndex = '2';
        signin.style.display = 'none';
        signup.style.zIndex = '7';
        
    }, 1500);


});
sign_in_btn.addEventListener('click', () =>{
    container.classList.remove('sign-up-mode');
    setTimeout( () => {
        signin.style.zIndex = '8';
        signin.style.display = 'flex';

        signup.style.zIndex = '2';

    }, 1500);
});
require('./bootstrap');

if(document.getElementById('_back')){
    const back = document.getElementById('_back');

    back.addEventListener('click', () => history.back());
}

if(document.getElementById('_back2')){
    const back = document.getElementById('_back2');

    back.addEventListener('click', () => history.go(-3));
}
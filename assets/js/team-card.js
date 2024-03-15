let loisir = document.querySelector('.loisir');
let travail = document.querySelector('.travail');
let container = document.querySelector('.imgContainer');
let all = document.querySelectorAll('.teamCard');

loisir.addEventListener('click', function(){
    travail.classList.remove('bg-black', 'text-white')
    travail.classList.add('text-black')

    loisir.classList.remove('text-white')
    loisir.classList.add('bg-black', 'text-white')

    all.forEach((card) => {
        let container = card.querySelector('.imgContainer');
        container.children[1].classList.add('animate-slide-left');  
        container.children[1].classList.remove('animate-slide-right');   
    });

})

travail.addEventListener('click', function(){
    loisir.classList.remove('bg-black', 'text-white')
    loisir.classList.add('text-black')

    travail.classList.remove('text-white')
    travail.classList.add('bg-black', 'text-white')
    
    all.forEach((card) => {
        let container = card.querySelector('.imgContainer');       
        container.children[1].classList.add('animate-slide-right');               
        container.children[1].classList.remove('animate-slide-left');  
    });
})



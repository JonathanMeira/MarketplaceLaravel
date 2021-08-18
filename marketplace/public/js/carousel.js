let thumb = document.querySelector('img.thumb');
let imgSmall = document.querySelectorAll('img.img-small');

imgSmall.forEach(function(el){
    el.addEventListener('click',function(){
        thumb.src = el.src;
    });
});

const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);





document.addEventListener(
    "click",
    function(event) {
        var target = event.target;
        var replyForm;
        //var replyBox;
    
       
        if (target.matches("[data-toggle='reply-form']")) {
            replyForm = document.getElementById(target.getAttribute("data-target"));
            //replyBox = document.getElementById("replyBox");
            //console.log(replyBox);
            
           
            replyForm.classList.toggle("d-none");
            replyForm.classList.toggle("z-index");
            
            
           
        }
    },
    false

   
);





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

function slideImage() {
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

function countReplies() {
    let allComments = document.querySelectorAll(".single-comment-container");


    allComments.forEach(element => {
        let count = 0;
        let span = element.querySelector(".comment_replies_number");
        let replyContainers = element.querySelectorAll('.replies-container');

        //  let replies = replyContainers.querySelectorAll(".single-reply-container");
        for (let i = 0; i < replyContainers.length; i++) {
            console.log('hej');
            count++;
        }
        span.textContent = count + "Replies";


        console.log(span)
    })

    // console.log(allComments)
}

countReplies();
function showReplyForm(element) {
    let allForms = document.querySelectorAll(".reply-form");
    allForms.forEach(form => {
        form.classList.remove("show");
    })
    let container = element.parentNode.parentNode;
    container.querySelector(".reply-form").classList.toggle("show");
}
function showReplies(element) {
    let container = element.parentNode.parentNode.parentNode;
    element.classList.toggle("active");
    container.querySelector(".replies-container").classList.toggle("show");
}


function cancelReply(element) {
    let container = element.parentNode.parentNode;
    container.querySelector(".reply-form").classList.remove("show");
}


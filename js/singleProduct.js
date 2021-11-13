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



function printReplyForm(element) {
    console.log(element)
    console.log(element.dataset.target);
    let currentComment = element.parentNode;
    /*  currentComment.innerHTML = ""; */

    let replyForm = `<form action="/create-reply" method="POST" class="reply-form" id="comment-1-reply-form">
    <input type="hidden" name="product_id" value="<?= $product_id ?>">
    <textarea name="reply_body" placeholder="Reply to comment" rows="4"></textarea>
    <button type="submit">Submit</button>
    <button type="button" onclick="cancelReply(this)">Cancel</button>
  </form>`;

    currentComment.insertAdjacentHTML('beforeend', replyForm);


}

function cancelReply(element) {
    element.parentNode.remove();
}
/*

document.addEventListener(
    "click",
    function (event) {
        var target = event.target;
        var replyForm;


        if (target.matches("[data-toggle='reply-form']")) {
            replyForm = document.getElementById(target.getAttribute("data-target"));
            //replyBox = document.getElementById(target.getAttribute("data-target"));

            replyForm.classList.toggle("d-none");
            replyForm.classList.toggle("z-index");
            //replyBox.classList.toggle("hidden");


        }
    },
    false


);


 */
document.addEventListener('keyup', function (e) {
    let container = document.getElementById('search_results');
    console.log(container)
    if (!container.contains(e.target)) {
        container.style.display = 'none';
        hide_results();
        /*   document.querySelector("input.search-input").value = ""; */
    }
});

let clearInputButton = document.querySelector("i.clear-input")
// People prof. exp. use this approach
let search_timer // used to stop the search_timer
function search() {

    let lol = document.querySelector("#search-form");

    if (search_timer) {
        clearTimeout(search_timer)
    }
    if (event.target.value.length >= 2) {

        search_timer = setTimeout(async function () {


            let conn = await fetch('/search', {

                method: "POST",
                body: new FormData(document.querySelector("#search-form"))

            })

            if (!conn.ok) {
                alert('uppps....')
            }

            let products = await conn.json()




            // populate the results
            document.querySelector("#search_results").innerHTML = ""

            let result_div = `
                       <div class="search-result-amount">
                     <h3> ${products.length} Results </h3>
                     </div>`
            document.querySelector("#search_results").insertAdjacentHTML('beforeend', result_div)


            products.forEach(product => {

                console.log(product.product_id);
                let image = JSON.parse(product.product_image)
                console.log(image);
                let single_product = `
                   <div class="user">
                   <div class="container">
                     <img src="../product-images/${image[0]}" alt="Image of product ${product.product_title}">
                     <div class="title"> ${product.product_title}</div>
   
                     <a class="button user" href="/single-product/${product.product_id}">
                       Go to Product <i class="fas fa-long-arrow-alt-right"></i>
                     </a>
         
         
                   </div>
                 </div>`
                document.querySelector("#search_results").insertAdjacentHTML('beforeend', single_product)
            })

            clearInputButton.style.display = "inline-flex"
            show_results()
        }, 200)
    } else {
        hide_results()
    }
}

function show_results() {
    let searchForm = document.querySelector('.search-input')
    /*    console.log(event.target.value, "lol") */
    if (searchForm.value.length >= 2) {
        let search_results = document.querySelector("#search_results")
        let product_container = document.querySelector(".product-container")
        console.log("show results ", search_results, product_container)
        search_results.style.display = "grid"
        product_container.style.display = "none"
        // display search_results div
        // populate/render the individual results
    }
}

function hide_results() {
    // hide search_results div
    let search_results = document.querySelector("#search_results")
    let product_container = document.querySelector(".product-container")

    console.log("hide results ", search_results, product_container)
    search_results.style.display = "none"
    product_container.style.display = "grid"

}

function clear_input() {
    hide_results();
    document.querySelector("input.search-input").value = "";
    clearInputButton.style.display = "none"

}
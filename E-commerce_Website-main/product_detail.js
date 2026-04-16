
 // we are changing the main Big image with the bottom smaller images.

let mainImg = document.getElementById("mainImg");
let sub_Img = document.getElementsByClassName("products_image_selector");

sub_Img[0].onclick = function(){
    mainImg.src = sub_Img[0].src;
}

sub_Img[1].onclick = function(){
    mainImg.src = sub_Img[1].src;
}

// Both the format of the function are valid, we can use any one.

sub_Img[2].addEventListener("click", () =>{
    mainImg.src = sub_Img[2].src;
})

sub_Img[3].addEventListener("click", () =>{
    mainImg.src = sub_Img[3].src;
})

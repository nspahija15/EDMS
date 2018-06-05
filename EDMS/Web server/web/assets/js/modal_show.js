
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

function showModalUser(message,link){

    var show = document.getElementById('showLostObject');

    show.innerHTML = '<div>' +
        '<p class="epoka-style-message" style="text-align: center"> '+message+'</p>' +
        '<div style="margin: auto">' +
        '   <div class="modal-btn-sh"><a type="button" class="epoka-style-btn btn btn-danger" href="'+link+'"> Yes , I am sure </a> &af; ' +
        '   <button type="button" class="epoka-style-btn btn btn-primary" data-dismiss="modal"> No , i am not </button></div> ' +
        '</div>' +
        '</div><div></div>';


}


function DisplayImage(MyImg) {

    var modal = document.getElementById('modal-image');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
//            var img = document.getElementById('MyImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption-m-image");

    modal.style.display = "block";
    modalImg.src = MyImg.src;
    captionText.innerHTML = MyImg.alt;


   // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-image")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    modal.onclick = function(){
        modal.style.display = "none";
    };

}










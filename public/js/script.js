jQuery(function ($) {
$('.js-accordion-title').on('click', function () {
  /*クリックでコンテンツを開閉*/
  $(this).next().slideToggle(200);
  /*矢印の向きを変更*/
  $(this).toggleClass('open', 200);
});

});

//編集モーダル/////////////////////////////////////////////////////////////////////////////
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementById("closeModal");

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

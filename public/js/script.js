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
var btn = document.getElementById("openModal");//ここがボタン
var span = document.getElementById("closeModal");

btn.onclick = function() {//ボタンを押した時の処理
  var post_id = $(this).attr('post_id');
  $('#update_id').val(post_id);//idを受け取る、idをhiddenでcontllorerに渡す。
  var post = $(this).attr('post');
  $('#textarea_id').text(post);//投稿している内容を引っ張ってきて表示する

  modal.style.display = "block";
  return false;
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    return false;
  }
}

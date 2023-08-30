////アコーディオンメニュー///////////////////////////////////////////////////////////
$(function () {
  // タイトルをクリックすると
  $(".js-accordion-title").on("click", function () {
    // クリックした次の要素を開閉
    $(this).next().slideToggle(300);
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open", 300);
  });
});

//編集モーダル/////////////////////////////////////////////////////////////////////////////
var modal = document.getElementById("myModal");
var span = document.getElementById("closeModal");

$(".openModal").each(function () {//$(".openModal")これだけで上と同じみたいな感じでに同時に変数を定義している。.each(function ()つぶやきがある数、.openModalはあるのでそれぞれを使えるように呼び出している。

  $(this).on('click', function () {//ボタンを押した時の処理
    var post_id = $(this).attr('post_id');
    $('#update_id').val(post_id);//idを受け取る、idをhiddenでcontllorerに渡す。

    var post = $(this).attr('post');
    $('#textarea_id').text(post);//投稿している内容を引っ張ってきて表示するtext

    modal.style.display = "block";//モーダルを表示する
    return false;
  });
})


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    return false;
  }
}
//////////////////////////////////////////////////////////////////////////////////////////

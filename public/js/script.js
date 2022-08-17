'use strict';
// 【パスネーム】
const provRegister = '/provRegister/input';
const register = '/register';
const nameChange = '/mypage/nameChange';
const passChange = '/mypage/passwordChange';
const articleDetail = '/articleDetail';
const postArticle = '/postArticle';
const postComment = '/postComment';
const editArticlePage = '/editArticle/edit';
const editCommentPage = '/editComment/edit';
const adminUserDataPage = '/adminUserData';
const adminArticleDataPage = '/adminArticleData';

// console.log(location.pathname)
window.onload = () => {

  //----------------------------------------------------
  // 新規登録ページ
  //----------------------------------------------------
  if (location.pathname === register) {
    let confBtn = document.getElementById('js_confirmBtn');
    let inputList = document.querySelectorAll('.input');
    let errorTxt = document.querySelectorAll('.errorTxt');
    confBtn.disabled = true;

    let emailPattern = /[\w\d_-]+@[\w\d_-]+\.[\w\d._-]+/;
    let passPattern = /\w{10,}/;
    let namePattern = /\w{8,}/;
    let pattern = [emailPattern, passPattern, , namePattern];
    for (let i = 0; i < inputList.length; i++) {
      inputList[i].addEventListener('blur', () => {
        let pass = document.getElementById('pass');
        valiCheck(pattern[i], inputList[i].value, errorTxt[i], confBtn);

        if (i === 2) {
          matchCheck(pass.value, inputList[i].value, errorTxt[i], confBtn)
        }

        registerPageBtnDisabled(inputList, errorTxt, confBtn);
      });
    }
    confBtn.addEventListener('click', () => {
      loginId = inputList[0].value;
      pass = inputList[1].value;
      userName = inputList[3].value;
    });


    //----------------------------------------------------
    // 仮登録ページ
    //----------------------------------------------------
  } else if (location.pathname === provRegister) {
    let preEmail = document.getElementById('js_preEmail');
    let errorTxt = document.getElementById('js_errorTxt');
    let btn = document.getElementById('js_confirmBtn');
    btn.disabled = true;

    preEmail.addEventListener('blur', () => {
      let emailPattern = /[\w\d_-]+@[\w\d_-]+\.[\w\d._-]+/;
      if (valiCheck(emailPattern, preEmail.value, errorTxt, btn)) {
        btn.disabled = false;
      };
    });


    //----------------------------------------------------
    // 名前変更ページ
    //----------------------------------------------------
  } else if (location.pathname === nameChange) {
    // モーダル処理
    let decideBtn = document.getElementById('js_decideBtn');
    let cancelBtn = document.getElementById('js_cancelBtn');
    let modal = document.getElementById('js_changeModal');
    let frame = document.getElementById('js_fadeFrame');
    let inputForm = document.getElementById('js_input');
    decideBtn.disabled = true;
    inputForm.addEventListener('blur', () => {
      if (inputForm.value !== "") {
        decideBtn.disabled = false;
      } else {
        decideBtn.disabled = true;
      }
    })

    decideBtn.addEventListener('click', () => {
      modalProgram(frame, modal, "block");
    });
    cancelBtn.addEventListener('click', () => {
      modalProgram(frame, modal, "none");
    });


    //----------------------------------------------------
    // パスワード変更ページ
    //----------------------------------------------------
  } else if (location.pathname === passChange) {
    let decideBtn = document.getElementById('js_decideBtn');
    let cancelBtn = document.getElementById('js_cancelBtn');
    let modal = document.getElementById('js_changeModal');
    let frame = document.getElementById('js_fadeFrame');
    let inputList = document.querySelectorAll('.inputForm');
    decideBtn.disabled = true;

    for (let i = 0; i < inputList.length; ++i) {
      inputList[i].addEventListener('blur', () => {
        infoPageBtnDisabled(inputList, decideBtn);
      });
    }


    decideBtn.addEventListener('click', () => {
      modalProgram(frame, modal, "block");
    });
    cancelBtn.addEventListener('click', () => {
      modalProgram(frame, modal, "none");
    });


    //----------------------------------------------------
    // 記事詳細ページ
    //----------------------------------------------------
  } else if (location.pathname.indexOf('/article/detail/') !== -1) {

    /***** 《削除ボタンの処理》 *****/
    let frame = document.getElementById('js_fadeFrame');

    if (document.getElementById('js_deleteArticleBtn') !== null) {
      let deleteArticleBtn = document.getElementById('js_deleteArticleBtn');

      deleteArticleBtn.addEventListener('click', () => {
        let deleteArticleModal = document.getElementById('js_deleteArticleModal');
        modalProgram(frame, deleteArticleModal, "block");

        let cancelArticleBtn = document.getElementById('js_cancelArticleBtn');
        cancelArticleBtn.addEventListener('click', () => {
          modalProgram(frame, deleteArticleModal, "none");
        });
      });
    }


    if (document.querySelector('.deleteCommentBtn') !== null) {
      let deleteCommentBtn = document.querySelectorAll('.deleteCommentBtn');
      let deleteCommentModal = document.getElementById('js_deleteCommentModal');


      for (let i = 0; i < deleteCommentBtn.length; ++i) {
        deleteCommentBtn[i].addEventListener('click', () => {
          modalProgram(frame, deleteCommentModal, "block");

          let cancelCommentBtn = document.getElementById('js_cancelCommentBtn');
          cancelCommentBtn.addEventListener('click', () => {
            modalProgram(frame, deleteCommentModal, "none");
          });
        });
      }


      let commentBtn = document.getElementById('js_commentBtn');
      let comment = document.getElementById('js_comment');
      commentBtn.disabled = true;
      comment.addEventListener('blur', ()=> {
        if(comment.value !== "") {
          commentBtn.disabled = false;
        } else if(comment.value === "") {
          commentBtn.disabled = true;
        }
      });
    }


    //----------------------------------------------------
    // 新規投稿ページ
    //----------------------------------------------------
  } else if (location.pathname === postArticle || location.pathname === postComment) {
    let confBtn = document.getElementById('js_confBtn');
    let formList = document.querySelectorAll('.postForm');
    confBtn.disabled = true;

    for (let i = 0; i < formList.length; ++i) {
      formList[i].addEventListener('blur', () => {
        infoPageBtnDisabled(formList, confBtn);
      });
    }


    //----------------------------------------------------
    // 編集ページ
    //----------------------------------------------------
  } else if (location.pathname === editArticlePage || location.pathname === editCommentPage) {
    let confBtn = document.getElementById('js_confBtn');
    let formList = document.querySelectorAll('.postForm');
    confBtn.disabled = true;

    for (let i = 0; i < formList.length; ++i) {
      formList[i].addEventListener('blur', () => {
        infoPageBtnDisabled(formList, confBtn);
      });
    }


    //----------------------------------------------------
    // 管理ページ
    //----------------------------------------------------
  } else if(location.pathname === adminUserDataPage || location.pathname === adminArticleDataPage) {
    let importBtn = document.getElementById('js_importBtn');
    let importFile = document.getElementById('js_importFile');
    importBtn.disabled = true;

    importFile.addEventListener('change', ()=> {
      if(importFile.value === "") {
        importBtn.disabled = true;
      } else if(importFile.value !== "") {
        importBtn.disabled = false;
      }
    });
  }
}




//----------------------------------------------------
// 関数リスト
//----------------------------------------------------
/* バリデーションチェック用 */
function valiCheck(pattern, elm, error, btn) {
  if (!elm.match(pattern)) {
    error.innerHTML = "正確に入力してください";
    btn.disabled = true;
    return false;
  } else if (elm === "") {
    btn.disabled = true;
    return false;
  } else if (elm.match(pattern) && elm !== "") {
    error.innerHTML = "";
    return true;
  }
}

/*　パスワード確認用。一致するかを調べる */
function matchCheck(value, elm, error, btn) {
  if (value !== elm) {
    error.innerHTML = "正確に入力してください";
    btn.disabled = true;
    return false;
  } else if (elm === "") {
    btn.disabled = true;
    return false;
  } else if (value === elm) {
    error.innerHTML = "";
    return true;
  }
}

/*　新規登録ページのボタン有効無効操作 */
function registerPageBtnDisabled(array, error, btn) {
  let count = 0;
  for (let i = 0; i < array.length; i++) {
    if (array[i].value !== "" && error[i].innerHTML === "") {
      ++count;
    } else if (array[i].value === "" && error[i].innerHTML !== "") {
      btn.disabled = true;
    }

    if (count === array.length) {
      btn.disabled = false;
    }
  }
}

/*　ユーザー情報変更ページのボタン有効無効操作 */
function infoPageBtnDisabled(array, btn) {
  let count = 0;
  for (let i = 0; i < array.length; i++) {
    if (array[i].value !== "") {
      ++count;
    } else if (array[i].value === "") {
      btn.disabled = true;
    }

    if (count === array.length) {
      btn.disabled = false;
    }
  }
}

/*　モーダルの表示非表示 */
function modalProgram(frame, modal, key) {
  frame.style.display = key;
  modal.style.display = key;
}
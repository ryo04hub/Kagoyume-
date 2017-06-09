<?php

/* -------------------------------------------------------------------

共通関数

------------------------------------------------------------------- */

/**
 * @brief 「トップへ戻る」リンクを返す関数
 *
 */

function return_top(){
   return "<a href='".ROOT_URL."'>トップへ戻る</a>";
 }

/**
 * フォームの再入力時に、すでにセッションに対応した値があるときはその値を返却する
 * @param string $name formのname属性
 * @return string セッションに入力されていた値
 */
function form_value($name){
    if(isset($_POST['mode']) && $_POST['mode']=='REINPUT'){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}

/**
 * ポストからセッションに存在チェックしてから値を渡す。
 * 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
 * @param string $name
 * @return string ポストに格納した値
 */
function bind_p2s($value){
  if(!empty($_POST[$value])){
    $_SESSION[$value] = $_POST[$value];
    return $_POST[$value];
  }else{
    $_SESSION[$value] = null;
    return null;
  }
}

/**
 * @brief 特殊文字を HTML エンティティに変換する
 *
 * これは、htmlspecialchars()を使いやすくするための関数です。
 * htmlspecialchars() http://jp.php.net/htmlspecialcharsより
 *   文字の中には HTML において特殊な意味を持つものがあり、
 *   それらの本来の値を表示したければ HTML の表現形式に変換してやらなければなりません。
 *   この関数は、これらの変換を行った結果の文字列を返します。
 *
 *   '&' (アンパサンド) は '&amp;' になります。
 *   ENT_QUOTES が設定されている場合のみ、 ''' (シングルクオート) は '&#039;'になります。
 *   '<' (小なり) は '&lt;' になります。
 *   '>' (大なり) は '&gt;' になります。
 *   ''' (シングルクオート) は '&#039;'になります。
 *
 * echo h("<>&'\""); //&lt;&gt;&amp;&#039;&quotと出力します。
 *
 * @param string $str 変換したい文字列
 *
 * @return string html用に変換した文字列
 *
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}


?>

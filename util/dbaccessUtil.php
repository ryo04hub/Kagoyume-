<?php

/** @mainpage
 *  DB関連関数
 */

/**
 * @file
 * @brief DB関連関数
 *
 * DB関連で使用する設定・関数を集めたファイルです。
 *
 * PHP version 7
 *
 */


/* -------------------------------------------------------------------

  接続

------------------------------------------------------------------- */

/**
 * @brief DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
 *
 * @param null
 * @return pdoクラス セッションに入力されていた値
 */

function connect2MySQL()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=kagoyume_db;charset=utf8', 'root', '');
        //SQL実行時のエラーをtry-catchで取得できるように設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}

/* -------------------------------------------------------------------

  ユーザー関連

------------------------------------------------------------------- */

/**
 * @brief テーブル「user_t」にレコードの挿入を行う。失敗した場合はエラー文を返却する
 *
 * @param string $username ユーザー名
 * @param string $password パスワード
 * @param string $mail メールアドレス
 * @param string $address 住所
 * @return null エラーが起きた場合はエラー文(string)を返す
 *
 */

function insert_users($username, $password, $mail, $address)
{
    //db接続を確立
    $insert_db = connect2MySQL();
    //DBに全項目のある1レコードを登録するSQL
    $insert_sql = 'INSERT INTO user_t(name,password,mail,address,newDate)'
            .'VALUES(:name,:password,:mail,:address,:newDate)';
    //現在時をdatetime型で取得
    $datetime = new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');
    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);
    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':name', $username);
    $insert_query->bindValue(':password', $password);
    $insert_query->bindValue(':mail', $mail);
    $insert_query->bindValue(':address', $address);
    $insert_query->bindValue(':newDate', $date);
    //SQLを実行
    try {
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db = null;
        return $e->getMessage();
    }
    $insert_db = null;
    return null;
}


/**
 * @brief テーブル「user_t」のレコードの更新を行う。失敗した場合はエラー文を返却する
 *
 * @param int $userID ユーザーID
 * @param string $username ユーザー名
 * @param string $password パスワード
 * @param string $mail メールアドレス
 * @param string $address 住所
 * @return null エラーが起きた場合はエラー文(string)を返す
 *
 */

function update_users($userID, $username, $password, $mail, $address)
{
    //db接続を確立
    $update_db = connect2MySQL();
    //DBに全項目のある1レコードを登録するSQL
    $update_sql = 'UPDATE user_t SET name = :name, password = :password, mail = :mail, address = :address, newDate = :newDate'.
                  ' WHERE userID = :userID';
    //現在時をdatetime型で取得
    $datetime = new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');
    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);
    //SQL文にセッションから受け取った値＆現在時をバインド
    $update_query->bindValue(':userID', $userID);
    $update_query->bindValue(':name', $username);
    $update_query->bindValue(':password', $password);
    $update_query->bindValue(':mail', $mail);
    $update_query->bindValue(':address', $address);
    $update_query->bindValue(':newDate', $date);
    //SQLを実行
    try {
        $update_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $update_db = null;
        return $e->getMessage();
    }
    $update_db = null;
    return null;
}

/**
 * @brief テーブル「user_t」内で検索を行う。失敗した場合はエラー文を返却する
 *
 * @param string $username ユーザー名
 * @return array ユーザー情報を連想配列で返す
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function search_users($username){

  $search_db = connect2MySQL();
  $search_sql = 'SELECT * FROM user_t WHERE name = :name';

  $search_query = $search_db->prepare($search_sql);
  $search_query->bindValue(':name', $username);

  try {
      $search_query->execute();
  } catch (PDOException $e) {
      $search_db = null;
      return $e->getMessage();
  }

  return $search_query->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * @brief $usernameを用いてuserIDを返す
 *
 * @param string $username ユーザー名
 * @return int ユーザーID
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function return_userID($username){

  $return_userID_db = connect2MySQL();
  $return_userID_sql = 'SELECT userID FROM user_t WHERE name = :name';
  $return_userID_query = $return_userID_db->prepare($return_userID_sql);
  $return_userID_query->bindValue(':name', $username);

  try {
      $return_userID_query->execute();
  } catch (PDOException $e) {
      $return_userID_db = null;
      return $e->getMessage();
  }
  return $return_userID_query->fetchColumn();
}

/**
 * @brief deleteFlgを0から1に更新する
 *
 * @param int $userID ユーザーID
 * @return null
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function delete_user($userID){
  $delete_user_db = connect2MySQL();
  $delete_user_sql = 'UPDATE user_t SET deleteFlg = 1 WHERE userID = :userID';
  $delete_user_query = $delete_user_db->prepare($delete_user_sql);
  $delete_user_query->bindValue(':userID', $userID);
  try {
      $delete_user_query->execute();
  } catch (PDOException $e) {
      $delete_user_db = null;
      return $e->getMessage();
  }
  $delete_user_db = null;
  return null;
}


/* -------------------------------------------------------------------

  商品データ関連

------------------------------------------------------------------- */

/**
 * @brief 購入金額を今までの合計金額(total)に足す
 *
 * @param string $username ユーザー名
 * @param int $totalPrice 合計金額
 * @return null
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function total_price_add($userID, $totalPrice){

  $totalPrice_db = connect2MySQL();
  $totalPrice_sql = 'UPDATE user_t SET total = total + :total WHERE userID = :userID';
  $totalPrice_query = $totalPrice_db->prepare($totalPrice_sql);
  $totalPrice_query->bindValue(':total', $totalPrice);
  $totalPrice_query->bindValue(':userID', $userID);

  try {
      $totalPrice_query->execute();
  } catch (PDOException $e) {
      $totalPrice_db = null;
      return $e->getMessage();
  }
  $totalPrice_db = null;
  return null;
}

/**
 * @brief 購入情報をテーブル「buy_t」に挿入する
 *
 * @param int $userID ユーザーID
 * @param string $itemCode 商品コード
 * @param int $type 発送方法
 * @return null
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function insert_items($userID, $itemCode, $type){

  $insert_items_db = connect2MySQL();
  $insert_items_sql = 'INSERT INTO buy_t(userID, itemCode, type, buyDate)'
                   .'VALUES(:userID, :itemCode, :type, :buyDate)';
  $datetime = new DateTime();
  $buyDate = $datetime->format('Y-m-d H:i:s');
  $insert_items_query = $insert_items_db->prepare($insert_items_sql);
  $insert_items_query->bindValue(':userID', $userID);
  $insert_items_query->bindValue(':itemCode', $itemCode);
  $insert_items_query->bindValue(':type', $type);
  $insert_items_query->bindValue(':buyDate', $buyDate);
  try {
      $insert_items_query->execute();
  } catch (PDOException $e) {
      $insert_items_db = null;
      return $e->getMessage();
  }
  $insert_items_db = null;
  return null;
}

/**
 * @brief テーブル「buy_t」内で検索をする
 *
 * @param int $userID ユーザーID
 * @return array 検索結果を連想配列で返す
 * @return string エラーが起きた場合はエラー文を返す
 *
 */

function search_items($userID){

  $search_items_db = connect2MySQL();
  $search_items_sql = 'SELECT * FROM buy_t WHERE userID = :userID';
  $search_items_query = $search_items_db->prepare($search_items_sql);
  $search_items_query->bindValue(':userID', $userID);

  try {
      $search_items_query->execute();
  } catch (PDOException $e) {
      $search_items_db = null;
      return $e->getMessage();
  }
  return $search_items_query->fetchAll(PDO::FETCH_ASSOC);

}

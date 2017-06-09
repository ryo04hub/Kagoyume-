<?php

/** @mainpage
 * Yahoo!ショッピングWeb APISDK共通関数
 */

/**
 * @file
 * @brief Yahoo!ショッピングWeb APISDK共通関数
 *
 * Yahoo!ショッピングWeb APISDKで、共通で使用する設定・関数を集めたファイルです。
 *
 * PHP version 7
 *
 */


/* -------------------------------------------------------------------

  検索を絞るデータ(appID、category_id、sort)

------------------------------------------------------------------- */

/**
 * @brief
 * class YAHOO_API_DATA
 * 検索結果が記されたXML生成に必要なプロパティ(配列)が入っています。
 *
 */
class YAHOO_API_DATA{

/**
 * @brief アプリケーションID
 * @var string
 */
protected static $appid = "dj0zaiZpPVptT1JUdkZhZ1RFSCZzPWNvbnN1bWVyc2VjcmV0Jng9MTY-";
//取得したアプリケーションIDを設定

/**
 * @brief カテゴリーID一覧
 *
 * @var array
 */
public static $categories = array(
                    "1" => "すべてのカテゴリから",
                    "13457"=> "ファッション",
                    "2498"=> "食品",
                    "2500"=> "ダイエット、健康",
                    "2501"=> "コスメ、香水",
                    "2502"=> "パソコン、周辺機器",
                    "2504"=> "AV機器、カメラ",
                    "2505"=> "家電",
                    "2506"=> "家具、インテリア",
                    "2507"=> "花、ガーデニング",
                    "2508"=> "キッチン、生活雑貨、日用品",
                    "2503"=> "DIY、工具、文具",
                    "2509"=> "ペット用品、生き物",
                    "2510"=> "楽器、趣味、学習",
                    "2511"=> "ゲーム、おもちゃ",
                    "2497"=> "ベビー、キッズ、マタニティ",
                    "2512"=> "スポーツ",
                    "2513"=> "レジャー、アウトドア",
                    "2514"=> "自転車、車、バイク用品",
                    "2516"=> "CD、音楽ソフト",
                    "2517"=> "DVD、映像ソフト",
                    "10002"=> "本、雑誌、コミック"
                    );

/**
 * @brief ソート方法一覧
 *
 * @var array
 *
 */
public static $sortOrder = array(
                   "-score" => "おすすめ順",
                   "+price" => "商品価格が安い順",
                   "-price" => "商品価格が高い順",
                   "+name" => "ストア名昇順",
                   "-name" => "ストア名降順",
                   "-sold" => "売れ筋順"
                   );

}


/* -------------------------------------------------------------------

  YAHOO_MODEL(XMLデータ、オブジェクトの生成)

------------------------------------------------------------------- */

/**
 * @brief
 * YAHOO_MODEL
 *
 * 受け取った検索キーワード、カテゴリーID、種類でXMLを生成し、
 * それをオブジェクト変換して返します。
 *
 */

class YAHOO_MODEL extends YAHOO_API_DATA{

  protected $itemListXML = null;

  public function setItemListXML($category_id, $query, $sort){
    $query4url = rawurlencode($query);
    $sort4url = rawurlencode($sort);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=" .
           YAHOO_API_DATA::$appid . "&query=$query4url&category_id=$category_id&sort=$sort4url&hits=10";
    $this->itemListXML = simplexml_load_file($url);
    return $this;
  }

  public function getItemlListXML(){
    return $this->itemListXML;
  }

  public function setItemDetailXML($itemcode){
    $code4url = rawurlencode($itemcode);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=" .
            YAHOO_API_DATA::$appid ."&itemcode=$code4url&responsegroup=large";
    $this->itemDetailXML = simplexml_load_file($url);
    return $this;
  }

  public function getItemDetailXML(){
     return $this->itemDetailXML;
   }

}


/* -------------------------------------------------------------------

  YAHOO_CONTROLLER(生成したXMLオブジェクトをビューに渡す)

------------------------------------------------------------------- */

/**
 * @brief
 * YAHOO_CONTROLLER
 *
 *
 *
 */

class YAHOO_CONTROLLER
{
  public static function deliveryItemList($category_id, $query, $sort)
  {
    $yahooModel = new YAHOO_MODEL();
    $xml = $yahooModel->setItemListXML($category_id, $query, $sort)
                      ->getItemlListXML();
    if ($xml["totalResultsReturned"] != null) { //検索件数がnullでない場合
      return $xml;
    } else {
      return null;
    }
  }

  public static function getItemDetail($itemcode)
  {
    $yahooModel = new YAHOO_MODEL();
    $xml = $yahooModel->setItemDetailXML($itemcode)
                      ->getItemDetailXML();
    return $xml;
  }

}

?>

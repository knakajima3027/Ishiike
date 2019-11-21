<?php
//var_dump($_POST);
//最初に変数を定義しておかないとエラーになる
$err_msg1 = "";
$err_msg2 = "";
$err_msg3 = "";
$err_msg4 = "";
$err_msg5 = "";
$message = "";
$sub_name = ( isset( $_POST["sub_name"] ) === true ) ?$_POST["sub_name"]: "";
$tea_name  = ( isset( $_POST["tea_name"] )  === true ) ?  trim($_POST["tea_name"]) : "";
$degree = ( isset( $_POST["degree"]) === true ) ? trim($_POST["degree"]) : "";
$test = ( isset( $_POST["test"]) === true ) ? trim($_POST["test"]) : "";
$report = ( isset($_POST["report"]) === true ) ? trim($_POST["report"]) : "";
 
//投稿がある場合のみ処理を行う
if (  isset($_POST["send"] ) ===  true ) {
    if ( $sub_name   === "" ) $err_msg1 = "授業の名前を入力してください"; 
 
    if ( $tea_name  === "" )  $err_msg2 = "教員の名前を入力してください";

    if ( $degree === "" ) $err_msg3 = "楽単度合いを入力してください";

    if ( $test === "" ) $err_msg4 = "テストがあるか入力してください";

    if ( $report === "" ) $err_msg5 = "レポートがあるか入力してください";
 
    if( $err_msg1 === "" && $err_msg2 === "" && $err_msg3 === "" && $err_msg4 === "" && $err_msg5 = "" ){
        $fp = fopen( "data.txt" ,"a" );
        fwrite( $fp ,  $sub_name."\t".$tea_name."\t".$degree."\t".$test."\t".$report."\n" );
        $message ="書き込みに成功しました。";
    }
 
}
 
$fp = fopen("data.txt","r");
 
$dataArr= array();
while( $res = fgets( $fp)){
    $tmp = explode("\t",$res);
    $arr = array(
        "sub_name"=>$tmp[0],
        "tea_name"=>$tmp[1],
        "degree"=>$tmp[2],
        "test"=>$tmp[3],
        "report"=>$tmp[4]
    );
    $dataArr[]= $arr;
} 
 
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>石池｜Ishiike</title>
    </head>
    <body>
        <?php echo $message; ?>
        <form method="post" action="">
        授業名：<input type="text" name="sub_name" value="<?php echo $sub_name; ?>" >
            <?php echo $err_msg1; ?><br>
            教員名：<textarea  name="tea_name" rows="1" cols="40"><?php echo $tea_name; ?></textarea>
            <?php echo $err_msg2; ?><br>
            楽単度：<textarea name="degree" rows="1" cols="40"><?php echo $degree; ?></textarea>
            <?php echo $err_msg3; ?><br>
            テストの有無：<textarea name="test" rows="1" cols="40"><?php echo $test; ?></textarea>
            <?php echo $err_msg4; ?><br>
            レポートの有無：<textarea name="report" rows="1" cols="40"><?php echo $report; ?></textarea>
            <?php echo $err_msg5; ?><br>
<br>
          <input type="submit" name="send" value="投稿" >
        </form>
        <dl>
         <?php foreach( $dataArr as $data ):?>
         <p><span><?php echo $data["sub_name"]; ?></span>:
         <span><?php echo $data["tea_name"]; ?></span>:
         <span><?php echo $data["degree"]; ?></span>:
         <span><?php echo $data["test"]; ?></span>:
         <span><?php echo $data["report"]; ?></span></p>
        <?php endforeach;?>
</dl>
    </body>
</html>

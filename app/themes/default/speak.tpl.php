<!DOCTYPE HTML>
<html>
<head>
    <meta charset='utf-8'/>
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1"/>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/themes/default/speak/speak.css" />
</head>
<body>
<div class="w100 con-wrap">
    <?
    foreach($list as $row)
    {
        $pic=$row['picture'];
        if($pic){
            $content="<img src='{$row['picture']}'>";
        }else{
            $content=nl2br($row['content']);
        }
        if($row['is_self']==1){
            $class='noself';
            $fac=$speak['face1'];
        }else{
            $class='';
            $fac=$speak['face2'];
        }
        ?>
        <div class="msg-item <?=$class?>">
            <div class="tx"><img src="<?=$fac?>" alt=""></div>
            <div class="con">
                <div class="txt"><p><?=$content?></p></div>
                <em><?=$row['time1']?></em>
            </div>
            <i></i>
        </div>
    <?
    }
    ?>
</div>
<script>
    window.onload = function(){
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 640) deviceWidth = 640;
        document.documentElement.style.fontSize = deviceWidth / 6.4 + 'px';
    }
</script>
</body>
</html>
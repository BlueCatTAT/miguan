<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>操作成功</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                padding: 0px;
                margin: 0px;
                background: #CCCCCC;
            }
            .mainContainer{
                margin-top:100px;
                padding: 0;
                overflow: hidden;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
            .errorContainer{
                width: 550px;
                margin:0px auto;
                padding: 0px;
                text-align:center;
            }
            .errorCode{
                font-size: 140px;
                font-weight: normal;
                text-shadow: 2px 2px 0 #ffffff;
                display: block;
                color: #707070;
                line-height: 140px;
                margin:10px 0;
            }
            .errorContainer .errorSpan {
                font-size: 22px;
                text-shadow: 0px 1px 0 #ffffff;
                display: block;
                color: #707070;
                line-height: 30px;
                margin-bottom: 20px;
                color: #fff;
                background-color: #c9302c;
                border-color: #ac2925;
                border-radius: 3px;
                line-height: 21px;
                padding: 8px 15px;
            }
            .errorContainer .successSpan{
                font-size: 22px;
                text-shadow: 0px 1px 0 #ffffff;
                display: block;
                color: #707070;
                line-height: 30px;
                margin-bottom: 20px;
                color: #fff;
                background-color: #449d44;
                border-color: #398439;
                border-radius: 3px;
                line-height: 21px;
                padding: 8px 15px;
            }
            .alert{
                border-radius: 3px;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
            }
            .alert-danger {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
            }
            .alert-success {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
            }
            .button{
                font:15px Calibri, Arial, sans-serif;
                text-shadow:1px 1px 0 rgba(255,255,255,0.4);
                text-decoration:none !important;
                white-space:nowrap;
                display:inline-block;
                vertical-align:baseline;
                position:relative;
                cursor:pointer;
                padding:10px 20px;
                -moz-border-radius:8px;
                -webkit-border-radius:8px;
                border-radius:8px;
                -moz-box-shadow:0 0 1px #fff inset;
                -webkit-box-shadow:0 0 1px #fff inset;
                box-shadow:0 0 1px #fff inset;
                -webkit-transition:background-position 1s;
                -moz-transition:background-position 1s;
                transition:background-position 1s;
            }
            .button:hover{
                background-position:top left;
                background-position:top left, bottom right, 0 0, 0 0;
            }
            .button:active{
                bottom:-1px;
            }
            .button.big		{ font-size:30px;}
            .button.medium	{ font-size:18px;}
            .button.small	{ font-size:13px;}
            .button.rounded{
                -moz-border-radius:4em;
                -webkit-border-radius:4em;
                border-radius:4em;
            }
            .blue.button{
                color:#0f4b6d !important;
                border:1px solid #84acc3 !important;
                background-color: #48b5f2;
                background-image:	-moz-radial-gradient(	center bottom, circle,
                    rgba(89,208,244,1) 0,rgba(89,208,244,0) 100px),
                    -moz-linear-gradient(#4fbbf7, #3faeeb);
                background-image:	-webkit-gradient(	radial, 50% 100%, 0, 50% 100%, 100,
                    from(rgba(89,208,244,1)), to(rgba(89,208,244,0))),
                    -webkit-gradient(linear, 0% 0%, 0% 100%, from(#4fbbf7), to(#3faeeb));
            }
            .blue.button:hover{
                background-color:#63c7fe;
                background-image:-moz-radial-gradient(	center bottom, circle,
                    rgba(109,217,250,1) 0,rgba(109,217,250,0) 100px),
                    -moz-linear-gradient(#63c7fe, #58bef7);

                background-image:-webkit-gradient(	radial, 50% 100%, 0, 50% 100%, 100,
                    from(rgba(109,217,250,1)), to(rgba(109,217,250,0))),
                    -webkit-gradient(linear, 0% 0%, 0% 100%, from(#63c7fe), to(#58bef7));
            }

            /* Green Button */
            .green.button{
                color:#345903 !important;
                border:1px solid #96a37b !important;	
                background-color: #79be1e;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(162,211,30,1) 0,rgba(162,211,30,0) 100px),-moz-linear-gradient(#82cc27, #74b317);
                background-image:-webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(162,211,30,1)), to(rgba(162,211,30,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#82cc27), to(#74b317));
            }
            .green.button:hover{
                background-color:#89d228;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(183,229,45,1) 0,rgba(183,229,45,0) 100px),-moz-linear-gradient(#90de31, #7fc01e);
                background-image:-webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(183,229,45,1)), to(rgba(183,229,45,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#90de31), to(#7fc01e));
            }
            .orange.button{
                color:#693e0a !important;
                border:1px solid #bea280 !important;	
                background-color: #e38d27;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(232,189,45,1) 0,rgba(232,189,45,0) 100px),-moz-linear-gradient(#f1982f, #d4821f);
                background-image:-webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(232,189,45,1)), to(rgba(232,189,45,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#f1982f), to(#d4821f));
            }
            .orange.button:hover{
                background-color:#ec9732;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(241,192,52,1) 0,rgba(241,192,52,0) 100px),-moz-linear-gradient(#f9a746, #e18f2b);
                background-image:-webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(241,192,52,1)), to(rgba(241,192,52,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#f9a746), to(#e18f2b));
            }
            .gray.button{
                color:#525252 !important;
                border:1px solid #a5a5a5 !important;	
                background-color: #a9adb1;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(197,199,202,1) 0,rgba(197,199,202,0) 100px),-moz-linear-gradient(#c5c7ca, #92989c);
                background-image:-webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(197,199,202,1)), to(rgba(197,199,202,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#c5c7ca), to(#92989c));
            }
            .gray.button:hover{
                background-color:#b6bbc0;
                background-image:-moz-radial-gradient(center bottom, circle, rgba(202,205,208,1) 0,rgba(202,205,208,0) 100px),-moz-linear-gradient(#d1d3d6, #9fa5a9);
                background-image: -webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100, from(rgba(202,205,208,1)), to(rgba(202,205,208,0))),-webkit-gradient(linear, 0% 0%, 0% 100%, from(#d1d3d6), to(#9fa5a9));
            }
            .subhead{
                text-align: center;
               height: 150px;
                background: linear-gradient(45deg, #002C39 0%, #00C9FF 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2) inset, 0 -3px 7px rgba(0, 0, 0, 0.2) inset;
                color: #fff;
                text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4), 0 0 30px rgba(0, 0, 0, 0.075);
            }
            .subhead:after {
                background: url("/Public/Home/images/common/bs-docs-masthead-pattern.png") repeat scroll center center rgba(0, 0, 0, 0);
                bottom: 0;
                content: "";
                display: block;
                left: 0;
                opacity: 0.4;
                position: absolute;
                right: 0;
                top: 0;
            }
            .subhead img{
                margin-top: 30px;
            }
            a{
                color: #555555;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class='subhead'>
        </div>
        <div class='mainContainer'>
            <div class='errorContainer'>
                <div class="alert alert-success">
                    <p><strong><?php echo($message); ?></strong></p>
                    <p class="detail"></p>
                    <p class="jump">
                        页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
                    </p>
                </div>
                <a href='/Admin' class='button small gray'>回首页</a>
            </div>
        </div>
        
        <script type="text/javascript">
            (function() {
                var wait = document.getElementById('wait'), href = document.getElementById('href').href;
                var interval = setInterval(function() {
                    var time = --wait.innerHTML;
                    if (time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    }
                    ;
                }, 1000);
            })();
        </script>
        
        
    </body>
</html>
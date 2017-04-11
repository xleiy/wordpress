<? /* Template Name: About模板 */ ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>About</title>
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <meta name="keywords" content="<?php bloginfo('name'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/kontext.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/icon.css" type="text/css" media="screen" />
        <script src="<?php bloginfo('template_url'); ?>/js/kontext.js"></script>
        <?php wp_head(); ?>
    </head>

    <?php
/**
  * 获取Bing每日壁纸和故事
  * @author giuem
  */
    function bingImgFetch(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=3');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $re = curl_exec($ch);
        curl_close($ch);
        $re = json_decode($re,1);//电脑版返回内容
        $re2 = json_decode(file_get_contents('http://cn.bing.com/cnhp/coverstory/'),1);//移动版返回内容
        return array(
            /* 更改图片尺寸，减小体积 */
            'url0' => str_replace('1920x1080','1366x768',$re['images'][0]['url']),
            'url1' => str_replace('1920x1080','1366x768',$re['images'][1]['url']),
            'url2' => str_replace('1920x1080','1366x768',$re['images'][2]['url']),
            /* 结束日期 */
            'date' => date('j',strtotime($re['images'][0]['enddate'])),
            /* 故事标题 */
            'title' => $re2['title'],
            /* 内容 */
            'd' => $re2['para1']
        );
    }
    $bingimg = bingImgFetch();
    ?>

    <body <?php body_class(); ?>>
    <!-- <img src="http://cn.bing.com/<?php echo $bingimg['url'];?>"> -->
        <article class="kontext">
            <!-- 第一个页面 -->
            <div class="layer one show" id='1'>
                <div><h2>谢磊</h2></div>
                <div class="sidebar">
                <div class="social-links">
                <ul>
                    <li class="social-link" title="home"><a href="<?php echo home_url(); ?>" class="link-home"><i class="iconfont icon-home" style="color: #fff;font-size: 139%;"></i></a></li>
                    <li class="social-link" title="github"><a href="https://github.com/xleiy" target="_blank" class="link-github"><i class="icon icon-github"></i></a></li>
                    <li class="social-link" title="twitter"><a href="https://twitter.com/xleiyao" target="_blank" class="link-twitter"><i class="icon icon-twitter"></i></a></li>
                    <li class="social-link" title="weibo"><a href="http://weibo.com/xleiyme" target="_blank" class="link-weibo"><i class="icon icon-weibo"></i></a></li>
                    <li class="social-link"><a href="mailto:xlei1139987950@gmail.com" target="_self" class="link-mail"><i class="icon icon-mail"></i></a></li>
                </ul>
            </div>
            </div>
            </div>
            <!-- 第二个页面 -->
            <div class="layer two" id="2">
                <h2>Layer Two</h2>
            </div>
            <!-- 第三个页面 -->
            <div class="layer three" id="3">
                <h2>Layer Three</h2>
            </div>
        </article>
        <ul class="bullets">
        </ul>
        </article>
        <script type="text/javascript">
        // Create a new instance of kontext
        var k = kontext(document.querySelector('.kontext'));
        // API METHODS:
         k.prev(); // Show prev layer
         k.next(); // Show next layer
         k.show( 3 ); // Show specific layer
         k.getIndex(); // Index of current layer
         k.getTotal(); // Total number of layers


        // DEMO-SPECIFIC:

        var bulletsContainer = document.body.querySelector('.bullets');

        var element = document.getElementsByClassName("layer");
        element[0].style.backgroundImage="url(http://cn.bing.com/<?php echo $bingimg['url0'];?>)";
        element[1].style.backgroundImage="url(http://cn.bing.com/<?php echo $bingimg['url1'];?>)";
        element[2].style.backgroundImage="url(http://cn.bing.com/<?php echo $bingimg['url2'];?>)";

        // Create one bullet per layer
        for (var i = 0, len = k.getTotal(); i < len; i++) {

            var bullet = document.createElement('li');
            bullet.className = i === 0 ? 'active' : '';
            bullet.setAttribute('index', i);
            bullet.onclick = function(event) {
                k.show(event.target.getAttribute('index'))
            };
            bullet.ontouchstart = function(event) {
                k.show(event.target.getAttribute('index'))
            };
            bulletsContainer.appendChild(bullet);
        }

        // Update the bullets when the layer changes
        k.changed.add(function(layer, index) {
            var bullets = document.body.querySelectorAll('.bullets li');
            for (var i = 0, len = bullets.length; i < len; i++) {
                bullets[i].className = i === index ? 'active' : '';
            }
        });

        document.addEventListener('keyup', function(event) {
            if (event.keyCode === 37) k.prev();
            if (event.keyCode === 39) k.next();
        }, false);

        var touchX = 0;
        var touchConsumed = false;

        document.addEventListener('touchstart', function(event) {
            touchConsumed = false;
            lastX = event.touches[0].clientX;
        }, false);

        document.addEventListener('touchmove', function(event) {
            event.preventDefault();

            if (!touchConsumed) {
                if (event.touches[0].clientX > lastX + 10) {
                    k.prev();
                    touchConsumed = true;
                } else if (event.touches[0].clientX < lastX - 10) {
                    k.next();
                    touchConsumed = true;
                }
            }
        }, false);
        </script>
    </body>

 </html>

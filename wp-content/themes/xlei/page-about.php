<? /* Template Name: About模板 */ ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>About</title>
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <meta name="keywords" content="<?php bloginfo('name'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/kontext.css">
        <script src="<?php bloginfo('template_url'); ?>/js/kontext.js"></script>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <article class="kontext">
            <!-- 第一个页面 -->
            <div class="layer one show">
                <h2>Kontext</h2>
                <p>A context-shift transition. Use the dots below or your keyboard arrows.</p>
            </div>
            <!-- 第二个页面 -->
            <div class="layer two">
                <h2>Layer Two</h2>0
            </div>
            <!-- 第三个页面 -->
            <div class="layer three">
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

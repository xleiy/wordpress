
jQuery.extend(jQuery.easing, {
  easeInOutBack: function(e, f, a, i, h, g) {
    if (g == undefined) {
      g = 1.70158
    }
    if ((f /= h / 2) < 1) {
      return i / 2 * (f * f * (((g *= (1.525)) + 1) * f - g)) + a
    }
    return i / 2 * ((f -= 2) * f * (((g *= (1.525)) + 1) * f + g) + 2) + a
  }
});~ (function(f) {
  f.fn.colorTip = function(a) {
    var b = {
      color: "black",
      timeout: 800
    };
    a = f.extend(b, a);
    return this.each(function() {
      var l = f(this);
      if (!l.attr("title")) {
        return true
      }
      l.addClass(a.color);
      var c = new e();
      var j = l.attr("title"),
      k = new d(j);
      l.append(k.generate()).addClass("colorTipContainer");
      l.hover(function() {
        l.removeAttr("title");
        k.show();
        c.clear()
      },
      function() {
        c.set(function() {
          k.hide();
          l.attr("title", j)
        },
        a.timeout)
      })
    })
  };
  function e() {}
  e.prototype = {
    set: function(b, a) {
      this.timer = setTimeout(b, a)
    },
    clear: function() {
      this.timer = null;
      clearTimeout(this.timer)
    }
  };
  function d(a) {
    this.content = a;
    this.shown = false
  }
  d.prototype = {
    generate: function() {
      return this.tip || (this.tip = f('<span class="colorTip"><span class="pointyTip"></span>' + this.content + '</span>'))
    },
    show: function() {
      if (this.shown) {
        return
      }
      this.tip.css("margin-left", -this.tip.outerWidth() / 2).fadeIn("fast");
      this.shown = true
    },
    hide: function() {
      this.tip.fadeOut();
      this.shown = false
    }
  }
})(jQuery);
jQuery(document).ready(function($) {
  var a1 = $('#a1'),
  a2 = $('#a2'),
  a3 = $('#a3'),
  a4 = $('#a4'),
  a5 = $('#a5'),
  a7 = $('#a7'),
  a8 = $('#a8'),
  a0 = $('.post-count'),
  data_year = '博客建立于2017-03-11',
  data_month = a4.attr('data-month'),
  data_days = a3.attr('data-days'),
  w = a1.width(),
  h = a1.height(),
  n = a0.length,
  l = (w - n * 70) / 2
  aniDataA = 600,
  aniDataB = 600;
  a2.text(data_year).css({
    left: w
  });
  a3.text('一共' + data_days + '天').css({
    left: w
  });
  a4.text(data_month + '个月啦~').css({
    left: w
  });
  a5.text(data_month + '个文章存档').css({
    left: w
  });
  a0.each(function() {
    $(this).css({
      left: l
    });
    l += 70;
  });
  setTimeout(function() {
    a1.animate({
      left: -w
    },
    800, 'easeInOutBack',
    function() {
      a1.hide();
      a2.show().animate({
        left: 0
      },
      800, 'easeInOutBack',
      function() {
        setTimeout(function() {
          a2.animate({
            'margin-top': '-=50px'
          },
          800, 'easeInOutBack',
          function() {
            a3.show().animate({
              left: 0
            },
            800,
            function() {
              a3.animate({
                left: '-=100px'
              },
              800, 'easeInOutBack');
              a4.show().animate({
                left: 220
              },
              800, 'easeInOutBack',
              function() {
                setTimeout(function() {
                  a2.animate({
                    left: -w
                  },
                  800, 'easeInOutBack',
                  function() {
                    a2.hide();
                  });
                  setTimeout(function() {
                    a3.animate({
                      left: -w
                    },
                    800, 'easeInOutBack',
                    function() {
                      a3.hide();
                    });
                    setTimeout(function() {
                      a4.animate({
                        left: -w
                      },
                      800, 'easeInOutBack',
                      function() {
                        a4.hide();
                        setTimeout(function() {
                          a5.animate({
                            left: 0
                          },
                          800, 'easeInOutBack',
                          function() {
                            setTimeout(function() {
                              a5.animate({
                                'margin-top': '-=100px'
                              },
                              600, 'easeInOutBack');
                              ani_a();
                              setTimeout(ani_b, 1300);
                              setTimeout(function() {
                                a5.animate({
                                  'margin-top': '-=600px'
                                },
                                1200, 'easeInOutBack',
                                function() {
                                  a5.hide();
                                });
                                a0.animate({
                                  bottom: '-1000px'
                                },
                                1200, 'easeInOutBack',
                                function() {
                                  a0.hide();
                                });
                                setTimeout(function() {
                                  a7.fadeIn(800,
                                  function() {
                                    setTimeout(function() {
                                      a7.animate({
                                        'margin-top': '-=50px'
                                      },
                                      800);
                                      a8.fadeIn(800,
                                      function() {
                                        $("#a8 a").colorTip({});
                                      });
                                    },
                                    800);
                                  });
                                },
                                800);
                              },
                              7000);
                            },
                            1000);
                          });
                        },
                        300);
                      });
                    },
                    200)
                  },
                  200)
                },
                2000);
              });
            });
          });
        },
        400);
      });
    })
  },
  2000);
  function ani_a() {
    a0.each(function(index) {
      $(this).animate({
        bottom: 50
      },
      aniDataA, 'easeInOutBack');
      aniDataA += 50;
    });
  }
  function ani_b() {
    a0.each(function(index) {
      var txt = $(this).attr('data-count');
      $(this).children('span.height').animate({
        height: txt * 40
      },
      aniDataB, 'easeInOutBack');
      ani_c($(this).children('span.count'), txt, aniDataB / txt);
      aniDataB += 200;
    });
  }
  function ani_c(elem, x, t) {
    var k = parseInt(elem.text());
    if (k < x) {
      k++;
      elem.text(k);
      setTimeout(function() {
        ani_c(elem, x)
      },
      t);
    } else {
      return false;
    }
  }
});


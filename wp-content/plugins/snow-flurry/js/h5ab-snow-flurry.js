/*! modernizr 3.3.1 (Custom Build) | MIT *
 * https://modernizr.com/download/?-csstransitions-touchevents-setclasses !*/
!function(e,n,t){function o(e){var n=x.className,t=Modernizr._config.classPrefix||"";if(S&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),S?x.className.baseVal=n:x.className=n)}function s(e,n){return typeof e===n}function r(){var e,n,t,o,r,i,a;for(var l in C)if(C.hasOwnProperty(l)){if(e=[],n=C[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(o=s(n.fn,"function")?n.fn():n.fn,r=0;r<e.length;r++)i=e[r],a=i.split("."),1===a.length?Modernizr[a[0]]=o:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=o),g.push((o?"":"no-")+a.join("-"))}}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):S?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function a(){var e=n.body;return e||(e=i(S?"svg":"body"),e.fake=!0),e}function l(e,t,o,s){var r,l,f,u,c="modernizr",d=i("div"),p=a();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=s?s[o]:c+(o+1),d.appendChild(f);return r=i("style"),r.type="text/css",r.id="s"+c,(p.fake?p:d).appendChild(r),p.appendChild(d),r.styleSheet?r.styleSheet.cssText=e:r.appendChild(n.createTextNode(e)),d.id=c,p.fake&&(p.style.background="",p.style.overflow="hidden",u=x.style.overflow,x.style.overflow="hidden",x.appendChild(p)),l=t(d,e),p.fake?(p.parentNode.removeChild(p),x.style.overflow=u,x.offsetHeight):d.parentNode.removeChild(d),!!l}function f(e,n){return!!~(""+e).indexOf(n)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function c(e,n){return function(){return e.apply(n,arguments)}}function d(e,n,t){var o;for(var r in e)if(e[r]in n)return t===!1?e[r]:(o=n[e[r]],s(o,"function")?c(o,t||n):o);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(n,o){var s=n.length;if("CSS"in e&&"supports"in e.CSS){for(;s--;)if(e.CSS.supports(p(n[s]),o))return!0;return!1}if("CSSSupportsRule"in e){for(var r=[];s--;)r.push("("+p(n[s])+":"+o+")");return r=r.join(" or "),l("@supports ("+r+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return t}function h(e,n,o,r){function a(){c&&(delete j.style,delete j.modElem)}if(r=s(r,"undefined")?!1:r,!s(o,"undefined")){var l=m(e,o);if(!s(l,"undefined"))return l}for(var c,d,p,h,v,y=["modernizr","tspan","samp"];!j.style&&y.length;)c=!0,j.modElem=i(y.shift()),j.style=j.modElem.style;for(p=e.length,d=0;p>d;d++)if(h=e[d],v=j.style[h],f(h,"-")&&(h=u(h)),j.style[h]!==t){if(r||s(o,"undefined"))return a(),"pfx"==n?h:!0;try{j.style[h]=o}catch(g){}if(j.style[h]!=v)return a(),"pfx"==n?h:!0}return a(),!1}function v(e,n,t,o,r){var i=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+T.join(i+" ")+i).split(" ");return s(n,"string")||s(n,"undefined")?h(a,n,o,r):(a=(e+" "+P.join(i+" ")+i).split(" "),d(a,n,t))}function y(e,n,o){return v(e,t,t,n,o)}var g=[],C=[],w={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){C.push({name:e,fn:n,options:t})},addAsyncTest:function(e){C.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var _=w._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];w._prefixes=_;var x=n.documentElement,S="svg"===x.nodeName.toLowerCase(),b=w.testStyles=l;Modernizr.addTest("touchevents",function(){var t;if("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch)t=!0;else{var o=["@media (",_.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");b(o,function(e){t=9===e.offsetTop})}return t});var z="Moz O ms Webkit",T=w._config.usePrefixes?z.split(" "):[];w._cssomPrefixes=T;var P=w._config.usePrefixes?z.toLowerCase().split(" "):[];w._domPrefixes=P;var E={elem:i("modernizr")};Modernizr._q.push(function(){delete E.elem});var j={style:E.elem.style};Modernizr._q.unshift(function(){delete j.style}),w.testAllProps=v,w.testAllProps=y,Modernizr.addTest("csstransitions",y("transition","all",!0)),r(),o(g),delete w.addTest,delete w.addAsyncTest;for(var N=0;N<Modernizr._q.length;N++)Modernizr._q[N]();e.Modernizr=Modernizr}(window,document);

/*
Copyright (c) 2016 Matthew Hudson - MIT License
device.js 0.2.7
*/
(function(){var a,b,c,d,e,f,g,h,i,j;b=window.device,a={},window.device=a,d=window.document.documentElement,j=window.navigator.userAgent.toLowerCase(),a.ios=function(){return a.iphone()||a.ipod()||a.ipad()},a.iphone=function(){return!a.windows()&&e("iphone")},a.ipod=function(){return e("ipod")},a.ipad=function(){return e("ipad")},a.android=function(){return!a.windows()&&e("android")},a.androidPhone=function(){return a.android()&&e("mobile")},a.androidTablet=function(){return a.android()&&!e("mobile")},a.blackberry=function(){return e("blackberry")||e("bb10")||e("rim")},a.blackberryPhone=function(){return a.blackberry()&&!e("tablet")},a.blackberryTablet=function(){return a.blackberry()&&e("tablet")},a.windows=function(){return e("windows")},a.windowsPhone=function(){return a.windows()&&e("phone")},a.windowsTablet=function(){return a.windows()&&e("touch")&&!a.windowsPhone()},a.fxos=function(){return(e("(mobile;")||e("(tablet;"))&&e("; rv:")},a.fxosPhone=function(){return a.fxos()&&e("mobile")},a.fxosTablet=function(){return a.fxos()&&e("tablet")},a.meego=function(){return e("meego")},a.cordova=function(){return window.cordova&&"file:"===location.protocol},a.nodeWebkit=function(){return"object"==typeof window.process},a.mobile=function(){return a.androidPhone()||a.iphone()||a.ipod()||a.windowsPhone()||a.blackberryPhone()||a.fxosPhone()||a.meego()},a.tablet=function(){return a.ipad()||a.androidTablet()||a.blackberryTablet()||a.windowsTablet()||a.fxosTablet()},a.desktop=function(){return!a.tablet()&&!a.mobile()},a.television=function(){var a;for(television=["googletv","viera","smarttv","internet.tv","netcast","nettv","appletv","boxee","kylo","roku","dlnadoc","roku","pov_tv","hbbtv","ce-html"],a=0;a<television.length;){if(e(television[a]))return!0;a++}return!1},a.portrait=function(){return window.innerHeight/window.innerWidth>1},a.landscape=function(){return window.innerHeight/window.innerWidth<1},a.noConflict=function(){return window.device=b,this},e=function(a){return-1!==j.indexOf(a)},g=function(a){var b;return b=new RegExp(a,"i"),d.className.match(b)},c=function(a){var b=null;g(a)||(b=d.className.replace(/^\s+|\s+$/g,""),d.className=b+" "+a)},i=function(a){g(a)&&(d.className=d.className.replace(" "+a,""))},a.ios()?a.ipad()?c("ios ipad tablet"):a.iphone()?c("ios iphone mobile"):a.ipod()&&c("ios ipod mobile"):a.android()?c(a.androidTablet()?"android tablet":"android mobile"):a.blackberry()?c(a.blackberryTablet()?"blackberry tablet":"blackberry mobile"):a.windows()?c(a.windowsTablet()?"windows tablet":a.windowsPhone()?"windows mobile":"desktop"):a.fxos()?c(a.fxosTablet()?"fxos tablet":"fxos mobile"):a.meego()?c("meego mobile"):a.nodeWebkit()?c("node-webkit"):a.television()?c("television"):a.desktop()&&c("desktop"),a.cordova()&&c("cordova"),f=function(){a.landscape()?(i("portrait"),c("landscape")):(i("landscape"),c("portrait"))},h=Object.prototype.hasOwnProperty.call(window,"onorientationchange")?"orientationchange":"resize",window.addEventListener?window.addEventListener(h,f,!1):window.attachEvent?window.attachEvent(h,f):window[h]=f,f(),"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return a}):"undefined"!=typeof module&&module.exports?module.exports=a:window.device=a}).call(this);

/*
snowFlurry JS - version 2.0
Copyright © 2015 S.W. Clough (https://www.html5andbeyond.com)
Licensed Under MIT
*/

(function ( $ ) {

    $.fn.snowFlurry = function( options ) {

        var s = $.extend({
            maxSize: 5,
            numberOfFlakes: 25,
            minSpeed: 10,
			maxSpeed: 15,
            color: '#fff',
            timeout: 0
        }, options );

        var windowWidth = $(window).innerWidth(),
            WidthArray = [],
            DelayArray = [],
            animateArray = [],
            flakeSize = [],
            snowInterval;

        if (s.maxSize <= 10) {
			for (var i = 1; i < s.maxSize; i++) {
			flakeSize.push(i);
			}
        } else {
            for (var i = 1; i < 10; i++) {
			flakeSize.push(i);
			}
        }

        for(var i=0; i < windowWidth - 20; i++) {
            WidthArray.push(i);
        }

        for(var i=0; i<s.numberOfFlakes; i++) {
            $('<div class="sf-snow-flake"></div>').appendTo('body');
        }

        for(var i=0; i<10; i++) {
            DelayArray.push(i);
        }

        for(var i=s.minSpeed; i<s.maxSpeed; i++) {
            animateArray.push(i);
        }

        function getRandomFlakeSize() {
            var item = flakeSize[Math.floor(Math.random()*flakeSize.length)];
            return item;
        }

        function getRandomPosition() {
            var item = WidthArray[Math.floor(Math.random()*WidthArray.length)];
            return item;
        }

        function getRandomDelay() {
            var item = DelayArray[Math.floor(Math.random()*DelayArray.length)];
            return item * 1000;
        }

        function getRandomAnimation() {
            var item = animateArray[Math.floor(Math.random()*animateArray.length)];
            return item * 1000;
        }

        $('.sf-snow-flake').each(function(){

        var elem = $(this);

        elem.attr('data-speed', getRandomAnimation());
        elem.attr('data-delay', getRandomDelay());

        var elemSpeed = elem.attr('data-speed'),
            elemDelay = elem.attr('data-delay');

        var flakeSize = getRandomFlakeSize();

        elem.css({
            'width': flakeSize,
            'height': flakeSize,
            'border-radius': flakeSize / 2,
            'background-color': s.color,
            'box-shadow': '0 0 2px 1px' + s.color
        })

        function activateAnim() {
            setTimeout(function(){
                elem.css('left', getRandomPosition());
                elem.addClass('sf-snow-anim');
                elem.css('transition', 'top ' + elemSpeed / 1000 + 's linear');

                setTimeout(function(){
                    elem.css('transition', '');
                    elem.removeClass('sf-snow-anim');
                }, elemSpeed);

            }, elemDelay);
        }

        if (device.mobile() || device.tablet() || $('html').hasClass('no-csstransitions')) {} else if (device.desktop()) {
            activateAnim();

            snowInterval = setInterval(function(){
               activateAnim();
            }, parseInt(elemDelay) + parseInt(elemSpeed));
        }

        if (s.timeout != 0) {
            setTimeout(function(){
                clearInterval(snowInterval);
                $('.sf-snow-flake').fadeOut(1500, function(){
                    $(this).remove();
                })
            }, s.timeout * 1000);
        }

        });

    };

}( jQuery ));
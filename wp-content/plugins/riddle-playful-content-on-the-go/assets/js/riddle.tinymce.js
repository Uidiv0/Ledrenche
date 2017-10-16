(function() {
    tinyMCE.PluginManager.add('riddle_mce_button', function(editor, url) {
        var shortcode_tag = 'rid-view';
        var currentPage = 1;
        /**
         * Replace ShortCode or Riddle Object to Embedded
         * @param obj
         */
        function replaceShortCodeToEmbedded(content){
            return content.replace(/\[rid-view([^\]]*)\]/g, function(all,attr,con) {

                var attrs = {
                    id : getAttr(attr,'id'),
                    maxWidth : getAttr(attr,'max-width'),
                    heightPx : getAttr(attr,'height-px'),
                    heightPc : getAttr(attr,'height-pc'),
                    seo : getAttr(attr,'seo'),
                    mode : getAttr(attr,'mode')
                };

                var shortcode_string = setShortCode(attrs);
                var img =  '<img src="../wp-content/plugins/riddle-playful-content-on-the-go/assets/img/placeholder.png" class="rid-preview" alt="'+encodeURIComponent(shortcode_string)+'">';

                return img;
            });
        }
        /**
         * Convert Embedded to ShortCode
         * @param content
         * @returns {string}
         */
        function replaceEmbeddedToShortCode(content){
            var container = jQuery('<div>').html(content);
            container.find('img.rid-preview').replaceWith(function(){
                return decodeURIComponent(this.alt);
            });
            return container.html();
        }

        /**
         * Set shortcode
         * @param riddle
         * @returns {*}
         */
        function setShortCode(riddle){
            var args = {
                tag : shortcode_tag,
                type : 'single',
                attrs : {
                    id :  '',
                    'max-width' : '',
                    'height-px' : '',
                    'height-pc' : '',
                    seo : '',
                    mode : ''
                }
            };

            jQuery.each(riddle,function(i,j){
                var key = i.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
                if(j){
                    args.attrs[key] = j;
                }else{
                    delete  args.attrs[key];
                }
            });

            return wp.shortcode.string(args);
        }

        /**
         * Get Attribute from shortcode
         * @param s see what I passed in replaceShortCodeToEmbedded function
         * @param n see what I passed in replaceShortCodeToEmbedded function
         * @returns {string}
         */
        function getAttr(s,n){
            n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
            return n ?  window.decodeURIComponent(n[1]) : '';
        }

        editor.addButton('riddle_mce_button', {
            text: 'Insert Riddle',
            onClick: function(){
                var wrapper = '<div style="height:100%;overflow-y:scroll;margin: 0 auto;" id="riddle-list">' +
                    '<i class="icon-spin6"></i></div>';
                editor.windowManager.open({
                    title: 'Insert Riddle',
                    width: 800,
                    height: 500,
                    html:wrapper,
                    buttons:{
                        text: 'Close',
                        classes: 'widget btn primary first abs-layout-item',
                        onclick: 'close',
                    }
                });
                getRiddle(currentPage);
            }
        });

        editor.on('GetContent',function(event){
            event.content = replaceEmbeddedToShortCode(event.content);
        });

        editor.on('BeforeSetContent',function(event){
            event.content = replaceShortCodeToEmbedded(event.content);
        });

        editor.on('LoadContent',function(event){
            var shortcode = jQuery.urlParam('shortcode');
            if(shortcode){
                var content = tinyMCE.activeEditor.selection.getContent();
                content += shortcode;
                tinyMCE.activeEditor.selection.setContent(content);
            }
        });
        /**
         * Get Riddle list
         * @returns {string}
         */
        function getRiddle(page){
            jQuery('#riddle-list').html('<i class="icon-spin6 animate-spin"></i>');
            var riddles = '';
            var url = buildPath();
            if(typeof page == 'undefined' || !page){
                page = 1;
            }
            var n = Date.now();
            jQuery.get(url+page+'&q='+n,function(callback){
                var list = jQuery.parseJSON(callback);
                jQuery.each(list.riddles,function(i,j){
                    riddles += '<div class="riddle-list">'+
                        '<img src="'+ j.image +'" />'+
                        '<p><i class="icon-rid-'+ j.type+'"></i> '+ j.type +'</p>'+
                        '<h2>'+ j.title +'</h2>'+
                        '<br /><br /><p><a href="#" style="background-color: #00A8EF;padding: 10px;color: #ffffff;" class="btn riddle" data-id="'+ j.id +'">Select</a></p>' +
                        '</div>';
                });
                riddles += '<div class="pagination">';
                var pagination = list.paginations;
                for(var i=1;i<=pagination.total_pages;i++){
                    if(i==pagination.pages.current){
                        riddles += '<span>'+i+'</span>';
                    }else{
                        riddles += '<a href="#" data-page="'+i+'" class="pagination-links">'+i+'</a>';
                    }
                }

                riddles += '</div></div>';
                currentPage = page;
                jQuery('#riddle-list').html(riddles);
            });
        }


        jQuery(document).on('click','.riddle',function(){
            editor.windowManager.close();
            editor.insertContent(setShortCode({id:jQuery(this).data('id')}))
        });

        jQuery(document).on('click','.pagination-links',function(){
            getRiddle(jQuery(this).data('page'));
        })
        /**
         * Get Shortcode from Url query string and clear URI
         * @param name
         * @returns {*}
         */
        jQuery.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null){
                return null;
            }
            else{
                var result = 0;
                if(results[1]){
                    var result = results[1];
                    result = result.replace(/\+/g,' ');
                    result = window.decodeURIComponent(result);
                    var clean_uri = location.protocol + "//" + location.host + location.pathname;
                    window.history.replaceState({}, document.title, clean_uri);
                }
                return  result;
            }
        }
        /**
         * Build path to get admin ajax
         * @returns {string}
         */
        function buildPath(){
            var pathName = location.pathname.split('/');
            delete pathName[0];
            var path = '';
            jQuery.each(pathName,function(i,j){
                if(i==1 && j=='wp-admin'){
                    path = '/wp-admin/admin-ajax.php?action=get_riddle_list&page=';
                }else if((i==1 && j!='wp-admin') || (i==2 && j=='wp-admin')){
                    path = '/'+pathName[1]+'/wp-admin/admin-ajax.php?action=get_riddle_list&page_number=';
                }
            });
            return location.protocol + "//" + location.host +path;
        }
    });
})();

/*

 */

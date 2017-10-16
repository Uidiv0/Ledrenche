/* Add helpful links to theme customizer */

(function($) {
	if ('undefined' !== typeof mh_magazine_links) {

		box = $('<div class="mh-theme-links-wrap"></div>');

		title = $('<h3 class="mh-theme-links-title"></h3>')
			.text(mh_magazine_links.title);

		themeDocu = $('<a class="mh-theme-link mh-theme-link-docs"></a>')
			.attr('href', mh_magazine_links.docsURL)
			.attr('target', '_blank')
			.text(mh_magazine_links.docsLabel);

		themeSupport = $('<a class="mh-theme-link mh-theme-link-support"></a>')
			.attr('href', mh_magazine_links.supportURL)
			.attr('target', '_blank')
			.text(mh_magazine_links.supportLabel);

		links = box.append(title).append(themeDocu).append(themeSupport);

		setTimeout(function() {
			$('#accordion-panel-mh_magazine_theme_options .control-panel-content').append(links);
		}, 2000);

		$('.mh-theme-link').on('click', function(e) {
			e.stopPropagation();
		});

	}
})(jQuery);
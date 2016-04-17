var http_reffer = '';
var addons_html = '';
jQuery(document).ready(function () {


    if (jQuery('div.wc_pbp_addon_listing').size() > 0) {
        jQuery('p.submit').remove();
    }

    if (jQuery('.wc_pbp_settings_submenu').size() > 0) {
        var id = window.location.hash;
        jQuery('.wc_pbp_settings_submenu a').removeClass('current');
        jQuery('.wc_pbp_settings_submenu a[href="' + id + '" ]').addClass('current');
        if (id == '') {
            jQuery('.wc_pbp_settings_submenu a:first').addClass('current');
            id = jQuery('.wc_pbp_settings_submenu a:first').attr('href');
        }
        http_reffer = jQuery('input[name=_wp_http_referer').val();

        settings_showHash(id);
    }

    jQuery('.wc_pbp_settings_submenu a').click(function () {
        var id = jQuery(this).attr('href');
        jQuery('.wc_pbp_settings_submenu a').removeClass('current');
        jQuery(this).addClass('current');
        settings_showHash(id);
        jQuery('input[name=_wp_http_referer').val(http_reffer + id)
    });


    jQuery('.wc_pbp_addon_listing').on('click', '.wc-pbp-activate-now', function () {
        active_deactive_addon(jQuery(this), '.wc-pbp-deactivate-now')
    });
    jQuery('.wc_pbp_addon_listing').on('click', '.wc-pbp-deactivate-now', function () {
        active_deactive_addon(jQuery(this), '.wc-pbp-activate-now')
    });

    addons_html = jQuery('.wc_pbp_addon_listing').clone();

    jQuery('ul.addons_category li a:first').addClass('current');
    jQuery('ul.addons_category li a').click(function () {
        var cat = jQuery(this).attr('data-category');
        var NewDis = 'div.wc-pbp-addon-' + cat;
        jQuery('ul.addons_category li a').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('.wc_pbp_addon_listing').html(addons_html.find(NewDis).clone());
        //jQuery('.wc-pbp-addon-all').hide();
        //jQuery(NewDis).show();
    });

});

function settings_showHash(id) {
    jQuery('div.wc_pbp_settings_content').hide();
    id = id.replace('#', '#settings_');
    jQuery(id).show();
}

function active_deactive_addon(ref, oppo) {
    if (typeof (oppo) === 'undefined') oppo = '.wc-pbp-deactivate-now';
    var clicked = ref;
    var slug = ref.parent().attr('data-pluginslug');
    console.log(slug);
    var parent_div = '.plugin-card-' + slug;
    var height = jQuery(parent_div).innerHeight();
    var width = jQuery(parent_div).innerWidth();
    jQuery(parent_div + ' .wc_pbp_ajax_overlay').css('height', height + 'px').css('width', width + 'px').fadeIn();
    clicked.attr('disabled', 'disable');
    var link = clicked.attr('href');
    jQuery.ajax({
        method: 'GET',
        url: link,
    }).done(function (response) {
        var status = response.success;
        jQuery(parent_div + ' .wc_pbp_ajax_overlay').fadeOut();
        clicked.removeAttr('disabled');
        if (status) {
            clicked.hide();
            jQuery(parent_div).find(oppo).fadeIn();
        }

        jQuery(parent_div).find('.wc_pbp_ajax_response').hide().html(response.data.msg).fadeIn(function () {
            setTimeout(function () {
                jQuery(parent_div).find('.wc_pbp_ajax_response').fadeOut();
            }, 5000);
        });

    });


}
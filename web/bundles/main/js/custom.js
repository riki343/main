// -------------------- VKONTAKTE --------------------  \\

function SendPostVK () {
    VK.init({ apiId: 4823166 });
    var vk_user_session = null;
    VK.Auth.getLoginStatus(function(response) {
        var message = 'Зарабатывайте инвестируя! Без приглашений! Автоматическое начисление средств. ' +
            'Регистрируйтесь сейчас! http://easytoinvest.net ';
        var attachment = 'photo295370921_356158010%2Falbum295370921_0%2Frev';
        if (response.session) {
            VK.Auth.login(function(response) {
                if (response.session) {
                    vk_user_session = response.session;
                    VK.Api.call('wall.post', { 'onwer_id': '', 'message': message, 'attachment': attachment }, function(r)
                    {
                        if(r.response) { console.log(r.response); }
                    });
                }
            });
        } else {
            VK.Auth.login(function(response) {
                if (response.session) {
                    vk_user_session = response.session;
                    VK.Api.call('wall.post', { 'onwer_id': '', 'message': message, 'attachment': attachment }, function(r)
                    {
                        if(r.response) { console.log(r.response); }
                    });
                }
            });
        }
    });
}

// -------------------- FACEBOOK --------------------  \\

window.fbAsyncInit = function() {
    FB.init({
        appId      : '797714073637018',
        xfbml      : true,
        version    : 'v1.0'
    });
};
function SendPostFacebook () {
    FB.ui({
        method: 'share',
        href: 'http://easytoinvest.net'
    }, function (response) {

    });
}

// -------------------- TWITTER --------------------  \\

$('#twitter-button').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;

    window.open(url, 'twitter', opts);

    return false;
});

// -------------------- TUMBLR --------------------  \\

var tumblr_link_url = "http://easytoinvest.net";
var tumblr_link_name = "Easytoinvest.net";
var tumblr_link_description = "Зарабатывайте инвестируя! Без приглашений! Автоматическое начисление средств. Регистрируйтесь сейчас!";
var tumblr_button = document.getElementById('tumblr-button');
tumblr_button.setAttribute("href", "http://www.tumblr.com/share/link?url=" + encodeURIComponent(tumblr_link_url) + "&name=" + encodeURIComponent(tumblr_link_name) + "&description=" + encodeURIComponent(tumblr_link_description));
tumblr_button.setAttribute("title", "Share on Tumblr");
$('#tumblr-button').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;

    window.open(url, 'tumblr', opts);

    return false;
});

var google_plus_link = "http://easytoinvest.net";
var google_plus = document.getElementById('google-plus-button');
google_plus.setAttribute("href", "https://plus.google.com/share?url=" + encodeURIComponent(google_plus_link) + "&hl=" + encodeURIComponent(tumblr_link_description));

$('#google-plus-button').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;

    window.open(url, 'google_plus', opts);

    return false;
});

var linked_in_link = "http://easytoinvest.net";
var linked_in = document.getElementById('linked-in-button');
linked_in.setAttribute("href", "http://www.linkedin.com/shareArticle?mini=true&url=" +
    encodeURIComponent(linked_in_link) + "&title=Easy To Invest" + "&summary=" +
    encodeURIComponent(tumblr_link_description) + "&source=" +
    encodeURIComponent('Easy To Invest')
);
$('#linked-in-button').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
            ',width='  + width  +
            ',height=' + height +
            ',top='    + top    +
            ',left='   + left;

    window.open(url, 'linked_in', opts);

    return false;
});

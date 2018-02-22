<?php
return [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => array(
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
            ),
            'services' => array( // You can change the providers and their classes.
//                'google' => array(
//                    'class' => 'nodge\eauth\services\GoogleOpenIDService',
//                    'realm' => '*.raketos.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ),
//                'yandex' => array(
//                    'class' => 'nodge\eauth\services\YandexOpenIDService',
//                    'realm' => '*.raketos.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ),
                'twitter' => array(
                    // register your app here: https://dev.twitter.com/apps/new
                    'class' => 'nodge\eauth\services\TwitterOAuth1Service',
                    'key' => 'QJ9IcgMDptjEB4tJEVi6dJhMu',
                    'secret' => 'ICp5qfGQ7tErOpYZnVrgXjczlihYnJ54xBlQAiLI0zhSiLFSww',
                ),
                'google' => array(
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
                    'clientId' => '1061850565738-stestims43vhjv9uf4qrt8pvinnc6avg.apps.googleusercontent.com',
                    'clientSecret' => 'SQdl3EViJiVpbGlxpH0Ecr3u',
//                    'clientId' => '324148681845-hbd8ohbtlqutgktu9utj0a0221a0uodf.apps.googleusercontent.com',
//                    'clientSecret' => 'D-ht8gZBq8VALPCajS7-bBRS',
                    'title' => 'Google',
                ),
                'yandex' => array(
                    // register your app here: https://oauth.yandex.ru/client/my
                    'class' => 'nodge\eauth\services\YandexOAuth2Service',
//                    'clientId' => '64ff2128b51842c4875a4cd6c7560aa4',
//                    'clientSecret' => '222c302b71024125b09596171cdfb19c',
                    'clientId' => '8004f93ae359451ca2548d2beac49859',
                    'clientSecret' => 'fd9c6d80dbdc434aa7a134712678d691',
                    'title' => 'Yandex',
                ),
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
                    'clientId' => '1679768568984069',
                    'clientSecret' => 'c0897689128e28eb19fcf6639441bb40',
                ),
//                'yahoo' => array(
//                    'class' => 'nodge\eauth\services\YahooOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ),
//                'linkedin' => array(
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
//                    'key' => '...',
//                    'secret' => '...',
//                    'title' => 'LinkedIn (OAuth1)',
//                ),
//                'linkedin_oauth2' => array(
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'LinkedIn (OAuth2)',
//                ),
//                'github' => array(
//                    // register your app here: https://github.com/settings/applications
//                    'class' => 'nodge\eauth\services\GitHubOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ),
//                'live' => array(
//                    // register your app here: https://account.live.com/developers/applications/index
//                    'class' => 'nodge\eauth\services\LiveOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ),
//                'steam' => array(
//                    'class' => 'nodge\eauth\services\SteamOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ),
                'vkontakte' => array(
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
                    'clientId' => '6191904',
                    'clientSecret' => 'dnc5qin6dnvwt4g5FZow',
                ),
//                'mailru' => array(
//                    // register your app here: http://api.mail.ru/sites/my/add
//                    'class' => 'nodge\eauth\services\MailruOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ),
//                'odnoklassniki' => array(
//                    // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
//                    // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
//                    'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'clientPublic' => '...',
//                    'title' => 'Odnoklas.',
//                ),
            ),
       
    
    
    ];

//        $i18n = array(
//            'translations' => array(
//                'eauth' => array(
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@eauth/messages',
//                ),
//            ),
//        );
//    
    
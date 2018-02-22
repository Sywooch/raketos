<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 03.04.2017
 * Time: 9:27
 */

namespace common\components;

use common\models\extend\GeoCityExtend;
use common\models\extend\GeoCountryExtend;
use Yii;
use common\models\GeoCity;
use yii\base\InvalidConfigException;
use yii\web\Cookie;
use yii\web\UrlManager as BaseUrlManager;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use yii\helpers\Url;

class MyUrlManager extends BaseUrlManager
{
    public $city;                                       // Город по умолчанию
    public $cityKey;                                    // Выбранный город
    public $cities = [];                                // Список городов
    public $citySessionKey = '_cityUrl';
    public $cityCookieKey = '_cityUrl';
    public $enableCityDetection = true;                 // определять город
    public $enableDefaultCityUrlCode = false;           // отображать url по умолчанию
    public $enableCityPersistence = true;
    public $cityParam = 'city';
    public $cityCookieOptions = [];
    public $enableLocaleUrls = true;
    public $ignoreCityUrlPatterns = [];
    public $frontendUrl;

    public $authClient = false;                                 // Ссылка авторизации через соц сети

    protected $_defaultCity;
    public $cityCookieDuration = 2592000;

    /**
     * @var \yii\web\Request
     */
    protected $_request;

    protected $_processed = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        /* Город по умолчанию - Москва */
        $this->_defaultCity = '524901';
        /* Получаем выбранный id города */
        $uri = $_SERVER['REQUEST_URI'];
        /* Проверка ссылки на авторизацию через соц сети */
        $authClient = Yii::$app->request->get('service');
        if ($authClient || stripos ($uri,'vklogin') !== false) {
            $this->authClient = true;
        }
        $uriArray = explode('/', $uri);
        $this->cityKey = intval($uriArray[1]);
        if (!$this->cityKey) {
            $this->cityKey = Yii::$app->request->getCookies()->getValue($this->cityCookieKey);
            if (!$this->cityKey) {
                $this->cityKey = \Yii::$app->session->get($this->citySessionKey);
            }
            if ($this->cityKey) {
                //$this->cityKey = Yii::$app->session->get($this->citySessionKey);
                $this->city = $this->cityKey;
            }
        }
        $cityKey = intval($uriArray[1]);
        if ($cityKey == $this->_defaultCity) {
            $this->cities[] = intval($this->_defaultCity);
        }
        $this->cities[] = intval($cityKey);
        if ($this->enableLocaleUrls && $this->cities) {
            if (!$this->enablePrettyUrl) {
                throw new InvalidConfigException('Установите свойство enablePrettyUrl в компоненте UrlManager в true.');
            }
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($request)
    {

        if ($this->enableLocaleUrls && $this->cityKey) {
            $process = true;
            if ($this->ignoreCityUrlPatterns) {
                $pathInfo = $request->getPathInfo();
                foreach ($this->ignoreCityUrlPatterns as $k => $pattern) {
                    if (preg_match($pattern, $pathInfo)) {
                        \Yii::trace("Ignore pattern '$pattern' matches '$pathInfo.' Skipping city processing.", __METHOD__);
                        $process = false;
                    }
                }
            }
            if ($process && !$this->_processed) {
                $this->_processed = true;
                $this->processLocaleUrl($request);
            }
        }
        return parent::parseRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function createUrl($params)
    {
        if ($this->enableLocaleUrls && $this->cityKey) {
            $city = \Yii::$app->urlManager->city;
            $url = parent::createUrl($params);

            if ((!$this->enableDefaultCityUrlCode && $city === $this->_defaultCity) || $this->authClient) {
                return  $url;
            } else {
                if ($this->suffix !== '/') {
                    if (count($params)!==1) {
                        $url = preg_replace('#/\?#', '?', $url);
                    } else {
                        $url = rtrim($url, '/');
                    }
                }
                $needle = $this->showScriptName ? $this->getScriptUrl() : $this->getBaseUrl();
                return '/'.$this->cityKey.$url;
            }
        } else {
            return parent::createUrl($params);
        }
    }

    /**
     * @var \yii\web\Request $request
     */
    protected function processLocaleUrl($request)
    {
        $this->_request = $request;
        $pathInfo = $request->getPathInfo();
        $patternCities = implode('|', $this->cities);

        if (preg_match("#^($patternCities)\b(/?)#i", $pathInfo, $m)) {
            $request->setPathInfo(mb_substr($pathInfo, mb_strlen($m[1].$m[2])));
            $code = $m[1];
            $city = $code;

            \Yii::$app->urlManager->city = $city;
            \Yii::trace("City code found in URL. Setting application city to '$city'.", __METHOD__);
            if ($this->enableCityPersistence) {
                \Yii::$app->session[$this->citySessionKey] = $city;
                \Yii::trace("Persisting city '$city' in session.", __METHOD__);
                if ($this->cityCookieDuration) {
                    $cookie = new Cookie(array_merge(
                        ['httpOnly' => true],
                        $this->cityCookieOptions,
                        [
                            'name' => $this->cityCookieKey,
                            'value' => $city,
                            'expire' => time() + (int) $this->cityCookieDuration
                        ]
                    ));
                    \Yii::$app->getResponse()->getCookies()->add($cookie);
                    \Yii::trace("Persisting city '$city' in cookie.", __METHOD__);
                }
            }
            if (!$this->enableDefaultCityUrlCode && $city === $this->_defaultCity) {
                $this->redirectToCity('');
            }
        } else {
            $city = null;
            if ($this->enableCityPersistence) {
                /* Извлекаем значения из сессий и куки */
                $city = \Yii::$app->session->get($this->citySessionKey);
                $city !== null && \Yii::trace("Found persisted city '$city' in session.", __METHOD__);
                if ($city === null) {
                    $city = $request->getCookies()->getValue($this->cityCookieKey);
                    $city !== null && \Yii::trace("Found persisted city '$city' in cookie.", __METHOD__);
                }
            }

            if ($city === null && $this->enableCityDetection) {
                $city = 524901;
            }

            if ($city === null || $city === $this->_defaultCity) {
                if (!$this->enableDefaultCityUrlCode) {
                    /* не отображать город по умолчанию */
                    return;
                } else {
                    /* отображать город по умолчанию */
                    $city = $this->_defaultCity;
                }
            }

            // #35: Only redirect if a valid language was found
            if ($this->matchCode($city) === [null, null]) {
                return;
            }

            $key = array_search($city, $this->cities);

            if ($key && is_string($key)) {
                $city = $key;
            }
            $this->redirectToCity($city);
        }
    }

    protected function matchCode($code)
    {
        $city = $code;
        if (in_array($city, $this->cities)) {
            return [$city, null];
        } else {
            return [null, null];
        }
    }

    protected function redirectToCity($city)
    {
        $result = parent::parseRequest($this->_request);
        //dd($result);
        if ($result === false) {
            throw new NotFoundHttpException(\Yii::t('yii', 'Page not found.'));
        }
        list ($route, $params) = $result;
        if($city){
            $params[$this->cityParam] = $city;
        }
        // See Yii Issues #8291 and #9161:
        $params = $params + $this->_request->getQueryParams();
        array_unshift($params, $route);
        $url = $this->createUrl($params);
        if ($this->suffix==='/' && $route==='') {
            $url = rtrim($url, '/').'/';
        }
        \Yii::trace("Redirecting to $url.", __METHOD__);
        \Yii::$app->getResponse()->redirect($url);
        if (YII_ENV_TEST) {
            throw new Exception(Url::to($url));
        } else {
            \Yii::$app->end();
        }
    }
}

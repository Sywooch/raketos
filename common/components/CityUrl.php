<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 27.05.2016
 * Time: 22:07
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

class CityUrl extends BaseUrlManager
{
    public $city;
    public $cities = [];
    public $citySessionKey = '_cityUrl';
    public $cityCookieName = '_cityUrl';
    public $enableCityDetection = true;                 // определять город
    public $enableDefaultCityUrlCode = false;       // отображать url по умолчанию
    public $enableCityPersistence = true;
    public $cityParam = 'city';
    public $cityCookieOptions = [];
    public $enableLocaleUrls = true;
    public $ignoreCityUrlPatterns = [];
    public $frontendUrl;

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
        /* @var $model GeoCityExtend */
        $modelCountry = GeoCountryExtend::findOne(185);
        $model = GeoCityExtend::find()
            ->joinWith('region')
            ->andWhere(['geo_region.country' => $modelCountry->iso2])
            ->all();

        foreach ($model as $one) {
            $this->cities[] = $one->id;
        }

        //dd($this->cities);

        if ($this->enableLocaleUrls && $this->cities) {
            if (!$this->enablePrettyUrl) {
                throw new InvalidConfigException('Locale URL support requires enablePrettyUrl to be set to true.');
            }
        }
        $this->_defaultCity = '524901';
        parent::init();
    }

    public function getDefaultCity()
    {
        return $this->_defaultCity;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($request)
    {
        if ($this->enableLocaleUrls && $this->cities) {
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
        if ($this->enableLocaleUrls && $this->cities) {
            $params = (array) $params;

            if (isset($params[$this->cityParam])) {
                $city = $params[$this->cityParam];
                unset($params[$this->cityParam]);
                $cityRequired = true;
            } else {
                $city = \Yii::$app->urlManager->city;
                $cityRequired = false;
            }

            // Do not use prefix for default language to prevent unnecessary redirect if there's no persistence and no detection
            if ($cityRequired && $city === $this->getDefaultCity() &&
                !$this->enableDefaultCityUrlCode && !$this->enableCityPersistence && !$this->enableCityDetection
            ) {
                $cityRequired = false;
            }

            $url = parent::createUrl($params);

            if (!$cityRequired && !$this->enableDefaultCityUrlCode && $city === $this->getDefaultCity()) {
                return  $url;
            } else {
                $keyCity = array_search($city, $this->cities);
                if (is_string($keyCity)) {
                    $city = $keyCity;
                }
                // Remove any trailing slashes unless one is configured as suffix
                if ($this->suffix!=='/') {
                    if (count($params)!==1) {
                        $url = preg_replace('#/\?#', '?', $url);
                    } else {
                        $url = rtrim($url, '/');
                    }
                }
                $needle = $this->showScriptName ? $this->getScriptUrl() : $this->getBaseUrl();
                $needleLength = strlen($needle);
                return $needleLength ? substr_replace($url, "$needle/$city", 0, $needleLength) : "/$city$url";
            }
        } else {
            return parent::createUrl($params);
        }
    }

    /**
     * Checks for a language or locale parameter in the URL and rewrites the pathInfo if found.
     * If no parameter is found it will try to detect the language from persistent storage (session /
     * cookie) or from browser settings.
     *
     * @var \yii\web\Request $request
     */
    protected function processLocaleUrl($request)
    {
        $this->_request = $request;
        $pathInfo = $request->getPathInfo();
        $patternCities = implode('|', $this->cities);

        //dd($this->cities);

        if (preg_match("#^($patternCities)\b(/?)#i", $pathInfo, $m)) {
            // $m = [
            //      0 => '524901'
            //      1 => '524901'
            //      2 => ''
            //  ]
            $request->setPathInfo(mb_substr($pathInfo, mb_strlen($m[1].$m[2])));
            $code = $m[1];
            if (isset($this->cities[$code])) {
                // Replace alias with language code
                $city = $this->cities[$code];
            } else {
                $city = $code;
            }

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
                            'name' => $this->cityCookieName,
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
                    $city = $request->getCookies()->getValue($this->cityCookieName);
                    $city !== null && \Yii::trace("Found persisted city '$city' in cookie.", __METHOD__);
                }
            }


            if ($city === null && $this->enableCityDetection) {
                /* Получить (определить) город пользователя */
                $geo = new \jisoft\sypexgeo\Sypexgeo();
                $geo->get();
                if (isset($geo->city['id'])) {
                    $modelCity = \common\models\GeoCity::find()->where(['id' => $geo->city['id']])->one();
                }

                if (isset($modelCity)) {
                    /* @var $city GeoCity */
                    $city = $modelCity->id;
                } else {
                    $city = 524901;
                }
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

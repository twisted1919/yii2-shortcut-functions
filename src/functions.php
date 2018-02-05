<?php
/**
 * This is a relatively small collection of shortcut functions.
 * We use them to access main Yii components and features instead of
 * always typing things as \Yii::$app && \Yii::$app->component
 **/

/**
 * Return the main application singleton (this is a service locator instance)
 */
if (!function_exists('app')) {

    /**
     * @return \yii\web\Application
     */
    function app() {
        return \Yii::$app;
    }
}

/**
 * Check the named app component
 */
if (!function_exists('app_has')) {

    /**
     * @param string $component
     * @param bool $checkInstance
     * @return bool
     */
    function app_has($component, $checkInstance = false) {
        return app()->has($component, $checkInstance);
    }
}

/**
 * Return named app component
 */
if (!function_exists('app_get')) {

    /**
     * @param string $component
     * @return mixed
     */
    function app_get($component) {
        return app()->get($component);
    }
}

/**
 * Set named app component
 */
if (!function_exists('app_set')) {

    /**
     * @param string $component
     * @param null $options
     * @return mixed
     */
    function app_set($component, $options = null) {
        return app()->set($component, $options);
    }
}

/**
 * Return the request object
 */
if (!function_exists('request')) {

    /**
     * @return \yii\web\Request
     */
    function request() {
        return app_get('request');
    }
}

/**
 * Return the response object
 */
if (!function_exists('response')) {

    /**
     * @return \yii\web\Response
     */
    function response() {
        return app_get('response');
    }
}

/**
 * Return the user object
 */
if (!function_exists('user')) {

    /**
     * @return \yii\web\User
     */
    function user() {
        return app_get('user');
    }
}

/**
 * Return the customer object
 */
if (!function_exists('customer')) {

    /**
     * @return \yii\web\User
     */
    function customer() {
        return app_get('customer');
    }
}

/**
 * Return the di container object
 */
if (!function_exists('container')) {

    /**
     * @return \yii\di\Container
     */
    function container() {
        return \Yii::$container;
    }
}

/**
 * Return environment variable
 */
if (!function_exists('env')) {

    /**
     * @param string $key
     * @param null $default
     * @return array|false|null|string
     */
    function env($key, $default = null) {
        if (false !== ($value = getenv($key))) {
            return $value;
        }
        return $default;
    }
}

/**
 * Get a value from an array
 */
if (!function_exists('array_get')) {

    /**
     * @param array $source
     * @param $key
     * @param null $default
     * @return mixed
     */
    function array_get(array $source = array(), $key, $default = null) {
        return \yii\helpers\ArrayHelper::getValue($source, $key, $default);
    }
}

/**
 * Return the file system object
 */
if (!function_exists('fs')) {

    /**
     * @param string $what
     * @return mixed
     */
    function fs($what = null) {
        return app_get(env('FS_ADAPTER', ($what !== null ?: 'fsLocal')));
    }
}

/**
 * Output data and stop execution
 */
if (!function_exists('dd')) {

    /**
     * @param $data
     * @param int $level
     * @param bool $highlight
     */
    function dd($data, $level = 10, $highlight = true) {
        \yii\helpers\VarDumper::dump($data, $level, $highlight);
        app()->end();
    }
}

/**
 * Return a param from application params section
 */
if (!function_exists('app_param')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function app_param($key, $default = null) {
        return array_get(app()->params, $key, $default);
    }
}

/**
 * Return a param from application view params
 */
if (!function_exists('view_param')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function view_param($key, $default = null) {
        return array_get(app()->view->params, $key, $default);
    }
}

/**
 * Return the db component
 */
if (!function_exists('db')) {

    /**
     * @return \yii\db\Connection
     */
    function db() {
        return app_get('db');
    }
}

/**
 * Return the options component
 */
if (!function_exists('options')) {

    /**
     * @return \twisted1919\options\Options
     */
    function options() {
        return app_get('options');
    }
}

/**
 * Return the notify component
 */
if (!function_exists('notify')) {

    /**
     * @return \twisted1919\notify\Notify
     */
    function notify() {
        return app_get('notify');
    }
}

/**
 * Return the cache component
 */
if (!function_exists('cache')) {

    /**
     * @return \yii\caching\Cache
     */
    function cache() {
        return app_get('cache');
    }
}

/**
 * Translation
 */
if (!function_exists('t')) {

    /**
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     * @return string the translated message.
     */
    function t($category, $message, $params = [], $language = null) {
        return call_user_func_array(['\Yii', 't'], func_get_args());
    }
}

/**
 * Get a named module or the current one.
 */
if (!function_exists('module')) {

    /**
     * @param string $name
     * @return null|\yii\base\Module
     */
    function module($name = null) {
        if ($name === null) {
            return app()->controller ? app()->controller->module : null;
        }
        return app()->getModule($name);
    }
}

/**
 * Return the security component
 */
if (!function_exists('security')) {

    /**
     * @return \yii\base\Security
     */
    function security() {
        return app()->getSecurity();
    }
}

/**
 * Create the url
 */
if (!function_exists('url')) {

    /**
     * @param array|string $url the parameter to be used to generate a valid URL
     * @param bool|string $scheme the URI scheme to use in the generated URL:
     *
     * - `false` (default): generating a relative URL.
     * - `true`: returning an absolute base URL whose scheme is the same as that in [[\yii\web\UrlManager::$hostInfo]].
     * - string: generating an absolute URL with the specified scheme (either `http`, `https` or empty string
     *   for protocol-relative URL).
     *
     * @return string the generated URL
     * @throws InvalidParamException a relative route is given while there is no active controller
     */
    function url($url = '', $scheme = false) {
        return call_user_func_array(['\yii\helpers\Url', 'to'], func_get_args());
    }
}

/**
 * Get the auth manager
 */
if (!function_exists('auth_manager')) {

    /**
     * @return mixed
     */
    function auth_manager() {
        return app_get('authManager');
    }
}

/**
 * Get the app queue
 */
if (!function_exists('queue')) {
    function queue() {
        return app_get('queue');
    }
}

/**
 * Log error
 */
if (!function_exists('log_error')) {
    function log_error($message, $category = 'application') {
        return \Yii::error($message, $category);
    }
}

/**
 * Log info
 */
if (!function_exists('log_info')) {
    function log_info($message, $category = 'application') {
        return \Yii::info($message, $category);
    }
}

/**
 * Log warning
 */
if (!function_exists('log_warning')) {
    function log_warning($message, $category = 'application') {
        return \Yii::warning($message, $category);
    }
}

/**
 * Return the AWS SDK component
 */
if (!function_exists('awssdk')) {
    function awssdk() {
        return app_get('awssdk')->getAwsSdk();
    }
}

/**
 * Return the mailer component
 */
if (!function_exists('mailer')) {

    /**
     * @return \app\yii\swiftmailer\Mailer
     */
    function mailer() {
        return app_get('mailer');
    }
}

/**
 * Return the session component
 */
if (!function_exists('session')) {

    /**
     * @return \yii\web\Session
     */
    function session() {
        return app_get('session');
    }
}

/**
 * Return the cookie component
 */
if (!function_exists('cookie')) {

    /**
     * @return mixed
     */
    function cookie() {
        return request()->getCookies();
    }
}

/**
 * Return the api component
 */
if (!function_exists('api')) {
    function api() {
        return app_get('api');
    }
}

/**
 * Return the elasticsearch component
 */
if (!function_exists('elasticsearch')) {
    function elasticsearch() {
        return app_get('elasticsearch');
    }
}

/**
 * Return the elastica component (extern elastic search library)
 */
if (!function_exists('elastica')) {
    function elastica() {
        return app_get('elastica');
    }
}

/**
 * Return encode html string
 */
if (!function_exists('html_encode')) {

    /**
    * @param string $content the content to be encoded
     * HTML entities in `$content` will not be further encoded.
     * @return string the encoded content
     */
    function html_encode($content) {
        return \yii\helpers\Html::encode($content);
    }
}

/**
 * Return decoded html string
 */
if (!function_exists('html_decode')) {

    /**
     * @param string $content the content to be decoded
     * @return string the decoded content
     */
    function html_decode($content) {
        return \yii\helpers\Html::decode($content);
    }
}

/**
 * Return a safe html string
 */
if (!function_exists('html_purify')) {

    /**
     * @param string $content The HTML content to purify
     * @param array|\Closure|null $config The config to use for HtmlPurifier.
     * If not specified or `null` the default config will be used.
     * You can use an array or an anonymous function to provide configuration options:
     *
     * - An array will be passed to the `HTMLPurifier_Config::create()` method.
     * - An anonymous function will be called after the config was created.
     *   The signature should be: `function($config)` where `$config` will be an
     *   instance of `HTMLPurifier_Config`.
     *
     *   Here is a usage example of such a function:
     *
     *   ```php
     *   // Allow the HTML5 data attribute `data-type` on `img` elements.
     *   $content = HtmlPurifier::process($content, function ($config) {
     *     $config->getHTMLDefinition(true)
     *            ->addAttribute('img', 'data-type', 'Text');
     *   });
     * ```
     *
     * @return string the purified HTML content.
     */
    function html_purify($content, $config = null) {
        return \yii\helpers\HtmlPurifier::process($content, $config);
    }
}

/**
 * Set an alias for the app
 */
if (!function_exists('set_alias')) {

    /**
     * @param string $alias the alias name (e.g. "@yii"). It must start with a '@' character.
     * It may contain the forward slash '/' which serves as boundary character when performing
     * alias translation by [[getAlias()]].
     * @param string $path the path corresponding to the alias. If this is null, the alias will
     * be removed. Trailing '/' and '\' characters will be trimmed. This can be
     *
     * - a directory or a file path (e.g. `/tmp`, `/tmp/main.txt`)
     * - a URL (e.g. `http://www.yiiframework.com`)
     * - a path alias (e.g. `@yii/base`). In this case, the path alias will be converted into the
     *   actual path first by calling [[getAlias()]].
     *
     * @return void
     */
    function set_alias($alias, $path) {
        return \Yii::setAlias($alias, $path);
    }
}

/**
 * Return an alias from the app
 */
if (!function_exists('get_alias')) {

    /**
     * @param string $alias the alias to be translated.
     * @param bool $throwException whether to throw an exception if the given alias is invalid.
     * If this is false and an invalid alias is given, false will be returned by this method.
     * @return string|bool the path corresponding to the alias, false if the root alias is not previously registered.
     * @throws InvalidParamException if the alias is invalid while $throwException is true.
     */
    function get_alias($alias, $throwException = true) {
        return \Yii::getAlias($alias, $throwException);
    }
}

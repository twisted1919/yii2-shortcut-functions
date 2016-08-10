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
    function app() {
        return \Yii::$app;
    }
}

/**
 * Check the named app component
 */
if (!function_exists('app_has')) {
    function app_has($component, $checkInstance = false) {
        return app()->has($component, $checkInstance);
    }
}

/**
 * Return named app component
 */
if (!function_exists('app_get')) {
    function app_get($component) {
        return app()->get($component);
    }
}

/**
 * Set named app component
 */
if (!function_exists('app_set')) {
    function app_set($component, $options = null) {
        return app()->set($component, $options);
    }
}

/**
 * Return the request object
 */
if (!function_exists('request')) {
    function request() {
        return app_get('request');
    }
}

/**
 * Return the response object
 */
if (!function_exists('response')) {
    function response() {
        return app_get('response');
    }
}

/**
 * Return the user object
 */
if (!function_exists('user')) {
    function user() {
        return app_get('user');
    }
}

/**
 * Return the di container object
 */
if (!function_exists('container')) {
    function container() {
        return \Yii::$container;
    }
}

/**
 * Return environment variable
 */
if (!function_exists('env')) {
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
    function array_get(array $source = array(), $key, $default = null) {
        return \yii\helpers\ArrayHelper::getValue($source, $key, $default);
    }
}

/**
 * Return the file system object
 */
if (!function_exists('fs')) {
    function fs($what = null) {
        return app_get(env('FS_ADAPTER', ($what !== null ?: 'fsLocal')));
    }
}

/**
 * Output data and stop execution
 */
if (!function_exists('dd')) {
    function dd($data, $level = 10, $highlight = true) {
        \yii\helpers\VarDumper::dump($data, $level, $highlight);
        app()->end();
    }
}

/**
 * Return a param from application params section
 */
if (!function_exists('app_param')) {
    function app_param($key, $default = null) {
        return array_get(app()->params, $key, $default);
    }
}

/**
 * Return a param from application view params
 */
if (!function_exists('view_param')) {
    function app_param($key, $default = null) {
        return array_get(app()->view->params, $key, $default);
    }
}

/**
 * Return the db component
 */
if (!function_exists('db')) {
    function db() {
        return app_get('db');
    }
}

/**
 * Return the cache component
 */
if (!function_exists('cache')) {
    function cache() {
        return app_get('cache');
    }
}

/**
 * Return the options component
 */
if (!function_exists('options')) {
    function options() {
        return app_get('options');
    }
}

/**
 * Return the notify component
 */
if (!function_exists('notify')) {
    function notify() {
        return app_get('notify');
    }
}

/**
 * Return the options component
 */
if (!function_exists('options')) {
    function cache() {
        return app_get('options');
    }
}

/**
 * Translation
 */
if (!function_exists('t')) {
    function t($category, $message, $params = [], $language = null) {
        return call_user_func_array(['\Yii', 't'], func_get_args());
    }
}

/**
 * Get a named module or the current one.
 */
if (!function_exists('module')) {
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
    function security() {
        return app()->getSecurity();
    }
}

/**
 * Create the url
 */
if (!function_exists('url')) {
    function url($url = '', $scheme = false) {
        return call_user_func_array(['\yii\helpers\Url', 'to'], func_get_args());
    }
}

/**
 * Get the auth manager
 */
if (!function_exists('auth_manager')) {
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
    function mailer() {
        return app_get('mailer');
    }
}

/**
 * Return the session component
 */
if (!function_exists('session')) {
    function session() {
        return app_get('session');
    }
}

/**
 * Return the cookie component
 */
if (!function_exists('cookie')) {
    function cookie() {
        return request()->cookie;
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
    function html_encode($content) {
        return \yii\helpers\Html::encode($content);
    }
}

/**
 * Return decoded html string
 */
if (!function_exists('html_decode')) {
    function html_decode($content) {
        return \yii\helpers\Html::decode($content);
    }
}

/**
 * Return a safe html string
 */
if (!function_exists('html_purify')) {
    function html_purify($content, $config = null) {
        return \yii\helpers\HtmlPurifier::process($content, $config);
    }
}

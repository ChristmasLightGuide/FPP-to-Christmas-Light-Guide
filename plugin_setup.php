<?php

include_once "/opt/fpp/www/common.php";
include_once 'functions.inc.php';

$pluginName = basename(dirname(__FILE__));

$logFile = $settings['logDirectory'] . "/" . $pluginName . ".log";

$clgSettings = array(
    'api_key' => '',
    'display_name' => '',
    'description' => '',
    'location' => '',
    'website' => '',
    'facebook' => '',
    'youtube' => ''
);

foreach ($clgSettings as $key => $default) {
    $clgSettings[$key] = $default;
    if (isset($pluginSettings[$key])) {
        $clgSettings[$key] = urldecode($pluginSettings[$key]);
    }
}

if (isset($_POST['submit'])) {
    foreach ($clgSettings as $key => $value) {
        if (isset($_POST[$key])) {
            $clgSettings[$key] = urlencode($_POST[$key]);
        }
    }
    WriteSettingToFile("clg", json_encode($clgSettings));
}

?>

<div id="global" class="settings">
    <fieldset>
        <legend>Christmas Light Guide Settings</legend>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <p>Display Name: <input type="text" name="display_name" value="<?php echo $clgSettings['display_name']; ?>"></p>
            <p>Description: <textarea name="description"><?php echo $clgSettings['description']; ?></textarea></p>
            <p>Location: <input type="text" name="location" value="<?php echo $clgSettings['location']; ?>"></p>
            <p>Website: <input type="url" name="website" value="<?php echo $clgSettings['website']; ?>"></p>
            <p>Facebook: <input type="url" name="facebook" value="<?php echo $clgSettings['facebook']; ?>"></p>
            <p>YouTube: <input type="url" name="youtube" value="<?php echo $clgSettings['youtube']; ?>"></p>
            <p>API Key: <input type="text" name="api_key" value="<?php echo $clgSettings['api_key']; ?>"></p>
            <input id="submit" name="submit" type="submit" class="buttons" value="Save">
        </form>
    </fieldset>
</div>
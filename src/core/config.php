<?php

\Source\Core\Environment::load(__DIR__ . '/../../');

define("CONF_APP_NAME", getenv("APP_NAME"));

define("CONF_URL_BASE", "/" . CONF_APP_NAME);

define("CONF_URL_FULL", getenv("APP_URL"));

define("CONF_VIEW_PATH", __DIR__ . "/../views");
<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['LOG']['BGM']['BgmVrt']['writerConfiguration'] = array(
	// configuration for WARNING severity, including all
	// levels with higher severity (ERROR, CRITICAL, EMERGENCY)
	\TYPO3\CMS\Core\Log\LogLevel::DEBUG => array(
		'TYPO3\\CMS\\Core\\Log\\Writer\\FileWriter' => array(
			// configuration for the writer
			'logFile' => 'typo3temp/logs/bgm_vrt.log'
		),
	),
);

?>
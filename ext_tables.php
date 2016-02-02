<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bgmvrt_domain_model_testsuite',
    'EXT:bgm_vrt/Resources/Private/Language/locallang_csh_tx_bgmvrt_domain_model_testsuite.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bgmvrt_domain_model_testsuite');

if (TYPO3_MODE === 'BE') {

    /**
     * Registers a Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'BGM.' . $_EXTKEY,
        'tools',     // Make module a submodule of 'web'
        'bgmvrt',    // Submodule key
        '',          // Position
        array(
            'Testsuite' => 'list, show',
            'Testrun' => 'show',
        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_module.xlf',
        )
    );
}

?>
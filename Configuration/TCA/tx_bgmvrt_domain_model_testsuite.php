<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:bgm_vrt/Resources/Private/Language/locallang_db.xlf:tx_bgmvrt_domain_model_testsuite',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'rootLevel' => 1,
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('bgm_vrt') . 'ext_icon.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, identifier, command',
    ),
    'types' => array(
        0 => array('showitem' => 'title, identifier, command, hidden, starttime, endtime, sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource'),
    ),
    'palettes' => array(),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_bgmvrt_domain_model_testsuite',
                'foreign_table_where' => 'AND tx_bgmvrt_domain_model_testsuite.pid=###CURRENT_PID### AND tx_bgmvrt_domain_model_testsuite.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bgm_vrt/Resources/Private/Language/locallang_db.xlf:tx_bgmvrt_domain_model_testsuite.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ),
        ),
        'identifier' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bgm_vrt/Resources/Private/Language/locallang_db.xlf:tx_bgmvrt_domain_model_testsuite.identifier',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ),
        ),
        'command' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bgm_vrt/Resources/Private/Language/locallang_db.xlf:tx_bgmvrt_domain_model_testsuite.command',
            'config' => array(
                'type' => 'text',
                'rows' => 10,
                'cols' => 50,
                'eval' => 'trim,required',
            ),
        ),
    ),
);
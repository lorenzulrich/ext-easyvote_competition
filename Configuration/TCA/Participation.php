<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotecompetition_domain_model_participation'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_easyvotecompetition_domain_model_participation']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, image, media, language, voting_enabled, votes, community_user',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, image, media, language, voting_enabled, votes, community_user, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_easyvotecompetition_domain_model_participation',
				'foreign_table_where' => 'AND tx_easyvotecompetition_domain_model_participation.pid=###CURRENT_PID### AND tx_easyvotecompetition_domain_model_participation.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
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
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.title',
			'config' => array(
				'type' => 'input',
				'eval' => 'required,trim'
			)
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'media' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.media',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'language' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.language',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.language.1', 1),
					array('LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.language.2', 2),
					array('LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.language.3', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			)
		),
		'voting_enabled' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.voting_enabled',
			'config' => array(
				'type' => 'check',
				'default' => 1
			)
		),
		'votes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.votes',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_easyvotecompetition_domain_model_vote',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'community_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_participation.community_user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => "AND tx_extbase_type LIKE 'Tx_Easyvote_CommunityUser' ORDER BY username",
				'items' => array(
					array('', 0)
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
		'competition' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

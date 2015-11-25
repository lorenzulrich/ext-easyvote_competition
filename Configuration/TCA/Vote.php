<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotecompetition_domain_model_vote'] = array(
    'ctrl' => $GLOBALS['TCA']['tx_easyvotecompetition_domain_model_vote']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, competition, participation, community_user',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden;;1, competition, participation, community_user, '),
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
                'foreign_table' => 'tx_easyvotecompetition_domain_model_vote',
                'foreign_table_where' => 'AND tx_easyvotecompetition_domain_model_vote.pid=###CURRENT_PID### AND tx_easyvotecompetition_domain_model_vote.sys_language_uid IN (-1,0)',
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
        'competition' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_vote.competition',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_easyvotecompetition_domain_model_competition',
                'foreign_table_where' => "ORDER BY title_short",
                'items' => array(
                    array('', 0)
                ),
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'participation' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_vote.participation',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_easyvotecompetition_domain_model_participation',
                'foreign_table_where' => "ORDER BY title",
                'items' => array(
                    array('', 0)
                ),
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'community_user' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_vote.community_user',
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
        'crdate' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:easyvote_competition/Resources/Private/Language/locallang_db.xlf:tx_easyvotecompetition_domain_model_vote.crdate',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'date',
                'readOnly' => 1
            ),
        ),
    ),
);

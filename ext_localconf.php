<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Competitiondetail',
    array(
        'Competition' => 'show',
        'Participation' => 'listByCompetition, addVote'

    ),
    // non-cacheable actions
    array(
        'Competition' => '',
        'Participation' => 'listByCompetition, addVote, create, update, delete, ',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Participationdetail',
    array(
        'Participation' => 'show',

    ),
    // non-cacheable actions
    array(
        'Competition' => '',
        'Participation' => 'show, create, update, delete',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Manageparticipation',
    array(
        'Participation' => 'edit, updatePreview, publish, delete',

    ),
    // non-cacheable actions
    array(
        'Participation' => 'edit, updatePreview, publish, delete',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Myparticipations',
    array(
        'Competition' => 'listForCommunityUser',

    ),
    // non-cacheable actions
    array(
        'Competition' => '',
        'Participation' => 'create, update, delete, ',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Competitionarchive',
    array(
        'Competition' => 'archive',

    ),
    // non-cacheable actions
    array(
        'Competition' => '',
        'Participation' => 'create, update, delete, ',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.' . $_EXTKEY,
    'Competitionlist',
    array(
        'Competition' => 'list',

    ),
    // non-cacheable actions
    array(
        'Competition' => '',
        'Participation' => 'create, update, delete, ',

    )
);

#
# Table structure for table 'tx_easyvotecompetition_domain_model_competition'
#
CREATE TABLE tx_easyvotecompetition_domain_model_competition (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	type int(11) DEFAULT '0' NOT NULL,
	title_short varchar(255) DEFAULT '' NOT NULL,
	title_long varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	image int(11) unsigned NOT NULL default '0',
	voting_frequency int(11) DEFAULT '0' NOT NULL,
	participation_end_date datetime DEFAULT '0000-00-00 00:00:00',
	participations int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotecompetition_domain_model_participation'
#
CREATE TABLE tx_easyvotecompetition_domain_model_participation (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	competition int(11) unsigned DEFAULT '0' NOT NULL,

	title text NOT NULL,
	description text NOT NULL,
	image int(11) unsigned NOT NULL default '0',
	media varchar(255) DEFAULT '' NOT NULL,
	language int(11) DEFAULT '0' NOT NULL,
	voting_enabled tinyint(1) unsigned DEFAULT '0' NOT NULL,
	votes int(11) unsigned DEFAULT '0',
	community_user int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotecompetition_domain_model_vote'
#
CREATE TABLE tx_easyvotecompetition_domain_model_vote (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	competition int(11) unsigned DEFAULT '0',
	participation int(11) unsigned DEFAULT '0',
	community_user int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotecompetition_domain_model_participation'
#
CREATE TABLE tx_easyvotecompetition_domain_model_participation (

	competition  int(11) unsigned DEFAULT '0' NOT NULL,

);

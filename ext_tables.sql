#
# Add fal reference field to news record
#
CREATE TABLE tx_news_domain_model_news (
	fal_media int(11) unsigned DEFAULT '0',
	fal_related_files int(11) unsigned DEFAULT '0'
);

#
# Add show in preview to file reference
CREATE TABLE sys_file_reference (
	showinpreview tinyint(4) DEFAULT '0' NOT NULL
);


#
# Add fal reference field to news record
#
CREATE TABLE tx_news_domain_model_news (
	fal_media text
);

#
# Add show in preview to file reference
CREATE TABLE sys_file_reference (
	showinpreview tinyint(4) DEFAULT '0' NOT NULL
);


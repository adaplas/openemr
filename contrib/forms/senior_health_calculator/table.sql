CREATE TABLE IF NOT EXISTS `form_senior_health_calculator` (
id bigint(20) NOT NULL auto_increment,
date datetime default NULL,
pid bigint(20) default NULL,
user varchar(255) default NULL,
groupname varchar(255) default NULL,
authorized tinyint(4) default NULL,
activity tinyint(4) default NULL,
pmhx TEXT,
fx TEXT,
mmse TEXT,
moca TEXT,
mini_cog TEXT,
gait_speed TEXT,
chair_stands TEXT,
grip_strength TEXT,
weight_loss TEXT,
bmi TEXT,
albumin TEXT,
score TEXT,

PRIMARY KEY (id)
) ENGINE=InnoDB;

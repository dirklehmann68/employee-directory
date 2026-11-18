CREATE TABLE tx_employeedirectory_domain_model_department (
    hidden smallint unsigned NOT NULL DEFAULT 0,
    description text,
    description_display varchar(20) NOT NULL DEFAULT 'subline',
    detail_link varchar(2048) NOT NULL DEFAULT ''
);

CREATE TABLE tx_employeedirectory_domain_model_jobfunction (
    hidden smallint unsigned NOT NULL DEFAULT 0
);

CREATE TABLE tx_employeedirectory_domain_model_employee (
    slug varchar(2048) NOT NULL DEFAULT '',
    starttime int unsigned NOT NULL DEFAULT 0,
    endtime int unsigned NOT NULL DEFAULT 0,
    fe_group varchar(255) NOT NULL DEFAULT ''
);

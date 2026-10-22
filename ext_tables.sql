CREATE TABLE tx_employeedirectory_domain_model_department (
    hidden smallint unsigned NOT NULL DEFAULT 0
);

CREATE TABLE tx_employeedirectory_domain_model_jobfunction (
    hidden smallint unsigned NOT NULL DEFAULT 0
);

CREATE TABLE tx_employeedirectory_domain_model_employee (
    slug varchar(2048) NOT NULL DEFAULT ''
);

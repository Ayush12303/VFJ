CREATE TABLE non_conformance_report (
    id INT,
    non_conformance_report_no INT,
    concerned_section VARCHAR(255),
    department VARCHAR(255),
    audited VARCHAR(255),
    auditor_name VARCHAR(255),
    audited_date DATE,
    non_conformance_against_ISO_number INT,
    non_conformance_against_IMS_number INT,
    paragraph_no INT,
    category VARCHAR(255),
    name_of_auditor VARCHAR(255),
    observation_agreed_or_not VARCHAR(255),
    comments VARCHAR(255),
    name_of_auditee VARCHAR(255),
    design VARCHAR(255),
    date DATE
);

--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.14
-- Dumped by pg_dump version 9.1.14
-- Started on 2015-07-13 16:33:55 EDT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 6 (class 2615 OID 2200)
-- Name: mod_pykota; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA mod_pykota;


ALTER SCHEMA mod_pykota OWNER TO postgres;

--
-- TOC entry 2103 (class 0 OID 0)
-- Dependencies: 6
-- Name: SCHEMA mod_pykota; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA mod_pykota IS 'standard public schema';


--
-- TOC entry 198 (class 3079 OID 11644)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2105 (class 0 OID 0)
-- Dependencies: 198
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = mod_pykota, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 161 (class 1259 OID 84006)
-- Dependencies: 1855 1856 1857 6
-- Name: billingcodes; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE billingcodes (
    id integer NOT NULL,
    billingcode text NOT NULL,
    description text,
    balance double precision DEFAULT 0.0,
    pagecounter integer DEFAULT 0,
    serverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.billingcodes OWNER TO postgres;

--
-- TOC entry 162 (class 1259 OID 84015)
-- Dependencies: 6
-- Name: billingcodes_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE billingcodes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.billingcodes_id_seq OWNER TO postgres;

--
-- TOC entry 163 (class 1259 OID 84017)
-- Dependencies: 161 6
-- Name: billingcodes_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE billingcodes_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.billingcodes_id_seq1 OWNER TO postgres;

--
-- TOC entry 2106 (class 0 OID 0)
-- Dependencies: 163
-- Name: billingcodes_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE billingcodes_id_seq1 OWNED BY billingcodes.id;


--
-- TOC entry 164 (class 1259 OID 84019)
-- Dependencies: 1859 1860 6
-- Name: coefficients; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE coefficients (
    id integer NOT NULL,
    printerid integer NOT NULL,
    label text NOT NULL,
    coefficient double precision DEFAULT 1.0,
    printersserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.coefficients OWNER TO postgres;

--
-- TOC entry 165 (class 1259 OID 84027)
-- Dependencies: 6
-- Name: coefficients_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE coefficients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.coefficients_id_seq OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 84029)
-- Dependencies: 164 6
-- Name: coefficients_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE coefficients_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.coefficients_id_seq1 OWNER TO postgres;

--
-- TOC entry 2107 (class 0 OID 0)
-- Dependencies: 166
-- Name: coefficients_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE coefficients_id_seq1 OWNED BY coefficients.id;


--
-- TOC entry 167 (class 1259 OID 84031)
-- Dependencies: 6 164
-- Name: coefficients_printerid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE coefficients_printerid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.coefficients_printerid_seq OWNER TO postgres;

--
-- TOC entry 2108 (class 0 OID 0)
-- Dependencies: 167
-- Name: coefficients_printerid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE coefficients_printerid_seq OWNED BY coefficients.printerid;


--
-- TOC entry 168 (class 1259 OID 84033)
-- Dependencies: 1863 1864 6
-- Name: grouppquota; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE grouppquota (
    id integer NOT NULL,
    groupid integer NOT NULL,
    printerid integer NOT NULL,
    softlimit integer,
    hardlimit integer,
    maxjobsize integer,
    datelimit timestamp(6) without time zone,
    printersserverid character varying(255) DEFAULT 'P1L09'::character varying,
    groupsserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.grouppquota OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 84041)
-- Dependencies: 168 6
-- Name: grouppquota_groupid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE grouppquota_groupid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.grouppquota_groupid_seq OWNER TO postgres;

--
-- TOC entry 2109 (class 0 OID 0)
-- Dependencies: 169
-- Name: grouppquota_groupid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE grouppquota_groupid_seq OWNED BY grouppquota.groupid;


--
-- TOC entry 170 (class 1259 OID 84043)
-- Dependencies: 6
-- Name: grouppquota_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE grouppquota_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.grouppquota_id_seq OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 84045)
-- Dependencies: 168 6
-- Name: grouppquota_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE grouppquota_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.grouppquota_id_seq1 OWNER TO postgres;

--
-- TOC entry 2110 (class 0 OID 0)
-- Dependencies: 171
-- Name: grouppquota_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE grouppquota_id_seq1 OWNED BY grouppquota.id;


--
-- TOC entry 172 (class 1259 OID 84047)
-- Dependencies: 6 168
-- Name: grouppquota_printerid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE grouppquota_printerid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.grouppquota_printerid_seq OWNER TO postgres;

--
-- TOC entry 2111 (class 0 OID 0)
-- Dependencies: 172
-- Name: grouppquota_printerid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE grouppquota_printerid_seq OWNED BY grouppquota.printerid;


--
-- TOC entry 173 (class 1259 OID 84049)
-- Dependencies: 1868 1869 6
-- Name: groups; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    groupname text NOT NULL,
    description text,
    limitby text DEFAULT 'quota'::text,
    serverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.groups OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 84057)
-- Dependencies: 6
-- Name: groups_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE groups_id_seq
    START WITH 100000000
    INCREMENT BY 1
    MINVALUE 100000000
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.groups_id_seq OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 84059)
-- Dependencies: 6 173
-- Name: groups_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE groups_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.groups_id_seq1 OWNER TO postgres;

--
-- TOC entry 2112 (class 0 OID 0)
-- Dependencies: 175
-- Name: groups_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE groups_id_seq1 OWNED BY groups.id;


--
-- TOC entry 176 (class 1259 OID 84061)
-- Dependencies: 1871 1872 6
-- Name: groupsmembers; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE groupsmembers (
    groupid integer NOT NULL,
    userid integer NOT NULL,
    groupsserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL,
    usersserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.groupsmembers OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 84069)
-- Dependencies: 1873 1874 1875 6
-- Name: jobhistory; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE jobhistory (
    id integer NOT NULL,
    jobid text,
    userid integer NOT NULL,
    printerid integer,
    pagecounter integer DEFAULT 0,
    jobsizebytes bigint,
    jobsize integer,
    jobprice double precision,
    action text,
    filename text,
    title text,
    copies integer,
    options text,
    hostname text,
    md5sum text,
    pages text,
    billingcode text,
    precomputedjobsize integer,
    precomputedjobprice double precision,
    jobdate timestamp(6) without time zone DEFAULT now(),
    serverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.jobhistory OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 84078)
-- Dependencies: 6
-- Name: jobhistory_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE jobhistory_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.jobhistory_id_seq OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 84080)
-- Dependencies: 177 6
-- Name: jobhistory_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE jobhistory_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.jobhistory_id_seq1 OWNER TO postgres;

--
-- TOC entry 2113 (class 0 OID 0)
-- Dependencies: 179
-- Name: jobhistory_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE jobhistory_id_seq1 OWNED BY jobhistory.id;


--
-- TOC entry 180 (class 1259 OID 84082)
-- Dependencies: 177 6
-- Name: jobhistory_userid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE jobhistory_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.jobhistory_userid_seq OWNER TO postgres;

--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 180
-- Name: jobhistory_userid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE jobhistory_userid_seq OWNED BY jobhistory.userid;


--
-- TOC entry 181 (class 1259 OID 84084)
-- Dependencies: 1878 1879 6
-- Name: payments; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE payments (
    id integer NOT NULL,
    userid integer NOT NULL,
    amount double precision,
    description text,
    date timestamp(6) without time zone DEFAULT now(),
    usersserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.payments OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 84092)
-- Dependencies: 6
-- Name: payments_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.payments_id_seq OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 84094)
-- Dependencies: 181 6
-- Name: payments_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE payments_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.payments_id_seq1 OWNER TO postgres;

--
-- TOC entry 2115 (class 0 OID 0)
-- Dependencies: 183
-- Name: payments_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE payments_id_seq1 OWNED BY payments.id;


--
-- TOC entry 184 (class 1259 OID 84096)
-- Dependencies: 181 6
-- Name: payments_userid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE payments_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.payments_userid_seq OWNER TO postgres;

--
-- TOC entry 2116 (class 0 OID 0)
-- Dependencies: 184
-- Name: payments_userid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE payments_userid_seq OWNED BY payments.userid;


--
-- TOC entry 185 (class 1259 OID 84098)
-- Dependencies: 1882 1883 6
-- Name: printergroupsmembers; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE printergroupsmembers (
    groupid integer NOT NULL,
    printerid integer NOT NULL,
    printersserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL,
    printersserverid2 character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.printergroupsmembers OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 84106)
-- Dependencies: 1884 1885 1886 1887 1888 6
-- Name: printers; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE printers (
    id integer NOT NULL,
    printername text NOT NULL,
    description text,
    priceperpage double precision DEFAULT 0.0,
    priceperjob double precision DEFAULT 0.0,
    passthrough boolean DEFAULT false,
    maxjobsize integer,
    isgroups boolean DEFAULT false,
    serverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.printers OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 84117)
-- Dependencies: 6
-- Name: printers_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE printers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.printers_id_seq OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 84119)
-- Dependencies: 186 6
-- Name: printers_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE printers_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.printers_id_seq1 OWNER TO postgres;

--
-- TOC entry 2117 (class 0 OID 0)
-- Dependencies: 188
-- Name: printers_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE printers_id_seq1 OWNED BY printers.id;


--
-- TOC entry 189 (class 1259 OID 84121)
-- Dependencies: 1890 6
-- Name: server; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE server (
    denomination character varying(255),
    place text,
    supporter character varying(255),
    active boolean,
    id character varying(255) DEFAULT 'P1L09'::character varying NOT NULL,
    description text
);


ALTER TABLE mod_pykota.server OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 84128)
-- Dependencies: 1891 1892 1893 1894 1895 6
-- Name: userpquota; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE userpquota (
    id integer NOT NULL,
    userid integer NOT NULL,
    printerid integer NOT NULL,
    lifepagecounter integer DEFAULT 0,
    pagecounter integer DEFAULT 0,
    softlimit integer,
    hardlimit integer,
    datelimit timestamp(6) without time zone,
    maxjobsize integer,
    warncount integer DEFAULT 0,
    printersserverid character varying(255) DEFAULT 'P1L09'::character varying,
    usersserverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.userpquota OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 84139)
-- Dependencies: 6
-- Name: userpquota_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE userpquota_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.userpquota_id_seq OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 84141)
-- Dependencies: 6 190
-- Name: userpquota_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE userpquota_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.userpquota_id_seq1 OWNER TO postgres;

--
-- TOC entry 2118 (class 0 OID 0)
-- Dependencies: 192
-- Name: userpquota_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE userpquota_id_seq1 OWNED BY userpquota.id;


--
-- TOC entry 193 (class 1259 OID 84143)
-- Dependencies: 190 6
-- Name: userpquota_printerid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE userpquota_printerid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.userpquota_printerid_seq OWNER TO postgres;

--
-- TOC entry 2119 (class 0 OID 0)
-- Dependencies: 193
-- Name: userpquota_printerid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE userpquota_printerid_seq OWNED BY userpquota.printerid;


--
-- TOC entry 194 (class 1259 OID 84145)
-- Dependencies: 6 190
-- Name: userpquota_userid_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE userpquota_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.userpquota_userid_seq OWNER TO postgres;

--
-- TOC entry 2120 (class 0 OID 0)
-- Dependencies: 194
-- Name: userpquota_userid_seq; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE userpquota_userid_seq OWNED BY userpquota.userid;


--
-- TOC entry 195 (class 1259 OID 84147)
-- Dependencies: 1899 1900 1901 1902 1903 6
-- Name: users; Type: TABLE; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    username text NOT NULL,
    email text,
    balance double precision DEFAULT 0.0,
    lifetimepaid double precision DEFAULT 0.0,
    limitby text DEFAULT 'quota'::text,
    description text,
    overcharge double precision DEFAULT 1.0 NOT NULL,
    serverid character varying(255) DEFAULT 'P1L09'::character varying NOT NULL
);


ALTER TABLE mod_pykota.users OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 84158)
-- Dependencies: 6
-- Name: users_id_seq; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.users_id_seq OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 84160)
-- Dependencies: 6 195
-- Name: users_id_seq1; Type: SEQUENCE; Schema: mod_pykota; Owner: postgres
--

CREATE SEQUENCE users_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mod_pykota.users_id_seq1 OWNER TO postgres;

--
-- TOC entry 2121 (class 0 OID 0)
-- Dependencies: 197
-- Name: users_id_seq1; Type: SEQUENCE OWNED BY; Schema: mod_pykota; Owner: postgres
--

ALTER SEQUENCE users_id_seq1 OWNED BY users.id;


--
-- TOC entry 1858 (class 2604 OID 84162)
-- Dependencies: 163 161
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY billingcodes ALTER COLUMN id SET DEFAULT nextval('billingcodes_id_seq1'::regclass);


--
-- TOC entry 1861 (class 2604 OID 84163)
-- Dependencies: 166 164
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY coefficients ALTER COLUMN id SET DEFAULT nextval('coefficients_id_seq1'::regclass);


--
-- TOC entry 1862 (class 2604 OID 84164)
-- Dependencies: 167 164
-- Name: printerid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY coefficients ALTER COLUMN printerid SET DEFAULT nextval('coefficients_printerid_seq'::regclass);


--
-- TOC entry 1865 (class 2604 OID 84165)
-- Dependencies: 171 168
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY grouppquota ALTER COLUMN id SET DEFAULT nextval('grouppquota_id_seq1'::regclass);


--
-- TOC entry 1866 (class 2604 OID 84166)
-- Dependencies: 169 168
-- Name: groupid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY grouppquota ALTER COLUMN groupid SET DEFAULT nextval('grouppquota_groupid_seq'::regclass);


--
-- TOC entry 1867 (class 2604 OID 84167)
-- Dependencies: 172 168
-- Name: printerid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY grouppquota ALTER COLUMN printerid SET DEFAULT nextval('grouppquota_printerid_seq'::regclass);


--
-- TOC entry 1870 (class 2604 OID 84168)
-- Dependencies: 175 173
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq1'::regclass);


--
-- TOC entry 1876 (class 2604 OID 84169)
-- Dependencies: 179 177
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY jobhistory ALTER COLUMN id SET DEFAULT nextval('jobhistory_id_seq1'::regclass);


--
-- TOC entry 1877 (class 2604 OID 84170)
-- Dependencies: 180 177
-- Name: userid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY jobhistory ALTER COLUMN userid SET DEFAULT nextval('jobhistory_userid_seq'::regclass);


--
-- TOC entry 1880 (class 2604 OID 84171)
-- Dependencies: 183 181
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY payments ALTER COLUMN id SET DEFAULT nextval('payments_id_seq1'::regclass);


--
-- TOC entry 1881 (class 2604 OID 84172)
-- Dependencies: 184 181
-- Name: userid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY payments ALTER COLUMN userid SET DEFAULT nextval('payments_userid_seq'::regclass);


--
-- TOC entry 1889 (class 2604 OID 84173)
-- Dependencies: 188 186
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY printers ALTER COLUMN id SET DEFAULT nextval('printers_id_seq1'::regclass);


--
-- TOC entry 1896 (class 2604 OID 84174)
-- Dependencies: 192 190
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY userpquota ALTER COLUMN id SET DEFAULT nextval('userpquota_id_seq1'::regclass);


--
-- TOC entry 1897 (class 2604 OID 84175)
-- Dependencies: 194 190
-- Name: userid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY userpquota ALTER COLUMN userid SET DEFAULT nextval('userpquota_userid_seq'::regclass);


--
-- TOC entry 1898 (class 2604 OID 84176)
-- Dependencies: 193 190
-- Name: printerid; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY userpquota ALTER COLUMN printerid SET DEFAULT nextval('userpquota_printerid_seq'::regclass);


--
-- TOC entry 1904 (class 2604 OID 84177)
-- Dependencies: 197 195
-- Name: id; Type: DEFAULT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq1'::regclass);


--
-- TOC entry 2061 (class 0 OID 84006)
-- Dependencies: 161 2098
-- Data for Name: billingcodes; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--



--
-- TOC entry 2122 (class 0 OID 0)
-- Dependencies: 162
-- Name: billingcodes_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('billingcodes_id_seq', 1, false);


--
-- TOC entry 2123 (class 0 OID 0)
-- Dependencies: 163
-- Name: billingcodes_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('billingcodes_id_seq1', 1, true);


--
-- TOC entry 2064 (class 0 OID 84019)
-- Dependencies: 164 2098
-- Data for Name: coefficients; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--



--
-- TOC entry 2124 (class 0 OID 0)
-- Dependencies: 165
-- Name: coefficients_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('coefficients_id_seq', 1, false);


--
-- TOC entry 2125 (class 0 OID 0)
-- Dependencies: 166
-- Name: coefficients_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('coefficients_id_seq1', 6, true);


--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 167
-- Name: coefficients_printerid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('coefficients_printerid_seq', 5, true);


--
-- TOC entry 2068 (class 0 OID 84033)
-- Dependencies: 168 2098
-- Data for Name: grouppquota; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO grouppquota VALUES (1, 100000002, 2, 190, 200, NULL, NULL, 'P1L09', 'P1L09');
INSERT INTO grouppquota VALUES (2, 100000002, 5, 490, 500, NULL, '2015-07-17 15:15:21', 'P1L09', 'P1L09');


--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 169
-- Name: grouppquota_groupid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('grouppquota_groupid_seq', 1, false);


--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 170
-- Name: grouppquota_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('grouppquota_id_seq', 2, true);


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 171
-- Name: grouppquota_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('grouppquota_id_seq1', 1, false);


--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 172
-- Name: grouppquota_printerid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('grouppquota_printerid_seq', 1, false);


--
-- TOC entry 2073 (class 0 OID 84049)
-- Dependencies: 173 2098
-- Data for Name: groups; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO groups VALUES (100000002, 'tecnol', 'dfgfgdfg', 'quota', 'P1L09');


--
-- TOC entry 2131 (class 0 OID 0)
-- Dependencies: 174
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('groups_id_seq', 100000002, true);


--
-- TOC entry 2132 (class 0 OID 0)
-- Dependencies: 175
-- Name: groups_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('groups_id_seq1', 100000002, true);


--
-- TOC entry 2076 (class 0 OID 84061)
-- Dependencies: 176 2098
-- Data for Name: groupsmembers; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO groupsmembers VALUES (100000002, 1, 'P1L09', 'P1L09');
INSERT INTO groupsmembers VALUES (100000002, 2, 'P1L09', 'P1L09');
INSERT INTO groupsmembers VALUES (100000002, 3, 'P1L09', 'P1L09');


--
-- TOC entry 2077 (class 0 OID 84069)
-- Dependencies: 177 2098
-- Data for Name: jobhistory; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO jobhistory VALUES (1, '224', 1, 2, 0, 114, 1, 0, 'ALLOW', NULL, 'Document 1', 1, 'media=Letter Collate job-uuid=urn:uuid:ee0a6041-f546-3d06-5bd7-e0c0bde1e997 job-originating-host-name=localhost time-at-creation=1436277106 time-at-processing=1436277106 PageSize=Letter', 'localhost', 'c648c02fbf3a075d8451ff527d7a2881', NULL, NULL, 1, 0, '2015-07-07 09:52:04.164929', 'P1L09');
INSERT INTO jobhistory VALUES (2, '225', 1, 2, 1, 1538933, 3, 0, 'ALLOW', NULL, 'ANEXO5-Informe.pdf', 1, 'StpFineBrightness=None StpGamma=None StpBrightness=None Duplex=DuplexNoTumble number-up=1 PageSize=Letter Resolution=300dpi InputSlot=Standard ColorModel=Gray StpDitherAlgorithm=None StpColorCorrection=None StpQuality=Standard StpColorPrecision=Normal StpFineContrast=None StpContrast=None StpImageType=TextGraphics StpDensity=None StpFineGamma=None StpiShrinkOutput=Shrink StpFineDensity=None noStpLinearContrast job-uuid=urn:uuid:1bfe82cb-ea57-390b-6ec6-02497d1cb47e job-originating-host-name=localhost time-at-creation=1436277163 time-at-processing=1436277163', 'localhost', 'd9f3eb52b826ab865b3c098fa4c37ec8', NULL, NULL, 3, 0, '2015-07-07 09:53:11.065831', 'P1L09');
INSERT INTO jobhistory VALUES (3, '226', 1, 2, 4, 911563, 3, 0, 'ALLOW', NULL, 'ANEXO5-Informe Gestion de Entidades.pdf', 1, 'StpFineBrightness=None StpGamma=None StpBrightness=None Duplex=DuplexNoTumble number-up=1 PageSize=Letter Resolution=300dpi InputSlot=Standard ColorModel=Gray StpDitherAlgorithm=None StpColorCorrection=None StpQuality=Standard StpColorPrecision=Normal StpFineContrast=None StpContrast=None StpImageType=TextGraphics StpDensity=None StpFineGamma=None StpiShrinkOutput=Shrink StpFineDensity=None noStpLinearContrast job-uuid=urn:uuid:0760710a-2e2c-3147-522e-883bb63ed8b0 job-originating-host-name=localhost time-at-creation=1436277238 time-at-processing=1436277238', 'localhost', '735701ff4428d4e0af137c0f073a074e', NULL, NULL, 3, 0, '2015-07-07 09:54:23.70641', 'P1L09');
INSERT INTO jobhistory VALUES (4, '227', 1, 5, 0, 227137, 1, 0, 'ALLOW', NULL, 'Servidor de Impresion', 1, 'PageSize=Letter Resolution=300dpi number-up=1 job-uuid=urn:uuid:86559307-89d6-3eb1-677f-7a1ea5d72f7e job-originating-host-name=localhost time-at-creation=1436281517 time-at-processing=1436281517', 'localhost', '943721e0c33b7520fa9b66c82aac0cef', NULL, NULL, 1, 0, '2015-07-07 11:05:18.036385', 'P1L09');
INSERT INTO jobhistory VALUES (5, '228', 3, 5, 1, 91673, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:da88b0d3-6c0b-3543-4a1f-8f270f3b881c job-originating-host-name=10.12.34.41 time-at-creation=1436536593 time-at-processing=1436536593', '10.12.34.41', '6458f409e2f4c4ca503755822334f6a8', NULL, NULL, 1, 0, '2015-07-10 09:56:34.907411', 'P1L09');
INSERT INTO jobhistory VALUES (6, '229', 3, 5, 2, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:b99226ba-9262-3000-5876-90b0ce5123d3 job-originating-host-name=10.12.34.41 time-at-creation=1436536665 time-at-processing=1436536665', '10.12.34.41', '091d9b0e94c245b13009305b4849066c', NULL, NULL, 2, 0, '2015-07-10 09:57:45.734276', 'P1L09');
INSERT INTO jobhistory VALUES (7, '230', 3, 5, 4, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:6e45c749-895a-35b3-6d99-aa27ff1a3178 job-originating-host-name=10.12.34.41 time-at-creation=1436536729 time-at-processing=1436536729', '10.12.34.41', '68515aef6644a0d2d787070855145b9f', NULL, NULL, 2, 0, '2015-07-10 09:58:50.07455', 'P1L09');
INSERT INTO jobhistory VALUES (8, '231', 3, 5, 6, 91673, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:669d1362-8ca0-3b1c-7283-64088bf213de job-originating-host-name=10.12.34.41 time-at-creation=1436536752 time-at-processing=1436536752', '10.12.34.41', '63d43061ecac5c271a5452665ac1725a', NULL, NULL, 1, 0, '2015-07-10 09:59:13.194498', 'P1L09');
INSERT INTO jobhistory VALUES (9, '232', 3, 5, 7, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:53d26c29-eb09-3a43-686d-729ade454e7b job-originating-host-name=10.12.34.41 time-at-creation=1436536822 time-at-processing=1436536822', '10.12.34.41', 'e8042fb21c5f6a090854b73a874cbac6', NULL, NULL, 2, 0, '2015-07-10 10:00:22.644123', 'P1L09');
INSERT INTO jobhistory VALUES (10, '233', 3, 5, 9, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:8e25ce9c-d7a8-3d33-6109-46f820a380a2 job-originating-host-name=10.12.34.41 time-at-creation=1436536846 time-at-processing=1436536846', '10.12.34.41', '8aacb40e729ca67a1748538b306aef08', NULL, NULL, 1, 0, '2015-07-10 10:00:47.036952', 'P1L09');
INSERT INTO jobhistory VALUES (11, '234', 3, 5, 10, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:961a0ca6-9270-3586-5eaa-345b1dfb51a8 job-originating-host-name=10.12.34.41 time-at-creation=1436536918 time-at-processing=1436536918', '10.12.34.41', '5602b2242e5a1aab756eb3b7b9f4702a', NULL, NULL, 1, 0, '2015-07-10 10:01:59.05223', 'P1L09');
INSERT INTO jobhistory VALUES (12, '235', 3, 5, 11, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:3f975d97-e0ba-3944-68a8-019c401d28db job-originating-host-name=10.12.34.41 time-at-creation=1436536987 time-at-processing=1436536987', '10.12.34.41', 'bf807df530f2dedcace8150828381eea', NULL, NULL, 1, 0, '2015-07-10 10:03:07.61572', 'P1L09');
INSERT INTO jobhistory VALUES (13, '236', 3, 5, 12, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:5f796364-8d03-368e-524b-80ecd75f4cfe job-originating-host-name=10.12.34.41 time-at-creation=1436537324 time-at-processing=1436537324', '10.12.34.41', 'e7ddd40f0290dee2d9bda9cfecd9746c', NULL, NULL, 1, 0, '2015-07-10 10:08:44.840624', 'P1L09');
INSERT INTO jobhistory VALUES (14, '237', 3, 5, 13, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:07719f3c-7769-33e0-437c-f40fb2fcba2c job-originating-host-name=10.12.34.41 time-at-creation=1436537345 time-at-processing=1436537345', '10.12.34.41', '406a56c619bb5d553cfae826e73b5282', NULL, NULL, 1, 0, '2015-07-10 10:09:05.579523', 'P1L09');
INSERT INTO jobhistory VALUES (15, '238', 3, 5, 14, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:c10b4779-52ac-37d8-674e-48d0cdd654cc job-originating-host-name=10.12.34.41 time-at-creation=1436537356 time-at-processing=1436537356', '10.12.34.41', '6f341446d7883468a7aca6a5cf26dcb6', NULL, NULL, 1, 0, '2015-07-10 10:09:16.762285', 'P1L09');
INSERT INTO jobhistory VALUES (16, '239', 3, 5, 15, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:56284d5d-12e6-3721-78f6-f0d285247d2b job-originating-host-name=10.12.34.41 time-at-creation=1436537378 time-at-processing=1436537378', '10.12.34.41', 'e648c12699a38e2d924026341f994fd8', NULL, NULL, 1, 0, '2015-07-10 10:09:39.274246', 'P1L09');
INSERT INTO jobhistory VALUES (17, '240', 3, 5, 16, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:344704b6-ae15-3dff-7ce9-016c006c0510 job-originating-host-name=10.12.34.41 time-at-creation=1436537404 time-at-processing=1436537404', '10.12.34.41', '61e323bea54c07a6b8ba3748844ae7a6', NULL, NULL, 1, 0, '2015-07-10 10:10:05.235628', 'P1L09');
INSERT INTO jobhistory VALUES (18, '241', 3, 5, 17, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:adf763b6-63d2-3110-4129-ce2b6123a4e8 job-originating-host-name=10.12.34.41 time-at-creation=1436537411 time-at-processing=1436537411', '10.12.34.41', '87de96ebd20e276184a855f9b6abf416', NULL, NULL, 1, 0, '2015-07-10 10:10:11.877897', 'P1L09');
INSERT INTO jobhistory VALUES (19, '242', 3, 5, 18, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:9f8d59b1-a58c-32f0-7cf7-55808446381a job-originating-host-name=10.12.34.41 time-at-creation=1436537423 time-at-processing=1436537423', '10.12.34.41', '349341293220b76088b5abadc0608e6f', NULL, NULL, 1, 0, '2015-07-10 10:10:23.566737', 'P1L09');
INSERT INTO jobhistory VALUES (20, '243', 3, 5, 19, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:9797c726-d68e-338d-59fa-d55d38b34bac job-originating-host-name=10.12.34.41 time-at-creation=1436537428 time-at-processing=1436537428', '10.12.34.41', '057323ad50140d494c0daaa740fbe65f', NULL, NULL, 1, 0, '2015-07-10 10:10:28.849909', 'P1L09');
INSERT INTO jobhistory VALUES (21, '244', 3, 5, 20, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:4d8744da-2d7f-3ddd-7e1f-cfc056173c44 job-originating-host-name=10.12.34.41 time-at-creation=1436537437 time-at-processing=1436537437', '10.12.34.41', '2f05df46922aea57378469d7b3fa3a63', NULL, NULL, 1, 0, '2015-07-10 10:10:37.297505', 'P1L09');
INSERT INTO jobhistory VALUES (22, '245', 3, 5, 21, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:2c75b82f-bcb7-3cd4-6b5b-f5aed23e3c67 job-originating-host-name=10.12.34.41 time-at-creation=1436539215 time-at-processing=1436539215', '10.12.34.41', '000a4eb3c74ca810e8c8d36da449b66d', NULL, NULL, 1, 0, '2015-07-10 10:40:15.722151', 'P1L09');
INSERT INTO jobhistory VALUES (23, '246', 3, 5, 22, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:a0dd8976-95a5-3880-642f-58096d000982 job-originating-host-name=10.12.34.41 time-at-creation=1436539355 time-at-processing=1436539355', '10.12.34.41', '70d34aaa2817a5025acbe932f7005191', NULL, NULL, 1, 0, '2015-07-10 10:42:36.240184', 'P1L09');
INSERT INTO jobhistory VALUES (24, '247', 3, 5, 23, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:ee4da8a0-3c55-3c90-4c51-a25de7313e1e job-originating-host-name=10.12.34.41 time-at-creation=1436539480 time-at-processing=1436539480', '10.12.34.41', '02d325833a29207a204b2c40d231961a', NULL, NULL, 1, 0, '2015-07-10 10:44:40.461084', 'P1L09');
INSERT INTO jobhistory VALUES (25, '248', 3, 5, 24, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:3e30266d-3526-3431-77a4-8a1ab9a54093 job-originating-host-name=10.12.34.41 time-at-creation=1436539528 time-at-processing=1436539528', '10.12.34.41', '52fd23e928aab7d77092f6c4a8da97c9', NULL, NULL, 1, 0, '2015-07-10 10:45:28.519526', 'P1L09');
INSERT INTO jobhistory VALUES (26, '249', 3, 5, 25, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:f8745912-14da-396c-4f57-9c763843fb30 job-originating-host-name=10.12.34.41 time-at-creation=1436539554 time-at-processing=1436539554', '10.12.34.41', '9578e863f017828c00d27f86c5c6cb89', NULL, NULL, 1, 0, '2015-07-10 10:45:54.825577', 'P1L09');
INSERT INTO jobhistory VALUES (27, '250', 3, 5, 26, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:607bab59-2cf2-334a-411e-916322752acc job-originating-host-name=10.12.34.41 time-at-creation=1436539602 time-at-processing=1436539602', '10.12.34.41', 'f8cc5834ca7494981209de72a7357ddb', NULL, NULL, 1, 0, '2015-07-10 10:46:42.380964', 'P1L09');
INSERT INTO jobhistory VALUES (28, '251', 3, 5, 27, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:7931166d-f1f1-30db-4928-4d8f24535e4e job-originating-host-name=10.12.34.41 time-at-creation=1436539625 time-at-processing=1436539625', '10.12.34.41', 'a1a34546df8a0dd2193576332dc7ed0c', NULL, NULL, 1, 0, '2015-07-10 10:47:05.548075', 'P1L09');
INSERT INTO jobhistory VALUES (29, '252', 3, 5, 28, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:7f51db65-8ae8-3265-7ab3-aaa86f09b19e job-originating-host-name=10.12.34.41 time-at-creation=1436539660 time-at-processing=1436539660', '10.12.34.41', 'b8edd668f94bf57d57f7ff3570beff26', NULL, NULL, 1, 0, '2015-07-10 10:47:40.748965', 'P1L09');
INSERT INTO jobhistory VALUES (30, '253', 3, 5, 29, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:63dfa804-888b-3eb5-4792-69a42dc15c3f job-originating-host-name=10.12.34.41 time-at-creation=1436539682 time-at-processing=1436539682', '10.12.34.41', '07cd34f7a95690d53f5056146012a186', NULL, NULL, 1, 0, '2015-07-10 10:48:03.081673', 'P1L09');
INSERT INTO jobhistory VALUES (31, '254', 3, 5, 30, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:a2c92324-9df2-312b-5178-eeeebcb0e6e1 job-originating-host-name=10.12.34.41 time-at-creation=1436539736 time-at-processing=1436539736', '10.12.34.41', '848ad99c6ea5a0d88a1ce0f4354a9785', NULL, NULL, 1, 0, '2015-07-10 10:48:56.832859', 'P1L09');
INSERT INTO jobhistory VALUES (32, '255', 3, 5, 31, 93954, 1, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:ccfb27c8-0861-32b6-45ad-59aa9fed3b5d job-originating-host-name=10.12.34.41 time-at-creation=1436539760 time-at-processing=1436539760', '10.12.34.41', '5d31cd3c24ca8bd07e0d3ecfdf95a3c9', NULL, NULL, 1, 0, '2015-07-10 10:49:21.068965', 'P1L09');
INSERT INTO jobhistory VALUES (33, '256', 3, 5, 32, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:fd7991b1-9ca5-3e3a-78b8-cf760fb79c8c job-originating-host-name=10.12.34.41 time-at-creation=1436539777 time-at-processing=1436539777', '10.12.34.41', '796b011665dd9e608fef89bdacc6d4b9', NULL, NULL, 2, 0, '2015-07-10 10:49:37.629464', 'P1L09');
INSERT INTO jobhistory VALUES (34, '257', 3, 5, 34, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:6c658579-931c-3a6c-7ef6-f8c0702ac59b job-originating-host-name=10.12.34.41 time-at-creation=1436539784 time-at-processing=1436539784', '10.12.34.41', '04bd3ecf7746d3e1f44eea56f93b7978', NULL, NULL, 2, 0, '2015-07-10 10:49:44.878783', 'P1L09');
INSERT INTO jobhistory VALUES (35, '258', 3, 5, 36, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:2c97957a-dbda-3162-42c3-c15b913e37f1 job-originating-host-name=10.12.34.41 time-at-creation=1436539791 time-at-processing=1436539791', '10.12.34.41', 'd5e3a774637383602f727e6cb4eb89c9', NULL, NULL, 2, 0, '2015-07-10 10:49:52.018692', 'P1L09');
INSERT INTO jobhistory VALUES (36, '259', 3, 5, 38, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:96fe51aa-ff94-3a5f-77e2-bc8038a9bd57 job-originating-host-name=10.12.34.41 time-at-creation=1436539809 time-at-processing=1436539809', '10.12.34.41', '3170366104e4715e592857052c8e0b30', NULL, NULL, 2, 0, '2015-07-10 10:50:09.394859', 'P1L09');
INSERT INTO jobhistory VALUES (37, '260', 3, 5, 40, 94322, 2, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:4d1469a6-e719-34d1-687b-4118c0de3023 job-originating-host-name=10.12.34.41 time-at-creation=1436539816 time-at-processing=1436539816', '10.12.34.41', 'ccd6db35bdc3dc326ecb1a0d674d70af', NULL, NULL, 2, 0, '2015-07-10 10:50:16.545247', 'P1L09');
INSERT INTO jobhistory VALUES (38, '261', 3, 5, 42, 98589, 3, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:a6178a7c-f040-38fc-7d7d-5bbfdfc51710 job-originating-host-name=10.12.34.41 time-at-creation=1436539834 time-at-processing=1436539834', '10.12.34.41', '07730d557e900345555727af10e897ec', NULL, NULL, 3, 0, '2015-07-10 10:50:34.482261', 'P1L09');
INSERT INTO jobhistory VALUES (39, '262', 3, 5, 45, 98589, 3, 0, 'ALLOW', NULL, 'Microsoft Word - Documento1', 1, 'job-uuid=urn:uuid:23e142d0-5a7e-3dc0-67eb-4ecb924a4b06 job-originating-host-name=10.12.34.41 time-at-creation=1436539842 time-at-processing=1436539842', '10.12.34.41', 'c3d71c0b9f09af94140a78314b77ee6f', NULL, NULL, 3, 0, '2015-07-10 10:50:42.580452', 'P1L09');
INSERT INTO jobhistory VALUES (40, '263', 3, 5, 48, 98591, 3, 0, 'ALLOW', NULL, 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:5fab947f-b25c-3d45-5344-d0854cf2989e job-originating-host-name=10.12.34.41 time-at-creation=1436539858 time-at-processing=1436539858', '10.12.34.41', '23069f5aae3b06aec09971f73b080ac9', NULL, NULL, 3, 0, '2015-07-10 10:50:58.549283', 'P1L09');
INSERT INTO jobhistory VALUES (41, '264', 3, 5, 51, 98591, 3, 0, 'ALLOW', NULL, 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:9941b44a-4838-3c86-7787-dab88b449672 job-originating-host-name=10.12.34.41 time-at-creation=1436539869 time-at-processing=1436539869', '10.12.34.41', '2f96287449403d91f29dde6338ce0753', NULL, NULL, 3, 0, '2015-07-10 10:51:09.650224', 'P1L09');
INSERT INTO jobhistory VALUES (42, '265', 3, 5, 54, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:50730c0d-b1f7-3051-5fd3-0ba3f324b6d3 job-originating-host-name=10.12.34.41 time-at-creation=1436539887 time-at-processing=1436539887', '10.12.34.41', '422a01d10ff742b923fdf27e1fa5c1e3', NULL, NULL, 2, 0, '2015-07-10 10:51:27.660242', 'P1L09');
INSERT INTO jobhistory VALUES (43, '266', 3, 5, 56, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:bd1fc84f-52ee-3822-7187-bceb4e92925d job-originating-host-name=10.12.34.41 time-at-creation=1436539900 time-at-processing=1436539900', '10.12.34.41', '5da16d85dca6c7188988ad9f3512029c', NULL, NULL, 2, 0, '2015-07-10 10:51:40.878398', 'P1L09');
INSERT INTO jobhistory VALUES (44, '267', 3, 5, 58, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:414019aa-9333-3c6a-4af0-1b5560117490 job-originating-host-name=10.12.34.41 time-at-creation=1436539928 time-at-processing=1436539928', '10.12.34.41', '70fca7808cf13bd90b242386dfc4a433', NULL, NULL, 2, 0, '2015-07-10 10:52:08.737087', 'P1L09');
INSERT INTO jobhistory VALUES (45, '268', 3, 5, 60, 98591, 3, 0, 'ALLOW', NULL, 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:9ea3eda4-4fc2-361b-7a72-252c75a9ade0 job-originating-host-name=10.12.34.41 time-at-creation=1436540003 time-at-processing=1436540003', '10.12.34.41', '42a459c4bbbbcfe695349fcad867dab3', NULL, NULL, 3, 0, '2015-07-10 10:53:23.894914', 'P1L09');
INSERT INTO jobhistory VALUES (46, '269', 3, 5, 63, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:9ef53c17-3ff7-3a1b-5d31-efef4fc921eb job-originating-host-name=10.12.34.41 time-at-creation=1436540034 time-at-processing=1436540034', '10.12.34.41', '9915accadacb86c2f0a95b19d60334ca', NULL, NULL, 1, 0, '2015-07-10 10:53:55.192439', 'P1L09');
INSERT INTO jobhistory VALUES (47, '270', 3, 5, 64, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:8748820a-8b2b-3ddc-7754-836936d9a261 job-originating-host-name=10.12.34.41 time-at-creation=1436540097 time-at-processing=1436540097', '10.12.34.41', '7ef5e319d3b5ac93bc90d088353d8f06', NULL, NULL, 1, 0, '2015-07-10 10:54:57.49677', 'P1L09');
INSERT INTO jobhistory VALUES (48, '271', 3, 5, 65, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:6c2843d2-2ef8-39ba-4bf2-13d01fdf1890 job-originating-host-name=10.12.34.41 time-at-creation=1436540103 time-at-processing=1436540103', '10.12.34.41', '64586dda183474e9e25eba26f81c92fb', NULL, NULL, 1, 0, '2015-07-10 10:55:03.42498', 'P1L09');
INSERT INTO jobhistory VALUES (49, '272', 3, 5, 66, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:b9e1c5f3-ca08-3c71-74cf-1dfc8682c263 job-originating-host-name=10.12.34.41 time-at-creation=1436540142 time-at-processing=1436540142', '10.12.34.41', '3cfe0a16b89bc02b0fcb8b0108298105', NULL, NULL, 3, 0, '2015-07-10 10:55:42.872834', 'P1L09');
INSERT INTO jobhistory VALUES (50, '273', 3, 5, 69, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:7f1116ce-4d7c-3a5e-6f3b-25e147985e87 job-originating-host-name=10.12.34.41 time-at-creation=1436540182 time-at-processing=1436540182', '10.12.34.41', '23840f85c70d13a10279866ee9624a6e', NULL, NULL, 2, 0, '2015-07-10 10:56:22.884914', 'P1L09');
INSERT INTO jobhistory VALUES (51, '274', 3, 5, 71, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:ddddb6ca-030e-38da-5994-eb31f60cbfc0 job-originating-host-name=10.12.34.41 time-at-creation=1436540203 time-at-processing=1436540203', '10.12.34.41', '8876c7732d77ad74083b2d08169375f8', NULL, NULL, 3, 0, '2015-07-10 10:56:44.257812', 'P1L09');
INSERT INTO jobhistory VALUES (52, '275', 3, 5, 74, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:29540d69-3919-3c5a-53d1-df341bae1fe7 job-originating-host-name=10.12.34.41 time-at-creation=1436540249 time-at-processing=1436540249', '10.12.34.41', '4c4acb4bbb90bacf402e85d07cae915c', NULL, NULL, 3, 0, '2015-07-10 10:57:29.498813', 'P1L09');
INSERT INTO jobhistory VALUES (53, '276', 3, 5, 77, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:043a7be6-25af-380c-5ae2-d16bde9cd1cc job-originating-host-name=10.12.34.41 time-at-creation=1436540317 time-at-processing=1436540317', '10.12.34.41', 'de6cfdb940faf6d750acc917c7cd1839', NULL, NULL, 3, 0, '2015-07-10 10:58:37.937332', 'P1L09');
INSERT INTO jobhistory VALUES (54, '277', 3, 5, 80, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:2a7f0059-006d-300d-7623-4c924f007b8f job-originating-host-name=10.12.34.41 time-at-creation=1436540337 time-at-processing=1436540337', '10.12.34.41', 'ab165ae406b996ce0828a2fdc9dc3eff', NULL, NULL, 3, 0, '2015-07-10 10:58:57.554538', 'P1L09');
INSERT INTO jobhistory VALUES (55, '278', 3, 5, 83, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:206c95cb-d657-3aed-6e19-d34d1327e58b job-originating-host-name=10.12.34.41 time-at-creation=1436540343 time-at-processing=1436540343', '10.12.34.41', '5a7e7278656697eac96b30920635db29', NULL, NULL, 3, 0, '2015-07-10 10:59:03.890734', 'P1L09');
INSERT INTO jobhistory VALUES (56, '279', 3, 5, 86, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:8b1c4fe0-93af-3e8b-7d9e-b5e5c8a99a39 job-originating-host-name=10.12.34.41 time-at-creation=1436540357 time-at-processing=1436540357', '10.12.34.41', '8c8cf6a7c69819fb6013fa1324271259', NULL, NULL, 3, 0, '2015-07-10 10:59:17.69024', 'P1L09');
INSERT INTO jobhistory VALUES (57, '280', 3, 5, 89, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:12cd9f4c-fcdc-34c4-7f2a-99a1da9bfe4f job-originating-host-name=10.12.34.41 time-at-creation=1436540363 time-at-processing=1436540363', '10.12.34.41', 'd92929f0d02833f1ded2a907ccd54ab4', NULL, NULL, 3, 0, '2015-07-10 10:59:23.35724', 'P1L09');
INSERT INTO jobhistory VALUES (58, '281', 3, 5, 92, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:51a9b9e8-8909-36e4-78aa-05c5c0473c90 job-originating-host-name=10.12.34.41 time-at-creation=1436540366 time-at-processing=1436540366', '10.12.34.41', '69919c251bfdc729adcfa3f9f1a585d3', NULL, NULL, 3, 0, '2015-07-10 10:59:26.984279', 'P1L09');
INSERT INTO jobhistory VALUES (59, '282', 3, 5, 95, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:8a307cda-6b3e-31f4-4246-9424a5dffeb2 job-originating-host-name=10.12.34.41 time-at-creation=1436540389 time-at-processing=1436540389', '10.12.34.41', '35fbc0db8d134a0d45828a067b5b54b3', NULL, NULL, 3, 0, '2015-07-10 10:59:50.258604', 'P1L09');
INSERT INTO jobhistory VALUES (60, '283', 3, 5, 98, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:835bc50e-a0b5-3a4f-7cfe-a9353cde3484 job-originating-host-name=10.12.34.41 time-at-creation=1436540447 time-at-processing=1436540447', '10.12.34.41', '77bfffbc00e849a7c6582ce82d667d7f', NULL, NULL, 3, 0, '2015-07-10 11:00:47.990523', 'P1L09');
INSERT INTO jobhistory VALUES (61, '284', 3, 5, 101, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:bcce6d9e-c1dd-362f-6086-e978481d238c job-originating-host-name=10.12.34.41 time-at-creation=1436540492 time-at-processing=1436540492', '10.12.34.41', '14631ca1cb67189e7bc0e7aed4da2b56', NULL, NULL, 3, 0, '2015-07-10 11:01:32.299611', 'P1L09');
INSERT INTO jobhistory VALUES (62, '285', 3, 5, 104, 93490, 6, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:e913f96a-1583-362c-685a-af6ea9e7bfcc job-originating-host-name=10.12.34.41 time-at-creation=1436540594 time-at-processing=1436540594', '10.12.34.41', '8708e43335ef38826335f38fdbb3aecf', NULL, NULL, 6, 0, '2015-07-10 11:03:14.99893', 'P1L09');
INSERT INTO jobhistory VALUES (63, '286', 3, 5, 110, 93490, 6, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:023b6ef0-54e3-35dd-5d64-1379bdb253e5 job-originating-host-name=10.12.34.41 time-at-creation=1436540616 time-at-processing=1436540616', '10.12.34.41', '9952c685bb052d12ab7e3a5a43d63b70', NULL, NULL, 6, 0, '2015-07-10 11:03:36.642012', 'P1L09');
INSERT INTO jobhistory VALUES (64, '287', 3, 5, 116, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:98fb8079-d7cf-3f83-4090-7e2133cc0824 job-originating-host-name=10.12.34.41 time-at-creation=1436540660 time-at-processing=1436540660', '10.12.34.41', '96e79e90b986d49a0d31b9407bc9483d', NULL, NULL, 3, 0, '2015-07-10 11:04:20.669903', 'P1L09');
INSERT INTO jobhistory VALUES (65, '288', 3, 5, 119, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:30b10092-7845-3bec-7cf3-e727e3ce6097 job-originating-host-name=10.12.34.41 time-at-creation=1436540679 time-at-processing=1436540679', '10.12.34.41', '8e9629e3f59dde8a33accafec039a07a', NULL, NULL, 2, 0, '2015-07-10 11:04:39.78041', 'P1L09');
INSERT INTO jobhistory VALUES (66, '289', 3, 5, 121, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:0b9bf1f0-8183-3667-41b1-a14e358d5abe job-originating-host-name=10.12.34.41 time-at-creation=1436540712 time-at-processing=1436540712', '10.12.34.41', '751797c2af01a295f266d7e3a272388b', NULL, NULL, 2, 0, '2015-07-10 11:05:13.177684', 'P1L09');
INSERT INTO jobhistory VALUES (67, '290', 3, 5, 123, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:d8cd2161-ba66-33d5-5e38-1c1bc316188e job-originating-host-name=10.12.34.41 time-at-creation=1436540736 time-at-processing=1436540736', '10.12.34.41', 'deb48481415b00b8cf690278616e3106', NULL, NULL, 3, 0, '2015-07-10 11:05:36.751783', 'P1L09');
INSERT INTO jobhistory VALUES (68, '291', 3, 5, 126, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:12a5fcd4-f0ee-3054-6233-18f995b9c527 job-originating-host-name=10.12.34.41 time-at-creation=1436540752 time-at-processing=1436540752', '10.12.34.41', '732b8882dc1af1a5a6ff02eff45a8800', NULL, NULL, 2, 0, '2015-07-10 11:05:52.674531', 'P1L09');
INSERT INTO jobhistory VALUES (69, '292', 3, 5, 128, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:dfa245bc-e382-3f2f-4aef-4d277e842f9e job-originating-host-name=10.12.34.41 time-at-creation=1436540766 time-at-processing=1436540766', '10.12.34.41', 'ed176c10c9573871f9c27a8b5ae98089', NULL, NULL, 2, 0, '2015-07-10 11:06:06.949062', 'P1L09');
INSERT INTO jobhistory VALUES (70, '293', 3, 5, 130, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:62e6f864-2506-347e-5d46-24ced1c25750 job-originating-host-name=10.12.34.41 time-at-creation=1436540781 time-at-processing=1436540781', '10.12.34.41', '53dff256b61b2aee29fcb748284965c0', NULL, NULL, 3, 0, '2015-07-10 11:06:22.147647', 'P1L09');
INSERT INTO jobhistory VALUES (71, '294', 3, 5, 133, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:117a6df0-9a0b-3900-4402-9bf99e5162b9 job-originating-host-name=10.12.34.41 time-at-creation=1436540808 time-at-processing=1436540808', '10.12.34.41', '25516783ff6e4dd8b20cbebebf987b59', NULL, NULL, 3, 0, '2015-07-10 11:06:49.165971', 'P1L09');
INSERT INTO jobhistory VALUES (72, '295', 3, 5, 136, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:2c51293c-f2fa-356d-6de0-027b692054d3 job-originating-host-name=10.12.34.41 time-at-creation=1436540852 time-at-processing=1436540852', '10.12.34.41', 'e2c4b0eb3228b005593b0429d2bdb8ba', NULL, NULL, 3, 0, '2015-07-10 11:07:33.138753', 'P1L09');
INSERT INTO jobhistory VALUES (73, '296', 3, 5, 139, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:79525d20-60ae-39e1-4455-e1e148c56b4c job-originating-host-name=10.12.34.41 time-at-creation=1436540864 time-at-processing=1436540864', '10.12.34.41', '6879645347f43507e5c90e073238c10b', NULL, NULL, 2, 0, '2015-07-10 11:07:44.821518', 'P1L09');
INSERT INTO jobhistory VALUES (74, '297', 3, 5, 141, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:4f9156be-b49a-37d7-5077-c2aa4634ca08 job-originating-host-name=10.12.34.41 time-at-creation=1436540879 time-at-processing=1436540879', '10.12.34.41', 'a03272987549efd2d6a9d15fd74baa6d', NULL, NULL, 1, 0, '2015-07-10 11:07:59.760237', 'P1L09');
INSERT INTO jobhistory VALUES (75, '298', 3, 5, 142, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:f3b3709d-5aa3-39e6-62e5-c709334dd5fe job-originating-host-name=10.12.34.41 time-at-creation=1436540900 time-at-processing=1436540900', '10.12.34.41', 'dd05f68a6788bc50f6a844c2bf94dbdc', NULL, NULL, 1, 0, '2015-07-10 11:08:20.546349', 'P1L09');
INSERT INTO jobhistory VALUES (76, '299', 3, 5, 143, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:0b07a24f-893b-3a77-77e1-bd0c9397d131 job-originating-host-name=10.12.34.41 time-at-creation=1436540946 time-at-processing=1436540946', '10.12.34.41', 'b0283a5b06b3e5981ef9900ed751298b', NULL, NULL, 1, 0, '2015-07-10 11:09:06.364879', 'P1L09');
INSERT INTO jobhistory VALUES (77, '300', 3, 5, 144, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:9c26ce37-1c9a-3901-721a-ab5883646d45 job-originating-host-name=10.12.34.41 time-at-creation=1436540980 time-at-processing=1436540980', '10.12.34.41', '8bf01de96f4969d933a7abf17bb98868', NULL, NULL, 1, 0, '2015-07-10 11:09:40.477766', 'P1L09');
INSERT INTO jobhistory VALUES (78, '301', 3, 5, 145, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:390b0080-4231-37ca-6019-61f77514b1d9 job-originating-host-name=10.12.34.41 time-at-creation=1436540997 time-at-processing=1436540997', '10.12.34.41', 'e5295192037e9a255c3a877fee0b6bfa', NULL, NULL, 2, 0, '2015-07-10 11:09:58.104107', 'P1L09');
INSERT INTO jobhistory VALUES (79, '302', 3, 5, 147, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:514e3656-bc88-36a2-416f-9efa46eceaef job-originating-host-name=10.12.34.41 time-at-creation=1436541054 time-at-processing=1436541054', '10.12.34.41', 'bed7da6cc9b7296f11cb8ddc58833409', NULL, NULL, 2, 0, '2015-07-10 11:10:55.057465', 'P1L09');
INSERT INTO jobhistory VALUES (80, '303', 3, 5, 149, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:7f02f43f-6c6b-313c-7dad-5f1f4ced2d6d job-originating-host-name=10.12.34.41 time-at-creation=1436541137 time-at-processing=1436541137', '10.12.34.41', '585ee9626e8983ddd1a3f52529c38a00', NULL, NULL, 2, 0, '2015-07-10 11:12:18.148902', 'P1L09');
INSERT INTO jobhistory VALUES (81, '304', 3, 5, 151, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:a62963f6-8958-3df1-5b41-57adab7c3021 job-originating-host-name=10.12.34.41 time-at-creation=1436541176 time-at-processing=1436541176', '10.12.34.41', '902ba43603da9a9f2b9f899b9ae35570', NULL, NULL, 2, 0, '2015-07-10 11:12:57.109664', 'P1L09');
INSERT INTO jobhistory VALUES (82, '305', 3, 5, 153, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d7ef3303-f580-3fad-61cc-2d95d9d9861e job-originating-host-name=10.12.34.41 time-at-creation=1436541186 time-at-processing=1436541186', '10.12.34.41', '1f9cae07199842b6b6f236e6b232d7a1', NULL, NULL, 2, 0, '2015-07-10 11:13:06.553285', 'P1L09');
INSERT INTO jobhistory VALUES (83, '306', 3, 5, 155, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:0f3f4df0-4afb-3ff1-5347-5a327e055921 job-originating-host-name=10.12.34.41 time-at-creation=1436541192 time-at-processing=1436541192', '10.12.34.41', '8daf352642cd91fad6a82d16690f62c2', NULL, NULL, 2, 0, '2015-07-10 11:13:13.000858', 'P1L09');
INSERT INTO jobhistory VALUES (84, '307', 3, 5, 157, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:a26b1dc7-4262-3285-43a7-e8c1f0f0ecf2 job-originating-host-name=10.12.34.41 time-at-creation=1436541197 time-at-processing=1436541197', '10.12.34.41', 'af0f5d3c2988d2c56fddd10c0659b0aa', NULL, NULL, 2, 0, '2015-07-10 11:13:17.429479', 'P1L09');
INSERT INTO jobhistory VALUES (85, '308', 3, 5, 159, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4e2b89cd-eb82-3bdb-450c-e42d223bf37d job-originating-host-name=10.12.34.41 time-at-creation=1436541200 time-at-processing=1436541200', '10.12.34.41', '1d56ba741641bcb2687ef7acfb750e57', NULL, NULL, 2, 0, '2015-07-10 11:13:21.042473', 'P1L09');
INSERT INTO jobhistory VALUES (86, '309', 3, 5, 161, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:b64c5d69-7c41-3174-73a5-12631e760bc9 job-originating-host-name=10.12.34.41 time-at-creation=1436541291 time-at-processing=1436541291', '10.12.34.41', '9cee62cc2814a3f136ed9ab85b56a5c4', NULL, NULL, 2, 0, '2015-07-10 11:14:51.461936', 'P1L09');
INSERT INTO jobhistory VALUES (87, '310', 3, 5, 163, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:6922daca-56da-3e11-69dc-05fcc417508b job-originating-host-name=10.12.34.41 time-at-creation=1436541376 time-at-processing=1436541376', '10.12.34.41', '90cdb7d8d0875717ad581d3972ca7a1d', NULL, NULL, 2, 0, '2015-07-10 11:16:16.352131', 'P1L09');
INSERT INTO jobhistory VALUES (88, '311', 3, 5, 165, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:459a467d-fe80-3882-50bd-d9f14e087f7d job-originating-host-name=10.12.34.41 time-at-creation=1436541388 time-at-processing=1436541388', '10.12.34.41', '9f378265a8902612dc277575b517c837', NULL, NULL, 2, 0, '2015-07-10 11:16:29.11311', 'P1L09');
INSERT INTO jobhistory VALUES (89, '312', 3, 5, 167, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:397f6654-aeed-3a3e-750d-6ca714b51e49 job-originating-host-name=10.12.34.41 time-at-creation=1436541399 time-at-processing=1436541399', '10.12.34.41', '010ca6aa37655d8c5939e754ee715eac', NULL, NULL, 2, 0, '2015-07-10 11:16:40.072354', 'P1L09');
INSERT INTO jobhistory VALUES (90, '313', 3, 5, 169, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2a3553af-ddf2-3efb-4b0a-7e89a4577285 job-originating-host-name=10.12.34.41 time-at-creation=1436541404 time-at-processing=1436541404', '10.12.34.41', 'cd718175d1211cb4466426612fe33f70', NULL, NULL, 2, 0, '2015-07-10 11:16:44.616615', 'P1L09');
INSERT INTO jobhistory VALUES (91, '314', 3, 5, 171, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:df917aec-9840-3ac3-5255-bf281c64f5d9 job-originating-host-name=10.12.34.41 time-at-creation=1436541409 time-at-processing=1436541409', '10.12.34.41', 'f37bfa0da9b102c19034b71a40b20a60', NULL, NULL, 2, 0, '2015-07-10 11:16:49.433242', 'P1L09');
INSERT INTO jobhistory VALUES (92, '315', 3, 5, 173, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:a09ea5cc-2486-3a9f-768a-55343a2e904e job-originating-host-name=10.12.34.41 time-at-creation=1436541411 time-at-processing=1436541411', '10.12.34.41', '73e34fc1ef22e931b66f7169c5a25efc', NULL, NULL, 2, 0, '2015-07-10 11:16:52.205568', 'P1L09');
INSERT INTO jobhistory VALUES (93, '316', 3, 5, 175, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:650c65d1-25d6-38a9-693f-4be5c55b03d8 job-originating-host-name=10.12.34.41 time-at-creation=1436541415 time-at-processing=1436541415', '10.12.34.41', '6855cbddfb7e5c4691ad95cc08515e5e', NULL, NULL, 2, 0, '2015-07-10 11:16:55.672789', 'P1L09');
INSERT INTO jobhistory VALUES (94, '317', 3, 5, 177, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:f8fcb977-5d00-309a-75e6-2494a72fcc99 job-originating-host-name=10.12.34.41 time-at-creation=1436541582 time-at-processing=1436541582', '10.12.34.41', '2d940b71e3b42a8e8cdd2db818b06977', NULL, NULL, 2, 0, '2015-07-10 11:19:42.89303', 'P1L09');
INSERT INTO jobhistory VALUES (95, '318', 3, 5, 179, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:e742bd12-8949-3abc-53b0-930e8816c4f9 job-originating-host-name=10.12.34.41 time-at-creation=1436541595 time-at-processing=1436541595', '10.12.34.41', '50712531badd8ae538486d63d667066a', NULL, NULL, 2, 0, '2015-07-10 11:19:55.58809', 'P1L09');
INSERT INTO jobhistory VALUES (96, '319', 3, 5, 181, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:19f4c0a1-9de6-3307-4df3-67f9450025f0 job-originating-host-name=10.12.34.41 time-at-creation=1436541600 time-at-processing=1436541600', '10.12.34.41', 'f3f959882ec5a098163269bf4fd19b18', NULL, NULL, 2, 0, '2015-07-10 11:20:00.38488', 'P1L09');
INSERT INTO jobhistory VALUES (97, '320', 3, 5, 183, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:807fb1dc-d582-3bad-73f5-d5696d7f9612 job-originating-host-name=10.12.34.41 time-at-creation=1436541604 time-at-processing=1436541604', '10.12.34.41', '6354859d87b0ac6be0a7e0192d70fe8b', NULL, NULL, 2, 0, '2015-07-10 11:20:04.68521', 'P1L09');
INSERT INTO jobhistory VALUES (98, '321', 3, 5, 185, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:8f790d19-2994-3535-6caf-fa11718e88a4 job-originating-host-name=10.12.34.41 time-at-creation=1436541614 time-at-processing=1436541614', '10.12.34.41', '1b081e62f028411db0d41b8c2b43ff2a', NULL, NULL, 1, 0, '2015-07-10 11:20:14.753703', 'P1L09');
INSERT INTO jobhistory VALUES (99, '322', 3, 5, 186, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:96b8388c-3780-3d33-6c7d-4c1d27717f9b job-originating-host-name=10.12.34.41 time-at-creation=1436541629 time-at-processing=1436541629', '10.12.34.41', 'e88fb40cd9fdf6225b27b00f3796a298', NULL, NULL, 1, 0, '2015-07-10 11:20:29.664985', 'P1L09');
INSERT INTO jobhistory VALUES (100, '323', 3, 5, 187, 99384, 1, 0, 'ALLOW', NULL, 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:a7e8a39d-5b25-352f-7e76-f93bea9f51ce job-originating-host-name=10.12.34.41 time-at-creation=1436541783 time-at-processing=1436541783', '10.12.34.41', '844728672139f7748a977a1299efea64', NULL, NULL, 1, 0, '2015-07-10 11:23:03.391828', 'P1L09');
INSERT INTO jobhistory VALUES (101, '324', 3, 5, 188, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d3c8486f-7e1b-3415-4cb7-a253245fe1e2 job-originating-host-name=10.12.34.41 time-at-creation=1436541791 time-at-processing=1436541791', '10.12.34.41', 'a18a212e20018890b00fd8d7ea2a1164', NULL, NULL, 2, 0, '2015-07-10 11:23:12.19441', 'P1L09');
INSERT INTO jobhistory VALUES (102, '325', 3, 5, 190, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:41a5a2b7-1b56-32a9-7c86-69c5e9bcd75a job-originating-host-name=10.12.34.41 time-at-creation=1436541800 time-at-processing=1436541800', '10.12.34.41', 'd0210823cf72c4cb47fc73ebaf157429', NULL, NULL, 2, 0, '2015-07-10 11:23:20.443837', 'P1L09');
INSERT INTO jobhistory VALUES (103, '326', 3, 5, 192, 92766, 4, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:62c89752-40c5-35ee-55dd-8668cf3433d3 job-originating-host-name=10.12.34.41 time-at-creation=1436541809 time-at-processing=1436541809', '10.12.34.41', '9eccb727c761e6224d915a2b3b9bffd8', NULL, NULL, 4, 0, '2015-07-10 11:23:29.667585', 'P1L09');
INSERT INTO jobhistory VALUES (104, '327', 3, 5, 196, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4f53eea1-e4b9-361c-6a88-ce7dc96b5100 job-originating-host-name=10.12.34.41 time-at-creation=1436541813 time-at-processing=1436541813', '10.12.34.41', 'e94b72c2fc3c438d8698cb1c559abd91', NULL, NULL, 2, 0, '2015-07-10 11:23:34.009229', 'P1L09');
INSERT INTO jobhistory VALUES (105, '328', 3, 5, 198, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2c2c751c-c41f-36e6-5696-99180fb0d3df job-originating-host-name=10.12.34.41 time-at-creation=1436541819 time-at-processing=1436541819', '10.12.34.41', 'eddae5b7253c3c18145da5926412dd5c', NULL, NULL, 2, 0, '2015-07-10 11:23:39.581748', 'P1L09');
INSERT INTO jobhistory VALUES (106, '329', 3, 5, 200, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d43ff0ea-c145-3673-77b0-1b1faec10ce6 job-originating-host-name=10.12.34.41 time-at-creation=1436541827 time-at-processing=1436541827', '10.12.34.41', '12be173cd4db42f5b2ad8edf8d4c914f', NULL, NULL, 2, 0, '2015-07-10 11:23:47.844406', 'P1L09');
INSERT INTO jobhistory VALUES (107, '330', 3, 5, 202, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:cbc0f314-820b-3bca-799a-2f9d68107643 job-originating-host-name=10.12.34.41 time-at-creation=1436541832 time-at-processing=1436541832', '10.12.34.41', 'b7ecf75beff9f8ee37c86a1be50493f5', NULL, NULL, 2, 0, '2015-07-10 11:23:52.597416', 'P1L09');
INSERT INTO jobhistory VALUES (108, '331', 3, 5, 204, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4feac85a-7a8d-383e-7fb6-f19c15853dd0 job-originating-host-name=10.12.34.41 time-at-creation=1436541835 time-at-processing=1436541835', '10.12.34.41', 'b2981c35016cd1955cb9629458e06cc0', NULL, NULL, 2, 0, '2015-07-10 11:23:56.045828', 'P1L09');
INSERT INTO jobhistory VALUES (109, '332', 3, 5, 206, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2c6d1e38-1fed-3f9a-5c6a-3670f6f72490 job-originating-host-name=10.12.34.41 time-at-creation=1436541838 time-at-processing=1436541838', '10.12.34.41', 'c9e1229e5e08ff48f74c085567672034', NULL, NULL, 2, 0, '2015-07-10 11:23:58.770863', 'P1L09');
INSERT INTO jobhistory VALUES (110, '333', 3, 5, 208, 92033, 2, 0, 'ALLOW', NULL, 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:9aace55b-5d84-379e-6da3-78340b144dc5 job-originating-host-name=10.12.34.41 time-at-creation=1436541845 time-at-processing=1436541845', '10.12.34.41', 'a3e394f4f24afb95107602ce8d641941', NULL, NULL, 2, 0, '2015-07-10 11:24:06.197652', 'P1L09');
INSERT INTO jobhistory VALUES (111, '334', 3, 5, 210, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:80174843-8171-3569-6da3-b21ddb5c6974 job-originating-host-name=10.12.34.41 time-at-creation=1436541854 time-at-processing=1436541854', '10.12.34.41', '12239d28bcf730f2029c71916c81e42c', NULL, NULL, 3, 0, '2015-07-10 11:24:15.225182', 'P1L09');
INSERT INTO jobhistory VALUES (112, '335', 3, 5, 213, 92386, 3, 0, 'ALLOW', NULL, 'Pykota.pdf', 1, 'job-uuid=urn:uuid:f51a850a-36da-3708-4bf8-7a30d5ab6bce job-originating-host-name=10.12.34.41 time-at-creation=1436541871 time-at-processing=1436541871', '10.12.34.41', 'cc2e9f9d2e0e59f80579b9776afaffee', NULL, NULL, 3, 0, '2015-07-10 11:24:31.562799', 'P1L09');
INSERT INTO jobhistory VALUES (113, '336', 3, 5, 216, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00336-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:51d369d3-940b-320e-6c05-a175bdcd4cdc job-originating-host-name=10.12.34.41 time-at-creation=1436542066 time-at-processing=1436542066', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 11:27:46.550375', 'P1L09');
INSERT INTO jobhistory VALUES (114, '337', 3, 5, 219, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00337-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:fe15066d-3fc1-3433-74a2-7cba133a4476 job-originating-host-name=10.12.34.41 time-at-creation=1436542086 time-at-processing=1436542086', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 11:28:06.97692', 'P1L09');
INSERT INTO jobhistory VALUES (115, '338', 3, 5, 222, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00338-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:c6fe92eb-8177-3458-63ac-6089306aa534 job-originating-host-name=10.12.34.41 time-at-creation=1436542091 time-at-processing=1436542091', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 11:28:11.469214', 'P1L09');
INSERT INTO jobhistory VALUES (116, '339', 3, 5, 225, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00339-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:916665cb-72ed-3fc4-441f-d2fdae8276b0 job-originating-host-name=10.12.34.41 time-at-creation=1436546748 time-at-processing=1436546748', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 12:45:48.662777', 'P1L09');
INSERT INTO jobhistory VALUES (117, '340', 3, 5, 228, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00340-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:bb355de6-440d-3025-648e-a5127e30462c job-originating-host-name=10.12.34.41 time-at-creation=1436546772 time-at-processing=1436546772', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 12:46:12.650776', 'P1L09');
INSERT INTO jobhistory VALUES (118, '341', 3, 5, 231, 75267, 4, 0, 'ALLOW', '/var/spool/cups/d00341-001', 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:0b536d0e-bd9f-3b67-5bde-e5ee930cfeef job-originating-host-name=10.12.34.41 time-at-creation=1436546907 time-at-processing=1436546907', '10.12.34.41', 'a5c02e39b2efaf852d4a4d7aeeeb100c', NULL, NULL, 4, 0, '2015-07-10 12:48:27.854762', 'P1L09');
INSERT INTO jobhistory VALUES (119, '342', 3, 5, 235, 75267, 4, 0, 'ALLOW', '/var/spool/cups/d00342-001', 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:a1426b74-3c60-3cb7-7823-ed8eb94d52b7 job-originating-host-name=10.12.34.41 time-at-creation=1436546931 time-at-processing=1436546931', '10.12.34.41', 'a5c02e39b2efaf852d4a4d7aeeeb100c', NULL, NULL, 4, 0, '2015-07-10 12:48:51.522477', 'P1L09');
INSERT INTO jobhistory VALUES (120, '343', 3, 5, 239, 75267, 4, 0, 'ALLOW', '/var/spool/cups/d00343-001', 'Microsoft Word - CUPS+Pykota+PostgreSQL', 1, 'job-uuid=urn:uuid:a89f0757-234e-3dab-7df3-05adb1681a2d job-originating-host-name=10.12.34.41 time-at-creation=1436547160 time-at-processing=1436547160', '10.12.34.41', 'a5c02e39b2efaf852d4a4d7aeeeb100c', NULL, NULL, 4, 0, '2015-07-10 12:52:41.218001', 'P1L09');
INSERT INTO jobhistory VALUES (121, '344', 3, 5, 243, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00344-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:35e6131b-441c-3202-5cdf-65a56388538a job-originating-host-name=10.12.34.41 time-at-creation=1436547704 time-at-processing=1436547704', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:01:44.432729', 'P1L09');
INSERT INTO jobhistory VALUES (122, '345', 3, 5, 245, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00345-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2b1e6818-b53d-38e9-6444-6d9ee884c459 job-originating-host-name=10.12.34.41 time-at-creation=1436547801 time-at-processing=1436547801', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:03:21.531567', 'P1L09');
INSERT INTO jobhistory VALUES (123, '346', 3, 5, 247, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00346-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:16b77ecb-4209-366f-4638-a691c7f9f65c job-originating-host-name=10.12.34.41 time-at-creation=1436547819 time-at-processing=1436547819', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:03:40.267084', 'P1L09');
INSERT INTO jobhistory VALUES (124, '347', 3, 5, 249, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00347-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:f8a052dd-1e10-38e0-6070-b9255be8d937 job-originating-host-name=10.12.34.41 time-at-creation=1436547827 time-at-processing=1436547827', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:03:48.186342', 'P1L09');
INSERT INTO jobhistory VALUES (125, '348', 3, 5, 251, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00348-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2ee6e943-ff03-309f-4d86-3985bc5a3a67 job-originating-host-name=10.12.34.41 time-at-creation=1436547840 time-at-processing=1436547840', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:04:00.752299', 'P1L09');
INSERT INTO jobhistory VALUES (126, '349', 3, 5, 253, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00349-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:e153377b-8e08-3984-5b5f-2d517bb6b3ff job-originating-host-name=10.12.34.41 time-at-creation=1436547846 time-at-processing=1436547846', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:04:06.896265', 'P1L09');
INSERT INTO jobhistory VALUES (127, '350', 3, 5, 255, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00350-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:1a3dc703-bb6d-3e48-4453-9c0c3667f833 job-originating-host-name=10.12.34.41 time-at-creation=1436547881 time-at-processing=1436547881', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:04:42.186986', 'P1L09');
INSERT INTO jobhistory VALUES (128, '351', 3, 5, 258, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00351-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:7a8be233-7e49-355d-68d5-090702796a31 job-originating-host-name=10.12.34.41 time-at-creation=1436547901 time-at-processing=1436547901', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:05:01.437446', 'P1L09');
INSERT INTO jobhistory VALUES (129, '352', 3, 5, 261, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00352-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:38f6b0b8-20c7-3032-7a62-0901ae7e21d1 job-originating-host-name=10.12.34.41 time-at-creation=1436547907 time-at-processing=1436547907', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:05:07.574772', 'P1L09');
INSERT INTO jobhistory VALUES (130, '353', 3, 5, 264, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00353-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:e82bf01b-7b50-3029-58a3-1fe432059156 job-originating-host-name=10.12.34.41 time-at-creation=1436547940 time-at-processing=1436547940', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:05:40.478843', 'P1L09');
INSERT INTO jobhistory VALUES (131, '354', 3, 5, 267, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00354-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:ce05726e-a5ec-321f-7483-0531d6b4f725 job-originating-host-name=10.12.34.41 time-at-creation=1436547956 time-at-processing=1436547956', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:05:56.534514', 'P1L09');
INSERT INTO jobhistory VALUES (132, '355', 3, 5, 270, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00355-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:43ea9459-82e6-3070-4299-ec1766dcd935 job-originating-host-name=10.12.34.41 time-at-creation=1436547965 time-at-processing=1436547965', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:06:05.468152', 'P1L09');
INSERT INTO jobhistory VALUES (133, '356', 3, 5, 273, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00356-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2d85f9f1-0dd2-30ed-6904-d94a38461912 job-originating-host-name=10.12.34.41 time-at-creation=1436548042 time-at-processing=1436548042', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:07:22.986896', 'P1L09');
INSERT INTO jobhistory VALUES (134, '357', 3, 5, 275, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00357-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:34817a22-2e3f-36e9-59de-dfe7265c303b job-originating-host-name=10.12.34.41 time-at-creation=1436548052 time-at-processing=1436548052', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:07:32.430662', 'P1L09');
INSERT INTO jobhistory VALUES (135, '358', 3, 5, 277, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00358-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:c280eccd-57e3-3b9a-5802-5729f72dfc8f job-originating-host-name=10.12.34.41 time-at-creation=1436548073 time-at-processing=1436548073', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:07:53.733965', 'P1L09');
INSERT INTO jobhistory VALUES (136, '359', 3, 5, 279, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00359-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:c63ba044-06c1-31e2-6f86-41daa747dca9 job-originating-host-name=10.12.34.41 time-at-creation=1436548082 time-at-processing=1436548082', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:08:02.970247', 'P1L09');
INSERT INTO jobhistory VALUES (137, '360', 3, 5, 281, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00360-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:7ad4e9a8-bbeb-3f76-5bbe-f06fb3f64b2b job-originating-host-name=10.12.34.41 time-at-creation=1436548097 time-at-processing=1436548097', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:08:17.98686', 'P1L09');
INSERT INTO jobhistory VALUES (138, '361', 3, 5, 283, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00361-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:8eb6cef4-bc59-3bf2-75fa-07bba173d499 job-originating-host-name=10.12.34.41 time-at-creation=1436548117 time-at-processing=1436548117', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:08:38.058795', 'P1L09');
INSERT INTO jobhistory VALUES (139, '362', 3, 5, 285, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00362-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:67bf2296-1155-39b6-5891-b2c1d0725317 job-originating-host-name=10.12.34.41 time-at-creation=1436548120 time-at-processing=1436548120', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:08:40.819368', 'P1L09');
INSERT INTO jobhistory VALUES (140, '363', 3, 5, 287, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00363-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:c1987329-afdd-3696-70cc-09ee6ef51d5c job-originating-host-name=10.12.34.41 time-at-creation=1436548123 time-at-processing=1436548123', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:08:43.729764', 'P1L09');
INSERT INTO jobhistory VALUES (141, '364', 3, 5, 289, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00364-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:181a43b8-bad9-35fe-5bc7-8f3e4940d8b8 job-originating-host-name=10.12.34.41 time-at-creation=1436548208 time-at-processing=1436548208', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:10:08.307623', 'P1L09');
INSERT INTO jobhistory VALUES (142, '365', 3, 5, 292, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00365-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:a6ce98eb-c27b-31e0-5daf-26ce841f2694 job-originating-host-name=10.12.34.41 time-at-creation=1436548226 time-at-processing=1436548226', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:10:26.287352', 'P1L09');
INSERT INTO jobhistory VALUES (143, '366', 3, 5, 295, 6571, 6, 0, 'ALLOW', '/var/spool/cups/d00366-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:7aaac536-7414-323e-6b9f-755c9e21912a job-originating-host-name=10.12.34.41 time-at-creation=1436548244 time-at-processing=1436548244', '10.12.34.41', 'c913cacc8843a0bd018d01a680ce5025', NULL, NULL, 6, 0, '2015-07-10 13:10:44.961836', 'P1L09');
INSERT INTO jobhistory VALUES (144, '367', 3, 5, 301, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00367-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:b18fc0fb-401d-32e2-647a-0b8ab563b678 job-originating-host-name=10.12.34.41 time-at-creation=1436548459 time-at-processing=1436548459', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:14:20.202858', 'P1L09');
INSERT INTO jobhistory VALUES (145, '368', 3, 5, 304, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00368-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:6590cce6-d047-3a4a-4588-e53735d90ec4 job-originating-host-name=10.12.34.41 time-at-creation=1436548508 time-at-processing=1436548508', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:15:08.552898', 'P1L09');
INSERT INTO jobhistory VALUES (146, '369', 3, 5, 307, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00369-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:b4d3d739-a296-3ae1-410e-19ddd90815b7 job-originating-host-name=10.12.34.41 time-at-creation=1436548518 time-at-processing=1436548518', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:15:18.751341', 'P1L09');
INSERT INTO jobhistory VALUES (147, '370', 3, 5, 310, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00370-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:c04f59fb-472f-3853-64f5-4f6e406cab92 job-originating-host-name=10.12.34.41 time-at-creation=1436548586 time-at-processing=1436548586', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:16:26.718775', 'P1L09');
INSERT INTO jobhistory VALUES (148, '371', 3, 5, 313, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00371-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:b5045098-a221-38f0-43fd-a5f667cd780c job-originating-host-name=10.12.34.41 time-at-creation=1436548631 time-at-processing=1436548631', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:17:11.76965', 'P1L09');
INSERT INTO jobhistory VALUES (149, '372', 3, 5, 316, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00372-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:fcacef11-59c2-3a7f-7a9d-8c5890b009ec job-originating-host-name=10.12.34.41 time-at-creation=1436548766 time-at-processing=1436548766', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:19:27.058289', 'P1L09');
INSERT INTO jobhistory VALUES (150, '373', 3, 5, 319, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00373-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:9ef4fc7f-31ea-3488-51b3-71e778ced597 job-originating-host-name=10.12.34.41 time-at-creation=1436548872 time-at-processing=1436548872', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:13.010683', 'P1L09');
INSERT INTO jobhistory VALUES (151, '374', 3, 5, 322, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00374-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:f8ebba18-e210-3b03-4aeb-0a97ea55da82 job-originating-host-name=10.12.34.41 time-at-creation=1436548880 time-at-processing=1436548880', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:21.181386', 'P1L09');
INSERT INTO jobhistory VALUES (152, '375', 3, 5, 325, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00375-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:88d9fc28-e4cf-392f-74ed-1fac686e159d job-originating-host-name=10.12.34.41 time-at-creation=1436548885 time-at-processing=1436548885', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:25.795412', 'P1L09');
INSERT INTO jobhistory VALUES (153, '376', 3, 5, 328, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00376-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:5d4bc0a8-f5fa-3803-4fc4-bfce61fc5a9d job-originating-host-name=10.12.34.41 time-at-creation=1436548901 time-at-processing=1436548901', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:41.656202', 'P1L09');
INSERT INTO jobhistory VALUES (154, '377', 3, 5, 331, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00377-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:b262632d-281c-3360-6722-5f25c4e0762d job-originating-host-name=10.12.34.41 time-at-creation=1436548908 time-at-processing=1436548908', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:48.701647', 'P1L09');
INSERT INTO jobhistory VALUES (155, '378', 3, 5, 334, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00378-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:3b23ebaf-e19f-3662-5480-2e00b4d8b58c job-originating-host-name=10.12.34.41 time-at-creation=1436548913 time-at-processing=1436548913', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:53.626284', 'P1L09');
INSERT INTO jobhistory VALUES (156, '379', 3, 5, 337, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00379-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:08559fc0-296a-312e-4af4-5987bb521231 job-originating-host-name=10.12.34.41 time-at-creation=1436548917 time-at-processing=1436548917', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:21:57.96266', 'P1L09');
INSERT INTO jobhistory VALUES (157, '380', 3, 5, 340, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00380-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:a1cf66e2-20d6-3510-55c9-a65f020828a8 job-originating-host-name=10.12.34.41 time-at-creation=1436548940 time-at-processing=1436548940', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:22:20.346797', 'P1L09');
INSERT INTO jobhistory VALUES (158, '381', 3, 5, 343, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00381-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:b2c6b332-619c-32a6-67ef-cdb143ce76d8 job-originating-host-name=10.12.34.41 time-at-creation=1436549005 time-at-processing=1436549005', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:23:25.952281', 'P1L09');
INSERT INTO jobhistory VALUES (159, '382', 3, 5, 346, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00382-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:08ed93e5-c076-3c0d-52d2-12aad61afe60 job-originating-host-name=10.12.34.41 time-at-creation=1436549009 time-at-processing=1436549009', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:23:29.330375', 'P1L09');
INSERT INTO jobhistory VALUES (160, '383', 3, 5, 349, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00383-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:d518f6e1-c5fa-314c-58c5-7fb21344c1d0 job-originating-host-name=10.12.34.41 time-at-creation=1436549039 time-at-processing=1436549039', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:23:59.656228', 'P1L09');
INSERT INTO jobhistory VALUES (161, '384', 3, 5, 352, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00384-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:314fb914-3e91-35f3-640e-1981f2be405f job-originating-host-name=10.12.34.41 time-at-creation=1436549052 time-at-processing=1436549052', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:24:12.538766', 'P1L09');
INSERT INTO jobhistory VALUES (162, '385', 3, 5, 355, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00385-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:9a8aedda-845d-333f-7738-c059e7431b77 job-originating-host-name=10.12.34.41 time-at-creation=1436549065 time-at-processing=1436549065', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:24:25.749357', 'P1L09');
INSERT INTO jobhistory VALUES (163, '386', 3, 5, 357, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00386-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4d46caa3-73f9-363e-4cfb-e20399243201 job-originating-host-name=10.12.34.41 time-at-creation=1436549072 time-at-processing=1436549072', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:24:32.550214', 'P1L09');
INSERT INTO jobhistory VALUES (164, '387', 3, 5, 359, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00387-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:84d7e838-bfc7-34aa-6adc-db673b204652 job-originating-host-name=10.12.34.41 time-at-creation=1436549075 time-at-processing=1436549075', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:24:36.404286', 'P1L09');
INSERT INTO jobhistory VALUES (165, '388', 3, 5, 361, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00388-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:e682b629-7b9e-3224-5f1e-a294d3d2f497 job-originating-host-name=10.12.34.41 time-at-creation=1436549102 time-at-processing=1436549102', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:25:02.745341', 'P1L09');
INSERT INTO jobhistory VALUES (166, '389', 3, 5, 364, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00389-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:4ee1f184-81c0-3ff4-5856-fc7175f91fcc job-originating-host-name=10.12.34.41 time-at-creation=1436549149 time-at-processing=1436549149', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:25:49.902669', 'P1L09');
INSERT INTO jobhistory VALUES (167, '390', 3, 5, 367, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00390-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:ae45d3da-3027-35ae-5759-a4794de2afdc job-originating-host-name=10.12.34.41 time-at-creation=1436549775 time-at-processing=1436549775', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:36:15.343978', 'P1L09');
INSERT INTO jobhistory VALUES (168, '391', 3, 5, 370, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00391-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:372e5ea3-13d3-3844-764d-f54a4bd25652 job-originating-host-name=10.12.34.41 time-at-creation=1436549788 time-at-processing=1436549788', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:36:28.652244', 'P1L09');
INSERT INTO jobhistory VALUES (169, '392', 3, 5, 373, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00392-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:14fe59ec-b998-31ad-5431-935418eb9a12 job-originating-host-name=10.12.34.41 time-at-creation=1436549799 time-at-processing=1436549799', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:36:40.11195', 'P1L09');
INSERT INTO jobhistory VALUES (170, '393', 3, 5, 376, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00393-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:19f15845-91c6-3176-5258-71b8c4fb151d job-originating-host-name=10.12.34.41 time-at-creation=1436550088 time-at-processing=1436550088', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:41:28.639566', 'P1L09');
INSERT INTO jobhistory VALUES (171, '394', 3, 5, 379, 4919, 3, 0, 'ALLOW', '/var/spool/cups/d00394-001', 'Microsoft Word - Kjhghghjglgh', 1, 'job-uuid=urn:uuid:2fb4216f-d2fb-34ce-7e68-d1f7aace7b5b job-originating-host-name=10.12.34.41 time-at-creation=1436550189 time-at-processing=1436550189', '10.12.34.41', '6a6aa52fdabc7f270e641e2c8cd6383b', NULL, NULL, 3, 0, '2015-07-10 13:43:09.391442', 'P1L09');
INSERT INTO jobhistory VALUES (172, '395', 3, 5, 382, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00395-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:bf079fe7-8d6b-3bfa-6877-b1c03d19ae79 job-originating-host-name=10.12.34.41 time-at-creation=1436550206 time-at-processing=1436550206', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:43:26.729986', 'P1L09');
INSERT INTO jobhistory VALUES (173, '396', 3, 5, 384, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00396-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:5cf780b6-d9aa-39e8-6830-66a2fc5f9b08 job-originating-host-name=10.12.34.41 time-at-creation=1436550219 time-at-processing=1436550219', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:43:40.017901', 'P1L09');
INSERT INTO jobhistory VALUES (174, '397', 3, 5, 387, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00397-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:af8e9917-2c55-3c9e-453e-a6f1096e66f4 job-originating-host-name=10.12.34.41 time-at-creation=1436550252 time-at-processing=1436550252', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:44:12.232344', 'P1L09');
INSERT INTO jobhistory VALUES (175, '398', 3, 5, 390, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00398-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:2d4e6bd4-33a7-303c-5671-6f51273c2899 job-originating-host-name=10.12.34.41 time-at-creation=1436550261 time-at-processing=1436550261', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:44:21.794024', 'P1L09');
INSERT INTO jobhistory VALUES (176, '399', 3, 5, 393, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00399-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:bda967e1-970e-3823-4977-f550cd2933cd job-originating-host-name=10.12.34.41 time-at-creation=1436550264 time-at-processing=1436550264', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 13:44:25.147188', 'P1L09');
INSERT INTO jobhistory VALUES (177, '400', 3, 5, 396, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00400-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:e7a84e51-40ba-3d97-6d82-dd23c9b36749 job-originating-host-name=10.12.34.41 time-at-creation=1436550274 time-at-processing=1436550274', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:44:34.475267', 'P1L09');
INSERT INTO jobhistory VALUES (178, '401', 3, 5, 398, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00401-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:1d4e94bb-44fb-399f-7a45-73ba0b6a7b48 job-originating-host-name=10.12.34.41 time-at-creation=1436551110 time-at-processing=1436551110', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:58:30.559695', 'P1L09');
INSERT INTO jobhistory VALUES (179, '402', 3, 5, 400, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00402-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:6b5d987e-a895-3162-7890-948f6fa080f8 job-originating-host-name=10.12.34.41 time-at-creation=1436551121 time-at-processing=1436551121', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:58:42.067087', 'P1L09');
INSERT INTO jobhistory VALUES (180, '403', 3, 5, 402, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00403-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:68b497d2-32f5-333f-7f4d-df2d2dfc95be job-originating-host-name=10.12.34.41 time-at-creation=1436551134 time-at-processing=1436551134', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:58:55.316527', 'P1L09');
INSERT INTO jobhistory VALUES (181, '404', 3, 5, 404, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00404-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:0ebc6058-f663-3482-733e-938a2ad8a00a job-originating-host-name=10.12.34.41 time-at-creation=1436551137 time-at-processing=1436551137', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:58:57.559174', 'P1L09');
INSERT INTO jobhistory VALUES (182, '405', 3, 5, 406, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00405-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:39627cfa-460d-32f3-71cc-2c18e0a610a4 job-originating-host-name=10.12.34.41 time-at-creation=1436551139 time-at-processing=1436551139', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:58:59.646099', 'P1L09');
INSERT INTO jobhistory VALUES (183, '406', 3, 5, 408, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00406-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d019b18d-2ad6-38c1-6fe2-780fd3b8b530 job-originating-host-name=10.12.34.41 time-at-creation=1436551141 time-at-processing=1436551141', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:59:01.881758', 'P1L09');
INSERT INTO jobhistory VALUES (184, '407', 3, 5, 410, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00407-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:db8fa2c5-3fb6-3498-6576-605986a2a68b job-originating-host-name=10.12.34.41 time-at-creation=1436551142 time-at-processing=1436551142', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:59:03.366333', 'P1L09');
INSERT INTO jobhistory VALUES (185, '408', 3, 5, 412, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00408-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:ae828601-c6f2-3d5c-7d4f-b18a7ca07f0a job-originating-host-name=10.12.34.41 time-at-creation=1436551165 time-at-processing=1436551165', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 13:59:26.381986', 'P1L09');
INSERT INTO jobhistory VALUES (186, '409', 3, 5, 414, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00409-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d5eb6f2f-cc60-3eb7-42fa-a166d9c7a577 job-originating-host-name=10.12.34.41 time-at-creation=1436551348 time-at-processing=1436551348', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:02:28.481134', 'P1L09');
INSERT INTO jobhistory VALUES (187, '410', 3, 5, 416, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00410-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d7eb1e56-fc70-3a04-4b62-ee5d65f0de4a job-originating-host-name=10.12.34.41 time-at-creation=1436551594 time-at-processing=1436551594', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:06:35.059485', 'P1L09');
INSERT INTO jobhistory VALUES (188, '411', 3, 5, 418, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00411-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:8440bcb9-0f91-3d59-4cd4-6b7e09c06cb2 job-originating-host-name=10.12.34.41 time-at-creation=1436551602 time-at-processing=1436551602', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:06:43.33957', 'P1L09');
INSERT INTO jobhistory VALUES (189, '412', 3, 5, 420, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00412-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2f60abe7-6fae-3bc4-5d92-d917c557859b job-originating-host-name=10.12.34.41 time-at-creation=1436551607 time-at-processing=1436551607', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:06:48.332375', 'P1L09');
INSERT INTO jobhistory VALUES (190, '413', 3, 5, 422, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00413-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:6a25295b-36ea-363d-7a1f-35cf2c419985 job-originating-host-name=10.12.34.41 time-at-creation=1436551611 time-at-processing=1436551611', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:06:52.136344', 'P1L09');
INSERT INTO jobhistory VALUES (191, '414', 3, 5, 424, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00414-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:79ce9cdd-2346-3443-7322-b0838c23e840 job-originating-host-name=10.12.34.41 time-at-creation=1436551618 time-at-processing=1436551618', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:06:58.802784', 'P1L09');
INSERT INTO jobhistory VALUES (192, '415', 3, 5, 426, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00415-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:498baa4f-6040-3d77-73d9-fc7e654483df job-originating-host-name=10.12.34.41 time-at-creation=1436551629 time-at-processing=1436551629', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:07:10.148497', 'P1L09');
INSERT INTO jobhistory VALUES (193, '416', 3, 5, 428, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00416-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:7bf9e108-537e-3808-625b-19f061601e0d job-originating-host-name=10.12.34.41 time-at-creation=1436551636 time-at-processing=1436551636', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:07:16.935191', 'P1L09');
INSERT INTO jobhistory VALUES (194, '417', 3, 5, 430, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00417-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:6ae600f4-b8e7-3ff0-6f2e-30c604e1fa76 job-originating-host-name=10.12.34.41 time-at-creation=1436551640 time-at-processing=1436551640', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:07:21.307343', 'P1L09');
INSERT INTO jobhistory VALUES (195, '418', 3, 5, 432, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00418-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:acc40764-9b3d-3b49-423b-46674ee13b2e job-originating-host-name=10.12.34.41 time-at-creation=1436551643 time-at-processing=1436551643', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 14:07:24.195283', 'P1L09');
INSERT INTO jobhistory VALUES (196, '419', 3, 5, 434, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00419-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:1538b94c-8061-3005-4b65-fa8e9b8fdab7 job-originating-host-name=10.12.34.41 time-at-creation=1436555137 time-at-processing=1436555137', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:05:37.803008', 'P1L09');
INSERT INTO jobhistory VALUES (197, '420', 3, 5, 436, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00420-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:8bebeb9c-1f60-394e-7275-e88025070285 job-originating-host-name=10.12.34.41 time-at-creation=1436555145 time-at-processing=1436555145', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:05:45.651269', 'P1L09');
INSERT INTO jobhistory VALUES (198, '421', 3, 5, 438, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00421-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:0a93659d-69b3-340c-7a48-1aa587b8d94d job-originating-host-name=10.12.34.41 time-at-creation=1436555149 time-at-processing=1436555149', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:05:50.182062', 'P1L09');
INSERT INTO jobhistory VALUES (199, '422', 3, 5, 440, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00422-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:fff9b88d-55f2-3e1e-7ba5-e418e3e215c4 job-originating-host-name=10.12.34.41 time-at-creation=1436555203 time-at-processing=1436555203', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:06:43.665638', 'P1L09');
INSERT INTO jobhistory VALUES (200, '423', 3, 5, 442, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00423-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:d87a1487-f5b4-3f44-716e-8c0919dddac3 job-originating-host-name=10.12.34.41 time-at-creation=1436555209 time-at-processing=1436555209', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:06:49.971074', 'P1L09');
INSERT INTO jobhistory VALUES (201, '424', 3, 5, 444, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00424-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:e1fab554-97ee-3351-7ca8-88f515c1ddae job-originating-host-name=10.12.34.41 time-at-creation=1436555229 time-at-processing=1436555229', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:07:09.555321', 'P1L09');
INSERT INTO jobhistory VALUES (202, '425', 3, 5, 446, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00425-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:2e110dc8-ccc8-3466-76d7-83b66e9b743a job-originating-host-name=10.12.34.41 time-at-creation=1436555237 time-at-processing=1436555237', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:07:18.379722', 'P1L09');
INSERT INTO jobhistory VALUES (203, '426', 3, 5, 448, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00426-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:a5ecaa5e-db37-3ea6-7e82-554f71a69e00 job-originating-host-name=10.12.34.41 time-at-creation=1436555255 time-at-processing=1436555255', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:07:35.886523', 'P1L09');
INSERT INTO jobhistory VALUES (204, '427', 3, 5, 450, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00427-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:f140faa3-aac3-3f91-6e00-90c528052f5f job-originating-host-name=10.12.34.41 time-at-creation=1436555260 time-at-processing=1436555260', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:07:40.558768', 'P1L09');
INSERT INTO jobhistory VALUES (205, '428', 3, 5, 452, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00428-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:def695cf-d3c9-32ad-5c85-61c7290314d1 job-originating-host-name=10.12.34.41 time-at-creation=1436555266 time-at-processing=1436555266', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:07:46.866365', 'P1L09');
INSERT INTO jobhistory VALUES (206, '429', 3, 5, 454, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00429-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:bd17f63e-da60-3b32-7faa-43ce3d6dbb89 job-originating-host-name=10.12.34.41 time-at-creation=1436555302 time-at-processing=1436555302', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:08:22.880213', 'P1L09');
INSERT INTO jobhistory VALUES (207, '430', 3, 5, 456, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00430-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4c08bf34-a8c5-356a-74c5-dffd0da8935b job-originating-host-name=10.12.34.41 time-at-creation=1436555306 time-at-processing=1436555306', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:08:26.502162', 'P1L09');
INSERT INTO jobhistory VALUES (208, '431', 3, 5, 458, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00431-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:bd440e0a-4d4d-3f86-6ee1-589a67d128f3 job-originating-host-name=10.12.34.41 time-at-creation=1436555309 time-at-processing=1436555309', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:08:30.091141', 'P1L09');
INSERT INTO jobhistory VALUES (209, '432', 3, 5, 460, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00432-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:4fef77d0-da5d-3efb-41ff-c4b372b949b8 job-originating-host-name=10.12.34.41 time-at-creation=1436555318 time-at-processing=1436555318', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:08:38.600204', 'P1L09');
INSERT INTO jobhistory VALUES (210, '433', 3, 5, 462, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00433-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:08b7e457-916e-38af-5796-d9da7553f70a job-originating-host-name=10.12.34.41 time-at-creation=1436555321 time-at-processing=1436555321', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:08:42.068257', 'P1L09');
INSERT INTO jobhistory VALUES (211, '434', 3, 5, 464, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00434-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:c9067ad2-db68-390c-40fa-a70f1446e4c8 job-originating-host-name=10.12.34.41 time-at-creation=1436555522 time-at-processing=1436555522', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:02.430761', 'P1L09');
INSERT INTO jobhistory VALUES (212, '435', 3, 5, 466, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00435-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:317620d8-4eec-351f-4694-32a4f004af86 job-originating-host-name=10.12.34.41 time-at-creation=1436555530 time-at-processing=1436555530', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:11.287849', 'P1L09');
INSERT INTO jobhistory VALUES (213, '436', 3, 5, 468, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00436-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:ab786217-e3e5-3506-4e22-cab5b84a05b5 job-originating-host-name=10.12.34.41 time-at-creation=1436555544 time-at-processing=1436555544', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:24.789688', 'P1L09');
INSERT INTO jobhistory VALUES (214, '437', 3, 5, 470, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00437-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:a98b5c3d-4637-398f-6ce6-2812f2015ac2 job-originating-host-name=10.12.34.41 time-at-creation=1436555553 time-at-processing=1436555553', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:33.476251', 'P1L09');
INSERT INTO jobhistory VALUES (215, '438', 3, 5, 472, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00438-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:f6e8db1e-484b-330e-587e-6c5abbb9df84 job-originating-host-name=10.12.34.41 time-at-creation=1436555557 time-at-processing=1436555557', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:38.308864', 'P1L09');
INSERT INTO jobhistory VALUES (216, '439', 3, 5, 474, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00439-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:8b450770-8712-3f94-7ef6-316a89ae8a7b job-originating-host-name=10.12.34.41 time-at-creation=1436555564 time-at-processing=1436555564', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:45.334441', 'P1L09');
INSERT INTO jobhistory VALUES (217, '440', 3, 5, 476, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00440-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:dd2ba69f-c004-3d6f-770d-3979c5fbafa5 job-originating-host-name=10.12.34.41 time-at-creation=1436555568 time-at-processing=1436555568', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:12:48.918133', 'P1L09');
INSERT INTO jobhistory VALUES (218, '441', 3, 5, 478, 1125511, 2, 0, 'ALLOW', '/var/spool/cups/d00441-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:ddec6840-b2e7-338d-45ca-a2f7610bbf0f job-originating-host-name=10.12.34.41 time-at-creation=1436555599 time-at-processing=1436555599', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:13:20.421624', 'P1L09');
INSERT INTO jobhistory VALUES (219, '442', 3, 5, 480, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00442-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:a062cfc1-b2e3-317a-7050-b4feeec47e23 job-originating-host-name=10.12.34.41 time-at-creation=1436555678 time-at-processing=1436555678', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:14:39.200496', 'P1L09');
INSERT INTO jobhistory VALUES (220, '443', 3, 5, 483, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00443-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:5b109957-11f6-3e8f-7d70-c7b983b145b2 job-originating-host-name=10.12.34.41 time-at-creation=1436555685 time-at-processing=1436555685', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:14:45.614545', 'P1L09');
INSERT INTO jobhistory VALUES (221, '444', 3, 5, 486, 72303, 3, 0, 'ALLOW', '/var/spool/cups/d00444-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:48e68e6f-a6a5-30d3-4f43-ee318dca92c6 job-originating-host-name=10.12.34.41 time-at-creation=1436555696 time-at-processing=1436555696', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:14:56.517363', 'P1L09');
INSERT INTO jobhistory VALUES (222, '445', 3, 5, 489, 72303, 3, 0, 'WARN', '/var/spool/cups/d00445-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:ee9465a5-3d86-304f-56a1-cbd5de588989 job-originating-host-name=10.12.34.41 time-at-creation=1436555721 time-at-processing=1436555721', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:15:21.736324', 'P1L09');
INSERT INTO jobhistory VALUES (223, '446', 3, 5, 492, 72303, 3, 0, 'WARN', '/var/spool/cups/d00446-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:8046c21e-0525-3bbf-5540-ba697460f09d job-originating-host-name=10.12.34.41 time-at-creation=1436555725 time-at-processing=1436555725', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:15:26.325444', 'P1L09');
INSERT INTO jobhistory VALUES (224, '447', 3, 5, 495, 72303, 3, 0, 'WARN', '/var/spool/cups/d00447-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:eb29dee5-a19a-3a43-6b82-f81a8c0e3c27 job-originating-host-name=10.12.34.41 time-at-creation=1436555750 time-at-processing=1436555750', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:15:51.078049', 'P1L09');
INSERT INTO jobhistory VALUES (225, '448', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00448-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:daeba631-0a93-3ba8-510f-816a19ac40b3 job-originating-host-name=10.12.34.41 time-at-creation=1436555754 time-at-processing=1436555754', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:15:54.304541', 'P1L09');
INSERT INTO jobhistory VALUES (226, '449', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00449-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:0ac8c673-f4db-3f05-5876-bc2c84031783 job-originating-host-name=10.12.34.41 time-at-creation=1436555757 time-at-processing=1436555757', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:15:57.664155', 'P1L09');
INSERT INTO jobhistory VALUES (227, '450', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00450-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:be667dde-8cc0-3d10-7318-9515c6d4e881 job-originating-host-name=10.12.34.41 time-at-creation=1436555768 time-at-processing=1436555768', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:16:08.610556', 'P1L09');
INSERT INTO jobhistory VALUES (228, '451', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00451-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:70fa2780-c544-3b0b-4b49-fdae8b32970a job-originating-host-name=10.12.34.41 time-at-creation=1436555771 time-at-processing=1436555771', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:16:11.774315', 'P1L09');
INSERT INTO jobhistory VALUES (229, '452', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00452-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:16c052a9-a3cc-3ba7-63fd-d569b42c02df job-originating-host-name=10.12.34.41 time-at-creation=1436555799 time-at-processing=1436555799', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:16:39.846648', 'P1L09');
INSERT INTO jobhistory VALUES (230, '453', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00453-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:121f68ee-9f34-3e54-40aa-89dd2cd58f61 job-originating-host-name=10.12.34.41 time-at-creation=1436555803 time-at-processing=1436555803', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:16:43.549378', 'P1L09');
INSERT INTO jobhistory VALUES (231, '454', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00454-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:1d1b7887-9005-358b-6589-084df76f7810 job-originating-host-name=10.12.34.41 time-at-creation=1436555876 time-at-processing=1436555876', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:17:56.63416', 'P1L09');
INSERT INTO jobhistory VALUES (232, '455', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00455-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:89a6f006-5164-3420-7dbd-0cc8899756eb job-originating-host-name=10.12.34.41 time-at-creation=1436555884 time-at-processing=1436555884', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:18:04.486999', 'P1L09');
INSERT INTO jobhistory VALUES (233, '456', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00456-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:5620cf9f-51dc-316b-51c6-5967facb936b job-originating-host-name=10.12.34.41 time-at-creation=1436555903 time-at-processing=1436555903', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:18:23.402361', 'P1L09');
INSERT INTO jobhistory VALUES (234, '457', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00457-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:c6c9469a-5005-3cc4-59c7-2419bb1f642d job-originating-host-name=10.12.34.41 time-at-creation=1436555953 time-at-processing=1436555953', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:19:14.247549', 'P1L09');
INSERT INTO jobhistory VALUES (235, '458', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00458-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:174f0b7a-5d80-303b-6993-2b5216b7d3d4 job-originating-host-name=10.12.34.41 time-at-creation=1436555958 time-at-processing=1436555958', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:19:18.29947', 'P1L09');
INSERT INTO jobhistory VALUES (236, '459', 3, 5, 0, 143812, 1, 0, 'WARN', '/var/spool/cups/d00459-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:5040fbee-2fe9-32fc-75ce-99d54cb9fd11 job-originating-host-name=10.12.34.41 time-at-creation=1436556009 time-at-processing=1436556009', '10.12.34.41', 'e30dfdc26d679836af3811f49e884186', NULL, NULL, 1, 0, '2015-07-10 15:20:10.049134', 'P1L09');
INSERT INTO jobhistory VALUES (237, '460', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00460-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:d7b49c5c-00b0-3348-519a-4864d6cc1aa8 job-originating-host-name=10.12.34.41 time-at-creation=1436556040 time-at-processing=1436556040', '10.12.34.41', 'bed33366e2fb774766bc0aa57530ac8a', NULL, NULL, 1, 0, '2015-07-10 15:20:41.213476', 'P1L09');
INSERT INTO jobhistory VALUES (238, '461', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00461-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:ace81569-b5c4-33d3-4e8f-96173003a3bb job-originating-host-name=10.12.34.41 time-at-creation=1436556056 time-at-processing=1436556056', '10.12.34.41', '37637a32834bdcabeb21d5d84fcd0b8f', NULL, NULL, 1, 0, '2015-07-10 15:20:56.685898', 'P1L09');
INSERT INTO jobhistory VALUES (239, '462', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00462-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:82434e87-94c2-387e-633d-2a853e568dcc job-originating-host-name=10.12.34.41 time-at-creation=1436556062 time-at-processing=1436556062', '10.12.34.41', '70ee3236562d14163c7d9bc5cae356ac', NULL, NULL, 1, 0, '2015-07-10 15:21:03.247287', 'P1L09');
INSERT INTO jobhistory VALUES (240, '463', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00463-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:92927985-f269-3eef-4615-ba637cc3354c job-originating-host-name=10.12.34.41 time-at-creation=1436556071 time-at-processing=1436556071', '10.12.34.41', 'e6d993834b59cb07659c489a8b5c2728', NULL, NULL, 1, 0, '2015-07-10 15:21:12.168964', 'P1L09');
INSERT INTO jobhistory VALUES (241, '464', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00464-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:831b0afd-f9a7-3a31-4433-4621c8270d4e job-originating-host-name=10.12.34.41 time-at-creation=1436556078 time-at-processing=1436556078', '10.12.34.41', '0d838417529dd45ac40ae30087525d57', NULL, NULL, 1, 0, '2015-07-10 15:21:18.831169', 'P1L09');
INSERT INTO jobhistory VALUES (242, '465', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00465-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:14414b48-2a5b-39d6-556a-d85aa8e43775 job-originating-host-name=10.12.34.41 time-at-creation=1436556084 time-at-processing=1436556084', '10.12.34.41', '3f3376471494334e06944a5eb3306a9b', NULL, NULL, 1, 0, '2015-07-10 15:21:24.527297', 'P1L09');
INSERT INTO jobhistory VALUES (243, '466', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00466-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:fb795aee-fa6f-3aa0-67a2-4a57e02c1016 job-originating-host-name=10.12.34.41 time-at-creation=1436556089 time-at-processing=1436556089', '10.12.34.41', '588d5568a93f9472489f60591f89517e', NULL, NULL, 1, 0, '2015-07-10 15:21:30.072529', 'P1L09');
INSERT INTO jobhistory VALUES (244, '467', 3, 5, 0, 143812, 0, 0, 'DENY', '/var/spool/cups/d00467-001', 'Página de prueba', 1, 'job-uuid=urn:uuid:1c4c6ac8-3f35-3b8c-62fd-078de28ed5a4 job-originating-host-name=10.12.34.41 time-at-creation=1436556092 time-at-processing=1436556092', '10.12.34.41', 'e8a5540f39fe3cf2ba86c624b76dd6b5', NULL, NULL, 1, 0, '2015-07-10 15:21:32.50771', 'P1L09');
INSERT INTO jobhistory VALUES (245, '468', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00468-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:808488dd-5b81-321f-4d49-80ea9f94a307 job-originating-host-name=10.12.34.41 time-at-creation=1436556098 time-at-processing=1436556098', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:21:38.611663', 'P1L09');
INSERT INTO jobhistory VALUES (246, '469', 3, 5, 0, 1125511, 0, 0, 'DENY', '/var/spool/cups/d00469-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:13964b2e-ee43-3b7b-7752-2b34a5e06130 job-originating-host-name=10.12.34.41 time-at-creation=1436556137 time-at-processing=1436556137', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:22:17.670154', 'P1L09');
INSERT INTO jobhistory VALUES (247, '470', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00470-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:733c819b-ff06-399d-5610-59c15ad8c080 job-originating-host-name=10.12.34.41 time-at-creation=1436556142 time-at-processing=1436556142', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:22:23.064415', 'P1L09');
INSERT INTO jobhistory VALUES (248, '471', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00471-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:4f6567da-3abd-3863-44fe-76c512a43357 job-originating-host-name=10.12.34.41 time-at-creation=1436556161 time-at-processing=1436556161', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:22:42.079562', 'P1L09');
INSERT INTO jobhistory VALUES (249, '472', 3, 5, 0, 1125511, 0, 0, 'DENY', '/var/spool/cups/d00472-001', 'Comandos crm shell.pdf', 1, 'job-uuid=urn:uuid:0f7be186-058e-3b72-5227-42ca8fed07d6 job-originating-host-name=10.12.34.41 time-at-creation=1436556183 time-at-processing=1436556183', '10.12.34.41', '5a56427b6a040485ae763f657e9bab7c', NULL, NULL, 2, 0, '2015-07-10 15:23:04.13156', 'P1L09');
INSERT INTO jobhistory VALUES (250, '473', 3, 5, 0, 72303, 0, 0, 'DENY', '/var/spool/cups/d00473-001', 'Pykota.pdf', 1, 'job-uuid=urn:uuid:3bb5e000-e407-351a-59f0-423fec5435b2 job-originating-host-name=10.12.34.41 time-at-creation=1436556195 time-at-processing=1436556195', '10.12.34.41', 'a4706e9fb2880b2a10eefb3f447117ee', NULL, NULL, 3, 0, '2015-07-10 15:23:15.362484', 'P1L09');
INSERT INTO jobhistory VALUES (251, '474', 3, 5, 0, 455, 0, 0, 'DENY', '/var/spool/cups/d00474-001', 'Microsoft Word - Doc1', 1, 'job-uuid=urn:uuid:b9c8cbe3-f580-3bd6-7cfb-81d45e04f8fb job-originating-host-name=10.12.34.41 time-at-creation=1436556306 time-at-processing=1436556306', '10.12.34.41', 'e8f7729e44740cb0aa239667d2dc4601', NULL, NULL, 1, 0, '2015-07-10 15:25:06.730113', 'P1L09');
INSERT INTO jobhistory VALUES (252, '475', 3, 5, 0, 455, 0, 0, 'DENY', '/var/spool/cups/d00475-001', 'Microsoft Word - Doc1', 1, 'job-uuid=urn:uuid:f3905e5b-cb13-32b1-5d4a-c416c686ca26 job-originating-host-name=10.12.34.41 time-at-creation=1436556416 time-at-processing=1436556416', '10.12.34.41', 'e8f7729e44740cb0aa239667d2dc4601', NULL, NULL, 1, 0, '2015-07-10 15:26:57.023261', 'P1L09');
INSERT INTO jobhistory VALUES (253, '476', 3, 5, 0, 455, 0, 0, 'DENY', '/var/spool/cups/d00476-001', 'Microsoft Word - Doc1', 1, 'job-uuid=urn:uuid:9818d037-77fd-3655-5ae7-665cc71e7ed3 job-originating-host-name=10.12.34.41 time-at-creation=1436556426 time-at-processing=1436556426', '10.12.34.41', 'e8f7729e44740cb0aa239667d2dc4601', NULL, NULL, 1, 0, '2015-07-10 15:27:06.318586', 'P1L09');
INSERT INTO jobhistory VALUES (254, '477', 3, 5, 0, 455, 0, 0, 'DENY', '/var/spool/cups/d00477-001', 'Microsoft Word - Doc1', 1, 'job-uuid=urn:uuid:af362413-8d43-3c4c-58d9-cef042ddaa78 job-originating-host-name=10.12.34.41 time-at-creation=1436556818 time-at-processing=1436556818', '10.12.34.41', 'e8f7729e44740cb0aa239667d2dc4601', NULL, NULL, 1, 0, '2015-07-10 15:33:38.419315', 'P1L09');
INSERT INTO jobhistory VALUES (255, '478', 3, 5, 0, 455, 0, 0, 'DENY', '/var/spool/cups/d00478-001', 'Microsoft Word - Doc1', 1, 'job-uuid=urn:uuid:7d9a0c9d-b50d-313a-7b75-cf801d1f48fa job-originating-host-name=10.12.34.41 time-at-creation=1436556839 time-at-processing=1436556839', '10.12.34.41', 'e8f7729e44740cb0aa239667d2dc4601', NULL, NULL, 1, 0, '2015-07-10 15:33:59.559179', 'P1L09');


--
-- TOC entry 2133 (class 0 OID 0)
-- Dependencies: 178
-- Name: jobhistory_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('jobhistory_id_seq', 255, true);


--
-- TOC entry 2134 (class 0 OID 0)
-- Dependencies: 179
-- Name: jobhistory_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('jobhistory_id_seq1', 1, false);


--
-- TOC entry 2135 (class 0 OID 0)
-- Dependencies: 180
-- Name: jobhistory_userid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('jobhistory_userid_seq', 1, false);


--
-- TOC entry 2081 (class 0 OID 84084)
-- Dependencies: 181 2098
-- Data for Name: payments; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--



--
-- TOC entry 2136 (class 0 OID 0)
-- Dependencies: 182
-- Name: payments_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('payments_id_seq', 1, false);


--
-- TOC entry 2137 (class 0 OID 0)
-- Dependencies: 183
-- Name: payments_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('payments_id_seq1', 1, true);


--
-- TOC entry 2138 (class 0 OID 0)
-- Dependencies: 184
-- Name: payments_userid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('payments_userid_seq', 1, false);


--
-- TOC entry 2085 (class 0 OID 84098)
-- Dependencies: 185 2098
-- Data for Name: printergroupsmembers; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO printergroupsmembers VALUES (7, 2, 'P1L09', 'P1L09');
INSERT INTO printergroupsmembers VALUES (7, 5, 'P1L09', 'P1L09');


--
-- TOC entry 2086 (class 0 OID 84106)
-- Dependencies: 186 2098
-- Data for Name: printers; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO printers VALUES (4, 'HP_LaserJetp6', 'HP LaserJet Professional P1606dn', 0, 0, false, 0, false, 'P1L09');
INSERT INTO printers VALUES (5, 'PDF_Printer', 'PDF_Printer', 0, 0, false, 0, false, 'P1L09');
INSERT INTO printers VALUES (6, 'Virtual_PDF_Printer', 'Virtual_PDF_Printer', 0, 0, false, 0, false, 'P1L09');
INSERT INTO printers VALUES (7, 'prueba', 'xdfsfd', 0, 0, false, 0, true, 'P1L09');
INSERT INTO printers VALUES (2, 'HP_LaserJet', 'HP LaserJet Professional P1606dn', 0, 0, NULL, 0, false, 'P1L09');
INSERT INTO printers VALUES (1, 'HP_HP_LaserJet_6P', 'HP HP LaserJet 6P', 0, 0, NULL, 0, false, 'P1L09');
INSERT INTO printers VALUES (3, 'HP_LaserJet_Professional_P1606dn', 'HP LaserJet Professional P1606dn', 0, 0, NULL, 0, false, 'P1L09');
INSERT INTO printers VALUES (11, 'ddddd', 'jhjk', 0, 0, false, 0, true, 'P1L09');
INSERT INTO printers VALUES (14, 'nnnlppp', 'nnnlppp', 0, 0, false, 0, true, 'P1L09');


--
-- TOC entry 2139 (class 0 OID 0)
-- Dependencies: 187
-- Name: printers_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('printers_id_seq', 7, true);


--
-- TOC entry 2140 (class 0 OID 0)
-- Dependencies: 188
-- Name: printers_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('printers_id_seq1', 14, true);


--
-- TOC entry 2089 (class 0 OID 84121)
-- Dependencies: 189 2098
-- Data for Name: server; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO server VALUES ('P1L10', 'MINFAR', 'Tieso Peres', true, 'P1L10', 'Piso 1 local 10');
INSERT INTO server VALUES ('P1L09', 'MINFAR', 'Perez Tieso', false, 'P1L09', 'P1L09');


--
-- TOC entry 2090 (class 0 OID 84128)
-- Dependencies: 190 2098
-- Data for Name: userpquota; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO userpquota VALUES (1, 1, 2, 7, 7, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (3, 2, 2, 0, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (4, 2, 5, 0, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (2, 1, 5, 1, 1, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (5, 3, 2, 0, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (10, 4, 2, 22, 22, 2, 2, NULL, 2, 2, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (11, 9, 2, 0, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (12, 9, 5, 0, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');
INSERT INTO userpquota VALUES (6, 3, 5, 498, 0, NULL, NULL, NULL, NULL, 0, 'P1L09', 'P1L09');


--
-- TOC entry 2141 (class 0 OID 0)
-- Dependencies: 191
-- Name: userpquota_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('userpquota_id_seq', 6, true);


--
-- TOC entry 2142 (class 0 OID 0)
-- Dependencies: 192
-- Name: userpquota_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('userpquota_id_seq1', 12, true);


--
-- TOC entry 2143 (class 0 OID 0)
-- Dependencies: 193
-- Name: userpquota_printerid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('userpquota_printerid_seq', 1, false);


--
-- TOC entry 2144 (class 0 OID 0)
-- Dependencies: 194
-- Name: userpquota_userid_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('userpquota_userid_seq', 1, false);


--
-- TOC entry 2095 (class 0 OID 84147)
-- Dependencies: 195 2098
-- Data for Name: users; Type: TABLE DATA; Schema: mod_pykota; Owner: postgres
--

INSERT INTO users VALUES (1, 'Tieso Martinez', 'tiesomar@minfar.cu', 25, 10, '13', 'Director General de autoservicios del piso 09', 15, 'P1L10');
INSERT INTO users VALUES (1, 'adonis', NULL, 0, 0, 'quota', 'sdsd', 1, 'P1L09');
INSERT INTO users VALUES (2, 'me', NULL, 0, 0, 'quota', 'sad', 1, 'P1L09');
INSERT INTO users VALUES (3, 'wxp', NULL, 0, 0, 'quota', 'dd', 1, 'P1L09');
INSERT INTO users VALUES (4, 'Mast', 'tiesmas', 1, 1, '12', '12', 12, 'P1L09');
INSERT INTO users VALUES (6, 'ertyuiioooooooooooo', NULL, 0, 0, 'quota', 'ertyuiioooooooooooo', 1, 'P1L09');
INSERT INTO users VALUES (9, 'tututut', NULL, 0, 0, 'quota', 'Nombre y apellidos', 1, 'P1L09');


--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 196
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 197
-- Name: users_id_seq1; Type: SEQUENCE SET; Schema: mod_pykota; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq1', 9, true);


--
-- TOC entry 1907 (class 2606 OID 84179)
-- Dependencies: 161 161 161 2099
-- Name: billingcodes_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY billingcodes
    ADD CONSTRAINT billingcodes_pkey PRIMARY KEY (id, serverid);


--
-- TOC entry 1910 (class 2606 OID 84181)
-- Dependencies: 164 164 164 2099
-- Name: coefficients_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY coefficients
    ADD CONSTRAINT coefficients_pkey PRIMARY KEY (id, printersserverid);


--
-- TOC entry 1914 (class 2606 OID 84183)
-- Dependencies: 168 168 168 2099
-- Name: grouppquota_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grouppquota
    ADD CONSTRAINT grouppquota_pkey PRIMARY KEY (id, groupsserverid);


--
-- TOC entry 1918 (class 2606 OID 84185)
-- Dependencies: 173 173 173 2099
-- Name: groups_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id, serverid);


--
-- TOC entry 1920 (class 2606 OID 84187)
-- Dependencies: 176 176 176 176 176 2099
-- Name: groupsmembers_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groupsmembers
    ADD CONSTRAINT groupsmembers_pkey PRIMARY KEY (groupid, userid, groupsserverid, usersserverid);


--
-- TOC entry 1925 (class 2606 OID 84189)
-- Dependencies: 177 177 177 2099
-- Name: jobhistory_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY jobhistory
    ADD CONSTRAINT jobhistory_pkey PRIMARY KEY (id, serverid);


--
-- TOC entry 1929 (class 2606 OID 84191)
-- Dependencies: 181 181 181 2099
-- Name: payments_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id, usersserverid);


--
-- TOC entry 1931 (class 2606 OID 84193)
-- Dependencies: 185 185 185 185 185 2099
-- Name: printergroupsmembers_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY printergroupsmembers
    ADD CONSTRAINT printergroupsmembers_pkey PRIMARY KEY (groupid, printerid, printersserverid, printersserverid2);


--
-- TOC entry 1933 (class 2606 OID 84195)
-- Dependencies: 186 186 186 2099
-- Name: printers_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY printers
    ADD CONSTRAINT printers_pkey PRIMARY KEY (id, serverid);


--
-- TOC entry 1936 (class 2606 OID 84197)
-- Dependencies: 189 189 2099
-- Name: server_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY server
    ADD CONSTRAINT server_pkey PRIMARY KEY (id);


--
-- TOC entry 1939 (class 2606 OID 84199)
-- Dependencies: 190 190 190 2099
-- Name: userpquota_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY userpquota
    ADD CONSTRAINT userpquota_pkey PRIMARY KEY (id, usersserverid);


--
-- TOC entry 1943 (class 2606 OID 84201)
-- Dependencies: 195 195 195 2099
-- Name: users_pkey; Type: CONSTRAINT; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id, serverid);


--
-- TOC entry 1905 (class 1259 OID 84202)
-- Dependencies: 161 2099
-- Name: billingcodes_billingcode_key; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX billingcodes_billingcode_key ON billingcodes USING btree (billingcode);


--
-- TOC entry 1908 (class 1259 OID 84203)
-- Dependencies: 164 164 2099
-- Name: coeffconstraint; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX coeffconstraint ON coefficients USING btree (printerid, label);


--
-- TOC entry 1911 (class 1259 OID 84204)
-- Dependencies: 168 2099
-- Name: grouppquota_g_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX grouppquota_g_id_ix ON grouppquota USING btree (groupid);


--
-- TOC entry 1912 (class 1259 OID 84205)
-- Dependencies: 168 2099
-- Name: grouppquota_p_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX grouppquota_p_id_ix ON grouppquota USING btree (printerid);


--
-- TOC entry 1915 (class 1259 OID 84206)
-- Dependencies: 168 168 2099
-- Name: grouppquota_up_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX grouppquota_up_id_ix ON grouppquota USING btree (groupid, printerid);


--
-- TOC entry 1916 (class 1259 OID 84207)
-- Dependencies: 173 2099
-- Name: groups_groupname_key; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX groups_groupname_key ON groups USING btree (groupname);


--
-- TOC entry 1921 (class 1259 OID 84208)
-- Dependencies: 177 2099
-- Name: jobhistory_hostname_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX jobhistory_hostname_ix ON jobhistory USING btree (hostname);


--
-- TOC entry 1922 (class 1259 OID 84209)
-- Dependencies: 177 2099
-- Name: jobhistory_p_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX jobhistory_p_id_ix ON jobhistory USING btree (printerid);


--
-- TOC entry 1923 (class 1259 OID 84210)
-- Dependencies: 177 177 2099
-- Name: jobhistory_pd_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX jobhistory_pd_id_ix ON jobhistory USING btree (printerid, jobdate);


--
-- TOC entry 1926 (class 1259 OID 84211)
-- Dependencies: 177 2099
-- Name: jobhistory_u_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX jobhistory_u_id_ix ON jobhistory USING btree (userid);


--
-- TOC entry 1927 (class 1259 OID 84212)
-- Dependencies: 181 2099
-- Name: payments_date_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX payments_date_ix ON payments USING btree (date);


--
-- TOC entry 1934 (class 1259 OID 84213)
-- Dependencies: 186 2099
-- Name: printers_printername_key; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX printers_printername_key ON printers USING btree (printername);


--
-- TOC entry 1937 (class 1259 OID 84214)
-- Dependencies: 190 2099
-- Name: userpquota_p_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX userpquota_p_id_ix ON userpquota USING btree (printerid);


--
-- TOC entry 1940 (class 1259 OID 84215)
-- Dependencies: 190 2099
-- Name: userpquota_u_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE INDEX userpquota_u_id_ix ON userpquota USING btree (userid);


--
-- TOC entry 1941 (class 1259 OID 84216)
-- Dependencies: 190 190 2099
-- Name: userpquota_up_id_ix; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX userpquota_up_id_ix ON userpquota USING btree (userid, printerid);


--
-- TOC entry 1944 (class 1259 OID 84217)
-- Dependencies: 195 2099
-- Name: users_username_key; Type: INDEX; Schema: mod_pykota; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX users_username_key ON users USING btree (username);


--
-- TOC entry 1946 (class 2606 OID 84218)
-- Dependencies: 1932 164 164 186 186 2099
-- Name: coefficients_printerid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY coefficients
    ADD CONSTRAINT coefficients_printerid_fkey FOREIGN KEY (printerid, printersserverid) REFERENCES printers(id, serverid);


--
-- TOC entry 1945 (class 2606 OID 84223)
-- Dependencies: 161 189 1935 2099
-- Name: fkbillingcod736427; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY billingcodes
    ADD CONSTRAINT fkbillingcod736427 FOREIGN KEY (serverid) REFERENCES server(id);


--
-- TOC entry 1949 (class 2606 OID 84228)
-- Dependencies: 173 189 1935 2099
-- Name: fkgroups179756; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT fkgroups179756 FOREIGN KEY (serverid) REFERENCES server(id);


--
-- TOC entry 1952 (class 2606 OID 84233)
-- Dependencies: 177 189 1935 2099
-- Name: fkjobhistory610158; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY jobhistory
    ADD CONSTRAINT fkjobhistory610158 FOREIGN KEY (serverid) REFERENCES server(id);


--
-- TOC entry 1956 (class 2606 OID 84238)
-- Dependencies: 186 1935 189 2099
-- Name: fkprinters48096; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY printers
    ADD CONSTRAINT fkprinters48096 FOREIGN KEY (serverid) REFERENCES server(id);


--
-- TOC entry 1959 (class 2606 OID 84243)
-- Dependencies: 195 189 1935 2099
-- Name: fkusers860748; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT fkusers860748 FOREIGN KEY (serverid) REFERENCES server(id);


--
-- TOC entry 1947 (class 2606 OID 84248)
-- Dependencies: 173 173 1917 168 168 2099
-- Name: grouppquota_groupid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY grouppquota
    ADD CONSTRAINT grouppquota_groupid_fkey FOREIGN KEY (groupid, groupsserverid) REFERENCES groups(id, serverid);


--
-- TOC entry 1948 (class 2606 OID 84253)
-- Dependencies: 168 168 186 186 1932 2099
-- Name: grouppquota_printerid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY grouppquota
    ADD CONSTRAINT grouppquota_printerid_fkey FOREIGN KEY (printerid, printersserverid) REFERENCES printers(id, serverid);


--
-- TOC entry 1950 (class 2606 OID 84258)
-- Dependencies: 176 176 173 173 1917 2099
-- Name: groupsmembers_groupid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY groupsmembers
    ADD CONSTRAINT groupsmembers_groupid_fkey FOREIGN KEY (groupid, groupsserverid) REFERENCES groups(id, serverid);


--
-- TOC entry 1951 (class 2606 OID 84263)
-- Dependencies: 195 176 176 195 1942 2099
-- Name: groupsmembers_userid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY groupsmembers
    ADD CONSTRAINT groupsmembers_userid_fkey FOREIGN KEY (userid, usersserverid) REFERENCES users(id, serverid);


--
-- TOC entry 1953 (class 2606 OID 84268)
-- Dependencies: 181 181 195 195 1942 2099
-- Name: payments_userid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY payments
    ADD CONSTRAINT payments_userid_fkey FOREIGN KEY (userid, usersserverid) REFERENCES users(id, serverid);


--
-- TOC entry 1954 (class 2606 OID 84273)
-- Dependencies: 185 185 186 186 1932 2099
-- Name: printergroupsmembers_groupid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY printergroupsmembers
    ADD CONSTRAINT printergroupsmembers_groupid_fkey FOREIGN KEY (groupid, printersserverid) REFERENCES printers(id, serverid);


--
-- TOC entry 1955 (class 2606 OID 84278)
-- Dependencies: 186 185 185 1932 186 2099
-- Name: printergroupsmembers_printerid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY printergroupsmembers
    ADD CONSTRAINT printergroupsmembers_printerid_fkey FOREIGN KEY (printerid, printersserverid2) REFERENCES printers(id, serverid);


--
-- TOC entry 1957 (class 2606 OID 84283)
-- Dependencies: 190 186 186 190 1932 2099
-- Name: userpquota_printerid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY userpquota
    ADD CONSTRAINT userpquota_printerid_fkey FOREIGN KEY (printerid, printersserverid) REFERENCES printers(id, serverid);


--
-- TOC entry 1958 (class 2606 OID 84288)
-- Dependencies: 1942 190 190 195 195 2099
-- Name: userpquota_userid_fkey; Type: FK CONSTRAINT; Schema: mod_pykota; Owner: postgres
--

ALTER TABLE ONLY userpquota
    ADD CONSTRAINT userpquota_userid_fkey FOREIGN KEY (userid, usersserverid) REFERENCES users(id, serverid);


--
-- TOC entry 2104 (class 0 OID 0)
-- Dependencies: 6
-- Name: mod_pykota; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA mod_pykota FROM PUBLIC;
REVOKE ALL ON SCHEMA mod_pykota FROM postgres;
GRANT ALL ON SCHEMA mod_pykota TO postgres;
GRANT ALL ON SCHEMA mod_pykota TO PUBLIC;


-- Completed on 2015-07-13 16:33:56 EDT

--
-- PostgreSQL database dump complete
--


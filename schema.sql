--
-- PostgreSQL database dump
--

-- Dumped from database version 14.13 (Homebrew)
-- Dumped by pg_dump version 14.13 (Homebrew)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: update_timestamp(); Type: FUNCTION; Schema: public; Owner: arcadia_admin
--

CREATE FUNCTION public.update_timestamp() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_timestamp() OWNER TO arcadia_admin;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: animal; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.animal (
    animal_id integer NOT NULL,
    prenom character varying(50) NOT NULL,
    species character varying(50) NOT NULL,
    etat character varying(50) NOT NULL,
    nourriture character varying(100) NOT NULL,
    dernier_controle_veterinaire date NOT NULL,
    details text,
    image_id integer,
    quantite character varying(255)
);


ALTER TABLE public.animal OWNER TO arcadia_admin;

--
-- Name: animal_animal_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.animal_animal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.animal_animal_id_seq OWNER TO arcadia_admin;

--
-- Name: animal_animal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.animal_animal_id_seq OWNED BY public.animal.animal_id;


--
-- Name: animal_history; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.animal_history (
    history_id integer NOT NULL,
    animal_id integer,
    modified_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    modified_by character varying(50),
    changes text
);


ALTER TABLE public.animal_history OWNER TO arcadia_admin;

--
-- Name: animal_history_history_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.animal_history_history_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.animal_history_history_id_seq OWNER TO arcadia_admin;

--
-- Name: animal_history_history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.animal_history_history_id_seq OWNED BY public.animal_history.history_id;


--
-- Name: avis; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.avis (
    avis_id integer NOT NULL,
    pseudo character varying(50) NOT NULL,
    commentaire character varying(50) NOT NULL,
    isvisible boolean DEFAULT true NOT NULL
);


ALTER TABLE public.avis OWNER TO arcadia_admin;

--
-- Name: avis_avis_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.avis_avis_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.avis_avis_id_seq OWNER TO arcadia_admin;

--
-- Name: avis_avis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.avis_avis_id_seq OWNED BY public.avis.avis_id;


--
-- Name: avis_habitat; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.avis_habitat (
    avis_habitat_id integer NOT NULL,
    habitat_id integer,
    avis text NOT NULL,
    redige_par character varying(50),
    date_avis timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.avis_habitat OWNER TO arcadia_admin;

--
-- Name: avis_habitat_avis_habitat_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.avis_habitat_avis_habitat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.avis_habitat_avis_habitat_id_seq OWNER TO arcadia_admin;

--
-- Name: avis_habitat_avis_habitat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.avis_habitat_avis_habitat_id_seq OWNED BY public.avis_habitat.avis_habitat_id;


--
-- Name: comporte; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.comporte (
    habitat_id integer NOT NULL,
    image_id integer NOT NULL
);


ALTER TABLE public.comporte OWNER TO arcadia_admin;

--
-- Name: consommation_nourriture; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.consommation_nourriture (
    consommation_id integer NOT NULL,
    animal_id integer,
    nourriture_id integer,
    date date NOT NULL,
    quantite integer NOT NULL
);


ALTER TABLE public.consommation_nourriture OWNER TO arcadia_admin;

--
-- Name: consommation_nourriture_consommation_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.consommation_nourriture_consommation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.consommation_nourriture_consommation_id_seq OWNER TO arcadia_admin;

--
-- Name: consommation_nourriture_consommation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.consommation_nourriture_consommation_id_seq OWNED BY public.consommation_nourriture.consommation_id;


--
-- Name: contact_messages; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.contact_messages (
    message_id integer NOT NULL,
    name character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    titre character varying(255) NOT NULL,
    message text NOT NULL,
    date_submitted timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.contact_messages OWNER TO arcadia_admin;

--
-- Name: contact_messages_message_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.contact_messages_message_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contact_messages_message_id_seq OWNER TO arcadia_admin;

--
-- Name: contact_messages_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.contact_messages_message_id_seq OWNED BY public.contact_messages.message_id;


--
-- Name: detient; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.detient (
    animal_id integer NOT NULL,
    habitat_id integer NOT NULL
);


ALTER TABLE public.detient OWNER TO arcadia_admin;

--
-- Name: dispose; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.dispose (
    animal_id integer NOT NULL,
    race_id integer NOT NULL
);


ALTER TABLE public.dispose OWNER TO arcadia_admin;

--
-- Name: formulaires_avis; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.formulaires_avis (
    formulaire_id integer NOT NULL,
    nom character varying(50) NOT NULL,
    message text NOT NULL,
    date_soumission timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    est_approuve boolean DEFAULT false
);


ALTER TABLE public.formulaires_avis OWNER TO arcadia_admin;

--
-- Name: formulaires_avis_formulaire_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.formulaires_avis_formulaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.formulaires_avis_formulaire_id_seq OWNER TO arcadia_admin;

--
-- Name: formulaires_avis_formulaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.formulaires_avis_formulaire_id_seq OWNED BY public.formulaires_avis.formulaire_id;


--
-- Name: habitat; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.habitat (
    habitat_id integer NOT NULL,
    nom character varying(255) NOT NULL,
    description character varying(255),
    description_rapide character varying(255),
    description_detaillee text,
    commentaire_habitat text,
    image_id integer
);


ALTER TABLE public.habitat OWNER TO arcadia_admin;

--
-- Name: habitat_habitat_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.habitat_habitat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.habitat_habitat_id_seq OWNER TO arcadia_admin;

--
-- Name: habitat_habitat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.habitat_habitat_id_seq OWNED BY public.habitat.habitat_id;


--
-- Name: horaires; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.horaires (
    horaire_id integer NOT NULL,
    jour_semaine character varying(15) NOT NULL,
    heure_ouverture time without time zone NOT NULL,
    heure_fermeture time without time zone NOT NULL
);


ALTER TABLE public.horaires OWNER TO arcadia_admin;

--
-- Name: horaires_horaire_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.horaires_horaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horaires_horaire_id_seq OWNER TO arcadia_admin;

--
-- Name: horaires_horaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.horaires_horaire_id_seq OWNED BY public.horaires.horaire_id;


--
-- Name: image; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.image (
    image_id integer NOT NULL,
    image_data bytea,
    image_path character varying(255),
    image_name character varying(255)
);


ALTER TABLE public.image OWNER TO arcadia_admin;

--
-- Name: image_image_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.image_image_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.image_image_id_seq OWNER TO arcadia_admin;

--
-- Name: image_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.image_image_id_seq OWNED BY public.image.image_id;


--
-- Name: nourriture; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.nourriture (
    nourriture_id integer NOT NULL,
    nom character varying(100) NOT NULL
);


ALTER TABLE public.nourriture OWNER TO arcadia_admin;

--
-- Name: nourriture_nourriture_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.nourriture_nourriture_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nourriture_nourriture_id_seq OWNER TO arcadia_admin;

--
-- Name: nourriture_nourriture_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.nourriture_nourriture_id_seq OWNED BY public.nourriture.nourriture_id;


--
-- Name: obtient; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.obtient (
    animal_id integer NOT NULL,
    rapport_veterinaire_id integer NOT NULL
);


ALTER TABLE public.obtient OWNER TO arcadia_admin;

--
-- Name: possede; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.possede (
    username character varying(50) NOT NULL,
    role_id integer NOT NULL
);


ALTER TABLE public.possede OWNER TO arcadia_admin;

--
-- Name: presentation; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.presentation (
    section_id integer NOT NULL,
    titre character varying(100),
    contenu text
);


ALTER TABLE public.presentation OWNER TO arcadia_admin;

--
-- Name: presentation_section_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.presentation_section_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.presentation_section_id_seq OWNER TO arcadia_admin;

--
-- Name: presentation_section_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.presentation_section_id_seq OWNED BY public.presentation.section_id;


--
-- Name: race; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.race (
    race_id integer NOT NULL,
    label character varying(50) NOT NULL
);


ALTER TABLE public.race OWNER TO arcadia_admin;

--
-- Name: race_race_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.race_race_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.race_race_id_seq OWNER TO arcadia_admin;

--
-- Name: race_race_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.race_race_id_seq OWNED BY public.race.race_id;


--
-- Name: rapport_veterinaire; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.rapport_veterinaire (
    rapport_veterinaire_id integer NOT NULL,
    animal_id integer,
    etat text NOT NULL,
    nourriture_proposee text NOT NULL,
    grammage integer NOT NULL,
    date_passage date NOT NULL,
    details text,
    redige_par character varying(50)
);


ALTER TABLE public.rapport_veterinaire OWNER TO arcadia_admin;

--
-- Name: rapport_veterinaire_rapport_veterinaire_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.rapport_veterinaire_rapport_veterinaire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rapport_veterinaire_rapport_veterinaire_id_seq OWNER TO arcadia_admin;

--
-- Name: rapport_veterinaire_rapport_veterinaire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.rapport_veterinaire_rapport_veterinaire_id_seq OWNED BY public.rapport_veterinaire.rapport_veterinaire_id;


--
-- Name: redige; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.redige (
    username character varying(50) NOT NULL,
    rapport_veterinaire_id integer NOT NULL
);


ALTER TABLE public.redige OWNER TO arcadia_admin;

--
-- Name: role; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.role (
    role_id integer NOT NULL,
    label character varying(255) NOT NULL
);


ALTER TABLE public.role OWNER TO arcadia_admin;

--
-- Name: role_role_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.role_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_role_id_seq OWNER TO arcadia_admin;

--
-- Name: role_role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.role_role_id_seq OWNED BY public.role.role_id;


--
-- Name: service_extra_info; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.service_extra_info (
    extra_info_id integer NOT NULL,
    service_id integer,
    title character varying(100) NOT NULL,
    text text NOT NULL
);


ALTER TABLE public.service_extra_info OWNER TO arcadia_admin;

--
-- Name: service_extra_info_extra_info_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.service_extra_info_extra_info_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_extra_info_extra_info_id_seq OWNER TO arcadia_admin;

--
-- Name: service_extra_info_extra_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.service_extra_info_extra_info_id_seq OWNED BY public.service_extra_info.extra_info_id;


--
-- Name: services; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.services (
    service_id integer NOT NULL,
    nom character varying(100) NOT NULL,
    description text,
    type character varying(50) NOT NULL,
    horaires text,
    prix numeric(10,2),
    image_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.services OWNER TO arcadia_admin;

--
-- Name: services_service_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.services_service_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.services_service_id_seq OWNER TO arcadia_admin;

--
-- Name: services_service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.services_service_id_seq OWNED BY public.services.service_id;


--
-- Name: type_compte_rendu; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.type_compte_rendu (
    type_id integer NOT NULL,
    label character varying(50) NOT NULL
);


ALTER TABLE public.type_compte_rendu OWNER TO arcadia_admin;

--
-- Name: type_compte_rendu_type_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.type_compte_rendu_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_compte_rendu_type_id_seq OWNER TO arcadia_admin;

--
-- Name: type_compte_rendu_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.type_compte_rendu_type_id_seq OWNED BY public.type_compte_rendu.type_id;


--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: arcadia_admin
--

CREATE TABLE public.utilisateur (
    user_id integer NOT NULL,
    username character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL,
    role_id integer
);


ALTER TABLE public.utilisateur OWNER TO arcadia_admin;

--
-- Name: utilisateur_user_id_seq; Type: SEQUENCE; Schema: public; Owner: arcadia_admin
--

CREATE SEQUENCE public.utilisateur_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_user_id_seq OWNER TO arcadia_admin;

--
-- Name: utilisateur_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arcadia_admin
--

ALTER SEQUENCE public.utilisateur_user_id_seq OWNED BY public.utilisateur.user_id;


--
-- Name: animal animal_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal ALTER COLUMN animal_id SET DEFAULT nextval('public.animal_animal_id_seq'::regclass);


--
-- Name: animal_history history_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal_history ALTER COLUMN history_id SET DEFAULT nextval('public.animal_history_history_id_seq'::regclass);


--
-- Name: avis avis_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.avis ALTER COLUMN avis_id SET DEFAULT nextval('public.avis_avis_id_seq'::regclass);


--
-- Name: avis_habitat avis_habitat_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.avis_habitat ALTER COLUMN avis_habitat_id SET DEFAULT nextval('public.avis_habitat_avis_habitat_id_seq'::regclass);


--
-- Name: consommation_nourriture consommation_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.consommation_nourriture ALTER COLUMN consommation_id SET DEFAULT nextval('public.consommation_nourriture_consommation_id_seq'::regclass);


--
-- Name: contact_messages message_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.contact_messages ALTER COLUMN message_id SET DEFAULT nextval('public.contact_messages_message_id_seq'::regclass);


--
-- Name: formulaires_avis formulaire_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.formulaires_avis ALTER COLUMN formulaire_id SET DEFAULT nextval('public.formulaires_avis_formulaire_id_seq'::regclass);


--
-- Name: habitat habitat_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.habitat ALTER COLUMN habitat_id SET DEFAULT nextval('public.habitat_habitat_id_seq'::regclass);


--
-- Name: horaires horaire_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.horaires ALTER COLUMN horaire_id SET DEFAULT nextval('public.horaires_horaire_id_seq'::regclass);


--
-- Name: image image_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.image ALTER COLUMN image_id SET DEFAULT nextval('public.image_image_id_seq'::regclass);


--
-- Name: nourriture nourriture_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.nourriture ALTER COLUMN nourriture_id SET DEFAULT nextval('public.nourriture_nourriture_id_seq'::regclass);


--
-- Name: presentation section_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.presentation ALTER COLUMN section_id SET DEFAULT nextval('public.presentation_section_id_seq'::regclass);


--
-- Name: race race_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.race ALTER COLUMN race_id SET DEFAULT nextval('public.race_race_id_seq'::regclass);


--
-- Name: rapport_veterinaire rapport_veterinaire_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.rapport_veterinaire ALTER COLUMN rapport_veterinaire_id SET DEFAULT nextval('public.rapport_veterinaire_rapport_veterinaire_id_seq'::regclass);


--
-- Name: role role_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.role ALTER COLUMN role_id SET DEFAULT nextval('public.role_role_id_seq'::regclass);


--
-- Name: service_extra_info extra_info_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.service_extra_info ALTER COLUMN extra_info_id SET DEFAULT nextval('public.service_extra_info_extra_info_id_seq'::regclass);


--
-- Name: services service_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.services ALTER COLUMN service_id SET DEFAULT nextval('public.services_service_id_seq'::regclass);


--
-- Name: type_compte_rendu type_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.type_compte_rendu ALTER COLUMN type_id SET DEFAULT nextval('public.type_compte_rendu_type_id_seq'::regclass);


--
-- Name: utilisateur user_id; Type: DEFAULT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN user_id SET DEFAULT nextval('public.utilisateur_user_id_seq'::regclass);


--
-- Name: animal_history animal_history_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal_history
    ADD CONSTRAINT animal_history_pkey PRIMARY KEY (history_id);


--
-- Name: animal animal_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_pkey PRIMARY KEY (animal_id);


--
-- Name: avis_habitat avis_habitat_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.avis_habitat
    ADD CONSTRAINT avis_habitat_pkey PRIMARY KEY (avis_habitat_id);


--
-- Name: avis avis_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_pkey PRIMARY KEY (avis_id);


--
-- Name: comporte comporte_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.comporte
    ADD CONSTRAINT comporte_pkey PRIMARY KEY (habitat_id, image_id);


--
-- Name: consommation_nourriture consommation_nourriture_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.consommation_nourriture
    ADD CONSTRAINT consommation_nourriture_pkey PRIMARY KEY (consommation_id);


--
-- Name: contact_messages contact_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.contact_messages
    ADD CONSTRAINT contact_messages_pkey PRIMARY KEY (message_id);


--
-- Name: detient detient_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.detient
    ADD CONSTRAINT detient_pkey PRIMARY KEY (animal_id, habitat_id);


--
-- Name: dispose dispose_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.dispose
    ADD CONSTRAINT dispose_pkey PRIMARY KEY (animal_id, race_id);


--
-- Name: formulaires_avis formulaires_avis_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.formulaires_avis
    ADD CONSTRAINT formulaires_avis_pkey PRIMARY KEY (formulaire_id);


--
-- Name: habitat habitat_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.habitat
    ADD CONSTRAINT habitat_pkey PRIMARY KEY (habitat_id);


--
-- Name: horaires horaires_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.horaires
    ADD CONSTRAINT horaires_pkey PRIMARY KEY (horaire_id);


--
-- Name: image image_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.image
    ADD CONSTRAINT image_pkey PRIMARY KEY (image_id);


--
-- Name: nourriture nourriture_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.nourriture
    ADD CONSTRAINT nourriture_pkey PRIMARY KEY (nourriture_id);


--
-- Name: obtient obtient_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.obtient
    ADD CONSTRAINT obtient_pkey PRIMARY KEY (animal_id, rapport_veterinaire_id);


--
-- Name: possede possede_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.possede
    ADD CONSTRAINT possede_pkey PRIMARY KEY (username, role_id);


--
-- Name: presentation presentation_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.presentation
    ADD CONSTRAINT presentation_pkey PRIMARY KEY (section_id);


--
-- Name: race race_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.race
    ADD CONSTRAINT race_pkey PRIMARY KEY (race_id);


--
-- Name: rapport_veterinaire rapport_veterinaire_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.rapport_veterinaire
    ADD CONSTRAINT rapport_veterinaire_pkey PRIMARY KEY (rapport_veterinaire_id);


--
-- Name: redige redige_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.redige
    ADD CONSTRAINT redige_pkey PRIMARY KEY (username, rapport_veterinaire_id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (role_id);


--
-- Name: service_extra_info service_extra_info_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.service_extra_info
    ADD CONSTRAINT service_extra_info_pkey PRIMARY KEY (extra_info_id);


--
-- Name: services services_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.services
    ADD CONSTRAINT services_pkey PRIMARY KEY (service_id);


--
-- Name: type_compte_rendu type_compte_rendu_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.type_compte_rendu
    ADD CONSTRAINT type_compte_rendu_pkey PRIMARY KEY (type_id);


--
-- Name: utilisateur utilisateur_email_key; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_email_key UNIQUE (email);


--
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (user_id);


--
-- Name: utilisateur utilisateur_username_key; Type: CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_username_key UNIQUE (username);


--
-- Name: services set_timestamp; Type: TRIGGER; Schema: public; Owner: arcadia_admin
--

CREATE TRIGGER set_timestamp BEFORE UPDATE ON public.services FOR EACH ROW EXECUTE FUNCTION public.update_timestamp();


--
-- Name: animal_history animal_history_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal_history
    ADD CONSTRAINT animal_history_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: animal animal_image_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_image_id_fkey FOREIGN KEY (image_id) REFERENCES public.image(image_id);


--
-- Name: avis_habitat avis_habitat_habitat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.avis_habitat
    ADD CONSTRAINT avis_habitat_habitat_id_fkey FOREIGN KEY (habitat_id) REFERENCES public.habitat(habitat_id);


--
-- Name: comporte comporte_habitat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.comporte
    ADD CONSTRAINT comporte_habitat_id_fkey FOREIGN KEY (habitat_id) REFERENCES public.habitat(habitat_id);


--
-- Name: comporte comporte_image_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.comporte
    ADD CONSTRAINT comporte_image_id_fkey FOREIGN KEY (image_id) REFERENCES public.image(image_id);


--
-- Name: consommation_nourriture consommation_nourriture_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.consommation_nourriture
    ADD CONSTRAINT consommation_nourriture_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: consommation_nourriture consommation_nourriture_nourriture_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.consommation_nourriture
    ADD CONSTRAINT consommation_nourriture_nourriture_id_fkey FOREIGN KEY (nourriture_id) REFERENCES public.nourriture(nourriture_id);


--
-- Name: detient detient_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.detient
    ADD CONSTRAINT detient_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: detient detient_habitat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.detient
    ADD CONSTRAINT detient_habitat_id_fkey FOREIGN KEY (habitat_id) REFERENCES public.habitat(habitat_id);


--
-- Name: dispose dispose_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.dispose
    ADD CONSTRAINT dispose_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: dispose dispose_race_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.dispose
    ADD CONSTRAINT dispose_race_id_fkey FOREIGN KEY (race_id) REFERENCES public.race(race_id);


--
-- Name: habitat fk_image_id; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.habitat
    ADD CONSTRAINT fk_image_id FOREIGN KEY (image_id) REFERENCES public.image(image_id) ON DELETE SET NULL;


--
-- Name: obtient obtient_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.obtient
    ADD CONSTRAINT obtient_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: obtient obtient_rapport_veterinaire_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.obtient
    ADD CONSTRAINT obtient_rapport_veterinaire_id_fkey FOREIGN KEY (rapport_veterinaire_id) REFERENCES public.rapport_veterinaire(rapport_veterinaire_id);


--
-- Name: rapport_veterinaire rapport_veterinaire_animal_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.rapport_veterinaire
    ADD CONSTRAINT rapport_veterinaire_animal_id_fkey FOREIGN KEY (animal_id) REFERENCES public.animal(animal_id);


--
-- Name: redige redige_rapport_veterinaire_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.redige
    ADD CONSTRAINT redige_rapport_veterinaire_id_fkey FOREIGN KEY (rapport_veterinaire_id) REFERENCES public.rapport_veterinaire(rapport_veterinaire_id);


--
-- Name: service_extra_info service_extra_info_service_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.service_extra_info
    ADD CONSTRAINT service_extra_info_service_id_fkey FOREIGN KEY (service_id) REFERENCES public.services(service_id);


--
-- Name: services services_image_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.services
    ADD CONSTRAINT services_image_id_fkey FOREIGN KEY (image_id) REFERENCES public.image(image_id);


--
-- Name: utilisateur utilisateur_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: arcadia_admin
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.role(role_id);


--
-- PostgreSQL database dump complete
--


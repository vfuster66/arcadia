-- Table `role`
CREATE TABLE IF NOT EXISTS role (
    role_id SERIAL PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

-- Table `utilisateur`
CREATE TABLE IF NOT EXISTS utilisateur (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    role_id INT REFERENCES role(role_id)
);

-- Relation entre utilisateur et role
CREATE TABLE IF NOT EXISTS possede (
    username VARCHAR(50),
    role_id INTEGER,
    FOREIGN KEY (username) REFERENCES utilisateur(username),
    FOREIGN KEY (role_id) REFERENCES role(role_id),
    PRIMARY KEY (username, role_id)
);

-- Table `services`
CREATE TABLE IF NOT EXISTS services (
    service_id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    type VARCHAR(50) NOT NULL,
    horaires TEXT,
    prix DECIMAL(10, 2),
    image_id INT REFERENCES image(image_id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Trigger function pour mettre à jour `updated_at`
CREATE OR REPLACE FUNCTION update_timestamp()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Trigger pour la table `services`
CREATE TRIGGER set_timestamp
BEFORE UPDATE ON services
FOR EACH ROW
EXECUTE FUNCTION update_timestamp();

-- Table `service_extra_info`
CREATE TABLE IF NOT EXISTS service_extra_info (
    extra_info_id SERIAL PRIMARY KEY,
    service_id INT REFERENCES services(service_id),
    title VARCHAR(100) NOT NULL,
    text TEXT NOT NULL
);

-- Table `image`
CREATE TABLE IF NOT EXISTS image (
    image_id SERIAL PRIMARY KEY,
    image_data BYTEA
);

-- Table `race`
CREATE TABLE IF NOT EXISTS race (
    race_id SERIAL PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

-- Table `habitat`
CREATE TABLE IF NOT EXISTS habitat (
    habitat_id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description VARCHAR(50),
    description_rapide VARCHAR(255),
    description_detaillee TEXT,
    commentaire_habitat VARCHAR(50)
);

-- Table `animal`
CREATE TABLE IF NOT EXISTS animal (
    animal_id SERIAL PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    species VARCHAR(50) NOT NULL,
    etat VARCHAR(50) NOT NULL,
    nourriture VARCHAR(100) NOT NULL,
    dernier_controle_veterinaire DATE NOT NULL,
    details TEXT,
    image_id INT REFERENCES image(image_id)
);

-- Table `animal_history`
CREATE TABLE IF NOT EXISTS animal_history (
    history_id SERIAL PRIMARY KEY,
    animal_id INT REFERENCES animal(animal_id),
    modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified_by VARCHAR(50),
    changes TEXT
);

-- Relation entre animal et race
CREATE TABLE IF NOT EXISTS dispose (
    animal_id INTEGER,
    race_id INTEGER,
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (race_id) REFERENCES race(race_id),
    PRIMARY KEY (animal_id, race_id)
);

-- Relation entre animal et habitat
CREATE TABLE IF NOT EXISTS detient (
    animal_id INTEGER,
    habitat_id INTEGER,
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id),
    PRIMARY KEY (animal_id, habitat_id)
);

-- Table `rapport_veterinaire`
CREATE TABLE IF NOT EXISTS rapport_veterinaire (
    rapport_veterinaire_id SERIAL PRIMARY KEY,
    animal_id INT REFERENCES animal(animal_id),
    etat TEXT NOT NULL,
    nourriture_proposee TEXT NOT NULL,
    grammage INT NOT NULL,
    date_passage DATE NOT NULL,
    details TEXT,
    redige_par VARCHAR(50) REFERENCES utilisateur(username)
);

-- Table `obtient`
CREATE TABLE IF NOT EXISTS obtient (
    animal_id INTEGER,
    rapport_veterinaire_id INTEGER,
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id),
    PRIMARY KEY (animal_id, rapport_veterinaire_id)
);

-- Relation entre habitat et image
CREATE TABLE IF NOT EXISTS comporte (
    habitat_id INTEGER,
    image_id INTEGER,
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id),
    FOREIGN KEY (image_id) REFERENCES image(image_id),
    PRIMARY KEY (habitat_id, image_id)
);

-- Table `redige`
CREATE TABLE IF NOT EXISTS redige (
    username VARCHAR(50),
    rapport_veterinaire_id INTEGER,
    FOREIGN KEY (username) REFERENCES utilisateur(username),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id),
    PRIMARY KEY (username, rapport_veterinaire_id)
);

-- Table `avis`
CREATE TABLE IF NOT EXISTS avis (
    avis_id SERIAL PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    commentaire VARCHAR(50) NOT NULL,
    isVisible BOOLEAN NOT NULL DEFAULT TRUE
);

-- Table `horaires`
CREATE TABLE IF NOT EXISTS horaires (
    horaire_id SERIAL PRIMARY KEY,
    jour_semaine VARCHAR(15) NOT NULL,
    heure_ouverture TIME NOT NULL,
    heure_fermeture TIME NOT NULL
);

-- Table `formulaires_avis`
CREATE TABLE IF NOT EXISTS formulaires_avis (
    formulaire_id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    date_soumission TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    est_approuve BOOLEAN DEFAULT FALSE
);

-- Table `presentation`
CREATE TABLE IF NOT EXISTS presentation (
    section_id SERIAL PRIMARY KEY,
    titre VARCHAR(100),
    contenu TEXT
);

-- Table `contact_messages`
CREATE TABLE IF NOT EXISTS contact_messages (
    message_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table `nourriture`
CREATE TABLE IF NOT EXISTS nourriture (
    nourriture_id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    type VARCHAR(100) NOT NULL,
    quantite_jour INTEGER NOT NULL,
    description TEXT
);

-- Table `consommation_nourriture`
CREATE TABLE IF NOT EXISTS consommation_nourriture (
    consommation_id SERIAL PRIMARY KEY,
    animal_id INTEGER REFERENCES animal(animal_id),
    nourriture_id INTEGER REFERENCES nourriture(nourriture_id),
    date DATE NOT NULL,
    quantite INTEGER NOT NULL
);

-- Table `avis_habitat`
CREATE TABLE IF NOT EXISTS avis_habitat (
    avis_habitat_id SERIAL PRIMARY KEY,
    habitat_id INT REFERENCES habitat(habitat_id),
    avis TEXT NOT NULL,
    redige_par VARCHAR(50) REFERENCES utilisateur(username),
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table `type_compte_rendu`
CREATE TABLE IF NOT EXISTS type_compte_rendu (
    type_id SERIAL PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

-- Insertion des rôles de base
INSERT INTO role (label) VALUES ('Employé'), ('Vétérinaire'), ('Administrateur');

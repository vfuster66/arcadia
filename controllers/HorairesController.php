<?php
require_once __DIR__ . '/../models/Horaires.php';

class HorairesController {
    private $horairesModel;

    public function __construct($db) {
        $this->horairesModel = new Horaires($db);
    }

    public function afficherHoraires() {
        $horaires = $this->horairesModel->getAllHoraires();
        include '../views/horairesView.php';
    }
}
?>

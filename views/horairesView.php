<ul>
    <?php foreach ($horaires as $horaire): ?>
        <li>
            <?php 
                // Conversion de l'heure d'ouverture et de fermeture au format HH:MM
                $heureOuverture = date('H:i', strtotime($horaire['heure_ouverture']));
                $heureFermeture = date('H:i', strtotime($horaire['heure_fermeture']));
            ?>
            <?php echo htmlspecialchars($horaire['jour_semaine']) . " : " . $heureOuverture . " - " . $heureFermeture; ?>
        </li>
    <?php endforeach; ?>
</ul>


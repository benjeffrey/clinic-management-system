
<?php 
// print_r(localeconv());


// Essayer de configurer plusieurs locales françaises pour s'assurer que l'une d'elles fonctionne
$locales = ['fr_FR.UTF-8', 'fr_FR.utf8', 'fr_FR', 'french'];

foreach ($locales as $locale) {
    if (setlocale(LC_TIME, $locale)) {
        break;
    }
}

date_default_timezone_set('Europe/Paris');

// Exemple de date récupérée de la base de données
$dateFromDatabase = '2023-06-01'; // Format YYYY-MM-DD

// Créer un objet DateTime à partir de la date
$date = new DateTime($dateFromDatabase);

// Obtenir le jour de la semaine et le mois en français
$dayOfWeek = strftime('%A', $date->getTimestamp());
$month = strftime('%B', $date->getTimestamp());

// Formater la date
$formattedDate = ucfirst($dayOfWeek) . ', le ' . $date->format('d') . ' ' . $month . ', ' . $date->format('Y');

// Afficher la date
echo $formattedDate;
?>

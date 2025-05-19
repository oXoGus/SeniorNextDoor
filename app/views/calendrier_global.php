<!DOCTYPE html>
<html lang="fr">
<script src="script/main_calendar.js" defer></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier Global</title>
    <link rel="stylesheet" href="style/Stylesheet.css">
</head>

<body>
    <header>
        <div class="nav-buttons">
            <div class="calenderSelection">
                <button onclick="location.href='home.php'"><img src="img/Home.svg" alt="Home"></button>
                <button class="active"><img src="img/CalendarArrowRight.svg" alt="Calendrier Global">Calendrier global</button>
            </div>

            <button onclick="location.href='calendrier_perso.php'">Calendrier personnel</button>
        </div>
    </header>
    <main>
        <section class="event-details-global">
            <div class="description">

                <h2></h2>
                <p></p>
                <p class="nb_inscrit"></p>

                <form action="calendrier_global.php" method="GET" style="display: none;">
                    <input type="hidden" name="event_id" value="">
                    <input type="hidden" name="event_date" value="">
                    <input type="submit" value="" class="button">
                </form>

                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['event_id'])) {
                        $eventId = $_GET['event_id'];
                        $eventDate = $_GET['event_date'];

                        $res = $cnx->prepare("SELECT * from calendrier_perso WHERE id_utilisateur = :user_id AND date_evenement = :event_date");
                        $res->execute([
                                        ':user_id' => $_SESSION['id'], 
                                        ':event_date' => $eventDate,
                                    ]);
                        if ($res->rowCount() == 1){
                                try {
                                    $stmt = $cnx->prepare("DELETE FROM calendrier_perso WHERE id_utilisateur = :user_id and date_evenement = :event_date");
                                    $stmt->execute([
                                        ':user_id' => $_SESSION['id'], 
                                        ':event_date' => $eventDate,
                                    ]);
                                    $stmt = $cnx->prepare("UPDATE calendrier_global SET nb_inscrit = nb_inscrit - 1 WHERE date_evenement = :event_date");
                                    $stmt->execute([
                                            ':event_date' => $eventDate,
                                        ]);

                                    echo "<p class='message'>Desincription réussie !</p>";

                                } catch (PDOException $e) {
                                    error_log("Failed to insert entry: " . $e->getMessage());
                                    echo "<p class='message'>Erreur lors de la desinscription.</p>";
                                }

                        } else{

                            try {
                                $stmt = $cnx->prepare("INSERT INTO calendrier_perso (id_utilisateur, date_evenement, id_evenement) VALUES (:user_id,:event_date, :event_id)");
                                $stmt->execute([
                                    ':user_id' => $_SESSION['id'], 
                                    ':event_date' => $eventDate,
                                    ':event_id' => $eventId
                                ]);
                                $stmt = $cnx->prepare("UPDATE calendrier_global SET nb_inscrit = nb_inscrit + 1 WHERE date_evenement = :event_date");
                                $stmt->execute([
                                        ':event_date' => $eventDate,
                                    ]);
                                echo "<p class='message'>Inscription réussie !</p>";
                                
                            } catch (PDOException $e) {
                                error_log("Failed to insert entry: " . $e->getMessage());
                                echo "<p class='message'>Erreur lors de l'inscription.</p>";
                            }
                        }
                    }
                ?>
            </div>
        </section>
        
        <section class="calendar-section-global">
            <div class="calendar-header">
                <button id="prev-month"><img src="img/CalendarArrowLeft.svg" alt="Previous month"></button>
                <div class="monthYear" id="monthYear"></div>
                <button id="next-month"><img src="img/CalendarArrowRight.svg" alt="Next month"></button>
            </div>
            <div class="days">
                <div class="day">Lun</div>
                <div class="day">Mar</div>
                <div class="day">Mer</div>
                <div class="day">Jeu</div>
                <div class="day">Ven</div>
                <div class="day">Sam</div>
                <div class="day">Dim</div>
            </div>
            <div class="dates" id="dates"></div>
            
        </section>
    </main>
    <?php
        try {
            $res = $cnx->query("SELECT c.date_evenement , c.id_evenement, c.nb_inscrit , e.titre_evenement , e.desc_evenement FROM calendrier_global c JOIN evenement e ON c.id_evenement = e.id_evenement");
            $infos = [];
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $infos[] = [
                    'date' => $row['date_evenement'],
                    'id' => $row['id_evenement'],
                    'titre' => $row['titre_evenement'],
                    'description' => $row['desc_evenement'],
                    'nb_inscrit' => $row['nb_inscrit']
                ];
            }
            $id = $_SESSION['id'];
            $res = $cnx->query("SELECT date_evenement FROM calendrier_perso WHERE id_utilisateur = $id");
            $mesDates = [];
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $mesDates[] = [
                    'date' => $row['date_evenement'],
                ];
            }
        } catch (Exception $e) {
            error_log("Database query failed: " . $e->getMessage());
            $infos = [];
            $mesDates = [];
        }
    ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const eventDates = <?php echo json_encode($infos); ?>;
        const myDates = <?php echo json_encode($mesDates); ?>;

        const attachDateClickListeners = () => {
            const dateElements = document.querySelectorAll("#dates .date");
            const eventTitle = document.querySelector(".event-details-global h2");
            const eventDescription = document.querySelector(".event-details-global .description p");
            const eventInscrit = document.querySelector(".event-details-global .description .nb_inscrit");
            const message = document.querySelector('.event-details-global .message');
            const form = document.querySelector(".event-details-global form");

            dateElements.forEach(dateElement => {
                dateElement.addEventListener("click", function() {
                    const clickedDate = this.getAttribute("data-date");
                    const event = eventDates.find(event => event.date === clickedDate);

                    if (message) message.remove();

                    if (event) {
                        const subscribed = myDates.find(subscribed => subscribed.date === clickedDate);
                        if (subscribed) {
                            form.querySelector("input[type='submit']").value = "Se désinscrire";
                        } else {
                            form.querySelector("input[type='submit']").value = "S'inscrire";
                        }
                        eventTitle.textContent = event.titre + " le " + dateElement.getAttribute("title");
                        eventDescription.textContent = event.description;
                        eventInscrit.textContent = "nombre d'inscrits: " + event.nb_inscrit;
                        form.querySelector("input[name='event_date']").value = event.date;
                        form.querySelector("input[name='event_id']").value = event.id;
                        form.style.display = "block";
                    } else {
                        eventTitle.textContent = dateElement.getAttribute("title");
                        eventDescription.textContent = "aucun evénement trouvé";
                        eventInscrit.textContent = "";
                        form.style.display = "none";
                    }
                });
            });
        };

        attachDateClickListeners();
        document.addEventListener("calendarUpdated", attachDateClickListeners);
    });
</script>

</body>
</html>
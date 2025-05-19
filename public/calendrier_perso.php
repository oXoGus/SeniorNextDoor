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
                <button onclick="location.href='calendrier_global.php'">Calendrier Global</button>
            </div>

            <button class="active"><img src="img/CalendarArrowRight.svg" alt="Calendrier Personnel">Calendrier personnel</button>
        </div>
    </header>
    <main>
        <section class="calendar-section-perso">
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
            <input type="checkbox" id="check_pop_up" />
            <label for="check_pop_up" class="btn">Nouvel évenement</label>
            
            <div class="fond">
                <div class="pop_up">
                    <label for="check_pop_up" class="close"> X </label>
                    <form id="event-form" method="GET" action="calendrier_perso.php">
                        <label for="event-title">Titre de l'événement:</label>
                        <input type="text" id="event_title" name="event_title" required><br><br>
                            
                        <label for="event_date">Date de l'événement:</label>
                        <input type="date" id="event_date" name="event_date" required><br><br>
                            
                        <label for="event_description">Description:</label>
                        <textarea id="event_description" name="event_description" optional></textarea><br><br>
                            
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['event_title']) && isset($_GET['event_date'])) {
                    $eventTitle = $_GET['event_title'];
                    $eventDate = date('Y-m-d', strtotime($_GET['event_date'] . ' -1 day'));
                    $eventDescription = $_GET['event_description'];

                    $res = $cnx->prepare("SELECT * from calendrier_perso WHERE id_utilisateur = :user_id AND date_evenement = :event_date");
                    $res->execute([
                                    ':user_id' => $_SESSION['id'], 
                                    ':event_date' => $eventDate,
                                ]);

                    if ($res->rowCount() == 1){
                        echo "<p class='message'>Vous avez déjà un événement à cette date !</p>";
                    }
                    else {
                        try {
                        $res = $cnx->prepare("INSERT INTO evenement (titre_evenement, desc_evenement, nom_image) VALUES (:event_title, :event_description, 'default.jpg')");
                        $res->execute([
                                        ':event_title' => $eventTitle, 
                                        ':event_description' => $eventDescription,
                                    ]);
                                echo "<p class='message'>création de l'événement reussie !</p>";
                        } catch (PDOException $e) {
                            error_log("Failed to insert entry: " . $e->getMessage());
                            echo "<p class='message'>Erreur lors de la création de l'événement.</p>";
                        }
                        try {
                        $res = $cnx->prepare("INSERT INTO calendrier_perso (id_utilisateur, date_evenement, id_evenement) VALUES (:user_id,:event_date, :event_id)");
                                $res->execute([
                                    ':user_id' => $_SESSION['id'], 
                                    ':event_date' => $eventDate,
                                    ':event_id' => $cnx->lastInsertId(),
                                ]);
                         } catch (PDOException $e) {
                            error_log("Failed to insert entry: " . $e->getMessage());
                            echo "<p class='message'>Erreur lors de l'ajout de l'événement au calendrier personnel.</p>";
                        }
                    }
                }
            ?>
                        

        </section>
        <section class="event-details-perso">
            <div class="description">
                <h2></h2>
                <p></p>

                <form action="calendrier_perso.php" method="GET" style="display: none;">
                    <input type="hidden" name="event_id" value="">
                    <input type="hidden" name="event_date" value="">
                    <input type="submit" value="Supprimer cet évenement" class="button">
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

                                echo "<p class='message'>suppression réussie !</p>";

                            } catch (PDOException $e) {
                                error_log("Failed to insert entry: " . $e->getMessage());
                                echo "<p class='message'>Erreur lors de la suppression.</p>";
                            }

                        } 
                    }
                ?>
            </div>
        </section>
    </main>
    <?php
        try {
            $res = $cnx->query("SELECT c.date_evenement , c.id_evenement , c.id_utilisateur , e.titre_evenement , e.desc_evenement FROM calendrier_perso c JOIN evenement e ON c.id_evenement = e.id_evenement");
            $infos = [];
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $infos[] = [
                    'date' => $row['date_evenement'],
                    'id_ev' => $row['id_evenement'],
                    'id_us' => $row['id_utilisateur'],
                    'titre' => $row['titre_evenement'],
                    'description' => $row['desc_evenement']
                ];
            }
        } catch (Exception $e) {
            error_log("Database query failed: " . $e->getMessage());
            $infos = [];
        }
    ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const eventDates = <?php echo json_encode($infos); ?>;
        const userId = <?php echo json_encode($_SESSION['id']); ?>;

        const attachDateClickListeners = () => {
            const dateElements = document.querySelectorAll("#dates .date");
            const eventTitle = document.querySelector(".event-details-perso h2");
            const eventDescription = document.querySelector(".event-details-perso .description p");
            const form = document.querySelector(".event-details-perso form");
            const message = document.querySelector('.event-details-perso .message');

            dateElements.forEach(dateElement => {
                dateElement.addEventListener("click", function() {
                    const clickedDate = this.getAttribute("data-date");
                    const event = eventDates.find(event => event.date === clickedDate && Number(event.id_us) === Number(userId));

                    if (message) message.remove();

                    if (event) {
                        eventTitle.textContent = event.titre + " le " + dateElement.getAttribute("title");
                        eventDescription.textContent = event.description;
                        form.querySelector("input[name='event_date']").value = event.date;
                        form.querySelector("input[name='event_id']").value = event.id;
                        form.style.display = "block";
                    } else {
                        eventTitle.textContent = dateElement.getAttribute("title");
                        eventDescription.textContent = "aucun evénement trouvé";
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
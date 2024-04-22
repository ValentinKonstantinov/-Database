SELECT * 
FROM bookings b 
INNER JOIN tickets t ON t.book_ref = b.book_ref
JOIN boarding_passes bp ON bp.ticket_no = t.ticket_no
JOIN ticket_flights tf ON bp.ticket_no = tf.ticket_no
WHERE t.passenger_name = 'Gennadiy Nikitin' 
;

SELECT * 
FROM tickets t
WHERE t.passenger_name = 'Gennadiy Nikitin' 
;

BEGIN;
DELETE bp
FROM boarding_passes bp
JOIN ticket_flights tf ON bp.ticket_no = tf.ticket_no
WHERE tf.ticket_no IN (SELECT t.ticket_no FROM tickets t WHERE t.passenger_name = 'Gennadiy Nikitin' )
;

DELETE tf
FROM ticket_flights tf
JOIN tickets t ON t.ticket_no = tf.ticket_no
WHERE t.passenger_name = 'Gennadiy Nikitin' 
;

DELETE b
FROM bookings b 
INNER JOIN tickets t ON t.book_ref = b.book_ref
WHERE t.passenger_name = 'Gennadiy Nikitin'											
;

DELETE t
FROM tickets t 
WHERE t.passenger_name = 'Gennadiy Nikitin' 
;
ROLLBACK;

/*
INSERT INTO tickets
(ticket_no, book_ref, passe
VALUES
(

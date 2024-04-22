/*EXPLAIN ANALYZE*/
SELECT 
f.flight_no,
f.scheduled_departure,
count(s.seat_no)
FROM ticket_flights tf
INNER JOIN flights f ON tf.flight_id = f.flight_id
INNER JOIN aircrafts_data ad ON f.aircraft_code = ad.aircraft_code
INNER JOIN seats s ON ad.aircraft_code = s.aircraft_code
WHERE f.status = 'Scheduled' /*AND tf.fare_conditions = 'Economy' AND s.fare_conditions = 'Economy' */
	AND f.departure_airport = 'VVO' AND (f.arrival_airport = 'DME' OR f.arrival_airport = 'VKO')
GROUP BY f.flight_no, f.scheduled_departure
ORDER BY f.scheduled_departure DESC
LIMIT 10
;
EXPLAIN ANALYZE
SELECT 
f.flight_no,
f.actual_departure,
sum(tf.amount)
FROM ticket_flights tf
INNER JOIN flights f ON tf.flight_id = f.flight_id
WHERE f.status = 'Arrived'
GROUP BY f.flight_no, f.actual_departure
ORDER BY sum(tf.amount) DESC
LIMIT 10
;
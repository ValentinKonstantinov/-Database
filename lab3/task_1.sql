EXPLAIN ANALYZE
SELECT 
	t.ticket_no,
	GROUP_CONCAT(t.passenger_name),
	f.flight_no,
	f.scheduled_arrival,
	f.scheduled_departure
FROM ticket_flights tf
INNER JOIN tickets t ON tf.ticket_no = t.ticket_no
INNER JOIN flights f ON tf.flight_id = f.flight_id
WHERE t.book_ref = '58DF57'
GROUP BY t.ticket_no, f.flight_no, f.scheduled_arrival, f.scheduled_departure
;
# Covering index todo? Nested loop?
# кластерный некластерный и сколько деревьев в таблице
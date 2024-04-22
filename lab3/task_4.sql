EXPLAIN ANALYZE
SELECT 
	f.flight_no,
    f.actual_departure,
    f.actual_arrival
FROM flights f
WHERE f.status = 'Arrived' AND f.departure_airport = 'KRR' AND f.arrival_airport = 'KGD'
ORDER BY f.actual_departure DESC
LIMIT 1
;
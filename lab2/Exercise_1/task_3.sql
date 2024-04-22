EXPLAIN ANALYZE
SELECT *
FROM flights f
WHERE (f.departure_airport = 'CSY' OR f.arrival_airport = 'CSY') AND f.aircraft_code = 'SU9'
;
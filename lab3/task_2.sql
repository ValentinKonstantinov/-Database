EXPLAIN ANALYZE
SELECT 
ad.aircraft_code,
s.fare_conditions,
count(s.fare_conditions) AS seat_count
FROM aircrafts_data ad
INNER JOIN seats s ON ad.aircraft_code = s.aircraft_code
GROUP BY ad.aircraft_code, s.fare_conditions
;
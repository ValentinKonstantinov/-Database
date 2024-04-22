EXPLAIN ANALYZE
SELECT DISTINCT s.aircraft_code
FROM seats s
WHERE s.fare_conditions = "Comfort"
;
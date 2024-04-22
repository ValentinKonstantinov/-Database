EXPLAIN ANALYZE
SELECT 
	book_ref,
	total_amount
FROM bookings
ORDER BY total_amount
LIMIT 10
;
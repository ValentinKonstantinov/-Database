EXPLAIN ANALYZE
SELECT 
	b.book_ref,
	b.total_amount,
	t.passenger_name,
    t.contact_data
FROM bookings b 
INNER JOIN tickets t ON t.book_ref = b.book_ref
WHERE total_amount = (SELECT MAX(total_amount) FROM bookings)
;
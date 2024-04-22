EXPLAIN ANALYZE
SELECT 
b.book_ref,
GROUP_CONCAT(t.passenger_name)
FROM bookings b
INNER JOIN tickets t ON t.book_ref = b.book_ref
GROUP BY b.book_ref
HAVING substring(b.book_ref, 1, 3) = substring(b.book_ref, 4, 3)
;
#  сравнить результаты и планы выполнения запросов с WHERE и HAVING 
/*удалить соединение лишнее
SELECT
	GROUP_CONCAT(f.flight_id)
FROM flights f 
WHERE f.status = 'Delayed' AND (f.arrival_airport = 'DME'OR f.departure_airport = 'DME')
;


UPDATE flights f
SET f.status = 'Canselled'
WHERE f.status = 'Delayed' AND (f.arrival_airport = 'DME' OR f.departure_airport = 'DME')
;


UPDATE flights
SET flights.status = 'Delayed'
WHERE flights.flight_id IN (348,761,974,2469,5377,5858,34275,36780,46165,53170,59329) 
;

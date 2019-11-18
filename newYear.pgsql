CREATE or REPLACE FUNCTION NewYear ()
RETURNS TEXT AS $B$

DECLARE
BEGIN
	Update remaining_leaves set yearid = '-1' where yearid = '0';
	Update remaining_leaves set yearid = '0' where yearid = '1';
	Update remaining_leaves set yearid = '1' where yearid = '-1';
	Update remaining_leaves set daysleft = '20' where yearid = '1';
	return 'OK';
END;
$B$ LANGUAGE plpgsql;

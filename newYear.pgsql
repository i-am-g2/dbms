-- CREATE or REPLACE FUNCTION NewYear ()
-- RETURNS TEXT AS $B$

-- DECLARE
-- BEGIN
-- 	Update remaining_leaves set yearid = '-1' where yearid = '0';
-- 	Update remaining_leaves set yearid = '0' where yearid = '1';
-- 	Update remaining_leaves set yearid = '1' where yearid = '-1';
-- 	Update remaining_leaves set daysleft = '20' where yearid = '1';
-- 	return 'OK';
-- END;
-- $B$ LANGUAGE plpgsql;

CREATE or REPLACE FUNCTION NewYear()
RETURNS TEXT  As $AA$
DECLARE 
	curVar CURSOR For Select yearid from remaining_leaves;
	yearid_t Integer;
BEGIN

	open curVar;
	LOOP
		FETCH curVar into yearid_t;
	Exit when not FOUND;
		IF(yearid_t = 1) THEN 
			UPDATE remaining_leaves SET yearid = '0' WHERE CURRENT OF curVar;
		ElSE 
			UPDATE remaining_leaves SET yearid = '1' WHERE CURRENT OF curVar;
			UPDATE remaining_leaves SET  daysleft = '20' WHERE CURRENT OF curVar;
		END IF;
	END LOOP;
	close curVar;
	RETURN 'OK';
END;
$AA$ LANGUAGE plpgsql;
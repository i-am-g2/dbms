--This Trigger checks if the value of to_ passed in route is acceptable or not, for e.g. if I passed CSE_HOD in to_ but CSE_HOD is not present in faculty_pos table then this value is not acceptable

CREATE OR REPLACE FUNCTION bef_routes_update()
    RETURNS trigger as
$$
DECLARE
    count_ int;
BEGIN
    IF NEW.to_='Approved' OR NEW.to_='Disabled' THEN
        return NEW;
    END IF;
    select into count_ count(username) from faculty_pos where position=NEW.to_;
    IF count_=1 THEN
        return NEW;
    ELSIF count <1 THEN
         RAISE EXCEPTION 'Passed position not appointed';
    ELSIF count >1 THEN
        RAISE EXCEPTION 'DATABASE corrupt more than one person at same position, please contact developers';
    END IF;
    return NEW;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_routes_update_tr ON routes;

CREATE TRIGGER  bef_routes_update_tr
    BEFORE UPDATE
    ON routes
    FOR EACH Row
    EXECUTE Procedure bef_routes_update();


-------------------------------------------------
--This Trigger checks if the value of to_ passed in route is acceptable or not, for e.g. if I passed CSE_HOD in to_ but CSE_HOD is not present in faculty_pos table then this value is not acceptable

CREATE OR REPLACE FUNCTION bef_routes_insert()
    RETURNS trigger as
$$
DECLARE
    count_ int;
BEGIN
    IF NEW.to_='Approved' OR NEW.to_='Disabled' THEN
        return NEW;
    END IF;
    select into count_ count(username) from faculty_pos where position=NEW.to_;
    IF count_=1 THEN
        return NEW;
    ELSIF count <1 THEN
         RAISE EXCEPTION 'Passed position not appointed';
    ELSIF count >1 THEN
        RAISE EXCEPTION 'DATABASE corrupt more than one person at same position, please contact developers';
    END IF;
    RETURN NEW;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_routes_insert_tr ON routes;

CREATE TRIGGER bef_routes_insert_tr
    BEFORE INSERT
    ON routes
    FOR EACH Row
    EXECUTE Procedure bef_routes_insert();

----------------------------------------
--Input validation on faculty_pos
CREATE OR REPLACE FUNCTION bef_faculty_insert()
    RETURNS trigger as
$$
DECLARE
    count_ int;
BEGIN
    IF NEW.position='Faculty' OR NEW.position='Director' OR NEW.position!='DFA' OR NEW.position!='ADFA' THEN
        RETURN NEW;
    ELSIF NEW.position='CSE_HOD' AND NEW.dept!='CSE' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    ELSIF NEW.position='EE_HOD' AND NEW.dept!='EE' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    ELSIF NEW.position='EE_HOD' AND NEW.dept!='ME' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    END IF;
RAISE EXCEPTION 'Passed values not valid';
    
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_faculty_insert_tr ON faculty_pos;

CREATE TRIGGER bef_faculty_insert_tr
    BEFORE INSERT
    ON faculty_pos
    FOR EACH Row
    EXECUTE Procedure bef_faculty_insert();

---------------------------------------------------
--Input validation on faculty_pos
CREATE OR REPLACE FUNCTION bef_faculty_update()
    RETURNS trigger as
$$
DECLARE
    count_ int;
BEGIN
    IF NEW.position='Faculty' OR NEW.position='Director' OR NEW.position!='DFA' OR NEW.position!='ADFA' THEN
        RETURN NEW;
    ELSIF NEW.position='CSE_HOD' AND NEW.dept!='CSE' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    ELSIF NEW.position='EE_HOD' AND NEW.dept!='EE' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    ELSIF NEW.position='EE_HOD' AND NEW.dept!='ME' THEN
        RAISE EXCEPTION 'Passed position is not for passed department';
    END IF;
RAISE EXCEPTION 'Passed values not valid';
    
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_faculty_update_tr ON faculty_pos;

CREATE TRIGGER bef_faculty_update_tr
    BEFORE UPDATE
    ON faculty_pos
    FOR EACH Row
    EXECUTE Procedure bef_faculty_update();

-------------------------------------------------------------------
--if an hod iss deleted then the corresponding route is automaticaly set to the next person in the cycle.


CREATE OR REPLACE FUNCTION bef_faculty_delete()
    RETURNS trigger as
$$
DECLARE
    _to VARCHAR(50);
BEGIN
    IF OLD.position='Faculty' THEN
        RETURN OLD;
    ELSE 
        SELECT INTO _to to_ from routes where from_=OLD.position;
        UPDATE routes SET to_= _to where to_=OLD.position;
    END IF;
    RETURN OLD;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_faculty_delete_tr ON faculty_pos;

CREATE TRIGGER bef_faculty_delete_tr
    BEFORE DELETE
    ON faculty_pos
    FOR EACH Row
    EXECUTE Procedure bef_faculty_delete();


---------------------------
-----Delete comments and applications when user is deleted

CREATE OR REPLACE FUNCTION bef_user_delete()
    RETURNS trigger as
$$
BEGIN
    DELETE from applications where username=OLD.username;
    DELETE from comments where username=OLD.username;
    DELETE from remaining_leaves where username=OLD.username;
    RETURN OLD;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_user_delete_tr ON credentials;

CREATE TRIGGER bef_user_delete_tr
    BEFORE DELETE
    ON credentials
    FOR EACH Row
    EXECUTE Procedure bef_user_delete();



CREATE OR REPLACE FUNCTION bef_application_delete()
    RETURNS trigger as
$$
BEGIN
    DELETE from comments where app_id=OLD.id;
    RETURN OLD;
END
$$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bef_application_delete_tr ON applications;

CREATE TRIGGER bef_application_delete_tr
    BEFORE DELETE
    ON applications
    FOR EACH Row
    EXECUTE Procedure bef_application_delete();
-----------------------------------------------------------
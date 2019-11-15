--This Trigger checks if the value of to_ passed in route is acceptable or not, for e.g. if I passed CSE_HOD in to_ but CSE_HOD is not present in faculty_pos table then this value is not acceptable

CREATE OR REPLACE FUNCTION bef_routes_update()
    RETURNS trigger as
$$
DECLARE
    count_ int;
BEGIN
    IF NEW.to_='Approved' THEN
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
    IF NEW.to_='Approved' THEN
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



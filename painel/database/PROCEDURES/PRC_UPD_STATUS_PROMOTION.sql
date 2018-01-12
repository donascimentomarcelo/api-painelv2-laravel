DELIMITER $ 
	CREATE PROCEDURE PRC_UPD_STATUS_PROMOTION()
    BEGIN 
		DECLARE PROMOTION INT;
        DECLARE DATE_END DATE;
        
	DECLARE vCODIGO CURSOR FOR select id, dt_end  from promotions;
    
    
    OPEN vCODIGO;
    
		LOOP
			FETCH vCODIGO INTO PROMOTION, DATE_END;
			
			IF DATE_END < NOW() THEN
			
			update promotions set status = "inativo" where id IN (PROMOTION);
			
			END IF;
			
		END LOOP;
	
    CLOSE vCODIGO;
    
END

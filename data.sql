SELECT
    COUNT(workshop_id),
    DATE_FORMAT(starttime, '%Y-%m-%d') AS DAY,
    DATE_FORMAT(starttime, '%Y-%m') AS MONTH,
    DATE_FORMAT(starttime, '%Y') AS YEAR,

FROM
   wp_workshops 
WHERE
    YEAR = 2009
GROUP BY
    DATE_FORMAT(starttime, '%Y-%m-%d ');


SELECT DATE_FORMAT(starttime, '%Y-%m-%d') AS DAY, COUNT(workshop_id) as COUNT FROM wp_workshops GROUP BY DATE_FORMAT(starttime,'%Y-%m-%d');

SELECT CONCAT(DATE_FORMAT(starttime,'%H:%i'),'-',DATE_FORMAT(endtime,'%H:%i')) AS time,`session`,`track` FROM `wp_workshops` WHERE DATE_FORMAT(starttime, '%Y-%m-%d') BETWEEN '2021-10-21' AND '2021-10-21 23:59:59' ORDER BY `starttime`


/* integrate multiple fields into one field in mysql */
SELECT 'workshop_id', 'session', CONCAT(DATE_FORMAT('starttime','%H:%i'),'-',DATE_FORMAT('endtime','%H:%i')) AS time, GROUP_CONCAT('track' SEPARATOR ',') AS track  FROM `wp_workshops` WHERE DATE_FORMAT('starttime', '%Y-%m-%d') BETWEEN '2021-10-21' AND '2021-10-21 23:59:59' ORDER BY 'starttime'  




CREATE VIEW servciesview AS 
SELECT services.* , categories.* FROM `services`
INNER JOIN categories ON categories.categories_id = services.services_categories ; 



CREATE VIEW coursesview AS 
SELECT courses.* , catcourses.* FROM courses 
INNER JOIN catcourses ON catcourses.catcourses_id = courses.courses_type  ; 

CREATE VIEW expertsview AS 
SELECT experts.* , catexperts.* from experts 
INNER JOIN catexperts ON catexperts.catexperts_id = experts.experts_cat  ; 



CREATE VIEW orderscourseview as 
SELECT courses.* , orderscourse.* , users.* FROM orderscourse 
INNER JOIN courses ON courses.courses_id = orderscourse.orderscourse_courseid
INNER JOIN users ON  users.users_id = orderscourse.orderscourse_userid ; 



CREATE  VIEW  ordersserviceview AS 
SELECT ordersservice.* , services.* , users.* FROM ordersservice
INNER JOIN    services ON services.services_id = ordersservice.ordersservice_serviceid
INNER JOIN    users ON  users.users_id = ordersservice.ordersservice_userid ; 

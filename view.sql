CREATE VIEW restaurantsview AS 
SELECT typeres.* , restaurants.* FROM restaurants 
INNER JOIN typeres ON restaurants.restaurants_type = typeres.typeres_id  ; 

CREATE VIEW itemsfoodview AS 
SELECT itemsfood.* , categoriesfood.* , restaurants.* FROM itemsfood 
INNER JOIN categoriesfood ON categoriesfood.categoriesfood_id = itemsfood.itemsfood_cat
INNER JOIN restaurants ON restaurants.restaurants_id = categoriesfood.categoriesfood_restaurants ;  

 

CREATE VIEW subitemsfoodview AS 
SELECT itemsfood.* , subitemsfood.* FROM subitemsfood 
INNER JOIN itemsfood ON  itemsfood.itemsfood_id = subitemsfood.subitemsfood_items ; 


CREATE VIEW categoriesfoodview as 
SELECT categoriesfood.* , restaurants.* FROM categoriesfood
INNER JOIN restaurants ON restaurants.restaurants_id = categoriesfood.categoriesfood_restaurants ; 


CREATE view deliverywaysview AS
SELECT deliveryways.* , rdtw.*, restaurants.restaurants_name  , restaurants.restaurants_lat , restaurants.restaurants_long ,  restaurants.restaurants_maxdistance  FROM rdtw 
INNER JOIN  deliveryways ON deliveryways.deliveryways_id = rdtw.rdtw_deliveryways 
INNER JOIN restaurants  ON restaurants.restaurants_id = rdtw.rdtw_res ; 



CREATE VIEW ordersfoodview AS 
SELECT ordersfood.* , users.*  , restaurants.* , deliveryways.* FROM ordersfood 
INNER JOIN users ON users.users_id = ordersfood.ordersfood_users    
INNER JOIN restaurants ON restaurants.restaurants_id = ordersfood.ordersfood_res 
INNER JOIN deliveryways ON  deliveryways.deliveryways_type = ordersfood.ordersfood_type  ; 
 


CREATE VIEW ordersdetailsview AS 
SELECT ordersfooddetails.* , ordersfood.*  , itemsfood.* FROM ordersfooddetails 
INNER JOIN ordersfood ON ordersfood.ordersfood_id = ordersfooddetails.ordersfooddetails_ordersid 
INNER JOIN itemsfood ON itemsfood.itemsfood_id = ordersfooddetails.ordersfooddetails_itemsid   ; 



CREATE VIEW orderssubitemsfoofview AS
SELECT ordersfooddetails.* , orderssubitemsfood.* FROM ordersfooddetails 
INNER JOIN orderssubitemsfood ON ordersfooddetails.ordersfooddetails_parentid = orderssubitemsfood.orderssubitemsfood_itemsid ; 


-- Report Restaurants 
CREATE VIEW reportresview AS
SELECT DISTINCT(ordersfooddetails.ordersfooddetails_itemsid)
, SUM(ordersfooddetails_quantity) as countitems  
, COUNT(ordersfooddetails_itemsid) as countwithoutquantity
, itemsfood.itemsfood_name
, itemsfood.itemsfood_price * SUM(ordersfooddetails_quantity) as totalprice  
, ordersfood.ordersfood_date   , 
ordersfood.ordersfood_res
FROM ordersfooddetails  
INNER JOIN itemsfood ON itemsfood.itemsfood_id = ordersfooddetails.ordersfooddetails_itemsid
INNER JOIN ordersfood ON ordersfood.ordersfood_id = ordersfooddetails.ordersfooddetails_ordersid
GROUP BY ordersfooddetails.ordersfooddetails_itemsid ; 




CREATE VIEW deliveryfoodview AS 
SELECT delivery.* , restaurants.* FROM delivery 
INNER JOIN restaurants ON restaurants.restaurants_id = delivery.delivery_res ; 


CREATE VIEW ratingviewres AS
SELECT rating.rating_comment , rating.rating_sid , users.users_name FROM rating 
INNER JOIN users ON rating.rating_userid = users.users_id
WHERE  
 rating_comment != 'empty' AND rating.rating_type = 'restaurants' ; 



CREATE VIEW contactadminres AS 
SELECT contact.* , restaurants.* FROM contact 
INNER JOIN restaurants ON restaurants.restaurants_id = contact_sid 
WHERE contact_stype = 'restaurants' AND contact_rtype = 'admin' ; 

CREATE VIEW contactadminusers AS 
SELECT contact.* , users.* FROM contact 
INNER JOIN users ON users.users_id = contact_sid 
WHERE contact_stype = 'users' AND contact_rtype = 'admin' ; 



-- Important

SELECT restaurants.* , AVG(rating.rating_value) AS avg  FROM restaurants 
INNER JOIN rating ON rating.rating_sid = restaurants.restaurants_id
UNION ALL 
SELECT restaurants.* , 0 AS avg  FROM restaurants WHERE restaurants_id NOT IN (SELECT rating.rating_sid FROM rating WHERE rating.rating_sid = restaurants.restaurants_id) ; 
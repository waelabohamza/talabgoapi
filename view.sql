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
SELECT deliveryways.* , rdtw.*, restaurants.restaurants_name FROM rdtw 
INNER JOIN  deliveryways ON deliveryways.deliveryways_id = rdtw.rdtw_deliveryways 
INNER JOIN restaurants  ON restaurants.restaurants_id = rdtw.rdtw_res ; 



CREATE VIEW ordersfoodview AS 
SELECT ordersfood.* , users.*  , restaurants.* FROM ordersfood 
INNER JOIN users ON users.users_id = ordersfood.ordersfood_users    
INNER JOIN restaurants ON restaurants.restaurants_id = ordersfood.ordersfood_res ; 



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